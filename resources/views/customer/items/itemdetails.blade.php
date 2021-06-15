@extends('customer.layouts.master')

@section('title')
@foreach($shop as $favshop)
<div class="row">
    <div class="col-12 d-flex no-block align-items-center">
        <h4 class="page-title">{{$favshop->shopName}}</h4>
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
@endforeach
@endsection

<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
@section('content')
<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">


                <!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->
                <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
                <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
                <!------ Include the above in your HEAD tag ---------->

                <div class="container emp-profile">


                </div>
                @foreach($shop as $shop)
                <div class="row">
                    @if(Session::get('success'))
                    <div class="alert alert-success">
                        {{Session::get('success')}}
                    </div>
                    @endif
                    @if(Session::get('error'))
                    <div class="alert alert-danger">
                        {{Session::get('error')}}
                    </div>
                    @endif
                    @error('item_quantity')
                    <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                    @foreach($items as $item)
                    <div class="col-md-4">
                        <div class="profile-img">
                        <img src="{{ Storage::url($item->item_image) }}" width="100px">

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-head">
                            <h5>
                                {{$shop->id}}
                            </h5>
                            <h6>
                                {{$shop->shopName}}
                            </h6>
                            <p class="proile-rating">RANKINGS : <span>rating</span></p>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                                </li>

                            </ul>
                        </div>
                    </div>

                </div>
                @endforeach
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-work">

                        </div>
                    </div>
                    <br>
                    <div class="col-md-8">

                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Item Id</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{$item->id}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Item Name</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{$item->item_name}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Price</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><s>{{$item->item_price}}</s>&nbsp&nbsp{{$item->offer_price}}</p>
                                    </div>
                                </div>
                                <!-- <div class="row">
                                    <div class="col-md-6">
                                        <label>Promo price</label>
                                    </div>
                                    <div class="col-md-6">
                                      
                                    </div>
                                </div> -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Description</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{$item->item_description}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Size</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{$item->item_size}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Stock</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{$item->item_stock}}</p>
                                    </div>
                                </div>


                                <div>
                                    <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#exampleModal">List</button>
                                    <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#exampleModal2">Cart</button>

                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <form method="get" action="{{route('addItemList',['itemID' => $item->id])}}">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Add to List</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label>Item Name</label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <p>{{$item->item_name}}</p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label>Item Quantity</label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="input-group mb-3">
                                                                    <input type="number" class="form-control" name="item_quantity" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label>Item Frequency</label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="input-group mb-3">
                                                                    <select class="form-select" name="item_frequency" aria-label="Default select example">
                                                                        <option value="None" selected>None</option>
                                                                        <option value="Daily">Daily</option>
                                                                        <option value="Weekly">Weekly</option>
                                                                        <option value="Fortnight">Fortnight</option>
                                                                        <option value="Monthly">Monthly</option>
                                                                    </select>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-info btn-lg">Save changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <form method="get" action="{{route('updateCart',['itemID' => $item->id])}}">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Add to Cart</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label>Item Name</label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <p>{{$item->item_name}}</p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label>Item Quantity</label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="input-group mb-3">
                                                                    <input type="number" class="quantity" name="item_quantity" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label>Total Price</label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <p id="results">

                                                                    <script>
                                                                        // $('.form-control prc').each(function(){
                                                                        //     var quantity = parseInt( $(this).find('[name="item-quantity"]').val(),10)

                                                                        // })
                                                                        // total = <php echo json_encode($item->offer_price); ?>;
                                                                        // quantity = total*$('.quantity').val();
                                                                        // $('#results').text(quantity);
                                                                        // document.getElementById("demo").innerHTML = "Hello JavaScript!";
                                                                    </script>


                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-info btn-lg">Save changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><br>


                        </div>
                    </div>
                    @endforeach

                </div>
                </form>


            </div>
        </div>
    </div>
</div>

</div>
@endsection