@extends('customer.layouts.master')
@section('title')
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Order Details {{$order->id}}</h4>
        </div>
    </div>
@endsection

@section('content')
                    <div class="card">
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
                            <div class="card text-white bg-primary mb-3" >
                                    <div class="card-header">Order {{$order->id}} </div>
                                        <div class="card-body">
                                            <h4 class="card-title">{{\App\Models\shopOwner::where('id',$order->shop_id)->value('shopName')}}</h4>
                                            <p class="card-text">Order at   : {{$order->created_at}}
                                            <br> Payment  : {{$order->payment}}
                                            <br> Status    : {{$order->status}}</p>
                                            <div class="col-md-5" text-align="right">
                                                <a href="{{ route('pdf',$order->id) }}" class="btn btn-danger">Export into PDF</a>
                                            </div>
                                        </div>
                                    </div>
                                    @if(!empty($success))
                                    <div class="alert alert-success">
                                        {{$success}}
                                    </div>
                                    
                                    @endif
                                    @if($order->status==='Preparing')
                                        <div class="alert alert-info" role="alert">
                                             Sit Back! Your shop is preparing your order~<marquee height="15px" width="10%" behavior="scroll" direction="right">  <i class="me-2 mdi mdi-cart-plus"></i>   </marquee>        
                                        </div>
                                    @endif
                                    
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Item Name</th>
                                        <th scope="col">Item Quantity</th>
                                        <th scope="col">Total Price</th>
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

                             @if($order->status==='Delivering')
                             <form method="get" action="{{route('custOrder.edit',$order->id)}}">
                                    <input type="hidden" name="status" id="status" value="delivered" />
                                    <button type="submit" class="btn btn-primary" >Order Received</button>

                             </form>
                            
                            @elseif($order->status==='Delivered')
                            @if($order->rate===NULL && $order->comment===NULL)
                            <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#rateshop">Rate Shop</button>
                            <!-- make modal display by default but howww -->
                            <div class="modal fade" id="rateshop" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content">
                                                
                                                <form class="form-horizontal" action="{{route('custOrder.update',$order->id)}}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                @method('patch') 
                                                    <div class="card-body">
                                                    <h4>Rate your order</h4>
                                                        <div class="border-top">                                                            
                                                            <div class="form-group row">
                                                                <label for="fname" class="col-md-3 control-label col-form-label">Rate <span class="text-danger">*</span></label>
                                                                <div class="col-md-9">
                                                                <div class="rateyo" id= "rating"
                                                                    data-rateyo-rating="2.5"
                                                                    data-rateyo-num-stars="5"
                                                                    data-rateyo-score="2.5">
                                                                    </div>
                                                                <span class='result'>&nbsp;&nbsp;&nbsp;&nbsp;2.5</span>
                                                                <input type="hidden" class="form-control" id ="rate" name="rating" step="0.1"aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required autofocus>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="fname" class="col-md-3 control-label col-form-label">Comment</label>
                                                                <div class="col-md-9">
                                                                    <input type="text" class="min-today form-control" id="comment" name="comment" >
                                                                </div>
                                                            </div>
                                                            
                                                        </div>

                                                    </div>

                                                    <div class="border-top">
                                                        <div class="card-body" style="text-align:center;">
                                                            <button type="submit" class="btn btn-info">Submit</button>
                                                        </div>
                                                    </div>


                                                </div>
                                            </form>
                                            </div>
                                        </div>
                                    </div> 
                                    @endif

                                    @endif
                        </div>

    @endsection