<?php

namespace App\Services;

use App\Models\AttendanceLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AttendanceLogService
{


    public function storeData(Request $request)
    {
        $attendanceLog = new AttendanceLog();
        $attendanceLog->user_id = $request->user_id;
        $attendanceLog->role_id = $request->role_id;
        $attendanceLog->branch_id = $request->branch_id;
        $attendanceLog->designation = $request->designation;
        $attendanceLog->save();
        return $attendanceLog;
    }

    public function updateData(Request $request, $attendanceLog)
    {
        $attendanceLog->user_id = $request->user_id;
        $attendanceLog->role_id = $request->role_id;
        $attendanceLog->branch_id = $request->branch_id;
        $attendanceLog->designation = $request->designation;
        $attendanceLog->save();
        return $attendanceLog;
    }

    public function storeValidation(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'role_id' => 'required|numeric',
            'branch_id' => 'required|numeric',
            'designation' => 'required',
        ]);

        return $validate;
    }
}
