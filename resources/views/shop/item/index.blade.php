@extends('shop.layouts.master')

@section('content')
    <div class="ms-auto text-end">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('shop/dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">All Item</li>
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
        @if(count($errors)>0)
            <div class="alert alert-danger" id="alert">
                Upload Validation Error
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">All Items</h3>
            <p>Total item: {{\App\Models\ShopItem::where('shop_id',$LoggedShopInfo->id)->count()}}</p>
            <a class="btn btn-sm btn-info" href="{{route('item.create')}}"><i class="fa fa-plus"></i> Add New Item</a>
            <h6> </h6>
            <p>
                <button class="btn btn-sm btn-info" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-plus"></i> Import Items from excel</button>
            </p>
              <div class="collapse" id="collapseExample">
                <div class="card card-body">
                    <div class="alert alert-info" role="alert">
                        <h4 class="alert-heading">Important note before import the item!</h4>
                        <p>Make sure data from excel file follow this sequence.</p>
                        <p><strong>[ Item name, Item brand, Item price, Item Stock, Item Volume/Weight ]</strong></p>
                        <hr>
                        <form method="post" enctype="multipart/form-data" action="{{route('shop.import')}}">
                            @csrf
                            <div class="form-group">
                                <label for="file">Import item: </label>
                                {{-- <label class="file"> --}}
                                    <input type="file" id="file" name="file" aria-label="File browser example" accept=".xls, .xlsx">
                                    <span class="file-custom"></span>
                                    <button type="submit" class="btn btn-info">Import</button>
                                {{-- </label> --}}
                                {{-- <input style="length: 50px" type="file" name="file" class="form-control" accept=".xls, .xlsx"/> --}}
                            </div>
                        </form>
                        <p class="mb-0">Make sure to assign the category for each items after imported the item.</p>
                    </div>
                </div>
              </div>

            <div class="table-responsive">
                <table id="myTable" class="table table-striped table-bordered">
                    <thead>
                        <tr class="table-info">
                            {{-- <th>No</th> --}}
                            <th><strong>Name</strong></th>
                            <th><strong>Image</strong></th> {{-- multiple image (video 12, mins 1826) --}}
                            <th><strong>Brand</strong></th>
                            <th><strong>Stock</strong></th>
                            {{-- <th>Status</th> --}}
                            <th><strong>Category</strong></th>
                            <th><strong>Action</strong></th> 
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($shopItem as $item)
                        <tr>
                            {{-- <td>{{$loop->iteration}}</td> --}}
                            <td>{{$item->item_name}}</td>
                            @if($item->item_image != NULL)
                            <td><img src="{{ Storage::url($item->item_image) }}" width="100px"></td>
                            @endif
                            @if($item->item_image == NULL)
                            <td>No image yet</td>
                            @endif
                            <td>{{$item->item_brand}}</td>
                            <td>{{$item->item_stock}}</td>

                            {{-- @if($item->item_stock <='10' && $item->item_stock >'0')
                            <td><span class="label label-warning">Low in stock</span></td>
                            @endif
                            @if($item->item_stock>'10')
                            <td><span class="label label-success">Active</span></td>
                            @endif
                            @if($item->item_stock=='0')
                            <td><span class="label label-danger">Out of stock</span></td>
                            @endif --}}

                            @if($item->category_id != NULL)
                            <td>{{\App\Models\Category::where('id',$item->category_id)->where('shop_id',$LoggedShopInfo->id)->value('category_name')}}</td>
                            @endif
                            @if($item->category_id == NULL)
                            <td><span class="label label-danger">Not assign yet</span></td>
                            @endif

                            <td>
                                <a style="float: left;" href="javascript:void(0);" data-toggle="modal" data-target="#productID{{$item->id}}" class="btn btn-sm btn-secondary" data-placement="bottom"><i class="fas fa-eye"></i></a>
                                <a style="float: left; margin-left: 5px;" href="{{route('item.edit',$item->id)}}" data-toggle="tooltip" class="btn btn-sm btn-info" data-placement="bottom"><i class="fas fa-edit"></i></a>
                                <form style="float: left; margin-left: 5px;" action="{{route('item.destroy',$item->id)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <a href="" data-toggle="tooltip" data-id="{{$item->id}}" class="dltBtn btn btn-sm btn-danger" data-placement="bottom"><i style="color: white" class="fas fa-trash-alt"></i></a>
                                </form>
                            </td>
                        </tr>
                         <!-- Modal -->
                        <div class="modal fade" id="productID{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                @php
                                    $product=\App\Models\ShopItem::where('id',$item->id)->first();
                                @endphp
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">{{$product->item_name}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    <strong>Description: </strong>
                                    <p>{!! html_entity_decode($product->item_description)!!}</p>

                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <strong>Price: </strong>
                                            <p>RM{{number_format($product->item_price,2)}}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <strong>Offer price: </strong>
                                            <p>RM{{number_format($product->offer_price,2)}}</p>
                                        </div>
                                        @if($product->item_discount != "")
                                            <div class="col-md-6">
                                                <strong>Discount: </strong>
                                                <p>{{$product->item_discount}}%</p>
                                            </div>
                                        @endif
                                        @if($product->item_discount == "")
                                            <div class="col-md-6">
                                                <strong>Discount: </strong>
                                                <p>No discount offer for this item</p>
                                            </div>
                                        @endif
                                        <div class="col-md-6">
                                            <strong>Volume/Weight: </strong>
                                            <p>{{$product->item_size}}</p>
                                        </div>
                                        @if($product->item_startPromo != "")
                                        <div class="col-md-6">
                                            <strong>Promotion start: </strong>
                                            <p>{{ \Carbon\Carbon::parse($product->item_startPromo)->format('d/m/Y')}}</p>
                                        </div>
                                        @endif
                                        @if($product->item_endPromo != "")
                                        <div class="col-md-6">
                                            <strong>Promotion end: </strong>
                                            <p>{{ \Carbon\Carbon::parse($product->item_endPromo)->format('d/m/Y')}}</p>
                                        </div>
                                        @endif
                                        <div class="col-md-6">
                                            <strong>Category: </strong>
                                            @if($product->category_id != NULL)
                                            <p>{{\App\Models\Category::where('id',$product->category_id)->where('shop_id',$LoggedShopInfo->id)->value('category_name')}}</p>
                                            @endif
                                            @if($product->category_id == NULL)
                                            <p><span class="label label-danger">Not assign yet</span></p>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <strong>Status: </strong>
                                            @if($product->item_stock<="10" && $product->item_stock>"0")
                                            <p> <span class="label label-warning">Low in stock</span></p>
                                            @endif
                                            @if($product->item_stock>"10")
                                            <p> <span class="label label-success">Active</span></p>
                                            @endif
                                            @if($product->item_stock=="0")
                                            <p> <span class="label label-danger">Out of stock</span></p>
                                            @endif
                                        </div>
                                    </div>
 
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
            text: "Once deleted, you will not be able to recover this item!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                form.submit();
                swal("Poof! This item has been deleted!", {
                icon: "success",
                });
            } else {
                swal("This item is not deleted!");
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
