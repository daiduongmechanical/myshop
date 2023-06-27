<!-- Lưu tại resources/views/product/index.blade.php -->
@extends('layout.layout');
@section('content')
<!-- Content Header (Page header) -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Form Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Do you want to delete it?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a type="button" class="btn btn-danger action-delete-discount">Delete</a>
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

                <div class="card-body  p-2">
                    <div class=" d-flex align-items-center mb-4">
                        <h1>Discount List</h1>
                    </div>

                    @if(session('success'))
                    <div class="alert alert-success">{{session('success')}}</div>
                    {{session()->forget('success')}}
                    @endif

                    @if(session('error'))
                    <div class="alert alert-danger">{{session('error')}}</div>
                    {{session()->forget('error')}}
                    @endif

                    <table id="discount__table" class="table table-striped table-bordered  border-2 border-dark">
                        <thead thead class="thead-dark ">
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Amount</th>
                                <th>Startdate</th>
                                <th>Enddate</th>
                                <th>Object</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($discounts as $d)
                            <tr>
                                <td>{{ $d->discountid }}</td>
                                <td>{{ $d->discountname}}</td>
                                <td>{{ $d->discountamount}}</td>
                                <td>{{ $d->startdate}}</td>
                                <td>{{ $d->enddate}}</td>
                                <td>{{ $d->object}}</td>

                                <td class="text-center">
                                    <a class="btn btn-info btn-sm" href="{{ url('discount/edit/'.$d->discountid) }}">
                                        <i class="fas fa-pencil-alt"></i> Edit
                                    </a>
                                    {{-- <a class="btn btn-danger btn-sm" href="{{ route('discount.delete', ['id' => $d->discountid]) }}"
                                    onclick="return confirm('Are you sure you want to delete?')">
                                    <i class="fas fa-trash"></i> Delete
                                    </a> --}}
                                    <button type="button" class="btn btn-danger btn-sm btn_delete_discount" data-toggle="modal" data-target="#exampleModal" data="{{ $d->discountid }}">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>

                        </tfoot>
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