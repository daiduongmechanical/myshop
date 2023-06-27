@extends('layout.layout')
@section('title', 'Reset Password')
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="offset-md-2 col-md-8 mt-5">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Update User Information</h3>
                    </div>
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif
                    @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('user/postEdit') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="card-body">

                            <!-- input id  field -->
                            <div class="input-group mb-4 ">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-default"><b style="width:100px">User ID</b></span>
                                </div>
                                <input type="text" value="{{ $user->id }}" name="id" readonly class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-default">
                            </div>


                            <!-- input name  field -->
                            <div class="input-group mb-4 ">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-default"><b style="width:100px">Name</b></span>
                                </div>
                                <input type="text" name="name" readonly value="{{ $user->name }}" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-default">
                            </div>


                            <!-- input email  field -->
                            <div class="input-group mb-4 ">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-sm"><b style="width:100px">Email</b></span>
                                </div>
                                <input type="email" name="email" readonly value="{{ $user->email }}" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                            </div>


                            <div class="input-group mb-4 ">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01"><b style="width:100px">Role</b></label>
                                </div>
                                <select class="custom-select" name="manage" id="inputGroupSelect01">
                                    <option value="0" {{ $user->manage=== 0 ?'selected':'' }}>Customer</option>
                                    <option value="1" {{ $user->manage=== 1 ?'selected':'' }}>Staff</option>

                                </select>
                            </div>





                            <div class=" input-group mb-4 ">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-default"><b style="width:100px">create Date</b></span>
                                </div>
                                <input readonly type="text" name="created" value="{{ $user->created_at }}" readonly class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-default">
                            </div>


                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>
@endsection