@extends('shop.layouts.master')

@section('content')
<div class="ms-auto text-end">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('shop/dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Order per Customer</li>
        </ol>
    </nav>
</div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Order details per Customer</h5>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body" style="line-height: 0.7;">
                            
                            {{-- <h3 class="card-title">Customer's order details</h3> --}}
                            <br>
                            <div class="form-group row">
                                <p style="font-size: 14px;" class="col-sm-3" style="font-size: 18px;">Customer Name:</p>
                                <p style="font-size: 14px;" class="col-sm-8" style="font-size: 18px;">{{$custOrders->name}}</p>
                            </div>
                            <div class="form-group row">
                                <p style="font-size: 14px;" class="col-sm-3" style="font-size: 18px;">Customer Address:</p>
                                <p style="font-size: 14px;" class="col-sm-8" style="font-size: 18px;">{{$custOrders->address}}</p>
                            </div>
                            <div class="form-group row">
                                <p style="font-size: 14px;" class="col-sm-3" style="font-size: 18px;">Delivery time: </p>
                                <p style="font-size: 14px;" class="col-sm-8" style="font-size: 18px;">{{ \Carbon\Carbon::parse($custOrders->checkoutDelivery)->format('H:i')}}</p>
                            </div>
                            <div class="form-group row">
                                <p style="font-size: 14px;" class="col-sm-3" style="font-size: 18px;">Delivery date: </p>
                                <p style="font-size: 14px;" class="col-sm-8" style="font-size: 18px;">{{ \Carbon\Carbon::parse($custOrders->checkoutDelivery)->format('d/m/Y')}}</p>
                            </div>
                            <div class="form-group row">
                                <p style="font-size: 14px;" class="col-sm-3" style="font-size: 18px;">Customer Contact: </p>
                                <p style="font-size: 14px;" class="col-sm-8" style="font-size: 18px;">{{$custOrders->email}}</p>
                            </div>
                            <div class="form-group row">
                                <p style="font-size: 14px;" class="col-sm-3" style="font-size: 18px;">Payment method: </p>
                                <p style="font-size: 14px;" class="col-sm-8" style="font-size: 18px;">{{$custOrders->payment}}</p>
                            </div>
                            <div class="form-group row">
                                <p style="font-size: 14px;" class="col-sm-3" style="font-size: 18px;">Total amount of payment: </p>
                                <p style="font-size: 14px;" class="col-sm-8" style="font-size: 18px;">RM{{$custOrders->total_payment}} (Including 6% sst)</p>
                            </div>
                            @if($OverallRate->rate != NULL)
                            <div class="form-group row">
                                <p style="font-size: 14px;" class="col-sm-3" style="font-size: 18px;">Rate: </p>
                                <p style="font-size: 14px;" class="col-sm-8" style="font-size: 18px;">{{$OverallRate->rate}}</p>
                            </div>
                            <div class="form-group row">
                                <p style="font-size: 14px;" class="col-sm-3" style="font-size: 18px;">Comment: </p>
                                <p style="font-size: 14px;" class="col-sm-8" style="font-size: 18px;">{{$OverallRate->comment}}</p>
                            </div>
                            @endif
                            <div class="form-group row">
                                <p style="font-size: 14px;" class="col-sm-4" style="font-size: 18px;">List of item bought: </p>
                                <p style="font-size: 14px;" class="col-sm-8" style="font-size: 18px;">
                                    <div class="table-responsive">
                                        <table id="myTable" class="table table-striped table-bordered">
                                            <thead>
                                                <tr class="table-info">
                                                    <th><strong>No</strong></th>
                                                    <th><strong>Item</strong></th>{{-- boleh tick banyak item kat sini --}}
                                                    <th><strong>Brand</strong></th>
                                                    <th><strong>Quantity</strong></th>{{-- bila tekan view "icon mata", show table semua item+price before and after promotion --}}
                                                    <th><strong>Price per unit</strong></th>
                                                    <th><strong>Total price</strong></th>
                                                </tr>
                                            </thead>
                                            <tbody style="text-align:center;">
                                                @foreach($custOrder as $order)
                                                    <tr>
                                                        <td>{{$loop->iteration}}.</td>
                                                        <td>{{$order->item_name}}</td>
                                                        <td>{{$order->item_brand}}</td>
                                                        <td>{{$order->item_quantity}}</td>
                                                        @if($order->item_endPromo == NULL)
                                                            <td>RM{{$order->item_price}}</td>
                                                        @endif
                                                        @if($order->item_endPromo != NULL)
                                                            <td>RM{{$order->offer_price}}</td>
                                                        @endif
                                                        <td>RM{{$order->total_price}}</td>
                                                    </tr>    
                                                @endforeach        
                                            </tbody>
                                        </table>
                                    </div>
                                </p>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection