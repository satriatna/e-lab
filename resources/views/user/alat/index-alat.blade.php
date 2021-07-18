@extends('layouts.main')
@section('content')
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0 text-dark">Alat</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('user.dashboard.index')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Alat</li>
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
                  <h3 class="card-title">Alat -  Jenis ( {{ DB::table('jenis')->where('id',$jenisId)->first()->nama }} )</h3>
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
                            Kode
                        </th>
                        <th style="width: 20%">
                            Nama Alat
                        </th>
                        <th style="width: 20%">
                            Harga
                        </th>
                        <th style="width: 20%">
                            Stok
                        </th>
                        <th style="width: 20%">
                            Foto
                        </th>
                        <th style="width: 20%">
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($alat as $key => $alat)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{$alat->kode}}</td>
                            <td>{{$alat->nama}}</td>
                            <td>{{$alat->harga }}</td>
                            <td>{{$alat->stok }}</td>
                            <td>
                                @if($alat->photo != null)
                                <img src="{{url('images/'. $alat->photo)}}" style="height:70px;width:70px;">
                                @endif
                            </td>
                            <td class="project-actions text-right">
                                <div class="d-flex d-inline">
                                    <a class="btn btn-primary btn-sm" href="{{route('user.alat.show', $alat->id)}}">
                                        <i class="fas fa-folder">
                                        </i>
                                    </a>
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
@push('scripts')
<script>
    $('#checkInOut').on('show.bs.modal', (e) => {
        var id = $(e.relatedTarget).data('id');
        var nama = $(e.relatedTarget).data('nama');
        var stok = $(e.relatedTarget).data('stok');
        var jenis = $(e.relatedTarget).data('jenis');

        $('#checkInOut').find('input[name="id"]').val(id);
        $('#checkInOut').find('input[name="nama"]').val(nama);
        $('#checkInOut').find('input[name="stok"]').val(stok);
        $('#checkInOut').find('input[name="jenis"]').val(jenis);
    });
</script>
<script type="text/javascript">
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div><input type="text" name="field_name[]" value=""/><a href="javascript:void(0);" class="remove_button"><img src="remove-icon.png"/></a></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});
</script>
@endpush