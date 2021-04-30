@extends('layouts.main')
@section('content')
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0 text-dark">Jenis Alat</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard.index')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Jenis Alat</li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
    @if(session()->get('success'))
    <div class="alert alert-success alert-dismissible show fade">
        <div class="alert-body">
        <button class="close" data-dismiss="alert">
            <span>&times;</span>
        </button>
        {{session()->get('success')}}
        </div>
    </div>
    @endif
    
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
            <div class="d-flex align-items-center justify-content-between">
                <div class="div">
                  <h3 class="card-title">Jenis Alat</h3>
                </div>
                <div class="div">
                    <a href="{{route('admin.jenis.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
                </div>
            </div>

            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th style="width: 1%">
                            #
                        </th>
                        <th style="width: 20%">
                            Nama
                        </th>
                        <th style="width: 20%">
                            Foto
                        </th>
                        <th style="width: 20%">
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jenis as $key => $jenis)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{$jenis->nama}}</td>
                            <td>
                            @if($jenis->photo != null)
                            <img src="{{url('images/'. $jenis->photo)}}" style="height:70px;width:70px;">
                            @endif
                            <td class="project-actions text-right">
                                <div class="d-flex d-inline">
                                    <a class="btn btn-primary btn-sm" href="{{route('admin.jenis.show', $jenis->id)}}">
                                        <i class="fas fa-folder">
                                        </i>
                                    </a>
                                    <a class="ml-1  btn btn-info btn-sm" href="{{route('admin.jenis.edit', $jenis->id)}}">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                    </a>
                                    <form action="{{route('admin.jenis.delete', $jenis->id)}}" id="delete" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Apa Anda yakin ?');" type="submit" class="btn btn-danger ml-1"><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        </div>
    <!-- /.card -->
    </section>
</div>
@endsection