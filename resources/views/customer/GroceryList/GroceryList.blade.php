@extends('customer.layouts.master')



@section('title')

<div class="row">
    <div class="col-12 d-flex no-block align-items-center">
        <h4 class="page-title">Your Grocery List</h4>
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
                @if(Session::get('success'))
                <div class="alert alert-success">
                    {{Session::get('success')}}
                </div>
                @endif
                @if(Session::get('error'))
                <div class="alert alert-danger">
                    {{Session::get('error')}}
                </div>
                @endif
                <h5 class="card-title">Basic Datatable</h5>
                <div class="table-responsive">
                    <table id="zero_config" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Item Name</th>
                                <th>Item Brand</th>
                                <th>Item Category</th>
                                <th>Item quantity</th>
                                <th>Item Frequency</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($list as $list)

                            <tr>
                                <td>{{$list->item_name}}</td>
                                <td>{{$list->item_brand}}</td>
                                <td>{{\App\Models\Category::where('id',$list->category_id)->value('category_name')}}</td>
                                <td>{{$list->item_quantity}}</td>
                                <td>{{$list->item_frequency}}</td>
                                <td><button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#productID{{$list->item_id}}">Update List</button></td>

                                <td><a class="btn btn-outline-primary" href="{{route('updateCart2',['itemID' => $list->item_id])}}" role="button">Add to Cart</a></td>

                            </tr>


                            <div class="modal fade" id="productID{{$list->item_id}}"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <form method="get" action="{{route('updateList2',['itemID' => $list->item_id])}}">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Update List</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Item Name</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p>{{$list->item_name}}</p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Item Quantity</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="input-group mb-3">
                                                            <input type="number" class="form-control" name="item_quantity" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="{{$list->item_quantity}}" placeholder="{{$list->item_quantity}}">
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Item Frequency</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="input-group mb-3">
                                                            <select class="form-select" name="item_frequency" aria-label="Default select example" selected="{{$list->item_frequency}}">
                                                                <option value="None">None</option>
                                                                <option value="Daily">Daily</option>
                                                                <option value="Weekly">Weekly</option>
                                                                <option value="Fortnight">Fortnight</option>
                                                                <option value="Monthly">Monthly</option>
                                                            </select>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <a class="btn btn-outline-danger" href="{{route('updateList',['itemID' => $list->id])}}" role="button">Delete</a>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            @endforeach


                        </tbody>
                   
                    </table>

                </div>

            </div>

        </div>
    </div>
</div>
@endsection