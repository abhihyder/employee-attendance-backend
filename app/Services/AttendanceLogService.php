<?php

namespace App\Services;

use App\Models\AttendanceLog;
use App\Utilities\SettingConstant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AttendanceLogService
{


    public function checkIn($employee)
    {
        $attendanceLog = new AttendanceLog();
        $attendanceLog->employee_id = $employee->id;
        $attendanceLog->branch_id = $employee->branch_id;
        $attendanceLog->attendance_type = 1;
        $attendanceLog->attendance_date = date('Y-m-d');
        $attendanceLog->attendance_time = date('H:i:s');
        $attendanceLog->save();
        return $attendanceLog;
    }
    public function checkOut($employee)
    {
        $attendanceLog = new AttendanceLog();
        $attendanceLog->employee_id = $employee->id;
        $attendanceLog->branch_id = $employee->branch_id;
        $attendanceLog->attendance_type = 2;
        $attendanceLog->attendance_date = date('Y-m-d');
        $attendanceLog->attendance_time = date('H:i:s');
        $attendanceLog->save();
        return $attendanceLog;
    }


    public function checkinTimeValidation()
    {
        $check_in_time = (date('His')) - SettingConstant::CHECK_IN_TIME;
        if ($check_in_time >= 0) {
            return true;
        } else {
            return false;
        }
    }

    public function checkedInOrNot($employee)
    {
        $isCheckedIn = AttendanceLog::where('employee_id', $employee->id)->where('branch_id', $employee->branch_id)->where('attendance_type', 1)->where('attendance_date', date('Y-m-d'))->get();
        if (count($isCheckedIn) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function checkedOutOrNot($employee)
    {
        $isCheckedOut = AttendanceLog::where('employee_id', $employee->id)->where('branch_id', $employee->branch_id)->where('attendance_type', 2)->where('attendance_date', date('Y-m-d'))->get();
        if (count($isCheckedOut) > 0) {
            return true;
        } else {
            return false;
        }
    }
}
