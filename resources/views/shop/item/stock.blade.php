@extends('shop.layouts.master')

@section('content')
<div class="ms-auto text-end">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('shop/dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Item Stock</li>
        </ol>
    </nav>
</div>
<div class="results">
    @if(Session::get('success'))
        <div class="alert alert-success" id="alert">
            {{Session::get('success')}}
        </div>
    @endif
    @if(Session::get('fail'))
        <div class="alert alert-danger" id="alert">
            {{Session::get('fail')}}
        </div>
    @endif
</div>
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Update Item Stock</h5>
        <div class="table-responsive">
            <table id="myTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Number</th>
                        <th>Item Name</th>
                        {{-- <th>Item Category</th> --}}
                        <th>Brand</th>
                        <th>Current stock</th> 
                        <th>Status</th> 
                        <th>Update Stock</th> 
                    </tr>
                </thead>
                <tbody>
                    @foreach($Itemstock as $itemstock)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$itemstock->item_name}}</td>
                        {{-- <td>{{$itemstock->category_name}}</td> --}}
                        <td>{{$itemstock->item_brand}}</td>
                        <td>{{$itemstock->item_stock}}</td>
                            @if($itemstock->item_stock <='10' && $itemstock->item_stock >'0')
                        <td><span class="label label-warning">Low in stock</span></td>
                            @endif
                            @if($itemstock->item_stock>'10')
                        <td><span class="label label-success">Active</span></td>
                            @endif
                            @if($itemstock->item_stock=='0')
                        <td><span class="label label-danger">Out of stock</span></td>
                            @endif
                        <td>
                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#itemID{{$itemstock->id}}">Update Stock</button>
                        </td>
                    </tr>

                    <div class="modal fade" id="itemID{{$itemstock->id}}"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <form method="get" action="{{route('updateStock',['itemID' => $itemstock->id])}}">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Update Stock for {{$itemstock->item_name}}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Item Quantity</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-group mb-3">
                                                    <input type="number" class="form-control" name="item_stock" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="{{$itemstock->item_stock}}" required>
                                                    <span class="text-danger">@error('item_stock'){{ $message }} @enderror</span>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready( function () {
    $('#myTable').DataTable(); //category table
    } );
</script>
@endsection