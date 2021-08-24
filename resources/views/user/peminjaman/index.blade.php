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
            <li class="breadcrumb-item"><a href="{{route('user.dashboard.index')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Transaksi</li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
    
	@if ($message = Session::get('alert'))
	  <div class="alert alert-danger alert-block">
		<button type="button" class="close" data-dismiss="alert">×</button>	
		  <strong>{{ $message }}</strong>
	  </div>
	@endif
	@if ($message = Session::get('success'))
	  <div class="alert alert-success alert-block">
		<button type="button" class="close" data-dismiss="alert">×</button>	
		  <strong>{{ $message }}</strong>
	  </div>
	@endif
    
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
            <div class="d-flex align-items-center justify-content-between">
                <div class="div">
                  <h3 class="card-title">Transaksi</h3>
                </div>
                <div class="div">
                    <a href="#" data-target="#pinjam" data-toggle="modal" class="btn btn-primary"><i class="fas fa-plus"></i></a>
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
                            Jumlah Alat Dipinjam
                        </th>
                        <th style="width: 20%">
                            Dari Tanggal
                        </th>
                        <th style="width: 20%">
                            Sampai Tanggal
                        </th>
                        <th style="width: 20%">
                            Status Peminjaman
                        </th>
                        <th style="width: 20%">
                            Status Pengembalian
                        </th>
                        <th>Status Pembayaran</th>
                        <th>Konfirmasi Pembayaran</th>
                        <th style="width: 20%">
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaksi as $key => $transaksi)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{$transaksi->peminjaman()->count()}}</td>
                            <td>{{$transaksi->dari_tanggal}}</td>
                            <td>{{$transaksi->sampai_tanggal}}</td>
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
                            <td class="project-actions text-right">
                                <div class="d-flex d-inline justify-content-center align-items-center">
                                    @if($transaksi->status_pinjam == 'loan_approved')
                                        @if($transaksi->bukti_bayar != null)
                                            <div class="badge badge-success align-items-center" style="margin-top: 10px !important;">Pembayaran Berhasil</div>
                                        @else
                                        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#uploadBuktiBayar" data-id="{{ $transaksi->id }}">Upload Bukti Pembayaran</button>
                                        @endif
                                    @else
                                        Status Peminjaman Tidak Mendukung
                                    @endif
                                </div>
                            </td>
                            <td>
                                @if($transaksi->keterangan_pembayaran)
                                {{$transaksi->keterangan_pembayaran}}
                                @else
                                -
                                @endif
                            </td>
                            <td class="project-actions text-right">
                                <div class="d-flex d-inline">
                                    <a class="btn btn-primary btn-sm" href="{{route('user.peminjaman.show', $transaksi->id)}}">
                                        <i class="fas fa-eye">
                                        </i>
                                    </a>
                                    <a href="{{route('user.peminjaman.delete', $transaksi->id)}}" onclick="return confirm('Apa Anda yakin ?');" class="btn btn-danger ml-1"><i class="fas fa-trash"></i></a>                    
                                    <a href="#" data-toggle="modal" data-id="{{$transaksi->id}}" data-target="#printIndividu" class="btn btn-success ml-1"><i class="fas fa-print"></i></a>
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

<div class="modal fade" id="printIndividu" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('user.peminjaman.print-individu') }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="id">
                <div class="modal-header">
                    <h5 class="modal-title"><span>Print</span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tipe">Tipe</label>
                        <select name="tipe" id="tipe" class="custom-select" required>
                            <option value="">~ Pilih ~</option>
                            <option value="pinjam">Peminjaman</option>
                            <option value="kembali">Pengembalian</option>
                        </select>
                        @error('tipe')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="uploadBuktiBayar" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <form action="{{ route('user.peminjaman.upload') }}" method="POST" id="form" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="id">
                <div class="modal-header">
                    <h5 class="modal-title"><span>Upload Bukti Pembayaran</span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="bukti_bayar">Bukti Bayar</label>
                        <input type="file" class="form-control @error('bukti_bayar') is-invalid @enderror" id="bukti_bayar" name="bukti_bayar" required>
                        @error('bukti_bayar')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                Silahkan membayar biaya peralatan alat sebesar Rp 25.000. <br> 
                Pembayaran dapat di lakukan melalui
                Rek BRI 0409-01-028554-50-0
                Atau Dana 081338402976
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" id="pinjam" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ route('user.peminjaman.create') }}" method="POST" id="form" enctype="multipart/form-data">
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
                            <a href="#" class="btn btn-secondary btnAdd" id="btnAdd">
                            Add More
                            </a href="#" class="btn btn-secondary">
                            <a href="#" class="btn btn-secondary btnDel" id="btnDel">
                            Delete
                            </a href="#" class="btn btn-secondary">
                            <div id="testingDiv1" class="clonedInput">
                                <div class="row">
                                    <div class="col-4">
                                        <label for="alat_id">Nama Alat</label>
                                        <select name="alat_id[]" class="form-control" id="select">
                                            <option value="">~ Pilih Salah Satu ~</option>
                                            @foreach($alat as $alat)
                                            <option value="{{$alat->id}}">{{$alat->jenis->nama}} - {{$alat->nama}}</option>
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
                        <label for="dari_tanggal">Dari Tanggal</label>
                        <input type="date" class="form-control" id="dari_tanggal" name="dari_tanggal" required>
                    </div>
                    <div class="form-group">
                        <label for="sampai_tanggal">Sampai Tanggal</label>
                        <input type="date" class="form-control" id="sampai_tanggal" name="sampai_tanggal" required>
                    </div>
                    <div class="form-group">
                        <label for="instansi">Instansi</label>
                        <input type="text" disabled class="form-control" id="instansi" name="instansi" value="{{Auth::guard(session()->get('role'))->user()->instansi}}" required>
                    </div>
                    <div class="form-group">
                        <label for="nama">Guru Pembimbing</label>
                        <input type="text" disabled class="form-control" id="nama" name="nama" value="{{Auth::guard(session()->get('role'))->user()->nama}}" required>
                    </div>
                    <hr>
                    
                    <span class="text-bold">
                        <p>Maksimal peminjaman 1 minggu. ( Anda tidak dapat meminjam lebih dari 1 minggu )</p>
                        <p>Batas waktu pengembalian alat yaitu sesuai rentan waktu saat Anda melakukan peminjaman</p>
                        <p>Jika melebihi rentan waktu yang ditentukan maka Anda akan dikenakan denda Rp 2.000 per hari</p>
                        <p>Alat dapat di ambil di laboratorium kimia SMA N 1 Gadingrejo</p>
                    </span>
                </div>
                <div class="modal-footer">
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
    $('#print').on('show.bs.modal', (e) => {
        var id = $(e.relatedTarget).data('id');
        $('#print').find('input[name="id"]').val(id);
    });
    
    $('#uploadBuktiBayar').on('show.bs.modal', (e) => {
        var id = $(e.relatedTarget).data('id');
        console.log(id);
        $('#uploadBuktiBayar').find('input[name="id"]').val(id);
    });
    $(document).ready(function(){
        
        $('.btnAdd').click(function () {
            var num = $('.clonedInput').length, 
            newNum = new Number(num + 1), 
            newElem = $('#testingDiv' + num).html();
            var $block = $('.clonedInput:last');
            var theValue = $block.find(':selected').val();
            var clone = $block.html();
            var $select = clone;
            $('#testingDiv' + num).after(clone);
        });
        $('.btnDel').click(function () {
        $(".clonedInput").remove();
        $(".col-4").remove();
        });
    });
    
    $('#printIndividu').on('show.bs.modal', (e) => {
        var id = $(e.relatedTarget).data('id');
        $('#printIndividu').find('input[name="id"]').val(id);
    });
</script>
@endpush