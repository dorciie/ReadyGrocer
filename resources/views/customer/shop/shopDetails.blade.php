    @extends('customer.layouts.master')


    @section('title')
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Shop Details</h4>
            <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    @endsection

    @section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">


                    <!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
                    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
                    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->

                    <div class="container emp-profile">
                       
                        <form method="get" action="{{route('shops.edit', $shopdetail->id)}}">
                            @if(Session::get('success'))
                            <div class="alert alert-success">
                                {{Session::get('success')}}
                            </div>
                            @endif
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="profile-img">
                                    @if($shopdetail->shop_image==NULL)
                                        <img src="{{asset('assets/images/logodef.png')}}" alt="Profile picture" width="300px" height="300px">
                                    @endif
                                    @if($shopdetail->shop_image!=NULL)
                                        <img src="{{ Storage::url($shopdetail->shop_image) }}" alt="Profile picture" width="300px" height="300px">
                                    @endif  
                                    <!-- <img src="{{asset('assets/images/shop1.jpg')}}" alt="user" width="190px" height="190px"/> -->
                                        <!-- <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS52y5aInsxSm31CvHOFHWujqUx_wWTS9iM6s7BAm21oEN_RiGoog" alt="" /> -->

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="profile-head">
                                        <h5>
                                            {{$shopdetail->id}}
                                        </h5>
                                        <h6>
                                            {{$shopdetail->shopName}}
                                        </h6>
                                        <p class="proile-rating">RANKINGS : <span>{{$shopdetail->rating}}</span></p>
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                                            </li>

                                        </ul>
                                       
                                    </div>
                                    <br><br>
                                    <div class="tab-content profile-tab" id="myTabContent">
                                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                            <!-- <div class="row">
                                                <div class="col-md-6">
                                                    <label>Shop Id</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <p>{{$shopdetail->id}}</p>
                                                </div>
                                            </div> -->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Shop Name</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <p>{{$shopdetail->shopName}}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Email</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <p>{{$shopdetail->email}}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Address</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <p>{{$shopdetail->address}}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Date Joined</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <p>{{$shopdetail->created_at}}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Shop Description</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <p>{{$shopdetail->shop_description}}</p>
                                                </div>
                                            </div>                                                
                                            
                                               <input type="hidden" name="caddress" id="caddress" value="{{$shopdetail->address_latitude}}, {{$shopdetail->address_longitude}}" />
                                                <input type="hidden" name="address_latitude" id="address_latitude" value="{{$shopdetail->address_latitude}}" />
                                                <input type="hidden" name="address_longitude" id="address_longitude" value="{{$shopdetail->address_longitude}}" />

                                                <div id="googleMap" style="width:100%;height:400px;"></div>
                                                <br>
                                            <button type="button" class="btn btn-info btn-lg" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        Fave
                                        </button>


                                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Change Favorite Shop</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                If you change your favourite shop, you will lose your grocery cart items :(<br>
                                                Are you sure?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Confirm</button>
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                        </div>
                                </div>

                            </div>
                            
                        </form>
                     


        <script>
                function myMap() {

                    
                addr = document.getElementById('caddress').value;
                var res = addr.split(",");
                var mapProp= {
                center:new google.maps.LatLng(parseFloat(res[0]), parseFloat(res[1])),
                zoom:13,
                };
                var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
                var marker = new google.maps.Marker({
                    position: {
                                                    lat: parseFloat(res[0]),
                                                    lng: parseFloat(res[1]),
                         },
                        map: map,
                        title:"Shop is here"
                    }); }
                   
        </script>

    <script src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_MAP_API')}}&callback=myMap"></script>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @endsection