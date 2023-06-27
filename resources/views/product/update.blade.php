<!-- Lưu tại resources/views/product/index.blade.php -->
@extends('layout.layout');
@section('content')
<!-- Content Header (Page header) -->





<form style="width: 100%" id='form__updatedish' class=" p-2 " method="post" enctype="multipart/form-data" action="{{ route('product.update-data') }}">
    @csrf
    <!-- Main content -->
    <section class="content card  p-2 ">
        <div class="col-sm-6 d-flex align-items-center">
            <h2>UPDATE DISH</h2>
        </div>
        @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        {{session()->forget('success')}}
        @endif
        <div class="row">

            <div class="col-6">
                <div class="card border border-warning p-3 " style="width: 100% ">
                    <div class=" field_wrapper">
                        @foreach($product->ingredients as $i)
                        <div class="d-flex mb-2">
                            <select required name="materialname[]" class="border border-primary mb-1 mr-2 " style="width: 65%">
                                @foreach ($material as $m)
                                <option @if($i->ingredientcode==$m->ingredientcode) selected @endif

                                    value="{{$m->ingredientcode}}">{{$m->name}} - {{$m->ingredientcode}}</option>
                                @endforeach
                            </select>
                            <input value="{{$i->mass}}" class="border border-primary mb-1 " type="number" style="width: 35%" name="materialmass[]" placeholder="mass">
                        </div>
                        @endforeach

                    </div>
                    <a class="btn btn-success add-more" data="{{$material}}">+ Add More</a>
                </div>
            </div>
            <div class="col-6">
                <div class=" border border-warning p-3 d-flex flex-column" style="width: 100%; height:44vh">
                    <input required value="{{ $product->dishid}}" readonly style="height: 35px" class="border border-primary mb-3 mt-1" type="text" name="dishid" placeholder=" Enter name of dish">
                    <input required value="{{ $product->dishname}}" style="height: 35px" class="border border-primary mb-3 mt-1" type="text" name="dishname" placeholder=" Enter name of dish">
                    <input required value="{{ $product->dishprice}}" style="height: 35px" class="border border-primary mb-3" type="number" name="dishprice" placeholder="Enter price of dish">


                    <select style="height: 35px" class="border border-primary mb-4 mt-1" name='type'>
                        <option @if($product->type==='tiramisu') selected @endif value="tiramisu">tiramisu</option>
                        <option @if($product->type==='donut') selected @endif value="donut">donut</option>
                        <option @if($product->type==='cup cake') selected @endif value="cup cake">cup cake</option>
                        <option @if($product->type==='roll cake') selected @endif value="roll cake">roll cake</option>
                        <option class="new__dish--option"> new type</option>
                    </select>
                    <textarea style="height: 150px" class="border border-primary mb-1" name="description"> {{ $product->description}}</textarea>

                </div>
            </div>
        </div>

        <div class="row mt-2">

            <div class="col-4" style="width: 100%; height:200px">
                <input class="border border-warning  position-relative image-update-dish" multiple style="width: 100%; height:100%; color:transparent ; z-index:10" type="file" name="dishimg[]">
                <div style="width: 100%; height:100% ;bottom:200px ; background-color:transparent;z-index:5 " class="d-flex position-relative">
                    <span style="margin: auto ">select or drag file</span>
                </div>
            </div>
            <div class="col-8">
                <div style="width: 100%; height:200px; overflow-y:scroll" class="border border-warning d-flex  p-3" id="image-preview-container">
                    @foreach($product->dishimages as $i)
                    <div style="height:90% ; aspect-ratio:1/1">
                        <img style="height:90% ; aspect-ratio:1/1" id="{{$i->id}}" class="mr-2 image-dish-update" src="{{$i->imageurl}}" alt="{{$i->id}}">
                        <button style="width:90%" class="btn btn-danger btn__delete--imagedish" id="{{$i->id}}">Delete</button>
                    </div>
                    @endforeach
                </div>

            </div>

        </div>
        <!-- /.row -->
        <div style="width: 100%" class="d-flex justify-content-end mt-2">

            <input type="submit" name='add-new-dish' class="btn btn-danger" value='Update this dish'>
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