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
            <h1>Update Discount</h1>
        </div>
        <div class="row p-4">
            <div class="col-5">
                <div class="card card-primary ">


                    {{-- check error --}}

                    @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error')}}
                    </div>
                    @endif
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('/discount/postEdit/') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="card-body border border-dark">
                            <div class="form-group">
                                <label for="txt-id"><b>Discount ID</b> </label>
                                <input type="text" class="form-control" id="txt-id" name="id" readonly value="{{ $discount->discountid }}">
                            </div>
                            <div class="form-group">
                                <label for="txt-name"><b> Discount Name</b> </label>
                                <input required type="text" class="form-control" id="txt-name" name="name" value="{{ $discount->discountname }}">
                            </div>
                            <div class="form-group">
                                <label for="txt-percent"><b>Discount Percent</b> </label>
                                <input type="number" max="70" class="form-control" id="txt-price" name="price" value="{{ $discount->discountamount }}">
                            </div>
                            <div class="form-group">
                                <label for="txt-start"><b>Start Sale Date</b> </label>
                                <input required type="date" class="form-control" id="start__sale--update" name="start_sale_date" value="{{ $discount->startdate }}">
                            </div>
                            <div class="form-group">
                                <label for="txt-end"><b>End Sale Date</b> </label>
                                <input required type="date" class="form-control" id="end__sale--update" name="end_sale_date" value="{{ $discount->enddate }}">
                            </div>



                        </div>


                </div>
                <!-- /.card -->
            </div>

            <div class="col-7">
                <label>Select:</label>
                <select name="object" id="select-all-none">
                    <option value="none">None</option>
                    <option value="all">All</option>
                    <option value="tiramisu">Tiramisu</option>
                    <option value="cup cake">Cupcake</option>
                    <option value="roll cake">Roll Cake</option>
                    <option value="donut">Donut</option>
                </select>
                <div class="card-body2">
                    <table id="product" class="table table-bordered table-hover">
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
                            @foreach($dishes as $dish)
                            <tr>
                                <td>
                                    <label for="checkbox"></label>
                                    <input type="checkbox" id="checkbox" name="checkbox[]" value="{{ $dish->dishid }}" sort="{{ $dish->type }}" @if($discountedDishes->pluck('dishid')->contains($dish->dishid)) checked @endif>
                                </td>
                                <td>{{ $dish->dishid }}</td>
                                <td>{{ $dish->dishname }}</td>
                                <td>{{ $dish->dishprice }}</td>
                                <td>{{ $dish->type }}</td>

                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Update Discount</button>
                    </div>

                </div>


                <!-- /.card -->
            </div>
            <!-- Khoảng trắng -->
            <div class="whitespace"></div>
            </form>
            <!-- /.col -->
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