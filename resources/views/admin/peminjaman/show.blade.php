@extends('layouts.main')
@section('content')
<style>
.hilang{
  display: none;
}
</style>
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0 text-dark">Detail Transaksi</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('user.dashboard.index')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{route('user.peminjaman.index')}}">Transaksi</a></li>
            <li class="breadcrumb-item active">Detail Transaksi</li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
    
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              Detail Transaksi
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Detail Pinjam</h3>
            </div>
            <div class="card-body">
              <table class="table">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Nama Alat</th>
                  <th>Jumlah</th>
                  <th>Keterangan</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($peminjaman->get() as $key => $pinjam)
                  <tr>
                    <td>{{++$key}}</td>
                    <td>{{$pinjam->alat->nama}}</td>
                    <td>{{$pinjam->jumlah}}</td>
                    <td>{{$pinjam->keterangan}}</td>
                  </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="3">Status</td>
                    <td>
                     
                      @if($peminjaman->first()->transaksi->status_pinjam == 'loan_pending')
                        Peminjaman Diproses
                      @elseif($peminjaman->first()->transaksi->status_pinjam == 'loan_dismiss')
                        Peminjaman Ditolak
                      @elseif($peminjaman->first()->transaksi->status_pinjam == 'loan_approved')
                        Peminjaman Diterima
                      @endif
                    </td>
                  </tr>
                  <tr>
                    <td colspan="3">Pengelola Lab</td>
                    <td>{{$adminPinjam->first()->admin->nama ?? 'Belum Di Konfirmasi'}}</td>
                  </tr>
                </tfoot>

              </table>
            </div>
            </form>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        @if(count($pengembalian->get()) > 0)
        @else
        <div class="card">
          <div class="card-header">
            Konfirmasi
          </div>
            <div class="card-body">
              <form action="{{route('admin.peminjaman.konfirmasi')}}" method="POST">
                @csrf
                <input type="hidden" name="transaksi_id" value="{{$transaksi->id}}">
                <div class="form-group">
                  <label for="status">Status</label>
                  <select name="status" id="status" class="custom-select" required>
                    <option value="loan_approved">Terima</option>
                    <option value="loan_dismiss">Tolak</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="keterangan">Keterangan</label>
                  <textarea name="keterangan" id="keterangan" rows="1" class="form-control" required></textarea>
                </div>
                <button class="btn btn-primary">Kirim</button>
              </form>
            </div>
          </div>
       @endif
       </div>
        @if(count($pengembalian->get()) == 0)
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              Belum Dikembalikan
            </div>
          </div>
        </div>
        @else
        <div class="col-md-6">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Detail Pengembalian</h3>
            </div>
            <div class="card-body">
              <table class="table">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Nama Alat</th>
                  <th>Jumlah</th>
                  <th>Keterangan</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($pengembalian->get() as $key => $kembali)
                  <tr>
                    <td>{{++$key}}</td>
                    <td>{{$kembali->alat->nama}}</td>
                    <td>{{$kembali->jumlah}}</td>
                    <td>{{$kembali->keterangan}}</td>
                  </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="3">Status</td>
                    <td>
                   
                      @if($pengembalian->first()->transaksi->status == 'return_pending')
                        Pengembalian Diproses
                      @elseif($pengembalian->first()->transaksi->status == 'return_approved')
                        Pengembalian Diterima
                      @elseif($pengembalian->first()->transaksi->status == 'return_dismiss')
                        Pengembalian Ditolak
                      @endif
                      
                    </td>
                  </tr>
                  <tr>
                    <td colspan="3">Hari / Tanggal</td>
                    <td>
                      {{
                        date('l / m-d-Y', strtotime($pengembalian->first()->created_at))
                      }}
                    </td>
                  </tr>
                  <tr>
                    <td colspan="3">No HP</td>
                    <td>
                      {{ $pengembalian->first()->transaksi->user->guru_pembimbing  }}
                    </td>
                  </tr>
                  <tr>
                    <td colspan="3">Instansi</td>
                    <td>
                      {{ $pengembalian->first()->transaksi->user->instansi  }}
                    </td>
                  </tr>
                  <tr>
                    <td colspan="3">Guru Pembimbing</td>
                    <td>
                      {{ $pengembalian->first()->transaksi->user->nama  }}
                    </td>
                  </tr>
                </tfoot>

              </table>
            </div>
            </form>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
          
        <div class="card">
          <div class="card-header">
              Konfirmasi
          </div>
          <div class="card-body">
            <form action="{{route('admin.pengembalian.konfirmasi')}}" method="POST">
              @csrf
              <input type="hidden" name="transaksi_id" value="{{$transaksi->id}}">
              <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="custom-select" required>
                  <option value="return_approved">Terima</option>
                  <option value="return_dismiss">Tolak</option>
                </select>
              </div>
              <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <textarea name="keterangan" id="keterangan" rows="1" class="form-control" required></textarea>
              </div>
              <button class="btn btn-primary">Kirim</button>
            </form>
          </div>
        </div>
        @endif
      </div>
    </section>
</div>
@endsection
@push('scripts')
<script>
  $("#kembalikan").click(function(){
      $(".hilang").show();
  });
  </script>
@endpush
