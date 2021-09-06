@extends('shop.layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Column -->
            <div class="col-md-6 col-lg-4 col-xlg-3">
                <div class="card card-hover">
                    <div class="box bg-cyan bg-gradient text-center shadow">
                        <h1 class="font-light text-white"><i class="mdi mdi-view-dashboard"></i></h1>
                        <h6 class="text-white">Total items</h6>
                        <h6 class="text-white">{{\App\Models\ShopItem::where('shop_id',$LoggedShopInfo->id)->count()}}</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 col-xlg-3">
                <div class="card card-hover">
                    <div class="box bg-success bg-gradient text-center shadow">
                        <h1 class="font-light text-white"><i class="mdi mdi-chart-bubble"></i></h1>
                        <h6 class="text-white">Total orders</h6>
                        <h6 class="text-white">{{\App\Models\Order::where('shop_id',$LoggedShopInfo->id)->count()}}</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 col-xlg-3">
                <div class="card card-hover">
                    <div class="box bg-primary bg-gradient text-center shadow">
                        <h1 class="font-light text-white"><i class="mdi mdi-chart-bar"></i></h1>
                        <h6 class="text-white">Total customers</h6>
                        <h6 class="text-white">{{\App\Models\Order::distinct('customer_id')->count()}}</h6>
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
                        <button type="button" class="btn btn-info btn-sm shadow" data-bs-toggle="modal" data-bs-target="#lowStock">View items</button>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-hover">
                    <div class="box bg-danger bg-gradient text-center shadow">
                        <h1 class="font-light text-white"><i class="mdi mdi-alert"></i></h1>
                        <h6 class="text-white">Items out of stock: {{\App\Models\ShopItem::where('shop_id',$LoggedShopInfo->id)->where('item_stock','==','0')->count()}}</h6>
                        <button type="button" class="btn btn-info btn-sm shadow" data-bs-toggle="modal" data-bs-target="#noStock">View items</button>
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
                                <option value="{{$Oneyear->years}}">{{$Oneyear->years}}</option>
                            @foreach($year as $tahun)
                                <option value="{{$tahun->year}}">{{$tahun->year}}</option>
                            @endforeach 
                        </select>
                        <button type="submit" class="btn btn-info" style="padding: 3px 7px; font-size:14px">View</button>
                    </form>
                </div><br>
                @if((\App\Models\Order::where('orders.status','delivered')->whereYear('created_at', $Oneyear->years)->count()) != NULL)
                <h6 style="text-align: center;">Total sales ({{$Oneyear->years}}): RM{{$totalSales->payment}} </h6> 
                @endif
                @if((\App\Models\Order::where('orders.status','delivered')->whereYear('created_at', $Oneyear->years)->count()) == NULL)
                <h6 style="text-align: center;">Total sales ({{$Oneyear->years}}): None</h6> 

                @endif
                <div>
                    <canvas id="Total-Sales-Analysis" style="max-width:100%;"></canvas>
                </div>
                <br><br>
                @if((\App\Models\Order::where('orders.status','delivered')->whereYear('created_at', $Oneyear->years)->count()) != NULL)
                <h6 style="text-align: center;">Total item sold in {{$Oneyear->years}}:  {{$totalItemSold->totalItem}}</h6> 
                @endif
                @if((\App\Models\Order::where('orders.status','delivered')->whereYear('created_at', $Oneyear->years)->count()) == NULL)
                <h6 style="text-align: center;">Total item sold in {{$Oneyear->years}}: None</h6> 
                @endif
                <div>
                    @if((\App\Models\Order::where('orders.status','delivered')->whereYear('created_at', $Oneyear->years)->count()) != NULL)
                    <canvas id="pie-chart" style="max-width:100%;"></canvas>
                    @endif
                    @if((\App\Models\Order::where('orders.status','delivered')->whereYear('created_at', $Oneyear->years)->count()) == NULL)
                    <p></p>
                    @endif
                </div><br><br>
                @if((\App\Models\Order::where('orders.status','delivered')->whereYear('created_at', $Oneyear->years)->count()) != NULL)
                    <div>
                        <p><button class="btn btn-info" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">View Item(s) sold <i class="fas fa-caret-down"></i></button></p>
                        <div class="collapse" id="collapseExample">
                            <div class="card card-body">
                                    <div class="table-responsive">
                                        <table id="myTable" class="table table-striped table-bordered table-sm">
                                            <thead class="table-info">
                                                <tr>
                                                    <th style="color: black"><strong>Item</strong></th>
                                                    <th style="color: black"><strong>Brand</strong></th> 
                                                    <th style="color: black"><strong>Category</strong></th>
                                                    <th style="color: black"><strong>Sold</strong></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($itemSold as $items)
                                                <tr>
                                                    <td>{{\App\Models\ShopItem::where('id',$items->id)->where('shop_id',$LoggedShopInfo->id)->value('item_name')}}</td>
                                                    <td>{{\App\Models\ShopItem::where('id',$items->id)->where('shop_id',$LoggedShopInfo->id)->value('item_brand')}}</td>
                                                    <td>{{$items->category_name}}</td>
                                                    <td>{{$items->totalItems}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                            </div>
                        </div>
                    <div>
                @endif
            </div>
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
        <!-- End modal item out of stock -->
    </div>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

<script>
    var xValues = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
    // var xValues = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    var yValues = <?php echo json_encode($datas); ?>;
    var barColors = ["red", "green","blue","orange","brown"];
    
    new Chart("Total-Sales-Analysis", {
      type: "bar",
    //   type: "line",
      data: {
        labels: xValues,
        datasets: [{
          backgroundColor: [
            '#2ec7c9','#b6a2de','#5ab1ef','#ffb980','#d87a80',
            '#8d98b3','#e5cf0d','#97b552','#95706d','#dc69aa',
            '#07a2a4','#9a7fd1'
          ],
        //   borderColor: [
        //     '#2ec7c9','#b6a2de','#5ab1ef','#ffb980','#d87a80',
        //     '#8d98b3','#e5cf0d','#97b552','#95706d','#dc69aa',
        //     '#07a2a4','#9a7fd1','#588dd5','#f5994e','#c05050',
        //     '#59678c','#c9ab00','#7eb00a','#6f5553','#c14089'
        //     ],
                // fill: false,
                // borderColor: 'rgba(204, 0, 102)',
                // tension: 0,
                // radius: 5,
                // backgroundColor: 'rgba(34,139,34)',
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
  $(function(){
      var cData = <?php echo json_encode($dataPoints);?>;
      var ctx = $("#pie-chart");

      //pie chart data
      var data = {
        labels: cData.label,
        datasets: [
          {
            label: "Users Count",
            data: cData.data,
            backgroundColor: [
                "#D7C59A","#F9E999","#A1A5A2","#C2DAB8","#E8BAC8","#AFDDFF","#FFC9C9","#B1A7FF","#9FF3E9","#CCFFCC",
                "#80BBDB","#CB8442","#C4281C","#C470A0","#0D69AC","#F5CD30","#624732","#6D6E6C","#287F47","#A1C48C",
                "#F3CF9B","#4B974B","#A05F35","#C1CADE","#CD544B","#7BB6E8","#F7F18D","#D9856C","#DA867A","#6E99CA",
                "#6B327C","#008F9C","#685C43","#435493","#E5ADC8","#C7D23C","#55A5AF","#D36F4C","#923978","#EAB892",
                "#9CA3A8","#D8DD56","#74869D","#335882","#98C2DB","#FF5959","#EFB838","#BE6862","#562424","#FEF3BB",
                "#D3BE96","#7E683F","#FF0000","#AA00AA","#AA5500",
            ],
            borderColor: [
                "#D7C59A","#F9E999","#A1A5A2","#C2DAB8","#E8BAC8","#AFDDFF","#FFC9C9","#B1A7FF","#9FF3E9","#CCFFCC",
                "#80BBDB","#CB8442","#C4281C","#C470A0","#0D69AC","#F5CD30","#624732","#6D6E6C","#287F47","#A1C48C",
                "#F3CF9B","#4B974B","#A05F35","#C1CADE","#CD544B","#7BB6E8","#F7F18D","#D9856C","#DA867A","#6E99CA",
                "#6B327C","#008F9C","#685C43","#435493","#E5ADC8","#C7D23C","#55A5AF","#D36F4C","#923978","#EAB892",
                "#9CA3A8","#D8DD56","#74869D","#335882","#98C2DB","#FF5959","#EFB838","#BE6862","#562424","#FEF3BB",
                "#D3BE96","#7E683F","#FF0000","#AA00AA","#AA5500",
            ],
            borderWidth: [1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1]
          }
        ]
      };

      //options
      var options = {
        responsive: true,
        title: {
          display: true,
          position: "top",
          text: "Total item(s) sold in a year based on category",
          fontSize: 14,
          fontColor: "#111"
        },
        legend: {
          display: true,
          position: "right",
          labels: {
            fontColor: "#333",
            fontSize: 16
          }
        }
      };

      //create Pie Chart class object
      var chart1 = new Chart(ctx, {
        type: "pie",
        data: data,
        options: options
      });

  });
</script>
<script>
    $(document).ready( function () {
    $('#myTable').DataTable(); //category table
    } );
</script>
@endsection