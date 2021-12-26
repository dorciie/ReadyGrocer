@extends('customer.layouts.master')


@section('title')
<div class="row">
    <div class="col-12 d-flex no-block align-items-center">
        <h4 class="page-title">Your Grocery Cart</h4>
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
<div class="row">
    <div class="col-12">
        <div class="card">

            <div class="card-body">
                <h5 class="card-title mb-0">Your Cart</h5>
            </div>
            @error('item_quantity')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <table class="table">
                <thead>

                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Item Name</th>
                        <th scope="col">Item Price(RM)</th>
                        <th scope="col">Item Quantity</th>
                        <th scope="col">Item Max Quantity</th>
                        <th scope="col">Item Brand</th>
                        <th scope="col">Total Price(RM)</th>
                        <th scope="col"></th>
                    </tr>

                </thead>
                <tbody>
                    <div style="display: none">{{$total =0}}</div>
                    @foreach($info as $info)

                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{$info->item_name}}</td>
                         <td>
                            <?php
                            date_default_timezone_set("Asia/Kuala_Lumpur");
                            $today = date(('Y-m-d H:i:s'));
                            if($info->item_startPromo != NULL && $today>=($info->item_startPromo)){
                                ?>{{number_format((float)$info->offer_price, 2, '.', '')}}
                                <?php
                            }else{
                                ?>{{number_format((float)$info->item_price, 2, '.', '')}}
                                <?php
                            }
                            ?></td> <!--  display price according to date -->
                        <td>{{$info->item_quantity}}</td>
                        <td>{{\App\Models\ShopItem::where('id',$info->item_id)->value('item_stock')}}</td>
                        
                        <td>{{$info->item_brand}}</td>
                        <td>{{number_format((float)$info->total_price, 2, '.', '')}}</td>
                        <div style="display: none">{{$total += $info->total_price}}</div>
                        <td><button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#updateItem{{$info->id}}">Edit Item</a></td>

                        <div class="modal fade" id="updateItem{{$info->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <form method="get" action="{{route('editCartItem',['cartItemID' => $info->id])}}">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="updateItem">Update Item</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Item Name</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <p>{{$info->item_id}}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Item Quantity</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="input-group mb-3">
                                                        <input type="number" class="form-control" name="item_quantity" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="{{$info->item_quantity}}" placeholder="{{$info->item_quantity}}"max="{{\App\Models\ShopItem::where('id',$info->item_id)->value('item_stock')}}"min="1">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <a class="btn btn-outline-danger" href="{{route('deleteCart',['itemID'=>$info->id])}}" role="button">Delete</a>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </tr>
                    @if ($loop->last)
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>6% SST : </td>
                        <td>{{number_format((float)$total *0.06, 2, '.', '')}}</td>
                        <div style="display: none">{{$total = $total + $total *0.06}}</div>
                        <td></td>
                    </tr>
                    @endif
                    @endforeach
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Automated Checkout At :</td>
                        <td>{{\App\Models\customer::where('id',35)->value('dtdelivery')}}</td>
                        <td>{{number_format((float)$total, 2, '.', '')}}</td>
                        <td> <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#checkoutcart">Check Out Now</button></td>
                    </tr>
                </tbody>
            </table>
            <div class="modal fade" id="checkoutcart" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <form method="get" action="{{route('checkout')}}">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Confirm Checkout</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                    @if($total==0)

                                        <div class="row">
                                    <div class="col-md-6">
                                    There is no item in your cart :(
                                    </div>
                                    </div>
                                    
                                    @else
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Total Price(RM)</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{number_format((float)$total, 2, '.', '')}}</p>
                                        <input type="hidden" name="totalPrice" id="totalPrice" value="{{$total}}" />

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Delivery Time</label>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                       
                                        <input type="radio" name="delivery"  value="deliveryNow"/>&nbspDeliveryNow<br>
                                        <?php
                                        date_default_timezone_set("Asia/Kuala_Lumpur");
                                        echo  date(('Y-m-d H:i:s'));
                                        ?><br><br>
                                       <!-- {{ $now = \Carbon\Carbon::now()}} -->
                                        <input type="radio" name="delivery" value="deliveryLater"/>&nbspDeliveryLater
                                        <input type="datetime-local" class="form-control"  name="deliveryDT" >
                
                                        </div>
                                        <!-- <div class="form-check">
                                        <input class="form-check-input" type="radio" name="delivery" id="flexRadioDefault2" >
                                        <label class="form-check-label" for="flexRadioDefault2" value="deliveryLater">
                                            Delivery Later
                                        </label>
                                        <input type="datetime-local" class="form-control"  name="deliveryDT" >

                                        </div> -->
                                    
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Payment via</label>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <select class="form-select" name="payment" aria-label="Default select example">
                                                <option value="Cash">Cash</option>
                                                <option value="Online Banking">Online Banking</option>
                                                <option value="Credit/Debit Card">Credit/Debit Card</option>
                                            </select>
                                        </div>

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-info btn-lg">Confirm</button>
                                </div>@endif
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @endsection