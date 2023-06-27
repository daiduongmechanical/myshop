<!-- Lưu tại resources/views/product/index.blade.php -->
@extends('layout.layout');
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">




    </div><!-- /.container-fluid -->
</section>


<!-- Main content -->
<section class="content">
    <div class="row justify-content-md-center">
        <div class="col-12  ">
            <div class="card">

                <!-- /.card-header -->
                <div class="card-body p-0">


                    <!-- modal delete -->
                    <div class="modal fade" id="modalDeleteDish" tabindex="-1" role="dialog" aria-labelledby="modalDeleteDishLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header alert alert-danger">
                                    <h5 class="modal-title " id="modalDeleteDishLabel">Hide Confirm</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to <b>HIDE</b> this dish
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary " data-dismiss="modal">Cancel</button>
                                    <a type="button" class="btn btn-danger action-delete-dish">Hide</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- end modal delete -->
                    <div class="card-body  p-2">
                        <div class=" d-flex align-items-center mb-4">
                            <h1>List Product</h1>
                        </div>

                        @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                        {{session()->forget('success')}}
                        @endif
                        <table id="product__table" class="table table-striped table-bordered  border-2 border-dark">
                            <thead class="thead-dark">
                                <tr class="border border-primary">
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
                                        <!-- <a class="btn btn-primary btn-sm" href="#">
                                            <i class="fas fa-folder"></i> View
                                        </a> -->
                                        <a class="btn btn-info btn-sm" href="{{ url('product/update/'.$p->dishid) }}">
                                            <i class="fas fa-pencil-alt"></i> Edit
                                        </a>
                                        <button class="btn btn-danger btn-sm btn_delete_dish" data="{{$p->dishid}}" data-toggle="modal" data-target="#modalDeleteDish">
                                            <i class="fa-solid fa-eye-slash"></i> Hide
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
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