@extends('shop.layouts.master')

@section('content')
    <div class="ms-auto text-end">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('shop/dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('profile.index')}}">Profile</a></li>
                <li class="breadcrumb-item active" aria-current="page">Change password</li>
            </ol>
        </nav>
    </div>
    <div class="results">
        @if(Session::get('success'))
            <div class="alert alert-success" id="alert">
                {{Session::get('success')}}
            </div>
        @endif
        @if(Session::get('error'))
            <div class="alert alert-danger" id="alert">
                {{Session::get('error')}}
            </div>
        @endif
    </div>
    <div class="container-fluid">
        <div class="card">
            <form class="form-horizontal" action="{{url('password_change')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <h5 class="card-title">Change password</h5>
                    <br>
                    {{-- <p>Enter your name: <input type="text"></p> --}}
                    <div class="form-group row">
                        <label for="fname"
                            class="col-sm-2 text-end control-label col-form-label">Old password: <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input id="changePassword" type="password" class="form-control" name="changePassword" value="{{ old('changePassword') }}">
                            <span class="text-danger">@error('changePassword'){{ $message }} @enderror</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname"
                            class="col-sm-2 text-end control-label col-form-label">New password: <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input id="newPassword" type="password" class="form-control" name="newPassword" value="{{ old('newPassword') }}">
                            <span class="text-danger">@error('newPassword'){{ $message }} @enderror</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname"
                            class="col-sm-2 text-end control-label col-form-label">Confirm password: <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input id="confirmPassword" type="password" class="form-control" name="confirmPassword" value="{{ old('confirmPassword') }}">
                            <span class="text-danger">@error('confirmPassword'){{ $message }} @enderror</span>
                        </div>
                    </div>
                    <br>
                    <div class="border-top">
                        <div class="card-body" style="text-align:center;">
                            <button type="submit" class="btn btn-primary">Update password</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
@endsection