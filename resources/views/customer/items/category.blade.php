@extends('customer.layouts.master')


@section('title')
@foreach($shop as $favshop)
<div class="row">
    <div class="col-12 d-flex no-block align-items-center">

        <h4 class="page-title">{{$favshop->shopName}}</h4>
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
@endforeach
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h5 class="card-title mb-0">Category Name</h5>

            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Brand</th>
                        <th scope="col">Price(RM)</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody> @foreach($name as $row)
                    @foreach($items as $item)

                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td><a href="{{route('itemDetails',['itemID' => $item->id])}}">{{$item->item_name}}</a></td>
                        <td>{{$item->item_brand}}</td>
                        <td>{{$item->item_price}}</td>
                        <td><button type="button" class="btn btn-primary">List</button></td>
                        <td><button type="button" class="btn btn-primary">Cart</button></td>
                    </tr>
                    @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection