@extends('layouts.main')
@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard.index')}}">Dashboard</a></li>
            </ol>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                <h3>{{$user}}</h3>

                <p> User</p>
                </div>
                <div class="icon">
                <i class="fas fa-user"></i>
                </div>
                <a href="{{route('admin.user.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                <h3>{{$alat}}</h3>

                <p>Alat</p>
                </div>
                <div class="icon">
                <i class="fas fa-tasks"></i>
                </div>
                <a href="{{route('admin.alat.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                <h3>{{$jenis}}</h3>

                <p>Jenis Alat</p>
                </div>
                <div class="icon">
                <i class="fas fa-folder-open"></i>
                </div>
                <a href="{{route('admin.jenis.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                <h3>{{$transaksi}}</h3>

                <p>Transaksi</p>
                </div>
                <div class="icon">
                <i class="ion ion-bag"></i>
                </div>
                <a href="{{route('admin.transaksi.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
</div>


@endsection