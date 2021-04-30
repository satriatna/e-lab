@extends('layouts.main')
@section('content')
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0 text-dark">Ubah</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard.index')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{route('admin.jenis.index')}}">Jenis Alat</a></li>
            <li class="breadcrumb-item active">Ubah</li>
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
              <h3 class="card-title">Ubah Jenis Alat</h3>
            </div>
            <form action="{{route('admin.jenis.update')}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{$jenis->id}}">
                <div class="card-body">
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" id="name" name="nama" value="{{$jenis->nama}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="photo">Foto <small>*optional</small></label>
                    <input type="file" id="photo" name="photo" class="form-control">
                </div>
                <div class="form-group">
                    <input type="submit" value="Simpan" class="btn btn-primary">
                </div>
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