@extends('shop.layouts.master')
@section('head')
<link rel="stylesheet" type="text/css" href="{{asset('assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
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
                <h3 class="card-title">Promotion for {{$item->item_name}}, {{$item->item_brand}}</h3><br>
                <div class="card">
                    <form class="form-horizontal" action="{{route('promotion.update',$item->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="card-body">
                        {{-- <h4>Promotion for {{$item->item_name}} brand {{$item->item_brand}}</h4> --}}
                        <div class="border-top">
                                <div class="form-group row">
                                    <label for="fname" class="col-md-3 control-label col-form-label">Start Promotion <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="datepicker-autoclose1" name="item_startPromo" value="{{\Carbon\Carbon::parse($item->item_startPromo)->format('d/m/Y')}}">
                                            <div class="input-group-append">
                                                <span class="input-group-text h-100"><i class="fa fa-calendar"></i></span>
                                            </div>
                                        </div>
                                        <span class="text-danger">@error('item_startPromo'){{ $message }} @enderror</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="fname" class="col-md-3 control-label col-form-label">End Promotion <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="datepicker-autoclose2" name="item_endPromo" value="{{\Carbon\Carbon::parse($item->item_endPromo)->format('d/m/Y')}}">
                                            <div class="input-group-append">
                                                <span class="input-group-text h-100"><i class="fa fa-calendar"></i></span>
                                            </div>
                                        </div>
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
<script src="{{asset('assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<script>
// $(document).ready(function(){
//     jQuery('#datepicker-autoclose1').datepicker({
//         autoclose: true,
//         todayHighlight: true,
//         startDate: new Date(),
//         format: 'dd/mm/yyyy'
//     });
//     jQuery('#datepicker-autoclose2').datepicker({
//         autoclose: true,
//         todayHighlight: true,
//         startDate: new Date(),
//         format: 'dd/mm/yyyy'
//     });
// });

$(document).ready(function(){
    today = new Date();
    tomorrow = new Date();
    tomorrow.setDate(today.getDate() + 1);
   $("#datepicker-autoclose1").datepicker({
       format: 'dd/mm/yyyy',
       autoclose: true,
    //    todayHighlight: true,
       startDate: tomorrow,
   }).on('changeDate', function (selected) {
       var minDate = new Date(selected.date.valueOf());
       $('#datepicker-autoclose2').datepicker('setStartDate', minDate);
   });

   $("#datepicker-autoclose2").datepicker({
       format: 'dd/mm/yyyy',
       autoclose: true,
    //    todayHighlight: true,
       startDate: tomorrow,
   }).on('changeDate', function (selected) {
           var minDate = new Date(selected.date.valueOf());
           $('#datepicker-autoclose1').datepicker('setEndDate', minDate);
   });
});
</script>
@endsection