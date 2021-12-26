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

                <h5 class="card-title mb-0">Category Name</h5>

            </div>
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
                            <button type="button" class="btn btn-outline-primary"><i class="me-2 mdi mdi-bell-ring-outline"></i>Add to List</button>
                        </td>
                        <td><button type="button" class="btn btn-outline-info"><i class="me-2 mdi mdi-cart-plus"></i>Add to Cart</button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection