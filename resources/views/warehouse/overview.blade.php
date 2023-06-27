@extends('layout.layout')
@section('title', 'View Product')   
@section('content')
<link rel="stylesheet" href="{{ asset('css/overview.css') }}">
<br>
<section class="content" >
    <div class="container-fluid">
    <h1>Overview by </h1>
    <br>
    <div class= "header">
        <div class="wrapper">
            <div class="icon">icon</i></div>
            <div class="revenue">Total Revenue</div>
            <div>Value</div>
        </div>
        <div class="wrapper">
            <div class="icon">icon</i></div>
            <div class="revenue">Total View</div>
            <div>Value</div>
        </div>
        <div class="wrapper">
            <div class="icon">icon</i></div>
            <div class="revenue">Total Order</div>
            <div>Value</div>
        </div>
    </div>
    <br>
    <h1>Details</h1>
    <div class="row">
        <div class="col-12">
            <div class="card">

                <!-- /.card-header -->
                <div class="card-body">
                    <table id="product" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Total views</th>
                                <th>Total orders</th>
                                <th>Total revenues</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach($warehouses as $w) --}}
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            {{-- @endforeach --}}
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