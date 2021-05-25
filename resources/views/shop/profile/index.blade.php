@extends('shop.layouts.master')

@section('content')

<div class="row" style="margin-top:45px">
    <div class="col-md-6 col-md-offset-3">
        <h4>Profile page</h4>
        <hr>
        <table class="table table-hover">
            <thead>
                <th>Name</th>
                <th>Email</th>
                <th>Logout</th>
            </thead>
            <tbody>
                <td>{{$LoggedShopInfo->name}}</td>
                <td>{{$LoggedShopInfo->email}}</td>
                <td><a href="shoplogout">Logout</a></td>
            </tbody>
        </table>
    </div>
</div>
@endsection
