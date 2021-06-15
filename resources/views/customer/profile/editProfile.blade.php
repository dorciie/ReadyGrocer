
@extends('customer.layouts.master')



@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
            @foreach($info as $info)
                <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
                <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
                <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
                <!------ Include the above in your HEAD tag ---------->
                <div class="row">
                    
                    <div class="col-md-4">
                        <div class="profile-img">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-head">
                            <h5>
                                {{$info->name}}
                            </h5>                           

                            <p class="proile-rating">Fav Shop : <span> {{\App\Models\shopOwner::where('id',$info->fav_shop)->value('shopName')}}</span></p>
                          
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-4">
                        
                    </div>
                    <div class="col-md-8">
                        <br> 
                        <div class="tab-content profile-tab" id="myTabContent">
                        <form class="form-horizontal" action="{{route('custProfile.store')}}" method="post" >
                        @csrf 
                            <div class="col-md-8">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Email</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                            <input type="email" class="form-control" id="email" name="email"aria-describedby="emailHelp" placeholder="{{$info->email}}" value="{{$info->email}}">                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Address</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                            <input type="string" class="form-control" id="search_input" name="address" placeholder="{{$info->address}}"value="{{$info->address}}">
                                            <button type="button" onclick="myMap()">Show On Map</button>
                                            <input type="hidden" name="address_latitude" id="address_latitude" value="{{$info->address_latitude}}" />
                                            <input type="hidden" name="address_longitude" id="address_longitude" value="{{$info->address_longitude}}" />
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Phone</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                            <input type="email" class="form-control" id="phone" aria-describedby="emailHelp"placeholder="">
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Password</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                *******
                                            </div>
                                        </div><hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Date Joined</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                {{$info->created_at}}
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Date & Time Automated Checkout</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                             <input type="datetime-local" class="form-control"  name="dtdelivery" value="{{$info->dtdelivery}}">
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">How Frequent do you want to automated checkout?</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                            <select id="status" name="autoDelivery" value="{{$info->autoDelivery}}">
                                                <option value="None">None</option>
                                                <option value="Daily">Daily</option>
                                                <option value="Weekly">Weekly</option>
                                                <option value="Fornight">Fortnight</option>
                                                <option value="Monthly">Monthly</option>
                                            </select>
                                            </div>
                                        </div>
                                       
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <button type="submit" class="btn btn-outline-primary" >Edit</button>
                                                <a class="btn btn-outline-danger" href="{{route('custProfile.index')}}" role="button">Cancel</a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>

                            </form>
                        </div>
                        
                        <div id="googleMap" style="width:100%; height:400px"></div>

                    
                    </div>

                </div>
                

@endforeach
            </div>
        </div>
    </div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key={{env('GOOGLE_MAP_API')}}"></script>
<script>
                                        var searchInput = 'search_input';
                                        $(document).ready(function() {
                                            var autocomplete;
                                            autocomplete = new google.maps.places.Autocomplete((document.getElementById(searchInput)), {
                                                types: ['geocode'],
                                                /*componentRestrictions: {
                                                    country: "USA"
                                                }*/
                                            });

                                            google.maps.event.addListener(autocomplete, 'place_changed', function() {
                                                var near_place = autocomplete.getPlace();
                                                document.getElementById("caddress").value = near_place.geometry.location.lat() + "," + near_place.geometry.location.lng();

                                            });
                                        });
                                    </script>
<script>
                                            function myMap() {
                                            

                                            // addr = document.getElementById('caddress').value;
                                            // var res = addr.split(",");
                                           var x = document.getElementById("address_latitude").value ;
                                            var y = document.getElementById("address_longitude").value ;
                                            var mapProp = {
                                                center: new google.maps.LatLng(x, y),
                                                zoom: 13,
                                            };
                                            var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);

                                            var myMarker = new google.maps.Marker({
                                                position: {
                                                    lat: parseFloat(x),
                                                    lng: parseFloat(y),

                                                },
                                                draggable: true,
                                                map,
                                                title: "you are here",
                                            });

                                            google.maps.event.addListener(myMarker, 'dragend', function(evt) {
                                                document.getElementById('address_latitude').value = evt.latLng.lat().toFixed(6);
                                                document.getElementById('address_longitude').value = evt.latLng.lng().toFixed(6);
                                                // document.getElementById('caddress').value = evt.latLng.lat().toFixed(6)+","+evt.latLng.lng().toFixed(6);

                                                document.getElementById('caddress').value = "Selected Location";
                                                map.panTo(evt.latLng);
                                            });
                                        }</script>

@endsection