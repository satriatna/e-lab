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
            <li class="breadcrumb-item"><a href="{{route('admin.alat.index')}}">Alat</a></li>
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
              <h3 class="card-title">Tambah Alat </h3>
            </div>
            <form action="{{route('admin.alat.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="jenis_id" value="{{$jenisId}}">
                <div class="card-body">
                <div class="form-group">
                    <label for="kode">Kode</label>
                    <input type="text" id="kode" name="kode" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" id="name" name="nama" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="stok">Stok</label>
                    <input type="number" id="stok" name="stok" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="harga">Harga</label>
                    <input type="number" id="harga" name="harga" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="jenis">Jenis</label>
                    <input type="text" disabled id="jenis" name="jenis" value="{{DB::table('jenis')->where('id',$jenisId)->first()->nama}}" class="form-control" required>
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