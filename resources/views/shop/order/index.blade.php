@extends('shop.layouts.master')

@section('content')
    <div class="ms-auto text-end">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('shop/dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">All Order</li>
            </ol>
        </nav>
    </div>
    <div class="results">
        @if(Session::get('success'))
            <div class="alert alert-success" id="alert">
                {{Session::get('success')}}
            </div>
        @endif
        @if(Session::get('error'))
            <div class="alert alert-danger" id="alert">
                {{Session::get('error')}}
            </div>
        @endif
    </div>
    <div class="card">
        <div class="card-body">
            {{-- <h5 class="card-title">All Order</h5> --}}
            
            @php
                date_default_timezone_set("Asia/Kuala_Lumpur");
                $todayDate = date("Y-m-d");
                $countPreparing = \App\Models\Order::where('shop_id',$LoggedShopInfo->id)->where('status','like','preparing')->count();
                // $count = \App\Models\Order::where('shop_id',$LoggedShopInfo->id)->where('status','like','preparing')->where(DB::raw("(DATE_FORMAT(checkoutDelivery,'%Y-%m-%d'))"),'=',$todayDate)->count();
            @endphp

            <ul class="nav nav-tabs nav-pills" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="allOrder-tab" data-bs-toggle="tab" data-bs-target="#allOrder" type="button" role="tab" aria-controls="allOrder" aria-selected="true">All Order</button>
                </li>
                @if($countPreparing == 0)
                    <li class="nav-item" role="presentation">
                    <button class="nav-link" id="newOrder-tab" data-bs-toggle="tab" data-bs-target="#newOrder" type="button" role="tab" aria-controls="newOrder" aria-selected="false">New Order</button>
                    </li>
                @endif
                @if($countPreparing != 0)
                    <li class="nav-item" role="presentation">
                    <button class="nav-link" id="newOrder-tab" data-bs-toggle="tab" data-bs-target="#newOrder" type="button" role="tab" aria-controls="newOrder" aria-selected="false">New Order <span class="badge rounded-pill bg-danger">
                      {{$countPreparing}}</span></button>
                  </li>
                @endif
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="delivering-tab" data-bs-toggle="tab" data-bs-target="#delivering" type="button" role="tab" aria-controls="delivering" aria-selected="false">Delivering</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="completed-tab" data-bs-toggle="tab" data-bs-target="#completed" type="button" role="tab" aria-controls="completed" aria-selected="false">Completed</button>
                </li>
            </ul>

        {{-- START TAB --}}
            <div class="tab-content" id="myTabContent">
            {{-- VIEW ALL ORDER --}}
                <div class="tab-pane fade show active" id="allOrder" role="tabpanel" aria-labelledby="allOrder-tab"><br>
                    <div class="table-responsive">
                        <table id="myTable" class="table table-striped table-bordered">
                            <thead>
                                <tr class="table-info">
                                    <th><strong>No</strong></th>
                                    <th><strong>Order details</strong></th>
                                    <th><strong>Delivery date</strong></th>
                                    <th><strong>Delivery time</strong></th>
                                    <th><strong>Total amount</strong></th>
                                    <th><strong>Payment method</strong></th>
                                    <th><strong>Deliver grocery</strong></th>
                                    {{-- <th><strong>BUANG</strong></th>  --}}
                                    <th><strong>Status</strong></th> 
                                </tr>
                            </thead>
                            <tbody style="text-align:center;">
                                @foreach($custOrder as $order)
                                <tr>
                                    <td>{{$loop->iteration}}.</td>
                                    <td><div class="card card-hover"><a href="{{route('orderCustomer',['orderID' => $order->id])}}" data-toggle="tooltip" class="btn btn-sm btn-info" data-placement="bottom"><i class="fa fa-info-circle" aria-hidden="true"></i> Order details</a></div></td>
                                    <td>{{ \Carbon\Carbon::parse($order->checkoutDelivery)->format('d/m/Y')}}</td>
                                    <td>{{ \Carbon\Carbon::parse($order->checkoutDelivery)->format('H:i:s')}}</td>
                                    <td>RM{{$order->total_payment}}</td>
                                    <td>{{$order->payment}}</td>
                                    @if($order->status == 'preparing')
                                    <td><div class="card card-hover"><a style="color:white;" href="" data-toggle="modal" data-target="#deliverOrder{{$order->id}}" class="btn btn-sm btn-danger" data-placement="bottom"><i class="fa fa-info-circle" aria-hidden="true"></i> Deliver now!</a></div></td>
                                    {{-- <td>No</td> --}}
                                    <td class="text-danger">Preparing</td>
                                    @endif
                                    @if($order->status == 'delivering')
                                    <td>Item out for delivery</td>
                                    {{-- <td><div class="card card-hover"><a style="color:white;" href="" data-toggle="modal" data-target="#confirmPurchase{{$order->id}}" class="btn btn-sm btn-danger" data-placement="bottom">No</a></div></td> --}}
                                    <td class="text-warning">Delivering</td>
                                    @endif
                                    @if($order->status == 'delivered')
                                    <td>Successfully delivered</td>
                                    {{-- <td>Yes</td> --}}
                                    {{-- <td><p><span class="label label-success">Yes</span></p></td> --}}
                                    @php
                                        $ratingValue = \App\Models\Order::where('id',$order->id)->value('rate');          
                                    @endphp
                                    @if($ratingValue != NULL)
                                    <td><div class="card card-hover"><a style="color:white;" href="" data-toggle="modal" data-target="#viewRating{{$order->id}}" class="btn btn-sm btn-success" data-placement="bottom"><i class="fa fa-info-circle" aria-hidden="true"></i> View Rating</a></div></td>
                                    @else
                                    <td>Not rated yet</td>
                                    @endif
                                    @endif
                                    
                                </tr> 
                                <!-- Modal Deliver Order-->
                                    <div class="modal fade" id="deliverOrder{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="deliverOrderTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Deliver Order</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                            If you want to delivery the order, please click on <strong>"Deliver order"</strong> button and it will notify customer about their item are in delivering
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            {{-- <button id="deliveryOrder" type="submit" class="btn btn-primary" data-dismiss="modal">Deliver order</button> --}}
                                            <a href="{{route('deliveryOrder',['orderID' => $order->id])}}" class="btn btn-info" >Deliver Order</a>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                {{-- end Modal --}}

                                 <!-- Modal View Rating-->
                                 <div class="modal fade" id="viewRating{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="deliverOrderTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Customer rating for this order</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group row">
                                                <div class="col-md-4">
                                                    <strong>Rate: </strong>
                                                </div>
                                                <div class="col-md-8">
                                                    <p>{{\App\Models\Order::where('id',$order->id)->value('rate')}}</p>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-4">
                                                    <strong>Comment: </strong>
                                                </div>
                                                <div class="col-md-8">
                                                    <p>{{\App\Models\Order::where('id',$order->id)->value('comment')}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        {{-- <button id="deliveryOrder" type="submit" class="btn btn-primary" data-dismiss="modal">Deliver order</button> --}}
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            {{-- end Modal --}}
        
                                    <!-- Modal Confirm purchase-->
                                    {{-- <div class="modal fade" id="confirmPurchase{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="confirmPurchaseTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Done deliver the groceries</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                            If you done deliver the item, please click on <strong>"Done Deliver"</strong> button.
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <a href="{{route('confirmPurchase',['orderID' => $order->id])}}" class="btn btn-info" >Done Deliver</a>
                                            </div>
                                        </div>
                                        </div>
                                    </div> --}}
                                    {{-- end Modal --}}
                                @endforeach        
                            </tbody>
                        </table>
                    </div>
                </div>
            {{--END VIEW ALL ORDER --}}

            {{-- VIEW NEW ORDER --}}
                <div class="tab-pane fade" id="newOrder" role="tabpanel" aria-labelledby="newOrder-tab"><br>
                    <div class="table-responsive">
                        <table id="myTablePreparing" class="table table-striped table-bordered">
                            <thead>
                                <tr class="table-info">
                                    <th><strong>No</strong></th>
                                    <th><strong>Order details</strong></th>
                                    <th><strong>Delivery date</strong></th>
                                    <th><strong>Delivery time</strong></th>
                                    <th><strong>Total amount</strong></th>
                                    <th><strong>Payment method</strong></th>
                                    <th><strong>Deliver grocery</strong></th>
                                    {{-- <th><strong>Done Deliver</strong></th>  --}}
                                    <th><strong>Status</strong></th> 
                                </tr>
                            </thead>
                            <tbody style="text-align:center;">
                                    @foreach($PreparingOrder as $order)
                                        <tr>
                                            <td>{{$loop->iteration}}.</td>\
                                            <td><div class="card card-hover"><a href="{{route('orderCustomer',['orderID' => $order->id])}}" data-toggle="tooltip" class="btn btn-sm btn-info" data-placement="bottom"><i class="fa fa-info-circle" aria-hidden="true"></i> Order details</a></div></td>
                                            <td>{{ \Carbon\Carbon::parse($order->checkoutDelivery)->format('d/m/Y')}}</td>
                                            <td>{{ \Carbon\Carbon::parse($order->checkoutDelivery)->format('H:i:s')}}</td>
                                            <td>RM{{$order->total_payment}}</td>
                                            <td>{{$order->payment}}</td>
                                            <td><div class="card card-hover"><a style="color:white;" href="" data-toggle="modal" data-target="#deliverOrder1{{$order->id}}" class="btn btn-sm btn-danger" data-placement="bottom"><i class="fa fa-info-circle" aria-hidden="true"></i> Deliver now!</a></div></td>
                                            {{-- <td>No</td> --}}
                                            <td class="text-danger">Preparing</td>
                                        </tr>
                                    <!-- Modal Deliver Order-->
                                        <div class="modal fade" id="deliverOrder1{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="deliverOrderTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Deliver Order</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                If you want to delivery the order, please click on <strong>"Deliver order"</strong> button and it will notify customer about their item are in delivering
                                                </div>
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                {{-- <button id="deliveryOrder" type="submit" class="btn btn-primary" data-dismiss="modal">Deliver order</button> --}}
                                                <a href="{{route('deliveryOrder',['orderID' => $order->id])}}" class="btn btn-info" >Deliver Order</a>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    {{-- end Modal --}}
                                    @endforeach     
                            </tbody>
                        </table>
                    </div>
                </div>
            {{--END VIEW NEW ORDER --}}

            {{-- VIEW DELIVERING ORDER --}}
                <div class="tab-pane fade" id="delivering" role="tabpanel" aria-labelledby="delivering-tab"><br>
                    <div class="table-responsive">
                        <table id="myTableDelivering" class="table table-striped table-bordered">
                            <thead>
                                <tr class="table-info">
                                    <th><strong>No</strong></th>
                                    <th><strong>Order details</strong></th>
                                    <th><strong>Delivery date</strong></th>
                                    <th><strong>Delivery time</strong></th>
                                    <th><strong>Total amount</strong></th>
                                    <th><strong>Payment method</strong></th>
                                    <th><strong>Deliver grocery</strong></th>
                                    {{-- <th><strong>Done Deliver</strong></th>  --}}
                                    <th><strong>Status</strong></th> 
                                </tr>
                            </thead>
                            <tbody style="text-align:center;">
                                    @foreach($DeliveringOrder as $order)
                                        <tr>
                                            <td>{{$loop->iteration}}.</td>
                                            <td><div class="card card-hover"><a href="{{route('orderCustomer',['orderID' => $order->id])}}" data-toggle="tooltip" class="btn btn-sm btn-info" data-placement="bottom"><i class="fa fa-info-circle" aria-hidden="true"></i> Order details</a></div></td>
                                            <td>{{ \Carbon\Carbon::parse($order->checkoutDelivery)->format('d/m/Y')}}</td>
                                            <td>{{ \Carbon\Carbon::parse($order->checkoutDelivery)->format('H:i:s')}}</td>
                                            <td>RM{{$order->total_payment}}</td>
                                            <td>{{$order->payment}}</td>
                                            <td>Item out for delivery</td>
                                            {{-- <td><div class="card card-hover"><a style="color:white;" href="" data-toggle="modal" data-target="#confirmPurchase1{{$order->id}}" class="btn btn-sm btn-danger" data-placement="bottom">No</a></div></td> --}}
                                            <td class="text-warning">Delivering</td>
                                        </tr>
                                    <!-- Modal Confirm purchase-->
                                    {{-- <div class="modal fade" id="confirmPurchase1{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="confirmPurchaseTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Done deliver the groceries</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                            If you done deliver the item, please click on <strong>"Done Deliver"</strong> button.
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <a href="{{route('confirmPurchase',['orderID' => $order->id])}}" class="btn btn-info" >Done Deliver</a>
                                            </div>
                                        </div>
                                        </div>
                                    </div> --}}
                                    {{-- end Modal --}}
                                    @endforeach   
                            </tbody>
                        </table>
                    </div>
                </div>
            {{--END VIEW DELIVERING ORDER --}}

            {{-- VIEW COMPLETED ORDER --}}
                <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="completed-tab"><br>
                    <div class="table-responsive">
                        <table id="myTableDelivered" class="table table-striped table-bordered">
                            <thead>
                                <tr class="table-info">
                                    <th><strong>No</strong></th>
                                    <th><strong>Order details</strong></th>
                                    <th><strong>Delivery date</strong></th>
                                    <th><strong>Delivery time</strong></th>
                                    <th><strong>Total amount</strong></th>
                                    <th><strong>Payment method</strong></th>
                                    <th><strong>Deliver grocery</strong></th>
                                    {{-- <th><strong>Done Deliver</strong></th>  --}}
                                    <th><strong>Status</strong></th> 
                                </tr>
                            </thead>
                            <tbody style="text-align:center;">
                                    @foreach($DeliveredOrder as $order)
                                        <tr>
                                            <td>{{$loop->iteration}}.</td>
                                            <td><div class="card card-hover"><a href="{{route('orderCustomer',['orderID' => $order->id])}}" data-toggle="tooltip" class="btn btn-sm btn-info" data-placement="bottom"><i class="fa fa-info-circle" aria-hidden="true"></i> Order details</a></div></td>
                                            <td>{{ \Carbon\Carbon::parse($order->checkoutDelivery)->format('d/m/Y')}}</td>
                                            <td>{{ \Carbon\Carbon::parse($order->checkoutDelivery)->format('H:i:s')}}</td>
                                            <td>RM{{$order->total_payment}}</td>
                                            <td>{{$order->payment}}</td>
                                            <td>Successfully delivered</td>
                                            {{-- <td>Yes</td> --}}
                                            @php
                                                $ratingValues = \App\Models\Order::where('id',$order->id)->value('rate');          
                                            @endphp
                                            @if($ratingValues != NULL)
                                            <td><div class="card card-hover"><a style="color:white;" href="" data-toggle="modal" data-target="#viewRating1{{$order->id}}" class="btn btn-sm btn-success" data-placement="bottom"><i class="fa fa-info-circle" aria-hidden="true"></i> View Rating</a></div></td>
                                            @else
                                            <td>Not rated yet</td>
                                            @endif                                        </tr>

                                        <!-- Modal View Rating-->
                                            <div class="modal fade" id="viewRating1{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="viewRating" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Customer rating for this order</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <strong>Rate: </strong>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <p>{{\App\Models\Order::where('id',$order->id)->value('rate')}}</p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <strong>Comment: </strong>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <p>{{\App\Models\Order::where('id',$order->id)->value('comment')}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    {{-- <button id="deliveryOrder" type="submit" class="btn btn-primary" data-dismiss="modal">Deliver order</button> --}}
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                        {{-- end Modal --}}
                                    @endforeach   
                            </tbody>
                        </table>
                    </div>
                </div>
            {{--END VIEW COMPLETED ORDER --}}
            </div>
        {{-- END TAB --}}
        </div>
    </div>
@endsection

@section('script')
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
    $(document).ready( function () {
    $('#myTable').DataTable(); //category table
    } );
</script>
<script>
    $(document).ready( function () {
    $('#myTablePreparing').DataTable(); //category table
    } );
</script>
<script>
    $(document).ready( function () {
    $('#myTableDelivering').DataTable(); //category table
    } );
</script>
<script>
    $(document).ready( function () {
    $('#myTableDelivered').DataTable(); //category table
    } );
</script>

{{-- <script>
    $('#deliveryOrder').on('click',function(){
        var order_id       = $('#order_id').val();

        $.ajax({
            type    : "POST",
            url     : "{{route('deliver.order')}}", 
            data    : {
                _token:'{{csrf_token()}}',
                order_id:order_id
                },
            success:function(response){
                alert('Succesfully notify customer about delivery info');
                location.reload();
            }
        });
    });
</script> --}}
@endsection