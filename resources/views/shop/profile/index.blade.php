@extends('shop.layouts.master')
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> --}}
@section('content')
<style>
    /* Style for flip card in my profile */
.flip-card {
    background-color: transparent;
    width: 300px;
    height: 300px;
    perspective: 1000px;
  }
  
  .flip-card-inner {
    position: relative;
    width: 100%;
    height: 100%;
    text-align: center;
    transition: transform 0.6s;
    transform-style: preserve-3d;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  }
  
  .flip-card:hover .flip-card-inner {
    transform: rotateY(180deg);
  }
  
  .flip-card-front, .flip-card-back {
    position: absolute;
    width: 100%;
    height: 100%;
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
  }
  
  .flip-card-front {
    background-color: #bbb;
    color: black;
  }
  
  .flip-card-back {
    background-color: #3875d7;
    color: white;
    transform: rotateY(180deg);
  }
</style>

<div class="container-fluid">
    <div style="text-align: right;">
        <a class="btn btn-info" href="{{route('profile.show',$shopOwner->id)}}"><i class="fas fa-edit"></i> Change password</a>
        <a class="btn btn-info" href="{{route('profile.edit',$shopOwner->id)}}"><i class="fas fa-edit"></i> Edit profile</a>
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
                    {{-- <h5 class="card-title"  style="text-align: center">
                        @if($shopOwner->shop_image==NULL)
                        <img src="{{asset('assets/images/logodef.png')}}" alt="user" width="180">
                        @endif
                        @if($shopOwner->shop_image!=NULL)
                        <img src="{{ Storage::url($shopOwner->shop_image) }}" alt="user" width="190" height="175">
                        @endif
                        {{-- <img src="{{asset('assets/images/users/2.jpg')}}" alt="user" class="rounded-circle" width="170"> 
                    </h5> --}}

                    <div class="flip-card align-items-center">
                        <div class="flip-card-inner">
                          <div class="flip-card-front"  style="text-align: center">
                            @if($shopOwner->shop_image==NULL)
                                <img src="{{asset('assets/images/logodef.png')}}" alt="Profile picture" width="300px" height="300px">
                            @endif
                            @if($shopOwner->shop_image!=NULL)
                                <img src="{{ Storage::url($shopOwner->shop_image) }}" alt="Profile picture" width="300px" height="300px">
                            @endif
                        </div>
                          <div class="flip-card-back"><br><br><br><br><br><br>
                            {{-- @foreach ($shopOwner as $user) --}}
                              {{-- <a href="" class="text-dark btn" style="background-color: #FFFFFF;" data-toggle="modal" data-bs-target="#modalEditPhoto"><strong>Edit Photo</strong></a> --}}
                              <button type="button" style="background-color: #FFFFFF;" class="btn text-dark" data-bs-toggle="modal" data-bs-target="#modalEditPhoto"><strong>Edit Photo</strong></button>
                            {{-- @endforeach --}}
                          </div>
                        </div>
                      </div><br>
                    <h4><br></h4>
                    <h2 style="text-align: center">{{$shopOwner->shopName}}</h2>
                    {{-- <h2 style="text-align: center">Rating: {{$shopOwner->rating}}</h2> --}}
                </div>
            </div>
        </div>

        <!-- Modal for Edit Photo behind flip card -->
        <div class="modal fade" id="modalEditPhoto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  190000" role="document">
            <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title" id="modalEditPhoto">Edit Photo</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body col-sm-12 col-md-12">
                <div class="d-flex justify-content-center">
                @if($shopOwner->shop_image==NULL)
                    <img src="{{asset('assets/images/logodef.png')}}" alt="Profile picture" width="300px" height="300px">
                @endif
                @if($shopOwner->shop_image!=NULL)
                    <img src="{{ Storage::url($shopOwner->shop_image) }}" alt="Profile picture" width="300px" height="300px">
                @endif                
            </div><br>

                <form method="POST" action="{{url('shop_image_update')}}">
                @csrf
                <div class="input-group container-fluid justify-content-center">
                    <input id="image" name="image" type="hidden" value="none">
                    <button type="submit" name="send" class="btn btn-outline-info">Remove current photo&nbsp;&nbsp;<i class="fa fa-trash"></i></button>
                </div>
                </form>
                <hr>

                <form method="POST" action="{{url('shop_image_update')}}" class="needs-validation" enctype="multipart/form-data">
                @csrf
                <div class="input-group container-fluid justify-content-center ">
                    <div class="col-sm-12 col-md-12">
                    <div class="custom-file">
                        <input type="file" class="form-control-file custom-file-input" id="image" name="image" accept="image/*">
                        {{-- <label class="custom-file-label" for="customFile">Choose File</label> --}}
                    </div>
                    </div>
                    <button type="submit" name="send" class="btn btn-outline-info pb--9">Change photo&nbsp;&nbsp;<i class="fa fa-upload"></i></button>
                </div>
                </form>
            
            </div>
            </div>
        </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-body" style="line-height: 0.7;">
                    <h3 class="card-title">Shop details</h3>
                    <br>
                    <div class="form-group row">
                        <p style="font-size: 14px;" class="col-sm-4" style="font-size: 18px;"><strong>Name:</strong></p>
                        <p style="font-size: 14px;" class="col-sm-8" style="font-size: 18px;">{{$shopOwner->name}}</p>
                    </div>
                    <div class="form-group row">
                        <p style="font-size: 14px;" class="col-sm-4" style="font-size: 18px;"><strong>Email:</strong></p>
                        <p style="font-size: 14px;" class="col-sm-8" style="font-size: 18px;">{{$shopOwner->email}}</p>
                    </div>
                    <div class="form-group row">
                        <p style="font-size: 14px;" class="col-sm-4" style="font-size: 18px;"><strong>Address: </strong></p>
                        <p style="font-size: 14px;" class="col-sm-8" style="font-size: 18px;">{{$shopOwner->address}}</p>
                    </div>
                    <div class="form-group row">
                        <p style="font-size: 14px;" class="col-sm-4" style="font-size: 18px;"><strong>Location: </strong></p>
                        <p style="font-size: 14px;" class="col-sm-8" style="font-size: 18px;">{{$shopOwner->address_latitude}}, {{$shopOwner->address_longitude}}</p>
                    </div>
                    <div class="form-group row">
                        <p style="font-size: 14px;" class="col-sm-4" style="font-size: 18px;"><strong>Contact Number: </strong></p>
                        <p style="font-size: 14px;" class="col-sm-8" style="font-size: 18px;">{{$shopOwner->phone_number}}</p>
                    </div>
                    <div class="form-group row">
                        <p style="font-size: 14px;" class="col-sm-4" style="font-size: 18px;"><strong>Delivery Charge: </strong></p>
                        @if($shopOwner->delivery_charge==NULL)
                        <p style="font-size: 14px;" class="col-sm-8" style="font-size: 18px;">0</p>
                        @endif
                        @if($shopOwner->delivery_charge!=NULL)
                        <p style="font-size: 14px;" class="col-sm-8" style="font-size: 18px;">RM {{$shopOwner->delivery_charge}} per km</p>
                        @endif
                    </div>
                    <div class="form-group row">
                        <p style="font-size: 14px;" class="col-sm-4" style="font-size: 18px;"><strong>Rating: </strong></p>
                        <p style="font-size: 14px;" class="col-sm-8" style="font-size: 18px;"></p>
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
