@extends('shop.layouts.master')

@section('content')
<div class="ms-auto text-end">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('shop/dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Order per Customer</li>
        </ol>
    </nav>
</div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Order per Customer</h5>
            
            </div>
        </div>
    </div>
@endsection