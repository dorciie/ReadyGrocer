@extends('shop.layouts.master')

@section('content')

{{-- <div class="row" style="margin-top:45px">
    <div class="col-md-6 col-md-offset-3">
        <h4>Profile page</h4>
        <hr>
        <table class="table table-hover">
            <thead>
                <th>Name</th>
                <th>Email</th>
                <th>Logout</th>
            </thead>
            <tbody>
                <td>{{$LoggedShopInfo->name}}</td>
                <td>{{$LoggedShopInfo->email}}</td>
                <td><a href="shoplogout">Logout</a></td>
            </tbody>
        </table>
    </div>
</div> --}}
{{-- <div class="ms-auto text-end">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('shop/dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">All Item</li>
        </ol>
    </nav>
</div> --}}

<div class="container-fluid">
    <div style="text-align: right;">
        <a class="btn btn-primary" href="#"><i class="fas fa-edit"></i> Update password</a>
        <a class="btn btn-primary" href="{{route('profile.edit',$shopOwner->id)}}"><i class="fas fa-edit"></i> Edit profile</a>
    </div>
    <br>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"  style="text-align: center">
                        @if($shopOwner->shop_image==NULL)
                        <img src="{{asset('assets/images/users/2.jpg')}}" alt="user" class="rounded-circle" width="170">
                        @endif
                        @if($shopOwner->shop_image!=NULL)
                        <img src="{{ Storage::url($shopOwner->shop_image) }}" alt="user" class="rounded-circle" width="190" height="175">
                        @endif
                        {{-- <img src="{{asset('assets/images/users/2.jpg')}}" alt="user" class="rounded-circle" width="170"> --}}
                        
                    </h5>
                    <h4><br></h4>
                    <h2 style="text-align: center">{{$shopOwner->name}}</h2>
                    <h2 style="text-align: center">Rating: {{$shopOwner->rating}}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Shop details</h3>
                    <div class="form-group row">
                        <p style="font-size: 14px;" class="col-sm-4" style="font-size: 18px;">Shop Name:</p>
                        <p style="font-size: 14px;" class="col-sm-8" style="font-size: 18px;">{{$shopOwner->shopName}}</p>
                    </div>
                    <div class="form-group row">
                        <p style="font-size: 14px;" class="col-sm-4" style="font-size: 18px;">Email:</p>
                        <p style="font-size: 14px;" class="col-sm-8" style="font-size: 18px;">{{$shopOwner->email}}</p>
                    </div>
                    <div class="form-group row">
                        <p style="font-size: 14px;" class="col-sm-4" style="font-size: 18px;">Address: </p>
                        <p style="font-size: 14px;" class="col-sm-8" style="font-size: 18px;">{{$shopOwner->address}}</p>
                    </div>
                    <div class="form-group row">
                        <p style="font-size: 14px;" class="col-sm-4" style="font-size: 18px;">Contact Number: </p>
                        <p style="font-size: 14px;" class="col-sm-8" style="font-size: 18px;">{{$shopOwner->phone_number}}</p>
                    </div>
                    <div class="form-group row">
                        <p style="font-size: 14px;" class="col-sm-4" style="font-size: 18px;">Delivery Charge: </p>
                        <p style="font-size: 14px;" class="col-sm-8" style="font-size: 18px;">RM {{$shopOwner->delivery_charge}}0</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">Shop description</h2>
                    <br>
                    <p>{{$shopOwner->shop_description}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
