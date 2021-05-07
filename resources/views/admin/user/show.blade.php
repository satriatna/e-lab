@extends('layouts.main')
@section('content')
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0 text-dark">Detail</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard.index')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{route('admin.user.index')}}">User</a></li>
            <li class="breadcrumb-item active">Detail</li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
    
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-6">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Detail User</h3>
            </div>
            <form action="{{route('admin.user.update')}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{$user->id}}">
                <div class="card-body">
                <div class="form-group">
                    <label for="nip">NIP</label>
                    <input type="number" id="nip" name="nip" value="{{$user->nip}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="nama">Guru Pembimbing</label>
                    <input type="text" id="nama" name="nama" value="{{$user->nama}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" value="{{$user->username}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="instansi">Instansi </label>
                    <input type="text" id="instansi" name="instansi" value="{{$user->instansi}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="guru_pembimbing">No HP </label>
                    <input type="text" id="guru_pembimbing" name="guru_pembimbing" value="{{$user->guru_pembimbing}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat </label>
                    <textare id="alamat" name="alamat" class="form-control">{{$user->alamat}}</textarea>
                </div>
            </form>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
    </section>
</div>
@endsection