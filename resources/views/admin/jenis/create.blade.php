@extends('layouts.main')
@section('content')
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0 text-dark">Tambah</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard.index')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{route('admin.jenis.index')}}">Jenis Alat</a></li>
            <li class="breadcrumb-item active">Tambah </li>
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
              <h3 class="card-title">Tambah Jenis Alat</h3>
            </div>
            <form action="{{route('admin.jenis.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" id="nama" name="nama" class="form-control">
                </div>
                <div class="form-group">
                    <label for="photo">Foto <small>*optional</small></label>
                    <input type="file" id="photo" name="photo" class="form-control">
                </div>
                <div class="form-group">
                  <button class="btn btn-primary" type="submit">Simpan</button>
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