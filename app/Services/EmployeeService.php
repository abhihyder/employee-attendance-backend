<?php

namespace App\Services;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EmployeeService
{


    public function storeData(Request $request)
    {
        $employee = new Employee();
        $employee->user_id = $request->user_id;
        $employee->role_id = $request->role_id;
        $employee->branch_id = $request->branch_id;
        $employee->designation = $request->designation;
        $employee->save();
        return $employee;
    }

    public function updateData(Request $request, $employee)
    {
        $employee->user_id = $request->user_id;
        $employee->role_id = $request->role_id;
        $employee->branch_id = $request->branch_id;
        $employee->designation = $request->designation;
        $employee->save();
        return $employee;
    }

    public function storeValidation(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'user_id' => 'required|numeric|unique:employees,user_id',
            'role_id' => 'required|numeric',
            'branch_id' => 'required|numeric',
            'designation' => 'required',
        ]);

        return $validate;
    }
}
