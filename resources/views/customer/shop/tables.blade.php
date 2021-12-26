@extends('customer.layouts.master')
       
@section('title')

	<!-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" id="bootstrap-css" rel="stylesheet" /> -->
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">List of Shops</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            @endsection
            @section('content')
            @foreach($cust as $cust)
            
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Shops</h5>
                                <div class="table-responsive">
                                <input id="custaddress" type="hidden" name="custaddress" value="{{$cust->address_latitude}},{{$cust->address_longitude}}">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Shop Name</th>
                                                <th>Shop Address</th>
                                                <th >Date Joined</th>
                                                <th>Distance from you(km)</th>
                                                <th>Rating</th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                            @foreach($shops as $row)
                                            
                                            <tr>

                                                <th scope="row"><a href="{{route('shops.show', $row['id'])}}">{{ $loop->iteration }}</a></th>
                                                <td>{{$row->shopName}}</td>
                                                <td name="address"  value="{{$row->address_latitude}},{{$row->address_longitude}}">{{$row->address}}</td>
                                                <!-- <td>{{$row->shopName}}</td> -->
                                                <td>{{DATE_FORMAT($row->created_at, "d/m/Y ")}}</td>
                                                <td id = 'distance{{$loop->iteration}}'>{{$row->address_latitude}}, {{$row->address_longitude}}</td>
                                                <td >{{$row->rating}}</td>

                                            </tr>
                                            @if ($loop->last)
                                           
                                            @endif
                                            @endforeach
                                       
                                        </tbody>
                                        
                                    </table>
                                   
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                <!-- <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=" type="text/javascript"></script> put google api -->
                <script>

                function calculateDistance() {
                    
                addr = document.getElementById('distance1').innerHTML;
                var res = addr.split(",");
                var x1 = parseFloat(res[0]);
                var y1 = parseFloat(res[1]);                
                addr2 = document.getElementById('distance2').innerHTML;
                var res = addr2.split(",");
                var x2 = parseFloat(res[0]);
                var y2 = parseFloat(res[1]);               
                 addr3 = document.getElementById('distance3').innerHTML;
                var res = addr3.split(",");
                var x3 = parseFloat(res[0]);
                var y3 = parseFloat(res[1]);                
                addr4 = document.getElementById('distance4').innerHTML;
                var res = addr4.split(",");
                var x4 = parseFloat(res[0]);
                var y4 = parseFloat(res[1]);                
                addr5 = document.getElementById('distance5').innerHTML;
                var res = addr5.split(",");
                var x5 = parseFloat(res[0]);
                var y5 = parseFloat(res[1]);
               
                var origin1 = new google.maps.LatLng(x1 , y1); //shop 
                var origin2 = new google.maps.LatLng(x2 , y2); //shop 
                var origin3 = new google.maps.LatLng(x3 , y3); //shop 
                var origin4 = new google.maps.LatLng(x4 , y4); //shop 
                var origin5 = new google.maps.LatLng(x5 , y5); //shop 
             
                addr2 = document.getElementById('custaddress').value;
                
                var res2 = addr2.split(",");
                var xx = parseFloat(res2[0]);
                var yy = parseFloat(res2[1]);
                
                var destinationB = new google.maps.LatLng(xx,yy ); //cust
                var service = new google.maps.DistanceMatrixService();
                service.getDistanceMatrix(
                {
                    origins: [origin1,origin2,origin3,origin4,origin5],
                    destinations: [destinationB],
                    travelMode: google.maps.TravelMode.DRIVING,
                    unitSystem: google.maps.UnitSystem.metric, // kilometers and meters.
                    avoidHighways: false,
                    avoidTolls: false
                },callback);
                }
                      function callback(response, status) {
                        var distance1 = response.rows[0].elements[0].distance;
                        var distance2 = response.rows[1].elements[0].distance;
                        var distance3 = response.rows[2].elements[0].distance;
                        var distance4 = response.rows[3].elements[0].distance;
                        var distance5 = response.rows[4].elements[0].distance;
                        var distance_in_kilo1 = distance1.value / 1000;
                        var distance_in_kilo2 = distance2.value / 1000;
                        var distance_in_kilo3 = distance3.value / 1000;
                        var distance_in_kilo4 = distance4.value / 1000;
                        var distance_in_kilo5 = distance5.value / 1000;
                                 document.getElementById('distance1').innerHTML=distance_in_kilo1;
                                 document.getElementById('distance2').innerHTML=distance_in_kilo2;
                                 document.getElementById('distance3').innerHTML=distance_in_kilo3;
                                 document.getElementById('distance4').innerHTML=distance_in_kilo4;
                                 document.getElementById('distance5').innerHTML=distance_in_kilo5;
         
        }
        
        
        for (i = 1; i < 6; i++) {

                document.getElementById('distance'+i).innerHTML = calculateDistance();
        }
        </script>
  @endsection