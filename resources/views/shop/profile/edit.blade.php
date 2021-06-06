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
                {{-- <div class="form-group row">
                    <label for="fname"
                        class="col-sm-2 text-end control-label col-form-label">Email <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="email" value="{{$shopOwner->email}}">
                        <span class="text-danger">@error('email'){{ $message }} @enderror</span>
                    </div>
                </div> --}}
                <div class="form-group row">
                    <label for="fname"
                        class="col-sm-2 text-end control-label col-form-label">Address <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="address" value="{{$shopOwner->address}}">
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
                {{-- <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Enter password">
                    <span class="text-danger">@error('password'){{ $message }} @enderror</span>
                </div>
                <div class="form-group">
                    <label for="">Confirm Password</label>
                    <input type="password" class="form-control" name="password_confirm" placeholder="Enter password">
                    <span class="text-danger">@error('password'){{ $message }} @enderror</span>
                </div> --}}
            </div>
            <div class="border-top">
                <div class="card-body" style="text-align:center;">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('script')
<script>
    
</script>
@endsection
