<!-- Lưu tại resources/views/product/index.blade.php -->
@extends('layout.layout');
@section('content')
<!-- Content Header (Page header) -->



<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="d-flex align-items-center mt-2">
                    <h1>List Hide Dishes</h1>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    {{session()->forget('success')}}
                    @endif
                    @if (session('error'))
                    <div class="alert alert-success">{{ session('error') }}</div>
                    {{session()->forget('error')}}
                    @endif
                    <!-- modal delete -->
                    <div class="modal fade" id="modalDeleteDish" tabindex="-1" role="dialog" aria-labelledby="modalDeleteDishLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header alert alert-danger">
                                    <h5 class="modal-title " id="modalDeleteDishLabel">Delete Confirm</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body notify__modal--oldDish">
                                    Are you sure you want to <b>delete</b> this dish
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary " data-dismiss="modal">Cancel</button>
                                    <a type="button" class="btn btn-danger action-delete-dish">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- end modal delete -->
                    <table id="product" class="table table-bordered table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>Product Id</th>
                                <th>Product Name</th>
                                <th>Price</th>

                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $p)
                            <tr>
                                <td>{{ $p->dishid }}</td>
                                <td>{{ $p->dishname}}</td>
                                <td>{{ $p->dishprice}}</td>

                                <td class="text-center">

                                    <a class="btn btn-info btn-sm" href="{{ url('product/update/'.$p->dishid) }}">
                                        <i class="fas fa-pencil-alt"></i> Edit
                                    </a>

                                    <button class="btn btn-primary  btn-sm btn_restore_dish" data="{{$p->dishid}}" data-toggle="modal" data-target="#modalDeleteDish">
                                        <i class="fa-solid fa-recycle"></i> Restore
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
{{-- @section('script-content');
    <script>
        $(function () {
            $('#product').DataTable();
        });
    </script> --}}

@endsection