@extends('layouts.app')

@section('header_title')
<h1 class="m-0" style="color: var(--primary)">Dashboard</h1>
<hr style="background-color: var(--primary)">
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-6 col-sm-3">
            <div class="card card-outline">
                <div class="card-header text-center">Payrolls Issued</div>
                <div class="card-body text-center">
                    <h2>{{$payrollsCount}}</h2>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-3">
            <div class="card card-outline">
                <div class="card-header text-center">Employee Count</div>
                <div class="card-body text-center">
                    <h2>{{$employeesCount}}</h2>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-3">
            <div class="card card-outline">
                <div class="card-header text-center">Roles</div>
                <div class="card-body text-center">
                    <h2>{{$rolesCount}}</h2>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-3">
            <div class="card card-outline">
                <div class="card-header text-center">Departments</div>
                <div class="card-body text-center">
                    <h2>{{$departmentsCount}}</h2>
                </div>
            </div>
        </div>
    </div>
    <hr style="background-color: var(--primary);width: 50%">
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Latest Employees</div>
                <div class="card-body table-responsive">
                    <table class="table table-hover bg-white">
                        <thead class="text-center">
                            <tr>
                                <th>Date Added</th>
                                <th>Name</th>
                                <th>Email</th>  
                                <th>Position</th>
                                <th>Department</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach($latestEmployees as $employee)
                                <tr>
                                    <td>{{$employee->created_at}}</td>
                                    <td>{{$employee->user->name}}</td>
                                    <td>{{$employee->user->email}}</td>
                                    <td>{{$employee->position}}</td>
                                    <td>{{$employee->department}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <hr style="background-color: var(--primary);width: 50%">
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Latest Payrolls Issued</div>
                <div class="card-body table-responsive">
                    <table class="table table-hover bg-white">
                        <thead class="text-center">
                            <tr>
                                <th>Date Issued</th>
                                <th>Name</th>
                                <th>Overtime</th>
                                <th>Hours</th>
                                <th>Rate</th>
                                <th>Gross</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach($latestPayrolls as $payroll)
                                <tr>
                                    <td>{{$payroll->created_at}}</td>
                                    <td>{{$payroll->employee->user->name}}</td>
                                    <td>{{$payroll->is_overtime ? 'Yes' : 'No'}}</td>
                                    <td>{{$payroll->hours}}</td>
                                    <td>{{$payroll->rate}}</td>
                                    <td>{{$payroll->gross}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('styles')
<style>
    .card-header {
        background-color: var(--tertiary);
        color: var(--primary);
    }

    .card-body h2 {
        color: var(--quaternary);
    }
</style>
@stop