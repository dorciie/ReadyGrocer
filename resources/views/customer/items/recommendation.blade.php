@extends('customer.layouts.master')
@section('title')
<div class="row">
    <div class="col-12 d-flex no-block align-items-center">

        <h4 class="page-title">{{$shop->shopName}}</h4>
       
    </div>
</div>
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h5 class="card-title mb-0">Recommended for you</h5>

            </div>
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
                    @if ($errors->any())
                    <div class="alert alert-danger">
                           <ul>
                            @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                          @endforeach
                            </ul>
                            </div>
                    @endif
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Brand</th>
                        <th scope="col">Price(RM)</th>
                        <th scope="col"><b>SALE</b></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody> 
                    @foreach($recommendation as $r)

                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td><a href="{{route('itemDetails',['itemID' => $r->id])}}">{{$r->item_name}}</a></td>
                        <td>{{$r->item_brand}}</td>
                        <td>{{$r->item_price}}</td>
                        <td>Get it for RM{{$r->offer_price}} at <br>{{$r->item_startPromo}} until {{$r->item_endPromo}}</td>
                        <td>
                            <button type="button" class="btn btn-outline-primary"data-bs-toggle="modal" data-bs-target="#addtoList{{$r->id}}"><i class="me-2 mdi mdi-bell-ring-outline"></i>Add to List</button>
                        </td>
                        <td><button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#addtoCart{{$r->id}}"><i class="me-2 mdi mdi-cart-plus"></i>Add to Cart</button>
                    </td>

                    </tr>
                    <div class="modal fade" id="addtoList{{$r->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <form method="get" action="{{route('addItemList',['itemID' => $r->id])}}">
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
                                                                <p>{{$r->item_name}}</p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label>Item Quantity</label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="input-group mb-3">
                                                                    <input type="number" class="form-control" name="item_quantity" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" min="1" required>
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
                         <div class="modal fade" id="addtoCart{{$r->id}}"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <form method="get" action="{{route('updateCart',['itemID' => $r->id])}}">
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
                                                                <p>{{$r->item_name}}</p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label>Item Quantity</label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="input-group mb-3">
                                                                    <input type="number" class="quantity" name="item_quantity" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" min="1" required>
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

                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection