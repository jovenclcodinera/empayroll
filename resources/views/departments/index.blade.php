@extends('layouts.app')

@section('title')
Empayroll | Departments
@stop

@section('header_title')
<h1 class="m-0" style="color: var(--primary)">Departments</h1>
<hr style="background-color: var(--primary)">
@stop

@section('content')

@include('departments.create')
@include('departments.show')
@include('departments.edit')

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    @if(in_array(auth()->user()->role, ['Tester', 'Admin']))
                        <button class="btn float-right button rounded-pill" data-toggle="modal"
                            data-target="#createDepartmentModal">
                            Create New
                        </button>
                    @endif
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-hover bg-white" id="departmentTable">
                        <thead class="text-center">
                            <tr>
                                <th>Name</th>
                                <th>Employees Count</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach($departments as $department)
                                <tr>
                                    <td>{{$department->name}}</td>
                                    <td>{{$department->employees->count()}}</td>
                                    <td>
                                        @if(Str::length($department->description) > 50)
                                            {{Str::limit($department->description, 50)}}
                                        @else
                                            {{$department->description}}
                                        @endif
                                    </td>
                                    <td>
                                        <span data-toggle="tooltip" data-placement="top" title="View">
                                            <button class="btn btn-primary rounded-circle mx-1 btn-sm"
                                                data-toggle="modal" data-target="#showDepartmentModal"
                                                onclick="showDepartment('{{$department->id}}')">
                                                <i class="far fa-eye"></i>
                                            </button>
                                        </span>
                                        @if(in_array(auth()->user()->role, ['Tester', 'Admin']))
                                            <span data-toggle="tooltip" data-placement="top" title="Edit">
                                                <button class="btn btn-warning rounded-circle mx-1 btn-sm"
                                                    data-toggle="modal" data-target="#editDepartmentModal"
                                                    onclick="editDepartment('{{$department->id}}')">
                                                    <i class="far fa-edit"></i>
                                                </button>
                                            </span>
                                            <span data-toggle="tooltip" data-placement="top" title="Delete">
                                                <button class="btn btn-danger rounded-circle mx-1 btn-sm"
                                                    onclick="deleteDepartment('{{$department->id}}')">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            </span>
                                        @endif()
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

@section('scripts')
<script>
    function showDepartment(id) {
        let departments = {!! $departments !!};
        department = departments.find(department => department.id == id);
        $('#showDepartmentInfo dd:first').text(department.name);
        $('#showDepartmentInfo dd:last').text(department.description);
        $('#showDepartmentTable').DataTable().clear().destroy();
        department.employees.forEach(employee => {
            $('#showDepartmentTable tbody').append('<tr>' + 
                '<td>' + employee.created_at + '</td>' +
                '<td>' + employee.user.name + '</td>' +
                '<td>' + employee.user.email + '</td>' +
                '<td>' + employee.position + '</td>' +
            '</tr>')
        });
        $('#showDepartmentTable').DataTable();
    };

    function editDepartment(id) {
        let departments = {!! $departments !!};
        department = departments.find(department => department.id == id);
        $('#editName').val(department.name);
        $('#editDescription').val(department.description);
        $('#editDepartmentForm').attr('action', '{{route('home')}}' + '/departments/' + id);
    };

    function deleteDepartment(id) {
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
                axios.delete('{{route('home')}}' + '/departments/' + id).then(() => {
                    Swal.fire(
                        'Deleted!',
                        'Department has been deleted.',
                        'success'
                    )
                    location.reload();
                });
            }
        })
    };

    $('#departmentTable').DataTable();
</script>
@stop