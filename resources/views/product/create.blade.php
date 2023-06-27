<!-- Lưu tại resources/views/product/index.blade.php -->
@extends('layout.layout');
@section('content')
<!-- Content Header (Page header) -->




@if (isset($error))
<div class="alert alert-danger">{{$error}}</div>

@endif



<form style="width: 100%" class=" p-2 " method="post" enctype="multipart/form-data" action="{{ route('product.newDish') }}">
    @csrf
    <!-- Main content -->
    <section class="content card  p-2 ">
        <div class="col-sm-6 d-flex align-items-center">
            <h2>ADD DISH</h2>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="card border border-warning p-3 " style="width: 100% ">
                    <div class=" field_wrapper">
                        <div class="d-flex mb-2">

                            <select required name="materialname[]" class="border border-primary mb-1 mr-2 " style="width: 65%">
                                @foreach ($material as $m)
                                <option value="{{$m->ingredientcode}}">{{$m->name}} - {{$m->ingredientcode}}</option>
                                @endforeach
                            </select>
                            <input required class="border border-primary mb-1 " type="number" style="width: 35%" name="materialmass[]" placeholder="mass">
                        </div>

                    </div>
                    @if(isset($material))
                    <a class="btn btn-success add-more" data="{{$material}}">+ Add More</a>
                    @endif
                </div>
            </div>
            <div class="col-6">
                <div class=" border border-warning p-3 d-flex flex-column" style="width: 100%; height:44vh">
                    <input required style="height: 35px" class="border border-primary mb-4 mt-1" type="text" name="dishname" placeholder=" Enter name of dish">
                    <input required style="height: 35px" class="border border-primary mb-4" type="number" name="dishprice" placeholder="Enter price of dish">
                    <select required style="height: 35px" class="border border-primary mb-4 mt-1" name='type'>
                        <option value="tiramisu">tiramisu</option>
                        <option value="donut">donut</option>
                        <option value="cup cake">cup cake</option>
                        <option value="roll cake">roll cake</option>
                        <option class="new__dish--option"> new type</option>
                    </select>
                    <textarea required style="height: 150px" class="border border-primary mb-1" name="description"></textarea>

                </div>
            </div>
        </div>

        <div class="row mt-2">

            <div class="col-4" style="width: 100%; height:200px">
                <input required class="border border-warning  position-relative image-new-dish" multiple style="width: 100%; height:100%; color:transparent ; z-index:10" type="file" name="dishimg[]">
                <div style="width: 100%; height:100% ;bottom:200px ; background-color:transparent;z-index:5 " class="d-flex position-relative">
                    <span style="margin: auto ">select or drag file</span>
                </div>
            </div>
            <div class="col-8">
                <div style="width: 100%; height:200px; overflow-y:scroll" class="border border-warning d-flex  p-3" id="image-preview-container">
                    <span class=" my-auto mx-auto" style="font-size: 20px;">Preview images</span>
                </div>

            </div>

        </div>
        <!-- /.row -->
        <div style="width: 100%" class="d-flex justify-content-end mt-2">

            <input type="submit" name='add-new-dish' class="btn btn-danger" value='Add New Dish'>
        </div>

    </section>


</form>

{{-- @section('script-content');
    <script>
        $(function () {
            $('#product').DataTable();
        });
    </script> --}}

@endsection