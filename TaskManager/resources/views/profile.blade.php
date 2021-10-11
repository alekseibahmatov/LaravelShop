@extends('layouts.layout')

@section('title') Personal Profile @endsection

@section('main')
<div class="container">
    <h1 class="mt-3">User Profile</h1>

    <form action="{{ route('user.profileEdit') }}" method="post">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="firstname">Firstname</label>
                <input type="text" class="form-control" id="firstname" name="firstname" value="{{ \Illuminate\Support\Facades\Auth::user()->firstname }}" placeholder="Firstname">
            </div>
            <div class="form-group col-md-6">
                <label for="lastname">Lastname</label>
                <input type="text" class="form-control" id="lastname" name="lastname" value="{{ \Illuminate\Support\Facades\Auth::user()->lastname }}" placeholder="Lastname">
            </div>
        </div>
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ \Illuminate\Support\Facades\Auth::user()->email }}" placeholder="Enter email">
        </div>
        <h4 class="mb-3 mt-5">Change password</h4>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        </div>
        <div class="form-group">
            <label for="password">Repeat password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Repeat password">
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
