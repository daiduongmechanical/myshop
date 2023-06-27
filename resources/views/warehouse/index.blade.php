<!-- Lưu tại resources/views/product/index.blade.php -->
@extends('layout.layout');
@section('content')
<!-- Content Header (Page header) -->



<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header alert alert-danger">
                <h5 class="modal-title" id="exampleModalLabel">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <b> Are you sure delete this Ingredient ?? </b>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a type="button" class="btn btn-danger action-delete-ingredient">Delete</a>
            </div>
        </div>
    </div>
</div>



<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">

                <!-- /.card-header -->
                <div class="card-body p-2">
                    <div class=" d-flex align-items-center mb-4">
                        <h1>List Materials</h1>

                    </div>
                    @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    {{session()->forget('success')}}
                    @endif
                    @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                    {{session()->forget('error')}}
                    @endif
                    <table id="material__table" class="table table-striped table-bordered  border-2 border-dark">
                        <thead class="thead-dark ">
                            <tr>
                                <th>Ingredient Id</th>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Update at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($warehouses as $w)
                            <tr>
                                <td>{{ $w->ingredientcode}}</td>
                                <td>{{ $w->name}}</td>
                                <td>{{ $w->mass}}</td>
                                <td>{{ $w->created_at}}</td>
                                <td class="text-center">

                                    <!-- <a class="btn btn-info btn-sm" href="{{ url('warehouse/edit/'.$w->ingredientcode) }}">
                                        <i class="fas fa-pencil-alt"></i> Edit
                                    </a> -->



                                    <button type="button" class="btn btn-danger btn-sm btn_delete_ingredient" data-toggle="modal" data-target="#exampleModal" data="{{ $w->ingredientcode }}">
                                        <i class="fas fa-trash"></i> Delete
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