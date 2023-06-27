<!-- Lưu tại resources/views/product/index.blade.php -->
@extends('layout.layout');
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">



    </div><!-- /.container-fluid -->
</section>

</section>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header alert alert-danger">
                <h5 class="modal-title" id="exampleModalLabel">Confirm Block</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <b> Are you sure block this account ?? </b>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                <a type="button" class="btn btn-danger action-delete-user">Block</a>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="exampleModal__restore" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header alert alert-warning">
                <h5 class="modal-title" id="exampleModalLabel">Confirm restore</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <b> Are you sure restore this account ?? </b>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                <a type="button" class="btn btn-warning action-restore-user">Restore</a>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->
<section class="content">
    <div class="row justify-content-md-center">
        <div class="col-12 ">
            <div class="card border  ">
                {{-- <div class="card-header">
                    <h3 class="card-title">........</h3>
                </div> --}}
                @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif
                <!-- /.card-header -->
                <div class="card-body   p-2">

                    <div class=" d-flex align-items-center mb-4">
                        <h1>List user</h1>
                    </div>

                    @if (session('deleted'))
                    <div class="alert alert-success">{{ session('deleted') }}</div>
                    {{session()->forget('deleted')}}
                    @endif

                    <table id="user__table" class="table table-striped table-bordered  border-2 border-dark display ">
                        <thead class="thead-dark ">
                            <tr>
                                <th>UserID</th>
                                <th>UserName</th>
                                <th>Email</th>
                                <th>Avatar</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user as $s)
                            <tr class="{{$s->block===1 ? 'bg-secondary' :'bg-white'}} ">
                                <td>{{ $s->id }}</td>
                                <td>{{ $s->name }}</td>
                                <td>{{ $s->email }}</td>
                                <td><img width="50px" src="{{$s->avatar}}"></td>
                                <td>{{ $s->manage=== 0 ? 'Customer' :($s->manage=== 1 ?'Staff' :'Manager') }}</td>
                                <td>
                                    <a class="btn btn-primary btn-sm mr-2" href="{{ url('user/view/' . $s->id) }}">
                                        <i class="fas fa-folder"></i> View
                                    </a>
                                    <a class="btn btn-info btn-sm mr-2" href="{{ url('user/edit/'.$s->id) }}">
                                        <i class="fas fa-pencil-alt"></i> Edit
                                    </a>

                                    @if($s->manage!=2)
                                    @if($s->block===0)
                                    <button type="button" class="btn btn-danger btn-sm btn_delete_user" data-toggle="modal" data-target="#exampleModal" data="{{ $s->id }}">
                                        <i class="fas fa-trash"></i> block
                                    </button>
                                    @endif

                                    @if($s->block===1)
                                    <button type="button" class="btn btn-warning btn-sm btn_restore_user" data-toggle="modal" data-target="#exampleModal__restore" data="{{ $s->id }}">
                                        <i class="fa-solid fa-recycle"></i> restore
                                    </button>
                                    @endif
                                    @endif
                                </td>
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
    <!-- /.row -->
</section>
@section('script-content')
<script>
    $(function() {
        $('#user').DataTable({});
    });
</script>

@endsection
@endsection