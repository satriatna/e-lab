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
            <li class="breadcrumb-item"><a href="{{route('user.peminjaman.index')}}">User</a></li>
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
                      @if($adminPinjam->transaksi->status_pinjam == 'loan_pending')
                        Peminjaman Diproses
                      @elseif($adminPinjam->transaksi->status_pinjam == 'loan_dismiss')
                        Peminjaman Ditolak
                      @elseif($adminPinjam->transaksi->status_pinjam == 'loan_approved')
                        Peminjaman Diterima
                      @endif
                    </td>
                  </tr>
                  <tr>
                      <td colspan="3">Dari Tanggal</td>
                      <td>
                        {{ $transaksi->dari_tanggal  }}
                      </td>
                  </tr>
                  <tr>
                      <td colspan="3">Sampai Tanggal</td>
                      <td>
                        {{ $transaksi->sampai_tanggal  }}
                      </td>
                  </tr>
                  <tr>
                      <td colspan="3">Tanggal Dikembalikan</td>
                      <td>
                        {{ $transaksi->tanggal_dikembalikan ?? '-'  }}
                      </td>
                  </tr>
                  <tr>
                    <td colspan="3">No HP</td>
                    <td>
                      {{ $adminPinjam->first()->transaksi->user->guru_pembimbing  }}
                    </td>
                  </tr>
                  <tr>
                    <td colspan="3">Instansi</td>
                    <td>
                      {{ $adminPinjam->first()->transaksi->user->instansi  }}
                    </td>
                  </tr>
                  <tr>
                    <td colspan="3">Guru Pembimbing</td>
                    <td>
                      {{ $adminPinjam->first()->transaksi->user->nama  }}
                    </td>
                  </tr>
                  <tr>
                    <td colspan="3">Pengelola Lab</td>
                    <td>{{$adminPinjam->first()->admin->nama ?? 'Belum Di Konfirmasi'}}</td>
                  </tr>
                </tfoot>

              </table>
            </div>
            <!-- <div class="card-footer">
              <span class="text-danger">Harap Membayar biaya perawatan alat sebesar Rp 25.000.</span>
            </div> -->
            </form>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        
        @if(count($pengembalian->get()) == 0)
        
        @if($adminPinjam->transaksi->status_pinjam == 'loan_dismiss' || $adminPinjam->transaksi->status_pinjam == 'loan_pending')
        @else
          @if(isset($adminPinjam->first()->admin->nama) !=  false)
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <a href="#" id="kembalikan">Kembalikan Alat</a> <br>
              </div>
              <div class="card-body hilang">
              <div class="table-responsive">
                  <table class="table">
                    <thead>
                    <tr>
                      <th>#</th>
                      <th>Nama Alat</th>
                      <th>Jumlah</th>
                      <th>Keterangan</th>
                    </tr>
                    </thead>
                      <form action="{{route('user.pengembalian.store')}}" method="POST">
                        @csrf
                    <tbody>
                      @foreach($peminjaman->get() as $key => $pinjamKembali)
                      <tr>
                        <td>{{++$key}}</td>
                        <td>{{$pinjamKembali->alat->nama}} <input type="hidden" name="alat_id[]" value="{{$pinjamKembali->alat_id}}"> </td>
                        <td>
                          <input type="number" name="jumlah[]" class="form-control" required>
                        </td>
                        <td>
                          <textarea type="text" name="keterangan[]" rows="1" class="form-control" required></textarea>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                    <tr>  
                      <th>Lama Pinjam</th>
                      <th>:</th>
                      <td> 
                        {{ $lamaPinjam . ' Hari' }}  </strong> 
                      </td>
                    </tr>
                    @if($selisihTanggal > 0)
                    <tr>  
                        <th>Denda</th>
                        <th>:</th>
                        <td> 
                          <span class="totalDenda">{{ $selisihTanggal * 2000 }}</span> <strong>  {{ 'Telat ' . $selisihTanggal . ' Hari' }}  </strong> 
                          <input type="hidden" name="denda" class="denda" value="{{ $selisihTanggal * 2000 }}" class="form-control" required>
                        </td>
                      </tr>
                    @else
                    <tr>
                      <th>Denda</th>
                      <th>:</th>
                      <td> 0 </td>
                    </tr>
                    @endif
                    
                    <tr>
                      <th>Tanggal Pengembalian</th>
                      <th>:</th>
                      <td> <input type="date" name="tanggal_dikembalikan" class="form-control" required> </td>
                    </tr>
                  </table>
                  <hr>
                      <input type="hidden" name="transaksi_id" value="{{$transaksi->id}}">
                      <button class="btn btn-primary simpan">Simpan</button>
                    </form>
                    <hr>
                </div>
              </div>
              <div class="card-footer">
                <span class="text-danger">Apabila alat yang dipinjam hilang atau rusak, maka harus di ganti dengan yang baru.</span>
              </div>
            </div>
          </div>
          @endif
        @endif
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
                        Pengembalian Tertunda
                      @elseif($pengembalian->first()->transaksi->status == 'return_approved')
                        Pengembalian Diterima
                      @elseif($pengembalian->first()->transaksi->status == 'return_dismiss')
                        Pengembalian Ditolak  
                      @endif
                      
                    </td>
                  </tr>
                  
                  <tr>
                      <td colspan="3">Dari Tanggal</td>
                      <td>
                        {{ $transaksi->dari_tanggal  }}
                      </td>
                  </tr>
                  <tr>
                      <td colspan="3">Sampai Tanggal</td>
                      <td>
                        {{ $transaksi->sampai_tanggal  }}
                      </td>
                  </tr>
                  <tr>
                      <td colspan="3">Denda</td>
                      <td>
                        {{ $transaksi->denda ?? '-'  }}
                      </td>
                  </tr>
                  <tr>
                      <td colspan="3">Tanggal Dikembalikan</td>
                      <td>
                        {{ $transaksi->tanggal_dikembalikan ?? '-'  }}
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