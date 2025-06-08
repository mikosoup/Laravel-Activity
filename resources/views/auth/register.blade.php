@extends('base')
@section('title', 'Register')

@if(session('success'))
<div class="alert alert-success" id="success">
    {{ Session::get('success') }}
</div>
@endif

@if(session('fail'))
<div class="alert alert-danger" id="fail">
    {{ Session::get('fail') }}
</div>
@endif

<form action="{{ route('auth.userRegister') }}" method="POST">
    @csrf
    <div class="modal-body">
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email">
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="text" class="form-control" id="password" name="password" placeholder="Enter Password">
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Register</button>
</form>