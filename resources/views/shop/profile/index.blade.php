@extends('shop.layouts.master')

@section('content')

<div class="container-fluid">
    <div style="text-align: right;">
        <a class="btn btn-primary" href="{{route('profile.show',$shopOwner->id)}}"><i class="fas fa-edit"></i> Change password</a>
        <a class="btn btn-primary" href="{{route('profile.edit',$shopOwner->id)}}"><i class="fas fa-edit"></i> Edit profile</a>
    </div>
    <br>
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
                <div class="card-body" style="line-height: 0.7;">
                    <h3 class="card-title">Shop details</h3>
                    <br>
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
                        <p style="font-size: 14px;" class="col-sm-4" style="font-size: 18px;">Location: </p>
                        <p style="font-size: 14px;" class="col-sm-8" style="font-size: 18px;">{{$shopOwner->address_latitude}}, {{$shopOwner->address_longitude}}</p>
                    </div>
                    <div class="form-group row">
                        <p style="font-size: 14px;" class="col-sm-4" style="font-size: 18px;">Contact Number: </p>
                        <p style="font-size: 14px;" class="col-sm-8" style="font-size: 18px;">{{$shopOwner->phone_number}}</p>
                    </div>
                    <div class="form-group row">
                        <p style="font-size: 14px;" class="col-sm-4" style="font-size: 18px;">Delivery Charge: </p>
                        @if($shopOwner->delivery_charge==NULL)
                        <p style="font-size: 14px;" class="col-sm-8" style="font-size: 18px;">0</p>
                        @endif
                        @if($shopOwner->delivery_charge!=NULL)
                        <p style="font-size: 14px;" class="col-sm-8" style="font-size: 18px;">RM {{$shopOwner->delivery_charge}} per km</p>
                        @endif
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
