@extends('shop.layouts.master')

@section('content')
    <div class="ms-auto text-end">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('shop/dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('profile.index')}}">My profile</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit profile</li>
            </ol>
        </nav>
    </div>

    <div class="results">
        @if(Session::get('success'))
            <div class="alert alert-success" id="alert">
                {{Session::get('success')}}
            </div>
        @endif
        @if(Session::get('error'))
            <div class="alert alert-danger" id="alert">
                {{Session::get('error')}}
            </div>
        @endif
    </div>

    <div class="card">
        <form class="form-horizontal" action="{{route('profile.update',$shopOwner->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="card-body">
                <h4 class="card-title">Edit profile</h4>
                <br>
                <div class="form-group row">
                    <label for="fname"
                        class="col-sm-2 text-end control-label col-form-label" >Image</label>
                    <div class="col-sm-9">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="shop_image" value="{{$shopOwner->shop_image}}" accept="image/*">
                            {{-- <label class="custom-file-label" for="shop_image">Choose
                                file...</label> --}}
                            {{-- <div class="invalid-feedback">Example invalid custom file feedback</div> --}}
                        </div>
                        <p>Old image: </p>
                        <img src="{{ Storage::url($shopOwner->shop_image) }}" width="200px">
                        <span class="text-danger">@error('shop_image'){{ $message }} @enderror</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="fname"
                        class="col-sm-2 text-end control-label col-form-label">Name <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="name" value="{{$shopOwner->name}}">
                        <span class="text-danger">@error('name'){{ $message }} @enderror</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="fname"
                        class="col-sm-2 text-end control-label col-form-label">Shop Name <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="shopName" value="{{$shopOwner->shopName}}">
                        <span class="text-danger">@error('shopName'){{ $message }} @enderror</span>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="fname"
                        class="col-sm-2 text-end control-label col-form-label">Address <span class="text-danger">*</span></label>
                    <div class="col-md-9">
                        <input id="search_input" type="string" class="form-control @error('address') is-invalid @enderror" name="address" value="{{$shopOwner->address}}">
                        <span class="text-danger">@error('address'){{ $message }} @enderror</span>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="fname"
                        class="col-sm-2 text-end control-label col-form-label">Contact Number</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="phone_number" value="{{$shopOwner->phone_number}}">
                        <span class="text-danger">@error('phone_number'){{ $message }} @enderror</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="fname"
                        class="col-sm-2 text-end control-label col-form-label">Delivery Charge</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">RM</span>
                            </div>
                            <input type="number" step="any" class="form-control" name="delivery_charge" value="{{$shopOwner->delivery_charge}}">
                        </div>
                        <span class="text-danger">@error('delivery_charge'){{ $message }} @enderror</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="fname"
                        class="col-sm-2 text-end control-label col-form-label">Description</label>
                    <div class="col-sm-9">
                        {{-- <textarea class="form-control" name="shop_description" value="{{$shopOwner->shop_description}}"></textarea> --}}
                        <input type="text" class="form-control" name="shop_description" value="{{$shopOwner->shop_description}}">
                        <span class="text-danger">@error('shop_description'){{ $message }} @enderror</span>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="fname"
                        class="col-sm-2 text-end control-label col-form-label">Location</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <input id="caddress" type="string" class="form-control " name="caddress" value="{{$shopOwner->address_latitude}}, {{$shopOwner->address_longitude}}" readonly><br>
                            <button class="btn btn-info" type="button" onclick="myMap()">Show On Map</button>
                            <input type="hidden" name="address_latitude" id="address_latitude" value="{{$shopOwner->address_latitude}}" />
                            <input type="hidden" name="address_longitude" id="address_longitude" value="{{$shopOwner->address_longitude}}" />
                        </div>
                    </div>
                </div>
                <div id="googleMap" style="width:100%; height:400px"></div>
            </div>
            <div class="border-top">
                <div class="card-body" style="text-align:center;">
                    <button type="submit" class="btn btn-info">Update</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('script')
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
    function myMap() {
        
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
@endsection
