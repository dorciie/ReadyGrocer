@extends('shop.layouts.master')

@section('content')
    <div class="ms-auto text-end">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('shop/dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('item.index')}}">All Item</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add new Item</li>
            </ol>
        </nav>
    </div>

    <div class="results">
        @if(Session::get('success'))
            <div class="alert alert-success" id="alert">
                {{Session::get('success')}}
            </div>
        @endif
        @if(Session::get('error'))
            <div class="alert alert-danger" id="alert">
                {{Session::get('error')}}
            </div>
        @endif
    </div>

    <div class="card">
        <form class="form-horizontal" action="{{route('item.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <h4 class="card-title">Add new item</h4>
                <br>
                <div class="form-group row">
                    <label for="fname"
                        class="col-sm-2 text-end control-label col-form-label">Item Name <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="item_name" value="{{old('item_name')}}">
                        <span class="text-danger">@error('item_name'){{ $message }} @enderror</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="fname"
                        class="col-sm-2 text-end control-label col-form-label">Item Brand <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="item_brand" value="{{old('item_brand')}}">
                        <span class="text-danger">@error('item_brand'){{ $message }} @enderror</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="fname"
                        class="col-sm-2 text-end control-label col-form-label">Item Price <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">RM</span>
                            </div>
                            <input type="number" step="any" class="form-control" name="item_price" value="{{old('item_price')}}"> 
                        </div>
                        <span class="text-danger">@error('item_price'){{ $message }} @enderror</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="fname"
                        class="col-sm-2 text-end control-label col-form-label">Category <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select name="category_id" class="form-select shadow-none">
                                <option value="">----category----</option>
                                @foreach(\App\Models\Category::where('shop_id',$LoggedShopInfo->id)->get() as $category)
                                    <option value="{{$category->id}}" {{old('category_id')==$category->id?'selected':''}}>{{$category->category_name}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">@error('category_id'){{ $message }} @enderror</span>
                        </div>
                </div>
                <div class="form-group row">
                    <label for="fname"
                        class="col-sm-2 text-end control-label col-form-label">Stock <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" name="item_stock" value="{{old('item_stock')}}">
                        <span class="text-danger">@error('item_stock'){{ $message }} @enderror</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="fname"
                        class="col-sm-2 text-end control-label col-form-label" >Image <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="item_image" value="{{old('item_image')}}" accept="image/*" required>
                            {{-- <label class="custom-file-label" for="item_image">Choose
                                file...</label> --}}
                            {{-- <div class="invalid-feedback">Example invalid custom file feedback</div> --}}
                        </div>
                        <span class="text-danger">@error('item_image'){{ $message }} @enderror</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="fname"
                        class="col-sm-2 text-end control-label col-form-label">Description</label>
                    <div class="col-sm-9">
                        <textarea rows="9" cols="50" class="form-control" name="item_description">{{old('item_description')}}</textarea>
                        <span class="text-danger">@error('item_description'){{ $message }} @enderror</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="fname"
                        class="col-sm-2 text-end control-label col-form-label">Weight/Volume <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="item_size" value="{{old('item_size')}}">
                        <span class="text-danger">@error('item_size'){{ $message }} @enderror</span>
                    </div>
                </div>
                <br><br>
            </div>
            <div class="border-top">
                <div class="card-body" style="text-align:center;">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('script')
<script>
    
</script>
@endsection
