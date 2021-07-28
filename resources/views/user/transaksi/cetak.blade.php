
<title>
    Detail Transaksi
</title>
<style>
    
table {
  border: 1px solid black !important;
  border-collapse: collapse;
}
.logo{
    height:70px;
    width:70px;
    float:left;
    margin-top:70px;
    margin-left: -80px;
}
.footer{
    float: right;
}
.footer .body{
    margin-top: 70px;
}
.container {
  padding-right: 15px;
  padding-left: 15px;
  margin-right: auto;
  margin-left: auto;
}
@media (min-width: 768px) {
  .container {
    width: 750px;
  }
}
@media (min-width: 992px) {
  .container {
    width: 970px;
  }
}
@media (min-width: 1200px) {
  .container {
    width: 1170px;
  }
}
</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <div class="container">
        <div class="heading">
            @php
            $public = 'images/logo/logo.jpeg';
            $image = base64_encode(file_get_contents(public_path($public)));
            @endphp
            <img src="data:image/png;base64,{{ $image }}" class="logo"> <br>
            <center>
            <h3>SMA N 1 GADINGREJO  </h3>
            Jl. Tegal Sari No.1, Gading Rejo, <br>
            Kec. Gading Rejo, Kabupaten Pringsewu, Lampung 35366 <br>
            website: sman1-gadingrejo.sch.id   Email:sman1gadingrejo@yahoo.com <br>
            </center>
        </div>
    </div>
    <hr>
    <h5>Nama User : {{ $transaksi->user->nama }}</h5>
    @if($tipe == 'pinjam')
    <table class="table table-bordered" border="5px solid black">
        <tr>
            <th colspan="5"><center>Data Alat Yang Dipinjam</center> </th>
        </tr>
        <thead>
            <tr>
                <th>Guru Pembimbing</th>
                <th>Nama Alat</th>
                <th>Jumlah</th>
                <th>Keterangan</th>
                <th>Dari Tanggal</th>
                <th>Sampai Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($peminjaman as $pinjam)
                @if($pinjam->transaksi->bukti_bayar)
                    @php
                        $public = 'images/bukti-pembayaran/'. $pinjam->transaksi->bukti_bayar;
                        $image = base64_encode(file_get_contents(public_path($public)));
                    @endphp
                @endif
            <tr>
                <td>{{$pinjam->transaksi->user->nama}} </td>
                <td>{{$pinjam->alat->nama}} </td>
                <td>{{$pinjam->jumlah}} </td>
                <td>{{$pinjam->keterangan}} </td>
                <td>
                    {{Carbon\Carbon::parse($pinjam->dari_tanggal)->isoFormat('dddd, D MMM Y')}}
                </td>
                <td>
                    {{Carbon\Carbon::parse($pinjam->sampai_tanggal)->isoFormat('dddd, D MMM Y')}}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6"><center>Tidak ada data</center></td>
            </tr>
            @endforelse
        </tbody>
    </table>
    @endif
    @if($tipe == 'kembali')
    <table class="table table-bordered" border="5px solid black">
        <tr>
            <th colspan="5"><center>Data Alat Yang Dikembalikan</center> </th>
        </tr>
        <thead>
            <tr>
                <th>Guru Pembimbing</th>
                <th>Nama Alat</th>
                <th>Jumlah</th>
                <th>Keterangan</th>
                <th>Dari Tanggal</th>
                <th>Sampai Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pengembalian as $kembali)
                @if($kembali->transaksi->bukti_bayar)
                    @php
                        $public = 'images/bukti-pembayaran/'. $kembali->transaksi->bukti_bayar;
                        $image = base64_encode(file_get_contents(public_path($public)));
                    @endphp
                @endif
            <tr>
                <td>{{$kembali->transaksi->user->nama}} </td>
                <td>{{$kembali->alat->nama}} </td>
                <td>{{$kembali->jumlah}} </td>
                <td>{{$kembali->keterangan}} </td>
                <td>
                    {{Carbon\Carbon::parse($kembali->dari_tanggal)->isoFormat('dddd, D MMM Y')}}
                </td>
                <td>
                    {{Carbon\Carbon::parse($kembali->sampai_tanggal)->isoFormat('dddd, D MMM Y')}}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6"><center>Tidak ada data</center></td>
            </tr>
            @endforelse
        </tbody>
    </table>
    @endif
    <table class="table table-bordered" border="5px solid black" style="width:20%;float:left;">
        <tr>
            <th><center>Bukti Pembayaran</center> </th>
            <th>
                @if($transaksi->bukti_bayar)
                    @php
                        $public = 'images/bukti-pembayaran/'. $transaksi->bukti_bayar;
                        $image = base64_encode(file_get_contents(public_path($public)));
                    @endphp
                @endif
                
                @if($transaksi->bukti_bayar)
                <img src="data:image/png;base64,{{ $image }}" style="height:70px;width:70px;">
                @else
                -
                @endif
            </th>
        </tr>
    </table>
    <div class="footer">
        <div class="header">    
            Pengelola LAB 
        </div>
        <div class="body">
            {{$pengembalian->first()->admin->nama ?? 'Admin'}}
        </div>
    </div>
    <p style="margin-top: 160px !important;">
    <b>Keterangan</b> : Harap Membayar biaya perawatan alat sebesar Rp 25.000
    </p>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>