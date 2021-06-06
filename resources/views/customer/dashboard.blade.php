@extends('customer.layouts.master')
    
            @section('title')
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                    @foreach($shop as $shopfav)
                        <h4 class="page-title">{{$shopfav->shopName}}</h4>
                        <div class="icon">
                        <i class="me-2 mdi mdi-flag-triangle"></i>
                        </div>
                        @endforeach
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Library</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            @endsection

            @section('content')
                <div class="row">
                @foreach($categories as $category) 
                <!-- buat display 5 je per category -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{$category->category_name}}</h5>
                                <div class="col">
                                    <div class="row align-items-start">
                                    @foreach($items as $item)
                                      @if (($item->category_id) ===($category->id) )

                                        <a class="col" href="{{route('itemDetails',['itemID' => $item->id])}}" >
                                            <div class="card-body border border-secondary">
                                                <h5 class="card-title" >{{$item->item_name}}</h5>
                                                <p>Lorem ipsum </p>
                                            </div>
                                        </a>
                                        @endif
                                        @endforeach
                                       
                                        <div class="col-md-3 col-sm-5 d-grid">
                                        <a type="button" href="{{ route('category',['categoryID' => $category->id]) }}"class="btn btn-lg btn-outline-info " id ="ts-info"width= "100px" >see more</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Categoryy</h5>

                                <div class="col">
                                    <div class="row align-items-start">
                                        <div class="col">
                                            <div class="card-body border border-secondary">
                                                <h5 class="card-title">Item 1</h5>
                                                <p>Lorem ipsum </p>
                                            </div>
                                        </div>
                                        <div class="col">
                                        <div class="card-body border border-secondary">
                                                <h5 class="card-title">One third width</h5>
                                                <p>Lorem ipsum </p>
                                            </div>
                                        </div>
                                        <div class="col">
                                        <div class="card-body border border-secondary">
                                                <h5 class="card-title">One third width</h5>
                                                <p>Lorem ipsum </p>
                                            </div>
                                        </div>
                                        <div class="col">
                                        <div class="card-body border border-secondary">
                                                <h5 class="card-title">One third width</h5>
                                                <p>Lorem ipsum </p>
                                            </div>
                                        </div>
                                        <div class="col">
                                        <div class="card-body border border-secondary">
                                                <h5 class="card-title">One third width</h5>
                                                <p>Lorem ipsum </p>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-5 d-grid">
                                        <button type="button" class="btn btn-lg btn-outline-info " id ="ts-info"width= "100px" >see more</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
              
            
          
            @endsection
      
   