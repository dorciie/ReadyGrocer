@extends('customer.layouts.master')

@section('title')
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            
            <h4 class="page-title">Your Orders</h4>
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
                <ul class="nav nav-tabs">
                        <li class="nav-item">
                        <div id="PendingD" class="nav-link active" aria-current="page">Pending Delivery</div>
                        </li>
                        <li class="nav-item">
                        <div id="Completed" class="nav-link" aria-current="page">Completed</div>
                        </li>
                        <li class="nav-item">                       
                         <div id="Cancel" class="nav-link" aria-current="page">Cancel</div>
                        </li>
                        </ul>                
                        </div>
                        
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Order ID</th>
                                    <th scope="col">Shop Name</th>
                                    <th scope="col">Date Time</th>
                                    <th scope="col">Total Price(RM)</th>
                                </tr>
                            </thead> 

                   @foreach($order as $order)    
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{$order->id}}</td>
                        <td>{{\App\Models\shopOwner::where('id',$order->shop_id)->value('shopName')}}</td>
                        <td>{{$order->checkoutDelivery}}</td>
                        <td>{{$order->total_price}}</td>
                     </tr>
                     @endforeach
                        </table>
            </div>
        </div>
    </div>
    @endsection