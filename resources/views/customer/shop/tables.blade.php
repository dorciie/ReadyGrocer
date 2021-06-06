@extends('customer.layouts.master')
       
@section('title')
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">List of Shops</h4>
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
                                <h5 class="card-title">Shops</h5>
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Position</th>
                                                <th>Office</th>
                                                <th>Age</th>
                                                <th>Start date</th>
                                                <th>Salary</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($shops as $row)
                                            <tr>
                                           
                                                <th scope="row"><a href="{{route('shopdetails',['shopID' => $row['id']])}}">{{$row['id']}}</a></th>
                                               
                                                <td>{{$row['shopName']}}</td>
                                                <td>{{$row['address']}}</td>
                                                <td>{{$row['shopName']}}</td>
                                                <td>$320,800</td>
                                                <td>$320,800</td>

                                            </tr>
                                            @endforeach
                                       
                                        </tbody>
                                       
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
  @endsection