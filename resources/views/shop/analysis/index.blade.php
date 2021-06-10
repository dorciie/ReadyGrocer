@extends('shop.layouts.master')

@section('content')
<div class="ms-auto text-end">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('shop/dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Sales</li>
        </ol>
    </nav>
</div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Sales in a year</h5>
                <br>
                <div>
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle"
                            data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">Select Year</button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">2020</a>
                            {{-- <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                            <a class="dropdown-item" href="#">Separated link</a> --}}
                        </div>
                    </div><!-- /btn-group -->
                </div>
                <div>
                    <canvas id="yearlySales" style="width:300%;max-width:1000px;"></canvas>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Sales in a month</h5>
                <br>
                <div>
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle"
                            data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">Select Month</button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">January</a>
                            <a class="dropdown-item" href="#">February</a>
                            <a class="dropdown-item" href="#">March</a>
                            <a class="dropdown-item" href="#">April</a>
                            <a class="dropdown-item" href="#">May</a>
                            <a class="dropdown-item" href="#">June</a>
                            <a class="dropdown-item" href="#">July</a>
                            <a class="dropdown-item" href="#">August</a>
                            <a class="dropdown-item" href="#">September</a>
                            <a class="dropdown-item" href="#">October</a>
                            <a class="dropdown-item" href="#">November</a>
                            <a class="dropdown-item" href="#">December</a>
                        </div>
                    </div><!-- /btn-group -->
                </div>
                <div>
                    <canvas style="align-items: center;" id="monthlySales" style="width:100%;max-width:600px"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<script>
    var xValues = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    var yValues = [500, 490, 440, 240, 150, 650, 590, 800, 810, 560, 550, 1000];
    var barColors = ["red", "green","blue","orange","brown"];
    
    new Chart("yearlySales", {
      type: "bar",
      data: {
        labels: xValues,
        datasets: [{
          backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(255, 159, 64, 0.2)',
            'rgba(255, 205, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(255, 99, 132, 0.2)',
            'rgba(255, 159, 64, 0.2)',
            'rgba(255, 205, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(153, 102, 255, 0.2)'
          ],
          borderColor: [
            'rgb(255, 99, 132)',
            'rgb(255, 159, 64)',
            'rgb(255, 205, 86)',
            'rgb(75, 192, 192)',
            'rgb(54, 162, 235)',
            'rgb(153, 102, 255)',
            'rgb(255, 99, 132)',
            'rgb(255, 159, 64)',
            'rgb(255, 205, 86)',
            'rgb(75, 192, 192)',
            'rgb(54, 162, 235)',
            'rgb(153, 102, 255)'
            
            ],
          borderWidth: 1,
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
        title: {
          display: true,
          text: "Sales Analysis on 2021"
        }
      }
    });
    </script>
    <script>
        var xValues = ["Canned Food", "Frozen", "Bakery", "Fruits & Vegetables", "Meat"];
        var yValues = [55, 49, 44, 24, 15];
        var barColors = [
          "#b91d47",
          "#00aba9",
          "#2b5797",
          "#e8c3b9",
          "#1e7145"
        ];
        
        new Chart("monthlySales", {
          type: "pie",
          data: {
            labels: xValues,
            datasets: [{
              backgroundColor: barColors,
              data: yValues
            }]
          },
          options: {
            title: {
              display: true,
              text: "Sales based on category/month"
            }
          }
        });
        </script>
@endsection