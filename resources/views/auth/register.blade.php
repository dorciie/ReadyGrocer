<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

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
                            <li><a href="{{ url('/shop/shoplogin') }}">Login as Shop owner</a></li>
                            <li><a href="{{ url('/customer/custLogin') }}">Login as Customer</a></li>
                        </ul>
                        <div class="card">
                            <div class="card-header">{{ __('Register') }}</div>

                            <div class="card-body">
                                <form method="POST" action="RegisterController">
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
                                            <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" >

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="shopName" class="col-md-4 col-form-label text-md-right">{{ __('shop Name') }}</label>

                                        <div class="col-md-6">
                                            <input id="shopName" type="string" class="form-control @error('shopName') is-invalid @enderror " name="shopName" value="{{ old('shopName') }}" placeholder ="Enter if you are shop owner" >

                                            @error('shopName')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('address') }}</label>

                                        <div class="col-md-6">
                                            <input id="address" type="string" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" >

                                            @error('address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                            
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
                                        <label for ="select-choice" class="col-md-4 col-form-label text-md-right">{{_('Status')}} </label>
                                        <div class="col-md-4">
                                            <select id="status" name="status">
                                            <option value="shop">Shop Owner</option>
                                            <option value="customer">Customer</option>
                                        </select> 
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('current address') }}</label>

                                        <div class="col-md-6">
                                            <input id="caddress" type="string" class="form-control " name="caddress" value="" >

                                            <button type="button" onclick="getLocation()">getaddress</button>
                                        
                                            <input type="hidden" name="address_latitude" id="address_latitude" value="0" />
                                            <input type="hidden" name="address_longitude" id="address_longitude" value="0" />
                                        </div>
                                    </div>
                                    
                                    <p id="demo"></p>

            <div id="googleMap" style = "width:100%; height:400px"></div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Register') }}
                                            </button>
                                        </div>
                                    </div>

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
            x.innerHTML = "Latitude: " + position.coords.latitude + 
            "<br>Longitude: " + position.coords.longitude;
            myMap(position);
            document.getElementById("caddress").value=position.coords.latitude +","+position.coords.longitude;
            document.getElementById("address_latitude").value=position.coords.latitude;
            document.getElementById("address_longitude").value=position.coords.longitude;
            }
            function myMap(position){
                    var mapProp = {
                        center:new google.maps.LatLng(position.coords.latitude,position.coords.longitude),
                        zoom:13,
                    };
                    var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
                    
                    new google.maps.Marker({
                    position: {lat:position.coords.latitude, lng: position.coords.longitude},
                    map,
                    title: "you are here",
                    });
                }
                </script>
                <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB3AJsTeZEYWKKUZVhrQnq9gtzsCg0LzBI&callback=myMap"></script>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            </main>
    </div>
</body>

