@extends('layouts.app')

@section('title')
Empayroll | Employees
@stop

@section('header_title')
<h1 class="m-0" style="color: var(--primary)">Employees</h1>
<hr style="background-color: var(--primary)">
@stop

@section('content')

@include('employees.show')
@include('employees.edit-bulk')

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="btn-group d-none" id="bulkActionsDropdown">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            Bulk Actions
                        </button>
                        <div class="dropdown-menu">
                          <button class="dropdown-item" onclick="onBulkAction('UPDATE')">Update</button>
                          <button class="dropdown-item" onclick="onBulkAction('DELETE')">Delete</button>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-hover bg-white" id="employeeTable">
                        <thead class="text-center">
                            <tr>
                                <th style="max-width: 100px">#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Position</th>
                                <th>Department</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach($employees as $employee)
                                <tr>
                                    <td>
                                        @if (auth()->user()->id != $employee->user->id)
                                            <div class="icheck-primary d-flex align-content-center align-items-center justify-content-center">
                                                <input type="checkbox" id="employeeCheckbox{{$loop->index}}"
                                                    onchange="employeeChecked('{{$employee->id}}')">
                                                <label for="employeeCheckbox{{$loop->index}}"></label>
                                            </div>
                                        @endif
                                    </td>
                                    <td>{{$employee->user->name}}</td>
                                    <td>{{$employee->user->email}}</td>
                                    <td>{{$employee->position}}</td>
                                    <td class="d-flex justify-content-center">
                                        @if (auth()->user()->id != $employee->user->id)
                                            <form action="{{route('employees.update', $employee->id)}}" method="POST"
                                                id="employeeEditDepartmentForm{{$loop->index}}">
                                                @csrf
                                                @method('PUT')
                                                <select name="department" class="form-control select2"
                                                    onchange="changeDepartment('{{$loop->index}}')">
                                                    @foreach($departments as $department)
                                                        <option value="{{$department->name}}"
                                                            @if($employee->department == $department->name) selected @endif>
                                                            {{$department->name}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </form>
                                        @else
                                            {{$employee->department}}
                                        @endif
                                    </td>
                                    <td>
                                        @if (auth()->user()->id != $employee->user->id)
                                            <form action="{{route('users.update', $employee->user->id)}}" method="POST"
                                                id="employeeEditRoleForm{{$loop->index}}">
                                                @csrf
                                                @method('PUT')
                                                <select name="role" class="form-control select2"
                                                    onchange="changeRole('{{$loop->index}}')">
                                                    @foreach($roles as $role)
                                                        <option value="{{$role->title}}"
                                                            @if($employee->user->role == $role->title) selected @endif>
                                                            {{$role->title}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </form>
                                        @else
                                            {{$employee->user->role}}
                                        @endif
                                    </td>
                                    <td>
                                        <span data-toggle="tooltip" data-placement="top" title="View">
                                            {{-- <button class="btn btn-primary rounded-circle m-1 btn-sm"
                                                data-toggle="modal" data-target="#showEmployeeModal"
                                                onclick="showEmployee('{{$employee->id}}')">
                                                <i class="far fa-eye"></i>
                                            </button> --}}
                                            <a href="{{route('profile.index', ['id' => $employee->user->id])}}" class="btn btn-primary rounded-circle m-1 btn-sm">
                                                <i class="far fa-eye"></i>
                                            </a>
                                        </span>
                                        @if($employee->user->id != auth()->user()->id)
                                            <span data-toggle="tooltip" data-placement="top" title="Delete">
                                                <button class="btn btn-danger rounded-circle m-1 btn-sm"
                                                    onclick="deleteEmployee('{{$employee->id}}')">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            </span>
                                        @endif
                                    </td>
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
    .dropdown-item:hover, .dropdown-item:focus{
        background-color: var(--tertiary) !important;
        color: var(--primary) !important;
    }
</style>
@stop

@section('scripts')
<script>
    let checkedEmployees = [];
    $('#employeeTable').DataTable();

    function showEmployee(id) {
        let employees = {!! $employees !!};
        employee = employees.find(employee => employee.id == id);
        if (employee.avatar_url) {
            $('#userPhoto').attr('src', 'storage/' + employee.avatar_url);
        } else {
            $('#userPhoto').attr('src', '{{asset('images/noimage.jpg')}}');
        }
        $('#showEmployeeInfo').children()[1].textContent = employee.user.name;
        $('#showEmployeeInfo').children()[3].textContent = employee.user.email;
        $('#showEmployeeInfo').children()[5].textContent = employee.position;
        $('#showEmployeeInfo').children()[7].textContent = employee.department;
        $('#showEmployeeInfo').children()[9].textContent = employee.user.role;
        $('#showEmployeeInfo').children()[11].textContent = employee.about_me;
        $('#showEmployeeTable').DataTable().clear().destroy();
        employee.payrolls.forEach(payroll => {
            let checkbox = $('<td>' + 1 + '</td>');
            let name = $('<td>' + payroll.created_at +'</td>');
            let overtime = $('<td>' + (payroll.is_overtime == '1' ? 'Yes' : 'No') +'</td>');
            let hours = $('<td>' + payroll.hours +'</td>');
            let rate = $('<td>' + payroll.rate +'</td>');
            let gross = $('<td>' + payroll.gross +'</td>');
            let newRow = $('<tr></tr>');
            $('#showEmployeeTable tbody').append(newRow);
            newRow
                .append(name)
                .append(overtime)
                .append(hours)
                .append(rate)
                .append(gross);
        });
        $('#showEmployeeTable').DataTable();
    }

    function deleteEmployee(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Only privileged users can revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3d5af1',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                axios.delete('{{route('home')}}' + '/employees/' + id).then(() => {
                    Swal.fire(
                        'Deleted!',
                        'Employee has been deleted.',
                        'success'
                    )
                    location.reload();
                });
            }
        })
    }

    function changeDepartment(index) {
        $('#employeeEditDepartmentForm' + index).submit();
    }

    function changeRole(index) {
        $('#employeeEditRoleForm' + index).submit();
    }

    function employeeChecked(id) {
        if (checkedEmployees.find(ids => ids == id)) {
            let index = checkedEmployees.findIndex(ids => ids == id)
            checkedEmployees.splice(index, 1);
        } else {
            checkedEmployees.push(id);
        }
        if (checkedEmployees.length > 0) {
            if ($('#bulkActionsDropdown').hasClass('d-none')) {
                $('#bulkActionsDropdown').removeClass('d-none');
            }
        } else {
            if (! $('#bulkActionsDropdown').hasClass('d-none')) {
                $('#bulkActionsDropdown').addClass('d-none');
            }
        }
    }

    function onBulkAction(action) {
        switch(action) {
            case 'UPDATE':
                $('#editBulkEmployeeModal').modal('show');
                break;
            case 'DELETE':
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Only Admins can revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3d5af1',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete them!'
                }).then((result) => {
                    if (result.value) {
                        axios.delete('{{route('employees.destroy.bulk')}}', {
                            data: {
                                checkedEmployees: checkedEmployees
                            }
                        })
                            .then(() => {
                                Swal.fire(
                                    'Deleted!',
                                    'The Employees were deleted.',
                                    'success'
                                )
                                window.location.href = '{{route('employees.index')}}';
                            })
                            .catch(error => {
                                Toast.fire({
                                    icon: "error",
                                    title: error.message
                                });
                            });
                    }
                })
                break;
        }
    }

    function onSubmitEditBulk() {
        axios.put('{{route('employees.edit.bulk')}}', {
            checkedEmployees: checkedEmployees,
            position: $('#editBulkPosition').val(),
            department: $('#editBulkDepartment option:selected').text()
        })
            .then(() => {
                Toast.fire({
                    icon: "success",
                    title: "Employees were successfully updated!"
                });
                $('#editBulkEmployeeModal').modal('hide');
                $('#editBulkForm').trigger('reset');
                window.location.href = '{{route('employees.index')}}';
            })
            .catch(error => {
                Toast.fire({
                    icon: "error",
                    title: error.message
                });
            });
    }
</script>
@stop