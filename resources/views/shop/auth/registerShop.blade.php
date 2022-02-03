<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>ReadyGrocer</title>
        <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/images/logodef.png')}}">
        <link href="{{asset('dist/css/style.min.css')}}" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    </head>
    <body style="background-color: #eee">
        <br>
        
        <br>
        <div class="container-fluid">       
            <div class="row"  style="justify-content: center;">
                <div class="card col-md-5 shadow rounded">
                    <br>
                    <div style="text-align: center;">
                        <a href="/"> <img src="{{asset('assets/images/default.png')}}" alt="homepage" class="light-logo" width="370" height="100" /></a>
                    </div> 
                    <div ><br> 
                        <h3 class="text-center">Shop Owner Register</h3><hr>
                        <form method="GET" action="{{route('register.index')}}">

                                    {{@csrf_field()}}
                                   
                                    <div class="input-group">                                    
                                        <div class="input-group-prepend col-2" >
                                            <span class="input-group-text bg-success text-white h-100" id="basic-addon1">Name</span>
                                        </div>
                                       
                                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                    </div><small>Full Name According to IC</small><br>
                                    <br>
                                    <div class="input-group">                                    
                                        <div class="input-group-prepend col-2">
                                            <span class="input-group-text bg-success text-white h-100"  id="basic-addon1">{{ __('E-Mail Address') }}</span>
                                        </div>
                                       
                                        <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                    </div><small>Format: email@gmail.com</small><br>
                                    <br>
                                    <div class="input-group">                                    
                                        <div class="input-group-prepend col-2" >
                                            <span class="input-group-text bg-success text-white h-100" id="basic-addon1">Shop Name</span>
                                        </div>
                                       
                                            <input id="shopName" type="string" class="form-control @error('shopName') is-invalid @enderror " name="shopName" value="{{ old('shopName') }}" >

                                            @error('shopName')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                    </div><small>Full Name According to IC</small><br>
                                    <br>
                                    <div class="input-group">                                    
                                        <div class="input-group-prepend col-2" >
                                            <span class="input-group-text bg-success text-white h-100" id="basic-addon1">SSM Registration</span>
                                        </div>
                                       
                                                <input id="SSMnum" type="string" class="form-control @error('SSMnum') is-invalid @enderror " name="SSMnum" value="{{ old('SSMnum') }}" >

                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                    </div><small>Full Name According to IC</small><br>
                                    <br>
                                    <div class="input-group">                                    
                                        <div class="input-group-prepend col-2">
                                            <span class="input-group-text bg-success text-white h-100" id="basic-addon1">{{ __('Password') }}</span>
                                        </div>
                                       
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror " name="password" required autocomplete="new-password">

                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror

                                    </div><small>Do Not Share your Password with anyone</small><br>
                                    <br>
                                    <div class="input-group">                                    
                                        <div class="input-group-prepend col-2">
                                            <span class="input-group-text bg-success text-white h-100" id="basic-addon1">{{ __('Phone Number') }}</span>
                                        </div>
                                       
                                                <input id="phone" type="string" class="form-control @error('phone') is-invalid @enderror " name="phone" required value="{{ old('phone') }}" pattern="[0-9]{3}-[0-9]{8}">
                                        
                                            @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                    </div><small>Format: 012-34567890</small><br>
                                    <br>
                                    <div class="input-group">                                    
                                        <div class="input-group-prepend col-2">
                                            <span class="input-group-text bg-success text-white h-100" id="basic-addon1">{{_('Status')}}</span>
                                        </div>
                                       
                                        <input id="status" type="string" class="form-control " name="status" value="Shop Owner" readonly>

                                    </div>
                                    <br>
                                    <!-- <div class="form-group row">
                                        <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('address') }}</label>

                                        <div class="col-md-6">
                                            <input id="search_input" type="string" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}">

                                            @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <br> -->
                                    <div class="input-group">                                    
                                        <div class="input-group-prepend col-2">

                                            <span class="input-group-text bg-success text-white h-100" id="basic-addon1">{{ __('Address') }}</span>
                                        </div>

                                            <input id="search_input" type="string" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}">

                                            @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror

                                    </div><small>Format: Home Address</small><br>
                                   <br>
                                   
                                    <div class="form-group row">
                                        <label for="address" class="col-md-4 col-form-label text-md-right"></label>

                                        <div class="col-md-6">
                                            <input id="caddress" type="hidden" class="form-control " name="caddress" value="" readonly><br>

                                            <button type="button" onclick="getLocation()">Show On Map</button>


                                            <input type="hidden" name="address_latitude" id="address_latitude" value="" />
                                            <input type="hidden" name="address_longitude" id="address_longitude" value="" />
                                        </div>
                                    </div>

                                    <p id="demo"></p>

                                    <div id="googleMap" style="width:100%; height:400px"></div>
                                    <br>
                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Register') }}
                                            </button>
                                        </div>
                                    </div>

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


                                    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key={{env('GOOGLE_MAP_API')}}"></script>

                                    <script>
                                        var x = document.getElementById("demo");

                                        function getLocation() {
                                            if (navigator.geolocation) {
                                                navigator.geolocation.getCurrentPosition(showPosition);
                                            } else {
                                                x.innerHTML = "Geolocation is not supported by this browser.";
                                            }
                                        }

                                        function showPosition(position) {
                                            myMap(position);
                                            // document.getElementById("caddress").value = "Current Location";
                                        }
                                        function myMap(position) {
                                            

                                            addr = document.getElementById('caddress').value;
                                            var res = addr.split(",");
                                            document.getElementById("address_latitude").value = parseFloat(res[0]);
                                            document.getElementById("address_longitude").value = parseFloat(res[1]);
                                            var mapProp = {
                                                center: new google.maps.LatLng(res[0], res[1]),
                                                zoom: 13,
                                            };
                                            var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);

                                            var myMarker = new google.maps.Marker({
                                                position: {
                                                    lat: parseFloat(res[0]),
                                                    lng: parseFloat(res[1]),

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
                                        }
                                    </script>

                                </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function myFunction() {
              var x = document.getElementById("myInput");
              if (x.type === "password") {
                x.type = "text";
              } else {
                x.type = "password";
              }
            }
            </script>
            
            <script src="{{asset('assets/libs/jquery/dist/jquery.min.js')}}"></script>
            <script src="{{asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    </body>
</html>