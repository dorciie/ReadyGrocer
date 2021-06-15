    @extends('customer.layouts.master')


    @section('title')
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Shop Details</h4>
            <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Library</li>
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


                    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
                    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
                    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

                    <div class="container emp-profile">
                        @foreach($shopdetail as $s)
                        <form method="get" action="{{route('shops.edit', $s->id)}}">
                            @if(Session::get('success'))
                            <div class="alert alert-success">
                                {{Session::get('success')}}
                            </div>
                            @endif
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="profile-img">
                                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS52y5aInsxSm31CvHOFHWujqUx_wWTS9iM6s7BAm21oEN_RiGoog" alt="" />

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="profile-head">
                                        <h5>
                                            {{$s->id}}
                                        </h5>
                                        <h6>
                                            {{$s->shopName}}
                                        </h6>
                                        <p class="proile-rating">RANKINGS : <span>{{$s->rating}}</span></p>
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                                            </li>

                                        </ul>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="profile-work">

                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="tab-content profile-tab" id="myTabContent">
                                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Shop Id</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <p>{{$s->id}}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Shop Name</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <p>{{$s->shopName}}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Email</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <p>{{$s->email}}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Address</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <p>{{$s->address}}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Date Joined</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <p>{{$s->created_at}}</p>
                                                </div>
                                            </div>
                                            <!-- <div id="googleMap" style="width:100%;height:400px;"></div> -->
                                        </div><br>
<!-- Button trigger modal -->
<button type="button" class="btn btn-info btn-lg" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Fave
</button>

<!-- Modal -->
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
                                                <button type="submit" class="btn btn-info btn-lg">Fave</button>
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                        <!-- <button type="submit" class="btn btn-info btn-lg">Fave</button> -->
                                    </div>
                                </div>
                            </div>
                        </form>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>

    </div>
    @endsection