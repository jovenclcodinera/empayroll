<?php

namespace App\Http\Controllers;

use App\Http\Requests\departments\EditDepartmentRequest;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('departments.index', [
            'departments' => Department::all()->load(['employees' => function($employee) {
                $employee->with('user');
            }])
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:departments'
        ]);

        Department::create($request->only(['name', 'description']));

        return redirect(route('departments.index'))->with('alert', [
            'type' => 'success',
            'message' => 'Department successfully created!'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(EditDepartmentRequest $request, Department $department)
    {
        $department->update([
            'name' => $request->editName,
            'description' => $request->editDescription
        ]);

        return redirect(route('departments.index'))->with('alert', [
            'type' => 'success',
            'message' => 'Department successfully updated!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        $department->delete();
    }
}
