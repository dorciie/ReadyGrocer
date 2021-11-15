@extends('shop.layouts.master')
@section('head')
<link rel="stylesheet" type="text/css" href="{{asset('assets/libs/select2/dist/css/select2.min.css')}}">
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
                <form class="form-horizontal" action="{{route('promotion.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                    <div class="card-body">
                        <h4>List of items</h4>
                        <p>Please select the item that you want to schedule promotion.</p>
                        <div class="form-group row">
                            @foreach(\App\Models\Category::where('shop_id',$LoggedShopInfo->id)->get() as $category)
                                {{-- <option value="{{$category->id}}" {{old('category_id')==$category->id?'selected':''}}>{{$category->category_name}}</option> --}}
                                <label class="col-md-3 mt-3">{{$category->category_name}}</label>
                                <div class="col-md-9">
                                    <select class="select2 form-select shadow-none mt-3" name="items_id[]" multiple="multiple" style="height: 36px;width: 100%;">
                                        @foreach(\App\Models\ShopItem::where('shop_id',$LoggedShopInfo->id)->where('category_id',$category->id )->where('item_stock','!=','0')->where('item_endPromo',NULL)->get() as $items)    
                                        <option value="{{$items->id}}" {{old('items_id')==$items->id?'selected':''}}> {{$items->item_name}}, {{$items->item_brand}}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">@error('items_id'){{ $message }} @enderror</span>
                                </div>
                            @endforeach
                        </div>
                        <div class="border-top">
                            <br>
                            <h4>Promotion details</h4>
                                <div class="form-group row">
                                    <label for="fname" class="col-md-3 control-label col-form-label">Start Promotion <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="date" class="min-today form-control" id="min" name="item_startPromo" value="{{old('item_startPromo')}}">
                                        <span class="text-danger">@error('item_startPromo'){{ $message }} @enderror</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="fname" class="col-md-3 control-label col-form-label">End Promotion <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="date" class="min-today form-control" id="min" name="item_endPromo" value="{{old('item_endPromo')}}">
                                        <span class="text-danger">@error('item_endPromo'){{ $message }} @enderror</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="fname"
                                        class="col-md-3 control-label col-form-label">Discount <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <input type="number" step="any" min="0" max="100" class="form-control" name="item_discount" value="{{old('item_discount')}}">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">%</span>
                                            </div>
                                        </div>
                                        <span class="text-danger">@error('item_discount'){{ $message }} @enderror</span>
                                    </div>
                                </div>
                        </div>
                        <div class="border-top">
                            <div class="card-body" style="text-align:center;">
                                <button type="submit" class="btn btn-info">Submit</button>
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
    <script src="{{asset('assets/libs/select2/dist/js/select2.min.js')}}"></script>
    <script src="{{asset('assets/libs/select2/dist/js/select2.full.min.js')}}"></script>

    <script> $(".select2").select2();</script>
    <script>
        $(function () {
                $(document).ready(function () {

                    var todaysDate = new Date(); // Gets today's date
                    var year = todaysDate.getFullYear(); // YYYY
                    var month = ("0" + (todaysDate.getMonth() + 1)).slice(-2); // MM
                    var day = ("0" + (todaysDate.getDate()+1)).slice(-2); // DD

                    var minDate = (year + "-" + month + "-" + day); // Results in "YYYY-MM-DD" for today's date 

                    // Now to set the max date value for the calendar to be today's date
                    $('[type="date"].min-today').attr('min', minDate);

                });
            });
    </script>
@endsection