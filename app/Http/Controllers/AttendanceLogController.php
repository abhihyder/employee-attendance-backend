<?php

namespace App\Http\Controllers;

use App\Models\AttendanceLog;
use App\Services\AttendanceLogService;
use App\Http\Controllers\Controller;
use App\Http\Resources\AttentanceLogResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        // return  AttentanceLogResource::collection(AttendanceLog::all());
        return getEmployeeByUser();
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
    public function store(Request $request)
    {
        try {

            $validate = $this->attendanceLogService->storeValidation($request);

            if ($validate->fails()) {
                return response()->json([
                    'error' => [
                        'message' => 'Validation errors!',
                        'errors' => $validate->errors()
                    ]
                ]);
            }

            DB::beginTransaction();
            $employee = $this->attendanceLogService->storeData($request);
            DB::commit();
            return response()->json([
                'success' => [
                    'message' => 'Employee Created Successfully!',
                    'data' => $employee
                ]
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => [
                    'message' => 'Something went wrong!',
                ]
            ]);;
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
        //
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AttendanceLog  $attendanceLog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AttendanceLog $attendanceLog)
    {
        try {
            $validate = $this->attendanceLogService->storeValidation($request);

            if ($validate->fails()) {
                return response()->json([
                    'error' => [
                        'message' => 'Validation errors!',
                        'errors' => $validate->errors()
                    ]
                ]);
            }

            DB::beginTransaction();
            $employee = $this->attendanceLogService->updateData($request, $employee);
            DB::commit();
            return response()->json([
                'success' => [
                    'message' => 'Employee Updated Successfully!',
                    'data' => $employee
                ]
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => [
                    'message' => 'Something went wrong!',
                ]
            ]);;
        }
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
