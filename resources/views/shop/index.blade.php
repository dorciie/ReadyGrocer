@extends('shop.layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- Sales Cards  -->
        <div class="row">
            <!-- Column -->
            <div class="col-md-6 col-lg-4 col-xlg-3">
                <div class="card card-hover">
                    <div class="box bg-cyan text-center">
                        <h1 class="font-light text-white"><i class="mdi mdi-view-dashboard"></i></h1>
                        <h6 class="text-white">Total item in the shop</h6>
                        <h6 class="text-white">{{\App\Models\ShopItem::where('shop_id',$LoggedShopInfo->id)->count()}}</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 col-xlg-3">
                <div class="card card-hover">
                    <div class="box bg-success text-center">
                        <h1 class="font-light text-white"><i class="mdi mdi-chart-bubble"></i></h1>
                        <h6 class="text-white">Total category of the item</h6>
                        <h6 class="text-white">{{\App\Models\Category::where('shop_id',$LoggedShopInfo->id)->count()}}</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 col-xlg-3">
                <div class="card card-hover">
                    <div class="box bg-info text-center">
                        <h1 class="font-light text-white"><i class="mdi mdi-chart-bar"></i></h1>
                        <h6 class="text-white">Total sales on current month</h6>
                        <h6 class="text-white">RM 100.00</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Column -->
            <div class="col-md-6">
                <div class="card card-hover">
                    <div class="box bg-warning text-center">
                        <h1 class="font-light text-white"><i class="mdi mdi-alert-box"></i></h1>
                        <h6 class="text-white">Items low in stock: {{\App\Models\ShopItem::where('shop_id',$LoggedShopInfo->id)->where('item_stock','<=','10')->where('item_stock','>','0')->count()}}</h6>
                        {{-- <h6 class="text-white"></h6> --}}
                        <button type="button" class="btn btn-outline-dark btn-sm" data-bs-toggle="modal" data-bs-target="#lowStock">View items</button>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-hover">
                    <div class="box bg-danger text-center">
                        <h1 class="font-light text-white"><i class="mdi mdi-alert"></i></h1>
                        <h6 class="text-white">Items out of stock: {{\App\Models\ShopItem::where('shop_id',$LoggedShopInfo->id)->where('item_stock','==','0')->count()}}</h6>
                        {{-- <h6 class="text-white"></h6> --}}
                        <button type="button" class="btn btn-outline-dark btn-sm" data-bs-toggle="modal" data-bs-target="#noStock">View items</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sales chart -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-md-flex align-items-center">
                            <div>
                                <h4 class="card-title">Activity Log</h4>
                                <h5 class="card-subtitle"></h5>
                            </div>
                        </div>
                        <div class="row">
                            <!-- column -->
                            <div class="col-lg-11">
                                <div class="flot-chart">
                                    {{-- <div class="flot-chart-content" id="flot-line-chart"></div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sales chart -->
        <!-- Modal for item low in stock -->
        <div class="modal fade" id="lowStock"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">List of items that low in stock</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <div class="row">
                                <table class="table table-bordered table-sm">
                                    <thead>
                                        <tr class="bg-warning">
                                            <th>Items</th>
                                            <th>Brand</th>
                                            <th>Stock</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($lowStock as $item)
                                        <tr>
                                            <td>{{$item->item_name}}</td>
                                            <td>{{$item->item_brand}}</td>
                                            <td>{{$item->item_stock}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <!-- End modal item low in stock -->

        <!-- Modal for item out of stock -->
        <div class="modal fade" id="noStock"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">List of items that low in stock</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <div class="row">
                                <table class="table table-bordered table-sm">
                                    <thead>
                                        <tr class="bg-danger">
                                            <th class="text-white">Items</th>
                                            <th class="text-white">Brand</th>
                                            <th class="text-white">Stock</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($noStock as $items)
                                        <tr>
                                            <td>{{$items->item_name}}</td>
                                            <td>{{$items->item_brand}}</td>
                                            <td>{{$items->item_stock}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <!-- End modal item out of stock -->
    </div>
@endsection