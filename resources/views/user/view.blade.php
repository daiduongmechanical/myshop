@extends('layout.layout')
@section('title', 'View User')
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="offset-md-2 col-md-8 mt-5">
                <!-- general form elements -->
                <div class="card card-primary mb-2 mt-2">
                    <div class="card-header">
                        <h3 class="card-title">User Over View</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <section class="content">
                        <div class="d-flex ">
                            <div class="m-2 mr-5">
                                <img src="{{ $user->avatar }}" alt="error" width="150px" height="200px">
                            </div>
                            <div class=>
                                <div class="form-group">
                                    UserId: <b>{{ $user->id }} </b>
                                </div>
                                <div class="form-group">
                                    UserName: <b>{{ $user->name }} </b>
                                </div>
                                <div class="form-group">
                                    Email: <b>{{ $user->email }} </b>
                                </div>
                                <div class="form-group">
                                    CreatedDate: <b>{{ $user->created_at }} </b>
                                </div>

                                <div class="form-group">
                                    Phone Number : <b>{{ $user->phone }} </b>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="input-group mb-4 ml-5" style="width: 86%">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default"><b style="width:100px">Total Order:</b></span>
                            </div>
                            <input type="text" value="{{ count($order)}}" name="id" readonly class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-default">
                        </div>
                        <div class="input-group mb-4 ml-5" style="width: 86%">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default"><b style="width:100px">Total Spend: </b></span>
                            </div>
                            <input type="text" value="{{ $sum }}$ " name="id" readonly class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-default">
                        </div>
                        <div class="input-group mb-4 ml-5" style="width: 86%">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default"><b style="width:100px">Total Rate: </b></span>
                            </div>
                            <input type="text" value="{{ count($rate) }}" name="id" readonly class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-default">
                        </div>
                        <div class="input-group mb-4 ml-5" style="width: 86%">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default"><b style="width:100px">Favarious:</b></span>
                            </div>
                            <input type="text" value="{{$view===null?'': $view->dishname }}" name="id" readonly class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-default">
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection