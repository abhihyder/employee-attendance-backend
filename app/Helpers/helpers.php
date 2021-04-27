<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

function getEmployeeByUser()
{
    $employee = DB::table('employees')->where('user_id', Auth::user()->id)->get();
    return $employee[0];
}
