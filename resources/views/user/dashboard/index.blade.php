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
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            </ol>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-4 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                <h3>{{$alat}}</h3>

                <p>Alat</p>
                </div>
                <div class="icon">
                <i class="fas fa-tasks"></i>
                </div>
                <a href="#" class="small-box-footer">Just info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-4 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                <h3>{{$jenis}}</h3>

                <p>Jenis Alat</p>
                </div>
                <div class="icon">
                <i class="fas fa-folder-open"></i>
                </div>
                <a href="#" class="small-box-footer">Just info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
</div>


@endsection