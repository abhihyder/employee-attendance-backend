<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Services\EmployeeService;
use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeeResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    public $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  EmployeeResource::collection(Employee::all());
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

            $validate = $this->employeeService->storeValidation($request);

            if ($validate->fails()) {
                return response()->json([
                    'error' => [
                        'message' => 'Validation errors!',
                        'errors' => $validate->errors()
                    ]
                ]);
            }

            DB::beginTransaction();
            $employee = $this->employeeService->storeData($request);
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
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return  new EmployeeResource($employee);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        try {
            $validate = $this->employeeService->storeValidation($request);

            if ($validate->fails()) {
                return response()->json([
                    'error' => [
                        'message' => 'Validation errors!',
                        'errors' => $validate->errors()
                    ]
                ]);
            }

            DB::beginTransaction();
            $employee = $this->employeeService->updateData($request, $employee);
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
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return response()->json([
            'success' => [
                'message' => 'Employee Deleted Successfully!',
            ]
        ]);
    }
}
