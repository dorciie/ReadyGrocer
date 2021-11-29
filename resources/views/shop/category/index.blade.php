@extends('shop.layouts.master')

@section('content')
    <div class="ms-auto text-end">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('shop/dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">All category</li>
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
        <div class="card-body">
            <h5 class="card-title">Category</h5>
            <p>Total category: {{\App\Models\Category::where('shop_id',$LoggedShopInfo->id)->count()}}</p>
            <a class="btn btn-sm btn-info" href="{{route('category.create')}}"><i class="fa fa-plus"></i> New Category</a>
            <br><br>
            <div class="table-responsive">
                <table id="myTable" class="table table-striped table-bordered">
                    <thead>
                        <tr class="table-info">
                            <th><strong>Number</strong></th>
                            <th><strong>Category Name</strong></th>
                            {{-- <th>Status</th>  --}}
                            <th><strong>Action</strong></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <td>{{$loop->iteration}}.</td>
                            <td>{{$category->category_name}}</td>
                            {{-- <td>active / inactive</td> --}}
                            <td>
                                <a style="float: left;" href="{{route('category.edit',$category->id)}}" data-toggle="tooltip" class="btn btn-sm btn-info" data-placement="bottom"><i class="fas fa-edit"></i></a>
                                <form style="float: left; margin-left: 5px;" action="{{route('category.destroy',$category->id)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <a href="" data-toggle="tooltip" data-id="{{$category->id}}" class="dltBtn btn btn-sm btn-danger" data-placement="bottom"><i style="color: white" class="fas fa-trash-alt"></i></a>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.dltBtn').click(function(e){
        var form=$(this).closest('form');
        var dataID =$(this).data('id');
        e.preventDefault();
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this category! Noted that if you delete this category, the product under this category also will be deleted",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                form.submit();
                swal("Deleting in process!", {
                icon: "success",
                });
            } else {
                swal("This category is not deleted!");
            }
        });
    });
</script>
<script>
    $(document).ready( function () {
    $('#myTable').DataTable(); //category table
    } );
</script>
@endsection
