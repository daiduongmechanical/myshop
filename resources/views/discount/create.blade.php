<!-- Lưu tại resources/views/product/index.blade.php -->
@extends('layout.layout');
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <link href="{{ asset('css/discount-style.css') }}" rel="stylesheet">
</section>


<section class="content">
    <div class="card ">
        <div class="d-flex align-items-center">
            <h1>Create Discount</h1>
        </div>
        <div class="row p-4">

            <div class="col-5">
                <div class="card card-primary">



                    {{-- check error --}}

                    @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error')}}
                    </div>
                    @endif
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('/discount/postCreate') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="card-body border border-dark">

                            <div class="form-group">
                                <label for="txt-name"><b>Discount Name</b> </label>
                                <input required type="text" class="form-control" id="txt-name" name="name" placeholder="Input Discount Name">
                            </div>
                            <div class="form-group">
                                <label for="txt-price"><b>Discount Percent</b> </label>
                                <input required type="number" max="70" class="form-control" id="txt-price" name="price" placeholder="Enter Discount Percent(max 70%)">
                            </div>
                            <div class="form-group">
                                <label for="txt-price"><b>Start Sale Date</b> </label>
                                <input required type="date" class="form-control" id="start__sale--create" name="start_sale_date" placeholder="1">
                            </div>
                            <div class="form-group">
                                <label for="txt-price"><b>End Sale Date</b> </label>
                                <input required type="date" class="form-control" id="end__sale--create" name="end_sale_date" placeholder="1">
                            </div>
                        </div>
                        <!-- /.card-body -->

                </div>
                <!-- /.card -->
            </div>

            <div class="col-7">
                &ensp;&ensp;&ensp; <label>Select:</label>
                <select name="object" id="select-all-none">
                    <option value="">None</option>
                    <option value="all">All</option>
                    <option value="tiramisu">Tiramisu</option>
                    <option value="cup cake">Cupcake</option>
                    <option value="roll cake">Roll Cake</option>
                    <option value="donut">Donut</option>
                    <option value="specific">Specific</option>
                </select>
                <div class="card-body2">
                    <table id="product" class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th>Select</th>
                                <th>Dish ID</th>
                                <th>Dish Name</th>
                                <th>Dish Price</th>
                                <th>Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dishes as $h)
                            <tr>
                                <td><label for="checkbox"></label>
                                    <input class="checkbox__create--discount" type="checkbox" id="checkbox" name="checkbox[]" value="{{ $h->dishid }}" sort="{{ $h->type }}">
                                </td>
                                <td>{{ $h->dishid }}</td>
                                <td>{{ $h->dishname}}</td>
                                <td>{{ $h->dishprice}}</td>
                                <td>{{ $h->type}}</td>


                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                            </tr>
                        </tfoot>
                    </table>

                    <div style="width: 100%;" class="d-flex">
                        <button type="submit" class="btn btn-primary mt-3">Create Discount</button>
                    </div>


                </div>


                <!-- /.card -->
            </div>
            <!-- Khoảng trắng -->
            <div class="whitespace"></div>
</section>
</form>
<!-- /.col -->
</div>
</div>
<!-- /.row -->
</section>

<!-- /.card-header -->

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