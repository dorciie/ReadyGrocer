@extends('shop.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Column -->
        <div class="col-md-6 col-lg-4 col-xlg-3">
            <div class="card card-hover">
                <div class="box bg-cyan bg-gradient text-center shadow">
                    <h1 class="font-light text-white"><i class="mdi mdi-view-list"></i></h1>
                    <h6 class="text-white">Total items</h6>
                    <h6 class="text-white">{{\App\Models\ShopItem::where('shop_id',$LoggedShopInfo->id)->count()}}</h6>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 col-xlg-3">
            <div class="card card-hover">
                <div class="box bg-success bg-gradient text-center shadow">
                    <h1 class="font-light text-white"><i class="mdi mdi-cart-outline"></i></h1>
                    <h6 class="text-white">Total orders</h6>
                    <h6 class="text-white">{{\App\Models\Order::where('shop_id',$LoggedShopInfo->id)->where('status','=','delivered')->count()}}</h6>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 col-xlg-3">
            <div class="card card-hover">
                <div class="box bg-primary bg-gradient text-center shadow">
                    <h1 class="font-light text-white"><i class="mdi mdi-chart-bar"></i></h1>
                    <h6 class="text-white">Total customers</h6>
                    <h6 class="text-white">{{\App\Models\Order::distinct('customer_id')->where('shop_id',$LoggedShopInfo->id)->count()}}</h6>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card card-hover">
                <div class="box bg-warning bg-gradient text-center shadow">
                    <h1 class="font-light text-white"><i class="mdi mdi-alert-box"></i></h1>
                    <h6 class="text-white">Items low in stock: {{\App\Models\ShopItem::where('shop_id',$LoggedShopInfo->id)->where('item_stock','<=','10')->where('item_stock','>','0')->count()}}</h6>
                    <button type="button" class="btn btn-info btn-sm shadow" data-bs-toggle="modal" data-bs-target="#lowStock"><i class="fa fa-info-circle" aria-hidden="true"></i> View items</button>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-hover">
                <div class="box bg-danger bg-gradient text-center shadow">
                    <h1 class="font-light text-white"><i class="mdi mdi-alert"></i></h1>
                    <h6 class="text-white">Items out of stock: {{\App\Models\ShopItem::where('shop_id',$LoggedShopInfo->id)->where('item_stock','==','0')->count()}}</h6>
                    <button type="button" class="btn btn-info btn-sm shadow" data-bs-toggle="modal" data-bs-target="#noStock"><i class="fa fa-info-circle" aria-hidden="true"></i> View items</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bar chart -->
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Sales Analysis per year</h5><br>
                <div>
                    <form action="{{url('year_change')}}" method="get" enctype="multipart/form-data">
                        <label>Select Year:</label>
                        <select name="year">
                            @foreach($year as $tahun)
                                <option value="{{date('Y')}}">{{date('Y')}}</option> {{-- get current year --}}
                                <option value="{{$tahun->year}}">{{$tahun->year}}</option> {{-- get from start user register year --}}
                            @endforeach 
                        </select>
                        <button type="submit" class="btn btn-info" style="padding: 3px 7px; font-size:14px">View</button>
                    </form>
                </div><br>
                @if((\App\Models\Order::where('orders.status','delivered')->where('orders.shop_id',$LoggedShopInfo->id)->whereYear('created_at', $Oneyear)->count()) != NULL)
                    <h6 style="text-align: center;">Total sales ({{$Oneyear}}): RM{{$totalSales->payment}} </h6> 
                @endif
                @if((\App\Models\Order::where('orders.status','delivered')->where('orders.shop_id',$LoggedShopInfo->id)->whereYear('created_at', $Oneyear)->count()) == NULL)
                    <h6 style="text-align: center;">Total sales ({{$Oneyear}}): NULL</h6> 
                @endif
                <div>
                    <canvas id="Total-Sales-Analysis" style="max-width:100%;"></canvas>
                </div>
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
                                    <table class="table table-striped table-bordered table-sm">
                                        <thead class="table-info">
                                            <tr>
                                                <th style="color: black"><strong>Items</strong></th>
                                                <th style="color: black"><strong>Brand</strong></th>
                                                <th style="color: black"><strong>Stock</strong></th>
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
                            <h5 class="modal-title" id="exampleModalLabel">List of items that out of stock</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <table class="table table-striped table-bordered table-sm">
                                    <thead class="table-info">
                                        <tr>
                                            <th style="color: black"><strong>Items</strong></th>
                                            <th style="color: black"><strong>Brand</strong></th>
                                            <th style="color: black"><strong>Stock</strong></th>
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
        </div>
    </div>
    <!-- End modal item out of stock -->
    <div class="row">
        <div class="col-md-2">
            <div class="card">
                <div class="card-body">
                    <h6>Filter month</h6><hr>
                    <input type="checkbox" name="statut" value='January'> January<br>
                    <input type="checkbox" name="statut" value="February"> February<br>
                    <input type="checkbox" name="statut" value='March'> March<br>
                    <input type="checkbox" name="statut" value="April"> April<br>
                    <input type="checkbox" name="statut" value='May'> May<br>
                    <input type="checkbox" name="statut" value="June"> June<br>
                    <input type="checkbox" name="statut" value='July'> July<br>
                    <input type="checkbox" name="statut" value="August"> August<br>
                    <input type="checkbox" name="statut" value="September"> September<br>
                    <input type="checkbox" name="statut" value="October"> October<br>
                    <input type="checkbox" name="statut" value="November"> November<br>
                    <input type="checkbox" name="statut" value="December"> December
                </div>
            </div>
        </div>
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    @if((\App\Models\Order::where('orders.status','delivered')->where('orders.shop_id',$LoggedShopInfo->id)->whereYear('created_at', $Oneyear)->count()) != NULL)
                        <h6 style="text-align: center;">Total item(s) sold in {{$Oneyear}}:  {{$totalItemSold->totalItem}}</h6> 
                    @endif
                    @if((\App\Models\Order::where('orders.status','delivered')->where('orders.shop_id',$LoggedShopInfo->id)->whereYear('created_at', $Oneyear)->count()) == NULL)
                        <h6 style="text-align: center;">Total item sold in {{$Oneyear}}: NULL</h6> 
                    @endif
                    <hr>
                    {{--Table item sold--}}
                    <div>
                        <div class="table-responsive">
                            <table id="myTable" class="table table-striped table-bordered table-sm">
                                <thead class="table-info">
                                    <tr>
                                        <th style="color: black"><strong>No</strong></th>
                                        <th style="color: black"><strong>Item</strong></th>
                                        <th style="color: black"><strong>Brand</strong></th> 
                                        <th style="color: black"><strong>Category</strong></th>
                                        <th style="color: black"><strong>Sold</strong></th>
                                        <th hidden style="color: black"><strong>Month</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($itemSold as $items)
                                        <tr>
                                            <td>{{$loop->iteration}}.</td>
                                            <td>{{\App\Models\ShopItem::where('id',$items->id)->where('shop_id',$LoggedShopInfo->id)->value('item_name')}}</td>
                                            <td>{{\App\Models\ShopItem::where('id',$items->id)->where('shop_id',$LoggedShopInfo->id)->value('item_brand')}}</td>
                                            <td>{{$items->category_name}}</td>
                                            <td>{{$items->totalItems}}</td>
                                            @if($items->month=='1')
                                            <td hidden>January</td>
                                            @elseif($items->month=='2')
                                            <td hidden>February</td>
                                            @elseif($items->month=='3')
                                            <td hidden>March</td>
                                            @elseif($items->month=='4')
                                            <td hidden>April</td>
                                            @elseif($items->month=='5')
                                            <td hidden>May</td>
                                            @elseif($items->month=='6')
                                            <td hidden>June</td>
                                            @elseif($items->month=='7')
                                            <td hidden>July</td>
                                            @elseif($items->month=='8')
                                            <td hidden>August</td>
                                            @elseif($items->month=='9')
                                            <td hidden>September</td>
                                            @elseif($items->month=='10')
                                            <td hidden>October</td>
                                            @elseif($items->month=='11')
                                            <td hidden>November</td>
                                            @elseif($items->month=='12')
                                            <td hidden>December</td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{--END TABLE ITEM SOLD--}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

<script>
    var xValues = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
    var yValues = <?php echo json_encode($datas); ?>;
    var barColors = ["red", "green","blue","orange","brown"];
    
    new Chart("Total-Sales-Analysis", {
      type: "bar",
      data: {
        labels: xValues,
        datasets: [{
          backgroundColor: [
            '#2ec7c9','#b6a2de','#5ab1ef','#ffb980','#d87a80',
            '#8d98b3','#e5cf0d','#97b552','#95706d','#dc69aa',
            '#07a2a4','#9a7fd1'
          ],
          borderWidth: 2,
          data: yValues

        }]
      },
      options: {
        scales: {
            yAxes: [{
                scaleLabel: {
                    display: true,
                    labelString: "Sales, RM",
                },
            }],
            xAxes: [{
                scaleLabel: {
                    display: true,
                    labelString: "Month",
                },
            }],
        },
        legend: {display: false},
        "hover": {
            "animationDuration": 0
        },
        animation: {
            duration: 500,
            easing: "easeOutQuart",
            onComplete: function () {
                var ctx = this.chart.ctx;
                ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontFamily, 'normal', Chart.defaults.global.defaultFontFamily);
                ctx.textAlign = 'center';
                ctx.textBaseline = 'bottom';

                this.data.datasets.forEach(function (dataset) {
                    for (var i = 0; i < dataset.data.length; i++) {
                        if (dataset.data[i] != 0) {
                            var model = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._model,
                                scale_max = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._yScale.maxHeight;
                            ctx.fillStyle = '#444';
                            var y_pos = model.y - 5;
                            if ((scale_max - model.y) / scale_max >= 0.93)
                                y_pos = model.y + 20; 
                            ctx.fillText(dataset.data[i], model.x, y_pos);
                        }
                    }
                });               
            }
        }
      }
    });
    </script>
    <script>
        $(document).ready( function () {
            var table = $('#myTable').DataTable();
        } );

        $('input:checkbox').on('change', function () {
            var stats = $('input:checkbox[name="statut"]:checked').map(function() {
                return this.value;
            }).get().join('|');
            $('#myTable').DataTable().column(5).search(stats, true, false, false).draw(false);
        });
    </script>
@endsection