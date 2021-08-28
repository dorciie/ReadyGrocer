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
            <h5 class="card-title">All Order</h5>
            
            <div class="alert alert-primary">
                @php
                date_default_timezone_set("Asia/Kuala_Lumpur");
                $todayDate = date("Y-m-d");
                $count = \App\Models\Order::where('shop_id',$LoggedShopInfo->id)->where('status','like','preparing')->where(DB::raw("(DATE_FORMAT(checkoutDelivery,'%Y-%m-%d'))"),'=',$todayDate)->count();
                @endphp
                You need to deliver <strong>{{$count}} </strong>order today.
            </div>

            <div class="table-responsive">
                <table id="myTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Delivery date</th>
                            <th>Delivery time</th>
                            <th>Total amount</th>
                            <th>Payment method</th>
                            <th>Deliver grocery</th>
                            <th>Done Deliver</th> 
                            <th>Status</th> 
                        </tr>
                    </thead>
                    <tbody style="text-align:center;">
                        @foreach($custOrder as $order)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td><div class="card card-hover"><a href="{{route('orderCustomer',['orderID' => $order->id])}}" data-toggle="tooltip" class="btn btn-sm btn-info" data-placement="bottom">{{$order->name}}</a></div></td>
                            <td>{{ \Carbon\Carbon::parse($order->checkoutDelivery)->format('d/m/Y')}}</td>
                            <td>{{ \Carbon\Carbon::parse($order->checkoutDelivery)->format('H:i:s')}}</td>
                            <td>RM{{$order->total_payment}}</td>
                            <td>{{$order->payment}}</td>
                            @if($order->status == 'preparing')
                            <td><div class="card card-hover"><a style="color:white;" href="" data-toggle="modal" data-target="#deliverOrder{{$order->id}}" class="btn btn-sm btn-danger" data-placement="bottom">No</a></div></td>
                            <td>No</td>
                            <td><h4><span class="label label-warning">Preparing</span></h4></td>
                            @endif
                            @if($order->status == 'delivering')
                            <td>Yes</td>
                            <td><div class="card card-hover"><a style="color:white;" href="" data-toggle="modal" data-target="#confirmPurchase{{$order->id}}" class="btn btn-sm btn-danger" data-placement="bottom">No</a></div></td>
                            <td><h4><span class="label label-primary">Delivering</span></h4></td>
                            @endif
                            @if($order->status == 'delivered')
                            <td>Yes</td>
                            <td>Yes</td>
                            {{-- <td><p><span class="label label-success">Yes</span></p></td> --}}
                            <td><h4><span class="label label-success">Delivered</span></h4></td>
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

                            <!-- Modal Confirm purchase-->
                            <div class="modal fade" id="confirmPurchase{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="confirmPurchaseTitle" aria-hidden="true">
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
                                    {{-- <button id="confirmPurchase" type="submit" class="btn btn-primary">Confirm Delivery</button> --}}
                                    <a href="{{route('confirmPurchase',['orderID' => $order->id])}}" class="btn btn-info" >Done Deliver</a>
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
    </div>
@endsection

@section('script')
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
    $(document).ready( function () {
    $('#myTable').DataTable(); //category table
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