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
            <br><br>
            <div class="table-responsive">
                <table id="myTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Delivery time</th> {{-- multiple image (video 12, mins 1826) --}}
                            <th>Total amount</th>
                            <th>Payment method</th>
                            <th>Deliver grocery</th>
                            <th>Confirm Purchase</th> 
                            <th>Status</th> 
                        </tr>
                    </thead>
                    <tbody style="text-align:center;">
                        <tr>
                            <td>1</td>
                            <td><a href="order_customer" data-toggle="tooltip" class="btn btn-sm btn-info" data-placement="bottom">customer1</a></td>
                            <td>13:30:00</td>
                            <td>RM500.00</td>
                            <td>Cash</td>
                            {{-- if status = processing, delivery grocery no == --}}
                            <td id="buttonDelivery"><a style="color:white;" href="javascript:void(0);" data-toggle="modal" data-target="#deliverOrder" class="btn btn-sm btn-danger" data-placement="bottom">no</a></td>
                            {{-- if status = delivering, deliver grocery yes --}}
                            {{-- <td>Yes</td> --}}
                            {{-- <td><a style="color:white;" href="javascript:void(0);" data-toggle="modal" data-target="#confirmPurchase" class="btn btn-sm btn-danger" data-placement="bottom">no</a></td> --}}
                            <td><p><span class="label label-warning">no</span></p></td>
                            <td><p><span class="label label-warning">preparing</span></p></td>
                        </tr>    
                        <tr>
                            <td>2</td>
                            <td><a href="order_customer" data-toggle="tooltip" class="btn btn-sm btn-info" data-placement="bottom">customer2</a></td>
                            <td>15:00:00</td>
                            <td>RM100.00</td>
                            <td>Cash</td>
                            {{-- if status = processing, delivery grocery no == --}}
                            {{-- <td id="buttonDelivery"><a style="color:white;" href="javascript:void(0);" data-toggle="modal" data-target="#deliverOrder" class="btn btn-sm btn-danger" data-placement="bottom">no</a></td> --}}
                            {{-- if status = delivering, deliver grocery yes --}}
                            <td><p><span class="label label-success">Yes</span></p></td>
                            <td><a style="color:white;" href="javascript:void(0);" data-toggle="modal" data-target="#confirmPurchase" class="btn btn-sm btn-danger" data-placement="bottom">no</a></td>
                            <td><p><span class="label label-primary">delivering</span></p></td>
                        </tr>  
                        <tr>
                            <td>3</td>
                            <td><a href="order_customer" data-toggle="tooltip" class="btn btn-sm btn-info" data-placement="bottom">customer3</a></td>
                            <td>12:00:00</td>
                            <td>RM200.00</td>
                            <td>Cash</td>
                            {{-- if status = processing, delivery grocery no == --}}
                            {{-- <td id="buttonDelivery"><a style="color:white;" href="javascript:void(0);" data-toggle="modal" data-target="#deliverOrder" class="btn btn-sm btn-danger" data-placement="bottom">no</a></td> --}}
                            {{-- if status = delivering, deliver grocery yes --}}
                            <td><p><span class="label label-success">Yes</span></p></td>
                            {{-- <td><a style="color:white;" href="javascript:void(0);" data-toggle="modal" data-target="#confirmPurchase" class="btn btn-sm btn-danger" data-placement="bottom">no</a></td> --}}
                            <td><p><span class="label label-success">Yes</span></p></td>
                            <td><p><span class="label label-success">delivered</span></p></td>
                        </tr>          
                    </tbody>
                </table>
                 <!-- Modal Deliver Order-->
                 <div class="modal fade" id="deliverOrder" tabindex="-1" role="dialog" aria-labelledby="deliverOrderTitle" aria-hidden="true">
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
                        <button id="deliveryOrder" type="submit" class="btn btn-primary" data-dismiss="modal">Deliver order</button>
                        </div>
                    </div>
                    </div>
                </div>
                {{-- end Modal --}}

                 <!-- Modal Confirm purchase-->
                 <div class="modal fade" id="confirmPurchase" tabindex="-1" role="dialog" aria-labelledby="confirmPurchaseTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Confirm Purchase</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                        If you done deliver the item, please click on <strong>"Confirm Purchase"</strong> button.
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Confirm Purchase</button>
                        </div>
                    </div>
                    </div>
                </div>
                {{-- end Modal --}}
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
<script>
    $('#deliveryOrder').on('click',function(){
        var custEmail   = 'customer1@customer1.com';
        // var shopID      = $LoggedShopInfo->id;

        $.ajax({
            type    : "POST",
            url     : "{{route('deliver.order')}}", //tambah ni kat belakang $shopOwner->id
            data    : {
                _token:'{{csrf_token()}}',
                custEmail:custEmail
                },
            success:function(response){
                document.getElementById("buttonDelivery").innerHTML = "Yes"; //yang ni boleh buang, ubah status dalam database shj then html akan ubah
                // status jadi delivering - deliver = yes
                //status delivered - confirm purchase = yes
                alert('Succesfully notify customer about delivery info');
            }
        });
    });
</script>
@endsection