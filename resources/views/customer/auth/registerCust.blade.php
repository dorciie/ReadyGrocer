<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ReadyGrocer</title>
   
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
     <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/images/favicon.png')}}">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">

        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="/">Home</a></li>
                            <!-- <li><a href="{{ url('/shop/shoplogin') }}">Login as Shop owner</a></li> -->
                            <li><a href="{{ url('/customer/custLogin') }}">Login as Customer</a></li>
                        </ul>
                        <div class="card">
                            <div class="card-header">{{ __('Register As Customer') }}</div>

                            <div class="card-body">
                                <form method="POST" action="{{route('register.store')}}">
                                    {{@csrf_field()}}

                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                        <div class="col-md-6">
                                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                        <div class="col-md-6">
                                            <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">

                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- <div class="form-group row">
                                        <label for="shopName" class="col-md-4 col-form-label text-md-right">{{ __('shop Name') }}</label>

                                        <div class="col-md-6">
                                            <input id="shopName" type="string" class="form-control @error('shopName') is-invalid @enderror " name="shopName" value="{{ old('shopName') }}" placeholder="Enter if you are shop owner">

                                            @error('shopName')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div> -->
                                   
                                    <div class="form-group row">
                                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                        <div class="col-md-6">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror " name="password" required autocomplete="new-password">

                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>   
                                    <div class="form-group row">
                                        <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>

                                        <div class="col-md-6">
                                            <input id="phone" type="string" class="form-control @error('phone') is-invalid @enderror " name="phone" required value="{{ old('phone') }}" pattern="[0-9]{3}-[0-9]{8}">
                                            <small>Format: 012-34567890</small><br>
  

                                            @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="select-choice" class="col-md-4 col-form-label text-md-right">{{_('Status')}} </label>
                                        <div class="col-md-6">
                                        <input id="status" type="string" class="form-control " name="Customer" value="Customer" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
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
            </div>

        </main>
    </div>
</body>