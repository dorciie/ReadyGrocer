@extends('shop.layouts.master')

@section('content')
    <div class="ms-auto text-end">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('shop/dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('category.index')}}">All category</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit category</li>
            </ol>
        </nav>
    </div>

    <div class="results">
        @if(Session::get('success'))
            <div class="alert alert-success" id="alert">
                {{Session::get('success')}}
            </div>
        @endif
        @if(Session::get('fail'))
            <div class="alert alert-danger" id="alert">
                {{Session::get('fail')}}
            </div>
        @endif
    </div>

    <div class="card">
        <form class="form-horizontal" action="{{route('category.update',$category->id)}}" method="post">
            @csrf
            @method('patch')
            <div class="card-body">
                <h4 class="card-title">Edit category</h4>
                <br>
                <div class="form-group row">
                    <label for="fname"
                        class="col-sm-2 text-end control-label col-form-label">Category Name <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="category_name" value="{{$category->category_name}}">
                        <span class="text-danger">@error('category_name'){{ $message }} @enderror</span>
                    </div>
                </div>
            </div>
            <div class="border-top">
                <div class="card-body" style="text-align:center;">
                    <button type="submit" class="btn btn-info">Submit</button>
                </div>
            </div>
        </form>
    </div>
@endsection
