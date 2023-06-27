@extends('layout.layout')
@section('title', 'Edit Product')
@section('content')
<br>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="offset-md-3 col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Product</h3>
                        </div>
                        {{-- check error --}}
                        @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error')}}
                        </div>
                        @endif
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" action="{{ url('warehouse/postEdit') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="card-body">
                            <div class="form-group">
                                    <label for="txt-name">ID</label>
                                    <input type="text" class="form-control" name="ingredientid" value="{{$warehouses->ingredientcode}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="txt-name">Material name</label>
                                    <input type="text" class="form-control" id="txt-name" name="name" value="{{$warehouses->name}}">
                                </div>
                                <div class="form-group">
                                    <label for="txt-quantity">Quantity</label>
                                    <input type="text" class="form-control" id="txt-quantity" name="quantity" value="{{$warehouses->mass}}">
                                </div>
                                <div class="form-group">
                                    <label for="txt-update">Quantity</label>
                                    <input type="datetime-local" class="form-control" id="txt-update" name="updated_at" value="{{$warehouses->updated_at}}">
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Edit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script-content')
<script>
    ClassicEditor
        .create( document.querySelector( '.ck-editor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
@endsection
