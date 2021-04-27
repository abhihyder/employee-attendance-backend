<?php

use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

function getEmployeeByUser()
{
    $employee = DB::table('employees')->where('user_id', Auth::user()->id)->get();
    return $employee[0];
}

function getManagerInfo($employee)
{
    $manager = Employee::where('branch_id', $employee->branch_id)->get();
    return $manager[0];
}
