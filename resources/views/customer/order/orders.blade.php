@extends('customer.layouts.master')

@section('title')
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            
            <h4 class="page-title">Your Orders</h4>
            
        </div>
    </div>
    @endsection
    @section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                
                    <ul class="nav nav-tabs nav-pills" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="allOrder-tab" data-bs-toggle="tab" data-bs-target="#allOrder" type="button" role="tab" aria-controls="allOrder" aria-selected="true">All Order</button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pendingDelivery-tab" data-bs-toggle="tab" data-bs-target="#pendingDelivery" type="button" role="tab" aria-controls="pendingDelivery" aria-selected="false">Pending Delivery</button>
                        </li>
                    
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="completeOrder-tab" data-bs-toggle="tab" data-bs-target="#completeOrder" type="button" role="tab" aria-controls="completeOrder" aria-selected="false">Complete Order </button>
                        </li>
                    </ul>
                </div>
                        
                        
                <div class="tab-content" id="myTabContent">
                    
                        {{-- VIEW ALL ORDER --}}
                <div class="tab-pane fade show active" id="allOrder" role="tabpanel" aria-labelledby="allOrder-tab"><br>
                    <div class="table-responsive">
                        <table id="myTableAll" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Order ID</th>
                                    <th scope="col">Shop Name</th>
                                    <th scope="col">Date Time</th>
                                    <th scope="col">Total Price(RM)</th>
                                </tr>
                            </thead> 
                            <tbody style="text-align:center;">
                                    @foreach($order as $order)    
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td><a href="{{route('custOrder.show',$order->id)}}">{{$order->id}}</a></td>
                                                <td>{{\App\Models\shopOwner::where('id',$order->shop_id)->value('shopName')}}</td>
                                                <td>{{$order->checkoutDelivery}}</td>
                                                <td>{{$order->total_price}}</td>
                                            </tr>
                                 @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            {{--END VIEW ALL ORDER --}}
            {{-- VIEW DELIVERING ORDER --}}
                <div class="tab-pane fade" id="pendingDelivery" role="tabpanel" aria-labelledby="pendingDelivery-tab"><br>
                    <div class="table-responsive">
                        <table id="myTableDelivering" class="table table-striped table-bordered">
                        <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Order ID</th>
                                    <th scope="col">Shop Name</th>
                                    <th scope="col">Date Time</th>
                                    <th scope="col">Total Price(RM)</th>
                                </tr>
                            </thead> 
                            <tbody style="text-align:center;">
                                         @foreach($pendingOrder as $order)    
                                                <tr>
                                                        <th scope="row">{{ $loop->iteration }}</th>
                                                        <td><a href="{{route('custOrder.show',$order->id)}}">{{$order->id}}</a></td>
                                                        <td>{{\App\Models\shopOwner::where('id',$order->shop_id)->value('shopName')}}</td>
                                                        <td>{{$order->checkoutDelivery}}</td>
                                                        <td>{{$order->total_price}}</td>
                                                    </tr>
                                         @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            {{--END VIEW ALL ORDER --}}
            {{-- VIEW ALL ORDER --}}
                <div class="tab-pane fade" id="completeOrder" role="tabpanel" aria-labelledby="completeOrder-tab"><br>
                    <div class="table-responsive">
                        <table id="myTableComplete" class="table table-striped table-bordered">
                        <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Order ID</th>
                                    <th scope="col">Shop Name</th>
                                    <th scope="col">Date Time</th>
                                    <th scope="col">Total Price(RM)</th>
                                </tr>
                            </thead> 
                            <tbody style="text-align:center;">
                                        @foreach($completeOrder as $order)    
                                                <tr>
                                                        <th scope="row">{{ $loop->iteration }}</th>
                                                        <td><a href="{{route('custOrder.show',$order->id)}}">{{$order->id}}</a></td>
                                                        <td>{{\App\Models\shopOwner::where('id',$order->shop_id)->value('shopName')}}</td>
                                                        <td>{{$order->checkoutDelivery}}</td>
                                                        <td>{{$order->total_price}}</td>
                                                    </tr>
                                         @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            {{--END VIEW ALL ORDER --}}
            </div>

            </div>
        </div>
    </div>
    @endsection
   