@extends('customer.layouts.master')


@section('title')           
     <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Your Grocery Cart</h4>
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
                        <div class="card">
                            
                            <div class="card-body">
                                <h5 class="card-title mb-0">Your Cart</h5>
                            </div>
                            
                            <table class="table">
                                <thead>

                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Item ID</th>
                                        <th scope="col">Item Price(RM)</th>
                                        <th scope="col">Item Quantity</th>
                                        <th scope="col">Total Price(RM)</th>

                                        <th scope="col">Item Brand</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    <div style="display: none">{{$total =0}}</div>
                                    @foreach($info as $info)

                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{$info->id}}</td>
                                        <td>{{$info->item_price}}</td>
                                        <td >{{$info->item_quantity}}</td>
                                        <td>{{$info->total_price}}</td>
                                        <td>{{$info->item_brand}}</td>
                                        <div style="display: none">{{$total += $info->total_price}}</div>

                                    </tr>
                                    @if ($loop->last)
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>{{$total}}</td>
                                        <td> <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#checkoutcart">Check Out Now</button></td>
                                    </tr>
                                    @endif
                                    @endforeach


                                </tbody>
                            </table>
                            <div class="modal fade" id="checkoutcart" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <form method="get" action="{{route('checkout')}}">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Confirm Checkout</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Total Price(RM)</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p>{{$total}}</p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Delivery Time</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p> 10.00pm</p>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-info btn-lg">Confirm</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                @endsection
        