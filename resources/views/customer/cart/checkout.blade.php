@extends('customer.layouts.master')


@section('title')
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Your Order is on the way!</h4>
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
                    <div class="col-12">
                       
                    @if(!empty($success))
                                    <div class="alert alert-success">
                                        {{$success}}
                                    </div>
                                    @else
                                    <div class="alert alert-success">
                                       error
                                    </div>
                                    @endif
                                  <button type="button" class="btn btn-primary" >Order Received</button>
                                  
                        
                    </div>
                </div>
          @endsection