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
            <li class="breadcrumb-item"><a href="{{route('admin.alat.index')}}">Alat</a></li>
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
              <h3 class="card-title">Detail Alat</h3>
            </div>
                <div class="card-body">
                <div class="form-group">
                    <label for="kode">Nama</label>
                    <input type="text" id="kode" name="kode" value="{{$alat->kode}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" id="nama" name="nama" value="{{$alat->nama}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="stok">Stok</label>
                    <input type="number" id="stok" name="stok" value="{{$alat->stok}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="jenis_id">Jenis Alat</label>
                    <input type="text" id="jenis_id" name="jenis_id" value="{{$alat->jenis->nama}}" class="form-control">
                </div>
                @if($alat->photo == null)
                Tidak ada foto
                @else
                <div class="form-group">
                    <label for="photo">Foto </label>
                    <img style="height: 200px;" src="{{url('images/'.$alat->photo)}}" type="file" id="photo" name="photo" class="form-control">
                </div>
                @endif
                </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
    </section>
</div>
@endsection