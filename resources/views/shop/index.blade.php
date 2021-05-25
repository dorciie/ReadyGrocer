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
                    <div class="box bg-warning text-center">
                        <h1 class="font-light text-white"><i class="mdi mdi-chart-bar"></i></h1>
                        <h6 class="text-white">Total sales</h6>
                        <h6 class="text-white">100</h6>
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
                                <h4 class="card-title">Order Analysis</h4>
                                <h5 class="card-subtitle">Overview of Latest Month</h5>
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
    </div>
@endsection