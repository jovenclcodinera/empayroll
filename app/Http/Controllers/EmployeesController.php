<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('employees.index', [
            'employees' => Employee::with(['user', 'payrolls'])->get(),
            'departments' => Department::orderBy('name')->get(),
            'roles' => Role::orderBy('title')->get(),
        ]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $employee->update($request->except(['_token', '_method']));

        return redirect(route('employees.index'))->with('alert', [
            'type' => 'success',
            'message' => 'Employee successfully updated!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
    }

    public function updateBulk(Request $request) {
        $updateParams = [];
        if (isset($request->position)) {
            $updateParams['position'] = $request->position;
        }
        if (isset($request->department)) {
            $updateParams['department'] = $request->department;
        }
        Employee::whereIn('id', $request->checkedEmployees)->update($updateParams);
    }

    public function destroyBulk(Request $request) {
        Employee::whereIn('id', $request->checkedEmployees)->get()->each(function($employee) {
            $employee->user()->delete();
            $employee->payrolls()->delete();
        });
        Employee::whereIn('id', $request->checkedEmployees)->delete();
    }
}
