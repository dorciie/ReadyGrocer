{{--@extends('customer.layouts.master')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
        @if(!empty($success))
                                    <div class="alert alert-success">
                                        {{$success}}
                                    </div>
                                   
                                    @endif
            <div class="card-body">
            @foreach($info as $info)
                <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
                <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
                <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
                <!------ Include the above in your HEAD tag ---------->
                <div class="row">
                    
                    <div class="col-md-4">
                        <div class="profile-img">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-head">
                            <h5>
                                {{$info->name}}
                            </h5>                           

                            <p class="proile-rating">Fav Shop : <span> {{\App\Models\shopOwner::where('id',$info->fav_shop)->value('shopName')}}</span></p>
                           <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <p class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</p>
                                </li>

                            </ul>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-4">
                        
                    </div>
                    <div class="col-md-8">
<br> 
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="col-md-8">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Email</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                {{$info->name}}
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Address</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                {{$info->address}}
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Phone</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                (239) 816-9029
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Password</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                *******
                                            </div>
                                        </div><hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Date Joined</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                {{$info->created_at}}
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Automated Delivery</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                            {{$info->autoDelivery}}
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Date & Time Automated Checkout</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                            {{$info->dtdelivery}}
                                            </div>
                                        </div>
                                       
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <a type="button" class="btn btn-outline-primary" href="{{route('custProfile.create')}}">Edit</a>
                                                <a class="btn btn-outline-danger" href="" role="button">Delete</a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>


                        </div>
                    </div>

                </div>
                

@endforeach
            </div>
        </div>
    </div>
</div>
@endsection--}}

@extends('customer.layouts.master')
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
        <a class="btn btn-info" href="{{route('custProfile.show',$info->id)}}"><i class="mdi mdi-account-key"></i> Change password</a>
        <a class="btn btn-info" href="{{route('custProfile.create')}}"><i class="fas fa-edit"></i> Edit profile</a>
    </div>
    <br>
  
    <div class="row">
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
        <div class="col-md-5">
            <div class="card align-items-center">
                <div class="card-bod align-items-centery">
                    {{-- <h5 class="card-title"  style="text-align: center">
                        
                        {{-- <img src="{{asset('assets/images/users/2.jpg')}}" alt="user" class="rounded-circle" width="170"> 
                    </h5> --}}
                    <br>
                    <div class="flip-card align-items-center">
                        <div class="flip-card-inner">
                          <div class="flip-card-front"  style="text-align: center">
                            @if($info->CustImage==NULL)
                                <img src="{{asset('assets/images/logodef.png')}}" alt="Profile picture" width="300px" height="300px">
                            @endif
                            @if($info->CustImage!=NULL)
                                <img src="{{ Storage::url($info->CustImage) }}" alt="Profile picture" width="300px" height="300px">
                            @endif
                        </div>
                          <div class="flip-card-back"><br><br><br><br><br><br>
                            
                          </div>
                        </div>
                      </div><br>
                    <h4><br></h4>
                    <h2 style="text-align: center"></h2><br>
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
                              
            </div><br>

                <form method="POST" action="{{url('cust_image_update')}}">
                @csrf
                <div class="input-group container-fluid justify-content-center">
                    <input id="image" name="image" type="hidden" value="none">
                    <button type="submit" name="send" class="btn btn-outline-info">Remove current photo&nbsp;&nbsp;<i class="fa fa-trash"></i></button>
                </div>
                </form>
                <hr>

                <form method="POST" action="{{url('cust_image_update')}}" class="needs-validation" enctype="multipart/form-data">
                @csrf
                <div class="input-group container-fluid justify-content-center ">
                    <div class="col-sm-12 col-md-12">
                        <div class="custom-file">
                            <input type="file" class="form-control-file custom-file-input" id="image" name="image" accept="image/*">
                            {{-- <label class="custom-file-label" for="customFile">Choose File</label> --}}
                            <button type="submit" name="send" class="btn btn-outline-info pb--9">Change photo&nbsp;&nbsp;<i class="fa fa-upload"></i></button>
                        </div>
                    </div>
                </div>
                </form>
            
            </div>
            </div>
        </div>
        </div>

        <div class="col-md-7">
            <div class="card">
                <div class="card-body" style="line-height: 1.2;">
                    <h3 class="card-title">Customer details</h3>
                    <br>
                    
                    <div class="form-group row">
                        <p class="col-sm-3" style="font-size: 14px;"><strong>Name:</strong></p>
                        <p class="col-sm-9" style="font-size: 14px;">{{$info->name}}</p>
                    </div>
                    <div class="form-group row">
                        <p class="col-sm-3" style="font-size: 14px;"><strong>Email:</strong></p>
                        <p class="col-sm-9" style="font-size: 14px;">{{$info->email}}</p>
                    </div>
                    <div class="form-group row">
                        <p class="col-sm-3" style="font-size: 14px;"><strong>Address: </strong></p>
                        <p class="col-sm-9" style="font-size: 14px;">{{$info->address}}</p>
                    </div>
                    <div class="form-group row">
                        <p class="col-sm-3" style="font-size: 14px;"><strong>Auto Delivery </strong></p>
                        <p class="col-sm-9" style="font-size: 14px;">{{$info->autoDelivery}}</p>
                    </div>
                    <div class="form-group row">
                        <p class="col-sm-3" style="font-size: 14px;"><strong>Date & Time for Delivery: </strong></p>
                        <p class="col-sm-9" style="font-size: 14px;">{{$info->dtdelivery}}</p>
                    </div>
                    <div class="form-group row">
                        <p class="col-sm-3" style="font-size: 14px;"><strong>Join Since: </strong></p>
                        <p class="col-sm-9" style="font-size: 14px;">{{$info->created_at}}</p>
                    </div>
            
                </div>
            
            </div>
        </div>
        
    </div>
</div>
@endsection
