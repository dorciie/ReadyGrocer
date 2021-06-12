@extends('shop.layouts.master')
@section('head')

@endsection
@section('content')
<div class="ms-auto text-end">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('shop/dashboard')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('promotion.index')}}">Schedule Promotion</a></li>
            <li class="breadcrumb-item active" aria-current="page">Schedule New Promotion</li>
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
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Schedule New promotion</h3>
                <div class="card">
                    <form class="form-horizontal" action="{{route('promotion.update',$item->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="card-body">
                        <h4>List of items {{$item->item_name}}</h4>
                        <div class="border-top">
                                <div class="form-group row">
                                    <label for="fname" class="col-md-3 control-label col-form-label">Start Promotion <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="date" class="form-control" name="item_startPromo" value="{{$item->item_startPromo}}">
                                        <span class="text-danger">@error('item_startPromo'){{ $message }} @enderror</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="fname" class="col-md-3 control-label col-form-label">End Promotion <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="date" class="form-control" name="item_endPromo" value="{{$item->item_endPromo}}">
                                        <span class="text-danger">@error('item_endPromo'){{ $message }} @enderror</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="fname"
                                        class="col-md-3 control-label col-form-label">Discount <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <input type="number" step="any" min="0" max="100" class="form-control" name="item_discount" value="{{$item->item_discount}}">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">%</span>
                                            </div>
                                        </div>
                                        <span class="text-danger">@error('item_discount'){{ $message }} @enderror</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="border-top">
                            <div class="card-body" style="text-align:center;">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection