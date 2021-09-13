@extends('customer.layouts.master')
@section('title')
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            
            <h4 class="page-title">Order Details</h4>
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
                    <div class="card">
                            <!-- <div class="card-body">
                                <h5 class="card-title">{{$order->id}}</h5>
                                <h6>{{$order->created_at}}</h6>
                            </div> -->
                            <div class="card text-white bg-primary mb-3" >
  <div class="card-header">Order {{$order->id}} </div>
  <div class="card-body">
    <h4 class="card-title">{{\App\Models\shopOwner::where('id',$order->shop_id)->value('shopName')}}</h4>
    <p class="card-text">Order at   : {{$order->created_at}}
    <br> Payment  : {{$order->payment}}
    <br> Status    : {{$order->status}}</p>

  </div>
</div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">First</th>
                                        <th scope="col">Last</th>
                                        <th scope="col">Handle</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cart as $cart)
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>{{\App\Models\ShopItem::where('id',$cart->item_id)->value('item_name')}}</td>
                                        <td>{{$cart->item_quantity}}</td>
                                        <td>{{$cart->total_price}}</td>
                                    </tr>
                                    @endforeach
                                   
                                </tbody>
                            </table>
                        </div>

    @endsection