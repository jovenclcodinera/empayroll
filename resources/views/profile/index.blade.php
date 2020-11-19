@extends('layouts.app')

@section('title')
Empayroll | Profile
@stop

@section('header_title')
<h1 class="m-0" style="color: var(--primary)">
    @if(auth()->user()->id == $user->id)
        My
    @else
        {{$user->name . "'s"}}
    @endif
    Profile
</h1>
<hr style="background-color: var(--primary)">
@stop

@section('content')

@include('profile.edit')
@include('payroll.edit')

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header"></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-sm-3 text-center">
                            <div style="position: relative">
                                <img
                                    src="@if(isset($user->employee->avatar_url)) {{asset('storage/' . $user->employee->avatar_url)}} @else {{asset('images/noimage.jpg')}} @endif"
                                    alt="avatar" class="img-fluid img-thumbnail w-100">
                                <form action="{{route('profile.update.avatar')}}" method="POST"
                                    id="editAvatarImageForm" enctype="multipart/form-data">
                                    @csrf
                                    <button class="btn btn-outline-secondary border-0 btn-flat p-1 small editImageButton"
                                        data-toggle="tooltip" data-placement="top" title="Edit Avatar"
                                        onclick="onChangeAvatar()" type="button">
                                        <i class="far fa-edit"></i>
                                    </button>
                                    <input type="file" id="editAvatarProfile" accept="image/*" class="d-none"
                                        onchange="selectedNewAvatar(event)" name="avatar">
                                </form>
                            </div>
                        </div>
                        <div class="col-12 col-sm-9" style="position: relative">
                            <span data-toggle="tooltip" data-placement="top" title="Edit Profile"
                                style="position: absolute;top: 0;right: 0;z-index:999">
                                <button class="btn btn-outline-dark rounded-circle small"
                                    data-toggle="modal" data-target="#editProfileModal">
                                    <i class="fas fa-user-edit"></i>
                                </button>
                            </span>
                            <dl class="row">
                                <dt class="col-sm-2">Name:</dt>
                                <dd class="col-sm-10 user-data">{{$user->name}}</dd>
                                <dt class="col-sm-2">Email:</dt>
                                <dd class="col-sm-10 user-data">{{$user->email}}</dd>
                                <dt class="col-sm-2">Position:</dt>
                                <dd class="col-sm-10 user-data">{{$user->employee->position}}</dd>
                                <dt class="col-sm-2">Department:</dt>
                                <dd class="col-sm-10 user-data">{{$user->employee->department}}</dd>
                                <dt class="col-sm-2">About Me:</dt>
                                <dd class="col-sm-10 user-data">{{$user->employee->about_me}}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-3">
            <div class="small-box">
                <div class="inner">
                  <h3>{{$user->employee->payrolls->count()}}</h3>
                  <p>Payrolls Issued</p>
                </div>
                <div class="icon">
                    <i class="fas fa-money-check-alt"></i>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-3">
            <div class="small-box">
                <div class="inner">
                  <h3>{{$user->employee->payrolls->max('gross')}}</h3>
                  <p>Maximum Gross</p>
                </div>
                <div class="icon">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-3">
            <div class="small-box">
                <div class="inner">
                  <h3>{{$user->employee->payrolls->min('gross')}}</h3>
                  <p>Minimum Gross</p>
                </div>
                <div class="icon">
                    <i class="far fa-money-bill-alt"></i>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-3">
            <div class="small-box">
                <div class="inner">
                  <h3>{{$user->employee->payrolls->sum('hours')}}</h3>
                  <p>Total Hours Worked</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-clock"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card card-outline">
                <div class="card-header">My Payrolls</div>
                <div class="card-body table-responsive">
                    <table class="table table-hover bg-white" id="profilePayrollsTable">
                        <thead class="text-center">
                            <tr>
                                <th>Date Issued</th>
                                <th>Overtime</th>  
                                <th>Hours</th>
                                <th>Rate</th>
                                <th>Gross</th>
                                <th>Approved</th>
                                @if(in_array(auth()->user()->role, ['Tester', 'Admin']))
                                    <th>Actions</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach($user->employee->payrolls as $payroll)
                                <tr>
                                    <td>{{$payroll->created_at}}</td>
                                    <td>{{$payroll->is_overtime == 1 ? 'Yes' : 'No'}}</td>
                                    <td>{{$payroll->hours}}</td>
                                    <td>{{$payroll->rate}}</td>
                                    <td>{{$payroll->gross}}</td>
                                    <td>{{$payroll->is_approved ? 'Yes' : 'No'}}</td>
                                    @if(in_array(auth()->user()->role, ['Tester', 'Admin']))
                                        <td>
                                            <span data-toggle="tooltip" data-placement="top" title="Edit">
                                                <button class="btn btn-warning rounded-circle mx-1 btn-sm"
                                                    data-toggle="modal" data-target="#editPayrollModal"
                                                    onclick="editPayroll('{{$payroll->id}}')">
                                                    <i class="far fa-edit"></i>
                                                </button>
                                            </span>
                                            <span data-toggle="tooltip" data-placement="top" title="Delete">
                                                <button class="btn btn-danger rounded-circle mx-1 btn-sm"
                                                    onclick="deletePayroll('{{$payroll->id}}')">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            </span>
                                        </td>
                                    @endif
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
    .user-data {
        color: var(--quaternary);
    }

    .small-box {
        background-color: var(--secondary) !important;
    }

    .small-box div p {
        color: var(--primary);
    }

    .editImageButton {
        position: absolute;
        top: 0;
        right: 0;
    }
</style>
@stop

@section('scripts')
<script>
    $('#profilePayrollsTable').DataTable({
        "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]]
    });
    let test = 'Hello';

    @error('avatar')
        Toast.fire({
            icon: "error",
            title: '{{$message}}'
        });
    @enderror

    function onChangeAvatar() {
        $('#editAvatarProfile').click();
    }

    function selectedNewAvatar() {
        $('#editAvatarImageForm').submit();
    }

    function editPayroll(id) {
        let payrolls = {!! $user->employee->payrolls !!};
        let payroll = payrolls.find(payroll => payroll.id == id);
        $('#editPayrollForm').attr('action', '{{route('home')}}' + '/payrolls/' + id);
        if (payroll.is_approved) {
            $('#editPayrollYes').prop('checked', true);
        } else {
            $('#editPayrollNo').prop('checked', true);
        }
        $('#editPayrollHours').val(payroll.hours);
        $('#editPayrollRate').val(payroll.rate);
    }

    function deletePayroll(id) {
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
                axios.delete('{{route('home')}}' + '/payrolls/' + id).then(() => {
                    Swal.fire(
                        'Deleted!',
                        'Payroll has been deleted.',
                        'success'
                    )
                    window.location.href = '{{route('profile.index')}}';
                });
            }
        })
    }
</script>
@stop
