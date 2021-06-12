@extends('shop.layouts.master')

@section('content')
<div class="ms-auto text-end">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('shop/dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Order per Customer</li>
        </ol>
    </nav>
</div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Order per Customer</h5>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body" style="line-height: 0.7;">
                            {{-- <h3 class="card-title">Customer's order details</h3> --}}
                            <br>
                            <div class="form-group row">
                                <p style="font-size: 14px;" class="col-sm-3" style="font-size: 18px;">Name:</p>
                                <p style="font-size: 14px;" class="col-sm-8" style="font-size: 18px;">Customer1</p>
                            </div>
                            <div class="form-group row">
                                <p style="font-size: 14px;" class="col-sm-3" style="font-size: 18px;">Address:</p>
                                <p style="font-size: 14px;" class="col-sm-8" style="font-size: 18px;">Kota Bharu</p>
                            </div>
                            <div class="form-group row">
                                <p style="font-size: 14px;" class="col-sm-3" style="font-size: 18px;">Delivery date and time: </p>
                                <p style="font-size: 14px;" class="col-sm-8" style="font-size: 18px;">20/08/2021, 15:30:00</p>
                            </div>
                            <div class="form-group row">
                                <p style="font-size: 14px;" class="col-sm-3" style="font-size: 18px;">Contact Number: </p>
                                <p style="font-size: 14px;" class="col-sm-8" style="font-size: 18px;">0131111111</p>
                            </div>
                            <div class="form-group row">
                                <p style="font-size: 14px;" class="col-sm-3" style="font-size: 18px;">Payment method: </p>
                                <p style="font-size: 14px;" class="col-sm-8" style="font-size: 18px;">Cash</p>
                            </div>
                            <div class="form-group row">
                                <p style="font-size: 14px;" class="col-sm-3" style="font-size: 18px;">Total amount of payment: </p>
                                <p style="font-size: 14px;" class="col-sm-8" style="font-size: 18px;">RM500.00</p>
                            </div>
                            <div class="form-group row">
                                <p style="font-size: 14px;" class="col-sm-4" style="font-size: 18px;">List of item bought: </p>
                                <p style="font-size: 14px;" class="col-sm-8" style="font-size: 18px;">
                                    <div class="table-responsive">
                                        <table id="myTable" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Item</th>{{-- boleh tick banyak item kat sini --}}
                                                    <th>Quantity</th>{{-- bila tekan view "icon mata", show table semua item+price before and after promotion --}}
                                                    <th>Price per unit,RM</th>
                                                </tr>
                                            </thead>
                                            <tbody style="text-align:center;">
                                                <tr>
                                                    <td>1</td>
                                                    <td>Susu Cair</td>
                                                    <td>5</td>
                                                    <td>3.50</td>
                                                </tr>    
                                                <tr>
                                                    <td>2</td>
                                                    <td>Sardine</td>
                                                    <td>3</td>
                                                    <td>5.00</td>
                                                </tr>  
                                                <tr>
                                                    <td>3</td>
                                                    <td>Toblerone</td>
                                                    <td>2</td>
                                                    <td>7.00</td>
                                                </tr>          
                                            </tbody>
                                        </table>
                                    </div>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection