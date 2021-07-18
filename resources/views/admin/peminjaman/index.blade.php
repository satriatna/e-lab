@extends('layouts.main')
@section('content')
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0 text-dark">Transaksi</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard.index')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Transaksi</li>
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
                  <h3 class="card-title">Peminjaman</h3>
                </div>
                <div class="div">
                    <a href="#" data-target="#print" data-toggle="modal" class="btn btn-success"><i class="fas fa-print"></i></a>
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
                        Jumlah Alat
                        </th>
                        <th style="width: 20%">
                            Status Pinjaman
                        </th>
                        <th style="width: 20%">
                            Status Pengembalian
                        </th>
                        <th style="width: 20%">
                            Bukti Pembayaran
                        </th>
                        <th style="width: 20%">
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaksi as $key => $transaksi)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{$transaksi->peminjaman()->count()}}</td>
                            <td>
                                @if($transaksi->status_pinjam == 'loan_pending')
                                    Peminjaman Diproses
                                @elseif($transaksi->status_pinjam == 'loan_dismiss')
                                    Peminjaman Ditolak
                                @elseif($transaksi->status_pinjam == 'loan_approved')
                                    Peminjaman Diterima
                                @endif
                            </td>
                            
                            <td>
                                @if($transaksi->status == 'return_pending')
                                    Pengembalian Diproses
                                @elseif($transaksi->status == 'return_dismiss')
                                    Pengembalian Ditolak
                                @elseif($transaksi->status == 'return_approved')
                                    Pengembalian Diterima
                                @endif
                            </td>
                            <td>
                                <a target="_blank" href="{{url('images/bukti-pembayaran/'. $transaksi->bukti_bayar)}}"><img src="{{url('images/bukti-pembayaran/'. $transaksi->bukti_bayar)}}" style="height:70px;width:70px;"></a>
                            </td>
                            <td class="project-actions text-right">
                                <div class="d-flex d-inline">
                                    <a class="btn btn-primary btn-sm" href="{{route('admin.peminjaman.show', $transaksi->id)}}">
                                        <i class="fas fa-eye">
                                        </i>
                                    </a>
                                    <form action="{{route('admin.peminjaman.delete', $transaksi->id)}}" id="delete" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Apa Anda yakin ?');" class="btn btn-danger ml-1"><i class="fas fa-trash"></i></button>
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

<div class="modal fade bd-example-modal-lg" id="pinjam" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ route('user.peminjaman.create') }}" method="POST" id="form">
                @csrf
                <input type="hidden" value="{{Auth::guard(session()->get('role'))->user()->id}}" name="user_id">
                <div class="modal-header">
                    <h5 class="modal-title">Isi Form Peminjaman</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="field_wrapper">
                        <div class="form-group">
                            <button id="btnAdd">
                            Add More
                            </button>
                            <button id="btnDel">
                            Delete
                            </button>
                            <div id="testingDiv1" class="clonedInput">
                                <div class="row">
                                    <div class="col-4">
                                        <label for="alat_id">Nama Alat</label>
                                        <select name="alat_id[]" class="form-control" id="select">
                                            <option value="">~ Pilih Salah Satu ~</option>
                                            @foreach($alat as $alat)
                                            <option value="{{$alat->id}}">{{$alat->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <label for="jumlah">Jumlah</label>
                                        <input type="number" name="jumlah[] " class="form-control">
                                    </div>
                                    <div class="col-4">
                                        <label for="keterangan">Keterangan</label>
                                        <input type="text" name="keterangan[] " class="form-control">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="created_at">Hari / Tanggal</label>
                        <input type="datetime-local" class="form-control" id="created_at" name="created_at" required>
                    </div>
                    <div class="form-group">
                        <label for="instansi">Instansi</label>
                        <input type="text" disabled class="form-control" id="instansi" name="instansi" value="{{Auth::guard(session()->get('role'))->user()->instansi}}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" id="print" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{route('user.peminjaman.pdf',)}}" method="POST" id="form">
                @csrf
                <input type="hidden" name="id">
                <div class="modal-header">
                    <h5 class="modal-title">Cetak PDF Data Transaksi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="dari">Dari Tanggal</label>
                        <input type="date" class="form-control" id="dari" name="dari" required>
                    </div>
                    <div class="form-group">
                        <label for="ke">Ke Tanggal</label>
                        <input type="date" class="form-control" id="ke" name="ke" required>
                    </div>
                    <div class="form-group">
                        <label for="tipe">Tipe</label>
                        <select name="tipe" id="tipe" class="custom-select" required>
                            <option value=""> ~ Pilih ~</option>
                            <option value="pinjam"> Peminjaman </option>
                            <option value="keluar"> Pengembalian </option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
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
	
    $('#btnAdd').click(function () {
          var num = $('.clonedInput').length, 
              newNum = new Number(num + 1), 
              newElem = $('#testingDiv' + num).clone().attr('id', 'testingDiv' + newNum).fadeIn('normal'); 
  // Store the block in a variable
      var $block = $('.clonedInput:last');
  
          // Grab the selected value
      var theValue = $block.find(':selected').val();
  
          // Clone the block 
      var clone = $block.clone();
  
          // Find the selected value in the clone, and remove
      if(theValue !="PleaseSelectOne")
      clone.find('option[value=' + theValue + ']').remove();
  // Grab the select in the clone
  var $select = clone.find('select');
  var newId="testingDiv"+newNum;
  console.log(newId);
      // Update its ID by concatenating theValue to the current ID
  $select.parent().attr('id', newId);
              
           $('#testingDiv' + num).after(clone);
          $('#btnDel').attr('disabled', false);
          if (newNum == 5) $('#btnAdd').attr('disabled', true).prop('value', "You've reached the limit");
        });
        $('#btnDel').click(function () {
  
  
            var num = $('.clonedInput').length;
  
              $('#testingDiv' + num).slideUp('slow', function () {
                $(this).remove();
  
                  if (num - 1 === 1) $('#btnDel').attr('disabled', true);
  
                  $('#btnAdd').attr('disabled', false).prop('value', "ADD MORE");
                });
  
            return false;
  
          $('#btnAdd').attr('disabled', false);
        });
        $('#btnDel').attr('disabled', true);
  });
  
</script>
@endpush