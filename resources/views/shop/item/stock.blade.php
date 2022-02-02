@extends('shop.layouts.master')

@section('content')
{{-- <style>
    body {
    /* Set "my-sec-counter" to 0 */
    counter-reset: my-sec-counter;
    }

    #counter::before {
    /* Increment "my-sec-counter" by 1 */
    counter-increment: my-sec-counter;
    content: counter(my-sec-counter) ". ";
    }      
</style> --}}
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

<div class="alert alert-info alert-dismissible fade show" role="alert">
    This items are in recommendation list to customer but it is already <strong>low in stock</strong> <br>
    @foreach($recommendation as $recommendation)
        <li>{{$recommendation->item_name}}, {{$recommendation->item_brand}}
    @endforeach
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div> 

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Update Item Stock</h5>

        {{-- NAV TAB --}}
        <ul class="nav nav-tabs nav-pills" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="allItem-tab" data-bs-toggle="tab" data-bs-target="#allItem" type="button" role="tab" aria-controls="allItem" aria-selected="true">All Item</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="noStock-tab" data-bs-toggle="tab" data-bs-target="#noStock" type="button" role="tab" aria-controls="noStock" aria-selected="false">Out of Stock</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="lowStock-tab" data-bs-toggle="tab" data-bs-target="#lowStock" type="button" role="tab" aria-controls="lowStock" aria-selected="false">Low in Stock</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="activeStock-tab" data-bs-toggle="tab" data-bs-target="#activeStock" type="button" role="tab" aria-controls="activeStock" aria-selected="false">Active</button>
            </li>
        </ul>
        {{--END NAV TAB --}}

        {{-- TAB CONTENT --}}
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="allItem" role="tabpanel" aria-labelledby="allItem-tab"><br>
                {{-- TABLE ALL STOCK --}}
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped table-bordered">
                        <thead>
                            <tr class="table-info">
                                <th><strong>No</strong></th>
                                <th><strong>Item Name</strong></th>
                                {{-- <th>Item Category</th> --}}
                                <th><strong>Brand</strong></th>
                                <th><strong>Current stock</strong></th> 
                                <th><strong>Status</strong></th> 
                                <th><strong>Update Stock</strong></th> 
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($Itemstock as $itemstock)
                            <tr>
                                <td>{{$loop->iteration}}.</td>
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
                                    <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#itemID{{$itemstock->id}}">Update Stock</button>
                                </td>
                            </tr>
                            {{-- MODAL ALL STOCK --}}
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
                                                        <label>Item Quantity <span class="text-danger">*</span></label>
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
                                                <button type="submit" class="btn btn-info">Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            {{--END MODAL ALL STOCK --}}
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{--END TABLE ALL STOCK --}}
            </div>
            <div class="tab-pane fade" id="noStock" role="tabpanel" aria-labelledby="noStock-tab"><br>
                {{-- TABLE NO STOCK --}}
                <div class="table-responsive">
                    <table id="myTableNoStock" class="table table-striped table-bordered">
                        <thead>
                            <tr class="table-info">
                                <th><strong>No</strong></th>
                                <th><strong>Item Name</strong></th>
                                {{-- <th>Item Category</th> --}}
                                <th><strong>Brand</strong></th>
                                <th><strong>Current stock</strong></th> 
                                <th><strong>Status</strong></th> 
                                <th><strong>Update Stock</strong></th> 
                            </tr>
                        </thead>
                        <tbody>
                                @foreach($NoStock as $itemstock)
                                    <tr>
                                        <td>{{$loop->iteration}}.</td>
                                        <td>{{$itemstock->item_name}}</td>
                                        {{-- <td>{{$itemstock->category_name}}</td> --}}
                                        <td>{{$itemstock->item_brand}}</td>
                                        <td>{{$itemstock->item_stock}}</td>
                                        <td><span class="label label-danger">Out of stock</span></td>
                                        <td>
                                            <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#itemID1{{$itemstock->id}}">Update Stock</button>
                                        </td>
                                    </tr>
                                    {{-- MODAL STOCK --}}
                                    <div class="modal fade" id="itemID1{{$itemstock->id}}"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                <label>Item Quantity <span class="text-danger">*</span></label>
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
                                                        <button type="submit" class="btn btn-info">Save changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    {{--END MODAL STOCK --}}
                                @endforeach
                        </tbody>
                    </table>
                </div>
                {{--END TABLE NO STOCK --}}
            </div>
            <div class="tab-pane fade" id="lowStock" role="tabpanel" aria-labelledby="lowStock-tab"><br>
                {{-- TABLE LOW STOCK --}}
                <div class="table-responsive">
                    <table id="myTableLowStock" class="table table-striped table-bordered">
                        <thead>
                            <tr class="table-info">
                                <th><strong>No</strong></th>
                                <th><strong>Item Name</strong></th>
                                {{-- <th>Item Category</th> --}}
                                <th><strong>Brand</strong></th>
                                <th><strong>Current stock</strong></th> 
                                <th><strong>Status</strong></th> 
                                <th><strong>Update Stock</strong></th> 
                            </tr>
                        </thead>
                        <tbody>
                                @foreach($LowStock as $itemstock)
                                    <tr>
                                        <td>{{$loop->iteration}}.</td>
                                        <td>{{$itemstock->item_name}}</td>
                                        {{-- <td>{{$itemstock->category_name}}</td> --}}
                                        <td>{{$itemstock->item_brand}}</td>
                                        <td>{{$itemstock->item_stock}}</td>
                                        <td><span class="label label-warning">Low in stock</span></td>
                                        <td>
                                            <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#itemID2{{$itemstock->id}}">Update Stock</button>
                                        </td>
                                    </tr>
                                    {{-- MODAL STOCK --}}
                                    <div class="modal fade" id="itemID2{{$itemstock->id}}"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                <label>Item Quantity <span class="text-danger">*</span></label>
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
                                                        <button type="submit" class="btn btn-info">Save changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    {{--END MODAL STOCK --}}
                                @endforeach
                        </tbody>
                    </table>
                </div>
                {{--END TABLE LOW STOCK --}}
            </div>
            <div class="tab-pane fade" id="activeStock" role="tabpanel" aria-labelledby="activeStock-tab"><br>
                 {{-- TABLE ACTIVE STOCK --}}
                 <div class="table-responsive">
                    <table id="myTableActive" class="table table-striped table-bordered">
                        <thead>
                            <tr class="table-info">
                                <th><strong>No</strong></th>
                                <th><strong>Item Name</strong></th>
                                {{-- <th>Item Category</th> --}}
                                <th><strong>Brand</strong></th>
                                <th><strong>Current stock</strong></th> 
                                <th><strong>Status</strong></th> 
                                <th><strong>Update Stock</strong></th> 
                            </tr>
                        </thead>
                        <tbody>
                                @foreach($ActiveStock as $itemstock)
                                    <tr>
                                        <td>{{$loop->iteration}}.</td>
                                        {{-- <td><div id="counter"></div></td> --}}
                                        <td>{{$itemstock->item_name}}</td>
                                        {{-- <td>{{$itemstock->category_name}}</td> --}}
                                        <td>{{$itemstock->item_brand}}</td>
                                        <td>{{$itemstock->item_stock}}</td>
                                        <td><span class="label label-success">Active</span></td>
                                        <td>
                                            <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#itemID3{{$itemstock->id}}">Update Stock</button>
                                        </td>
                                    </tr>
                                
                                    {{-- MODAL ALL STOCK --}}
                                    <div class="modal fade" id="itemID3{{$itemstock->id}}"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                <label>Item Quantity <span class="text-danger">*</span></label>
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
                                                        <button type="submit" class="btn btn-info">Save changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    {{--END MODAL STOCK --}}
                                @endforeach
                        </tbody>
                    </table>
                </div>
                {{--END TABLE ACTIVE STOCK --}}
            </div>
        </div>
        {{-- END TAB CONTENT --}}
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready( function () {
    $('#myTable').DataTable(); //category table
    } );
</script>
<script>
    $(document).ready( function () {
    $('#myTableNoStock').DataTable(); //category table
    } );
</script>
<script>
    $(document).ready( function () {
    $('#myTableLowStock').DataTable(); //category table
    } );
</script>
<script>
    $(document).ready( function () {
    $('#myTableActive').DataTable(); //category table
    } );
</script>
@endsection