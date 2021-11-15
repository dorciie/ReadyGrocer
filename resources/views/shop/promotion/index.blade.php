@extends('shop.layouts.master')

@section('content')
<div class="ms-auto text-end">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('shop/dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Schedule Promotion</li>
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
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Schedule promotion</h5>
                <a class="btn btn-sm btn-info" href="{{route('promotion.create')}}"><i class="fa fa-plus"></i> Schedule new promotion</a>
                <br><br>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped table-bordered table-sm">
                        <thead>
                            <tr class="table-info">
                                <th style="width:100px;"><strong>No</strong></th>
                                <th style="width:100px;"><strong>Items</strong></th>{{-- boleh tick banyak item kat sini --}}
                                <th style="width:100px;"><strong>Brand</strong></th>
                                <th style="width:100px;"><strong>Start Promotion</strong></th>{{-- bila tekan view "icon mata", show table semua item+price before and after promotion --}}
                                <th style="width:100px;"><strong>End Promotion</strong></th>
                                <th style="width:100px;"><strong>Day(s)</strong></th>
                                <th style="width:100px;"><strong>Price</strong></th>
                                <th style="width:100px;"><strong>Discount</strong></th>
                                <th style="width:100px;"><strong>Offer Price</strong></th>
                                <th style="width:100px;"><strong>Action</strong></th>
                            </tr>
                        </thead>
                        <tbody style="text-align:center;">
                            @foreach($shopItem as $item)</td>
                            <input type="hidden" value="{{$start_date = \Carbon\Carbon::parse($item->item_startPromo)}}">
                            <input type="hidden" value="{{$end_date = \Carbon\Carbon::parse($item->item_endPromo)}}">
                            <input type="hidden" value="{{$different_days = $start_date->diffInDays($end_date)}}">
                            <tr>
                                <td>{{$loop->iteration}}.</td>
                                <td>{{$item->item_name}}</td>
                                <td>{{$item->item_brand}}</td>
                                <td>{{ \Carbon\Carbon::parse($item->item_startPromo)->format('d/m/Y')}}</td>
                                <td>{{ \Carbon\Carbon::parse($item->item_endPromo)->format('d/m/Y')}}</td>
                                <td>{{$different_days+1}}</td>
                                <td>RM{{$item->item_price}}</td>
                                <td>{{$item->item_discount}}%</td>
                                <td>RM{{$item->offer_price}}</td>
                                <td>
                                    <a href="{{route('promotion.edit',$item->id)}}" data-toggle="tooltip" class="btn btn-sm btn-info" data-placement="bottom"><i class="fas fa-edit"></i></a>
                                    <form action="{{route('promotion.destroy',$item->id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <a href="" data-toggle="tooltip" data-id="{{$item->id}}" class="dltBtn btn btn-sm btn-danger" data-placement="bottom"><i style="color: white" class="fas fa-trash-alt"></i></a>
                                    </form>
                                </td>
                            </tr>  
                            @endforeach  
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.dltBtn').click(function(e){
        var form=$(this).closest('form');
        var dataID =$(this).data('id');
        e.preventDefault();
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this promotion!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                form.submit();
                swal("Poof! This promotion has been deleted!", {
                icon: "success",
                });
            } else {
                swal("This promotion is not deleted!");
            }
        });
    });
</script>
<script>
    $(document).ready( function () {
    $('#myTable').DataTable(); //category table
    } );
</script>
@endsection