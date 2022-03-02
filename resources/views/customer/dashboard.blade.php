@extends('customer.layouts.master')

@if(!empty($newCust))
@section('title')
<div class="row">
    <div class="col-12 d-flex no-block align-items-center">

        <h4 class="page-title">Welcome!</h4>
        <div class="icon">
        </div>
        
    </div>
</div>
@endsection
@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"></h5>

            <div class="col">
                <div class="row align-items-start">
                    <div class="col">
                        <div class="card-body border border-secondary">
                            <h5 class="card-title">Let's get you started</h5>
                            <p><a href="{{route('shops.index')}}">Choose a fav shop here</a> </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@else
@section('title')
<div class="row">
    <div class="col-12 d-flex no-block align-items-center">
        @foreach($shop as $shopfav)
        <h4 class="page-title">{{$shopfav->shopName}}</h4>
        <div class="icon">
            <i class="me-2 mdi mdi-flag-triangle"></i> (You are currently viewing your favourite shop)
        </div>
        @endforeach
        <div class="ms-auto text-end">
            <nav aria-label="breadcrumb">
                <!-- <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Library</li>
                </ol> -->
            </nav>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row">
<div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Recommended for you</h5>
                <div class="col ">
                    <div class="row-1 align-self-end  ">
                        <div class="row align-items-start">
                        <?php
                                $count =0;
                            ?>
                        @foreach($recommendation as $recommendation)
                        <div class="col" >
                                <div class="card-body border border-secondary"style="height: 200px;" >
                                    <a href="{{route('itemDetails',['itemID' => $recommendation->id])}}"><h5 class="card-title">{{$recommendation->item_name}}</h5></a>
                                    <p>{{$recommendation->item_brand}} </p>
                                    <p>{{$recommendation->item_description}} </p>
                                    <small>SALE from {{$recommendation->item_startPromo}} until {{$recommendation->item_endPromo}}</small>
                                </div> 
                            </div>
                            <?php $count++; 
                            if($count==5){
                                ?>@break<?php
                            }
                            ?>
                           @endforeach
                          
                            <div class="col d-flex justify-content-end align-items-center p-4">
                                <a type="button" href="{{ route('recommendation') }}" class="btn btn-info btn-lg" id="ts-info" width="100px">see more</a> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    @foreach($categories as $category)
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{$category->category_name}}</h5>
                <div class="col ">
                    <div class="row-1 align-self-end  ">
                        <div class="row align-items-start">
                            <?php
                                $count =0;
                            ?>

                            @foreach($items as $item)
                            @if (($item->category_id) ===($category->id) )
                            <div class="col" >
                                <div class="card-body border border-secondary" style="height: 150px; ">
                                    <a href="{{route('itemDetails',['itemID' => $item->id])}}"><h5 class="card-title">{{$item->item_name}}</h5></a>
                                    <p>{{$item->item_brand}} </p>
                                    <p>{{$item->item_description}} </p>
                                </div>
                            </div>
                                
                            <?php $count++; 
                            if($count==5){
                                ?>@break<?php
                            }
                            ?>
                            @endif
                            @endforeach
                            
                            <div class="col d-flex justify-content-end align-items-center p-4">
                                <a type="button" href="{{ route('category',['categoryID' => $category->id]) }}" class="btn btn-info btn-lg" id="ts-info" width="100px">see more</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach

@endsection
@endif