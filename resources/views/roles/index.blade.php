@extends('layouts.app')

@section('title')
Empayroll | Roles
@stop

@section('header_title')
<h1 class="m-0" style="color: var(--primary)">Roles</h1>
<hr style="background-color: var(--primary)">
@stop

@section('content')

@include('roles.create')
@include('roles.show')
@include('roles.edit')

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    @if(in_array(auth()->user()->role, ['Tester', 'Admin']))
                        <button class="btn float-right button rounded-pill" data-toggle="modal"
                            data-target="#createRoleModal">
                            Create New
                        </button>
                    @endif
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-hover bg-white" id="rolesTable">
                        <thead class="text-center">
                            <tr>
                                <th>Title</th>
                                <th>Users Count</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach($roles as $role)
                                <tr>
                                    <td>{{$role->title}}</td>
                                    <td>{{$role->users->count()}}</td>
                                    <td>
                                        @if(Str::length($role->description) > 50)
                                            {{Str::limit($role->description, 50)}}
                                        @else
                                            @isset($role->description)
                                                {{$role->description}}
                                            @endisset
                                            @empty($role->description)
                                                No description has been provided for this role
                                            @endempty
                                        @endif
                                    </td>
                                    <td>
                                        <span data-toggle="tooltip" data-placement="top" title="View">
                                            <button class="btn btn-primary rounded-circle mx-1 btn-sm"
                                                data-toggle="modal" data-target="#showRoleModal"
                                                onclick="showRole('{{$role->id}}')">
                                                <i class="far fa-eye"></i>
                                            </button>
                                        </span>
                                        @if(in_array(auth()->user()->role, ['Tester', 'Admin']))
                                            <span data-toggle="tooltip" data-placement="top" title="Edit">
                                                <button class="btn btn-warning rounded-circle mx-1 btn-sm"
                                                    data-toggle="modal" data-target="#editRoleModal"
                                                    onclick="editRole('{{$role->id}}')">
                                                    <i class="far fa-edit"></i>
                                                </button>
                                            </span>
                                            <span data-toggle="tooltip" data-placement="top" title="Delete">
                                                <button class="btn btn-danger rounded-circle mx-1 btn-sm"
                                                    onclick="deleteRole('{{$role->id}}')">
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

@section('scripts')
<script>
    function showRole(id) {
        let roles = {!! $roles !!};
        let role = roles.find(role => role.id == id);
        $('#showRoleInfo dd:first').text(role.title);
        $('#showRoleInfo dd:last').text(role.description);
        $('#showRoleTable').DataTable().clear().destroy();
        role.users.forEach(user => {
            $('#showRoleTable tbody').append('<tr>' + 
                '<td>' + user.created_at + '</td>' +
                '<td>' + user.name + '</td>' +
                '<td>' + user.email + '</td>' +
                '<td>' + user.employee.position + '</td>' +
            '</tr>')
        });
        $('#showRoleTable').DataTable();
    }

    function editRole(id) {
        let roles = {!! $roles !!};
        role = roles.find(role => role.id == id);
        $('#editTitle').val(role.title);
        $('#editDescription').val(role.description);
        $('#editRoleForm').attr('action', '{{route('home')}}' + '/roles/' + id);
    }

    function deleteRole(id) {
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
                axios.delete('{{route('home')}}' + '/roles/' + id).then(() => {
                    Swal.fire(
                        'Deleted!',
                        'Role has been deleted.',
                        'success'
                    )
                    location.reload();
                });
            }
        })
    }

    $('#rolesTable').DataTable();
</script>
@stop