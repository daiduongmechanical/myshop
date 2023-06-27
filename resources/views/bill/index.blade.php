<!-- Lưu tại resources/views/product/index.blade.php -->
@extends('layout.layout');
@section('content')
<!-- Content Header (Page header) -->
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

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
                <b> Are you sure delete this Banner? </b>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a type="button" class="btn btn-danger action-delete-bill">Delete</a>
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
                        <h1>List of Bill</h1>
                    </div>
                    <table id="material__table" class="table table-striped table-bordered  border-2 border-dark">
                        <thead class="thead-dark ">
                            <tr>
                                <th>Bill ID</th>
                                <th>Amount</th>
                                <th>Type</th>
                                <th>Order ID</th>
                                <th>Created at</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bills as $b)
                            <tr>
                                <td>{{ $b->billid}}</td>
                                <td>${{ $b->amount}}</td>
                                <td>{{ $b->type}}</td>
                                <td>{{ $b->orderid}}</td>
                                <td>{{ $b->created_at}}</td>


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