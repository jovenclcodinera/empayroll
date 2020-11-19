@extends('layouts.app')

@section('title')
Empayroll | Home
@stop

@section('content')
<div class="container">
    <div class="jumbotron jumbotron-fluid bg-transparent">
        <div class="container align-content-center align-items-center">
            <div class="row">
                <div class="col-12 text-center justify-content-center">
                    <h1 class="display-2 text-white">Employee</h1>
                    <h2 class="dipslay-3">Payroll System</h2>
                </div>
            </div>
        </div>
      </div>
</div>
@endsection

@section('styles')
<style>
    .content-wrapper {
        background-color: white;
        background-image: linear-gradient(rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.2)),url('images/home-bg.jpg');
        background-size: cover;
        background-repeat: no-repeat;
    }
</style>
@stop
