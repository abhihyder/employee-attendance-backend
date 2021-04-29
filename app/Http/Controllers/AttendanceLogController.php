<?php

namespace App\Http\Controllers;

use App\Models\AttendanceLog;
use App\Services\AttendanceLogService;
use App\Http\Controllers\Controller;
use App\Utilities\SettingConstant;
use App\Http\Resources\AttentanceLogResource;
use App\Mail\AttendanceMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AttendanceLogController extends Controller
{
    public $attendanceLogService;

    public function __construct(AttendanceLogService $attendanceLogService)
    {
        $this->attendanceLogService = $attendanceLogService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  AttentanceLogResource::collection(AttendanceLog::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeChechIn(Request $request)
    {
        try {

            $checkinTime = $this->attendanceLogService->checkinTimeValidation();;

            if ($checkinTime === false) {

                return $this->errorReponse('You can not check-in before ' . date('h:i a', strtotime(SettingConstant::CHECK_IN_TIME)));
            }

            $employee = getEmployeeByUser();
            $checkedInOrNot = $this->attendanceLogService->checkedInOrNot($employee);

            if ($checkedInOrNot === true) {
                return $this->errorReponse('Already you have checked-in for today!');
            }

            DB::beginTransaction();
            $attendanceLog = $this->attendanceLogService->checkIn($employee);
            DB::commit();
            $manager = getBranchManagerInfo($attendanceLog);
            Mail::to($manager->user->email)->send(new AttendanceMail($attendanceLog));
            return $this->successReponseWithData('You have checked-in successfully!', $attendanceLog);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->errorReponse('Something went wrong!');
        }
    }

    public function storeChechOut(Request $request)
    {
        try {

            $employee = getEmployeeByUser();
            $checkedInOrNot = $this->attendanceLogService->checkedInOrNot($employee);

            if ($checkedInOrNot === false) {
                return $this->errorReponse('You have not checked-in yet today! Please check-in first.');
            }

            $checkedOutOrNot = $this->attendanceLogService->checkedOutOrNot($employee);

            if ($checkedOutOrNot === true) {
                return $this->errorReponse('You have done for today! Please check-in first on next day.');
            }

            DB::beginTransaction();
            $attendanceLog = $this->attendanceLogService->checkOut($employee);
            DB::commit();
            $manager = getBranchManagerInfo($attendanceLog);
            Mail::to($manager->user->email)->send(new AttendanceMail($attendanceLog));
            return $this->successReponseWithData('You have checked-out successfully!', $attendanceLog);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->errorReponse('Something went wrong!');
        }
    }

    public function checkedInOrNot()
    {
        $employee = getEmployeeByUser();
        $checkedInOrNot = $this->attendanceLogService->checkedInOrNot($employee);

        if ($checkedInOrNot === true) {
            return $this->successReponse('yes');
        } else {
            return $this->successReponse('no');
        }
    }

    public function checkedOutOrNot()
    {
        $employee = getEmployeeByUser();
        $checkedOutOrNot = $this->attendanceLogService->checkedOutOrNot($employee);

        if ($checkedOutOrNot === true) {
            return $this->successReponse('yes');
        } else {
            return $this->successReponse('no');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AttendanceLog  $attendanceLog
     * @return \Illuminate\Http\Response
     */
    public function show(AttendanceLog $attendanceLog)
    {
        return  new AttentanceLogResource($attendanceLog);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AttendanceLog  $attendanceLog
     * @return \Illuminate\Http\Response
     */
    public function edit(AttendanceLog $attendanceLog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AttendanceLog  $attendanceLog
     * @return \Illuminate\Http\Response
     */
    public function destroy(AttendanceLog $attendanceLog)
    {
        //
    }
}
