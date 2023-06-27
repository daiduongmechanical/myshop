@extends('layout.layout')
@section('title', 'View Product')
@section('content')
<link rel="stylesheet" href="{{ asset('css/overview.css') }}">
<br>
<section class="content">
    <div class="container-fluid card p-3">
        <div class="upper ">
            <h1>
                Overview by
                <select class="custom-select border border-dark p-2 sort-by">
                    <option value="date">Date</option>
                    <option value="month">Month</option>
                    <option value="year">Year</option>
                </select>
            </h1>
            <div class="Select sort-byDate sort-by">
                <input type="date" value="<?= date("Y-m-d") ?>" id="dateSort" class="date-time border border-dark p-2">
            </div>
            <div class="Select sort-byMonth sort-by">
                <input type="month" value="<?= date('Y-m') ?>" id="monthSort" class="date-time border border-dark p-2">
            </div>
            <div class="Select sort-byYear sort-by">
                <input type="number" min="1900" max="2023" step="1" value="2023" value="<?= date('Y') ?>" id="yearSort" class="date-time border border-dark p-2">
            </div>
        </div>


        <br>

        <div class="header">
            <div class="wrapper">
                <button id="revenue_button" class="sort-by">
                    <div class="icon d-flex justify-content-center align-items-center"><i class="fa-sharp fa-solid fa-coins " style="font-size: 30px;"></i></div>
                </button>
                <div class="revenue">Total Revenue</div>

                <div id="totalCost">
                    @if(isset($overviews))
                    {{$overviews[0]}}
                    @endif

                </div>
            </div>
            <div class="wrapper">
                <div class="icon d-flex justify-content-center align-items-center"><i class="fa-solid fa-eye" style="font-size: 30px;"></i></div>

                <div class="revenue">Total View</div>
                <div id="totalView">
                    @if(isset($overviews))
                    {{$overviews[1]}}
                    @endif
                </div>
            </div>
            <div class="wrapper">
                <button id="order_button" class="sort-by">
                    <div class="icon d-flex justify-content-center align-items-center"><i class="fa-sharp fa-solid fa-cart-shopping" style="font-size: 30px;"></i></div>
                </button>
                <div class="revenue">Total Order</div>
                <div id="totalOrder">
                    @if(isset($overviews))
                    {{$overviews[2]}}
                    @endif
                </div>
            </div>
        </div>
        <br>
        <h1>Details</h1>
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="search-results" class="table table-striped table-bordered  border-2 border-dark">
                            <thead class="thead-dark ">
                                <tr>
                                    <th>Image</th>
                                    <th>DishID</th>
                                    <th>Name</th>
                                    <th>Total orders</th>
                                    <th>Total cost</th>
                                </tr>
                            </thead class="thead-dark ">
                            <tbody>
                                @foreach ($overviews[3] as $e)
                                <tr>
                                    <td id="OverviewImage"><img width="50px" src="{{$e->info->dishimages[0]->imageurl}}" alt=""></td>
                                    <td id="OverviewDishID">{{$e->info->dishid}}</td>
                                    <td id="OverviewName">{{$e->info->dishname}}</td>
                                    <td id="OverviewTotalOrders"></td>
                                    <td id="OverviewTotalCost"></td>
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
    </div>

</section>

@endsection