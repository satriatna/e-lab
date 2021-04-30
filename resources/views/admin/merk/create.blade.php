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
            <li class="breadcrumb-item"><a href="{{route('admin.merk.index')}}">Merek Barang</a></li>
            <li class="breadcrumb-item active">Tambah</li>
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
              <h3 class="card-title">Tambah Merek</h3>
            </div>
            <form action="{{route('admin.merk.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                <div class="form-group">
                    <label for="name">Nama Merk</label>
                    <input type="text" id="name" name="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="description">Deskripsi</label>
                    <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
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