@extends('layout.layout')
@section('title', 'Create Product')
@section('content')

<br>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="offset-md-3 col-md-6">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Create Material</h3>
                    </div>
                    {{-- check error --}}
                    @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error')}}
                    </div>
                    @endif
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('warehouse/postCreate') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="card-body">
                            <div class="form-group">
                                <label for="txt-ingredientcode">ID</label>
                                <input required type="text" class="form-control" id="txt-ingredientcode" name="ingredientcode">
                            </div>
                            <div class="form-group">
                                <label for="txt-name">Material name</label>
                                <input required type="text" class="form-control" id="txt-name" name="name">
                            </div>
                            <div class="form-group">
                                <label for="txt-quantity">Quantity</label>
                                <input required type="number" class="form-control" id="txt-quantity" name="mass">
                            </div>

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
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
        .create(document.querySelector('.ck-editor'))
        .catch(error => {
            console.error(error);
        });
</script>
@endsection