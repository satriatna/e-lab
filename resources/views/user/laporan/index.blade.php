
<title>
    Laporan Data Yang {{$tipe == 'pinjam' ? 'Dipinjam' : 'Dikembalikan'}}
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
    margin-top: 40px;
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
        <h6>
            <center>
            Dari Tanggal : {{date("d-m-Y",strtotime($dari))}} <br>
            Sampai Tanggal : {{date("d-m-Y",strtotime($ke))}} <br>
            </center>
        </h6>
    <table class="table table-bordered" border="5px solid black">
            <tr>
                <th colspan="7"><center>Data Yang {{$tipe == 'pinjam' ? 'Dipinjam' : 'Dikembalikan'}}</center> </th>
            </tr>
            <thead>
                <tr>
                    <th>Guru Pembimbing</th>
                    <th>Nama Alat</th>
                    <th>Jumlah</th>
                    <th>Keterangan</th>
                    <th>Bukti Pembayaran</th>
                    <th>Dari Tanggal</th>
                    <th>Sampai Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse($laporan as $lap)
                    @if($lap->transaksi->bukti_bayar)
                        @php
                            $public = 'images/bukti-pembayaran/'. $lap->transaksi->bukti_bayar;
                            $image = base64_encode(file_get_contents(public_path($public)));
                        @endphp
                    @endif
                <tr>
                    <td>{{$lap->transaksi->user->nama}} </td>
                    <td>{{$lap->alat->nama}} </td>
                    <td>{{$lap->jumlah}} </td>
                    <td>{{$lap->keterangan}} </td>
                    <td>
                        @if($lap->transaksi->bukti_bayar)
                        <img src="data:image/png;base64,{{ $image }}" style="height:70px;width:70px;">
                        @else
                        -
                        @endif
                    </td>
                    <td>
                        {{Carbon\Carbon::parse($lap->dari_tanggal)->isoFormat('dddd, D MMM Y')}}
                    </td>
                    <td>
                        {{Carbon\Carbon::parse($lap->sampai_tanggal)->isoFormat('dddd, D MMM Y')}}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7"><center>Tidak ada data</center></td>
                </tr>
                @endforelse
            </tbody>
        </table>
       <div class="footer">
            <div class="header">    
                Pengelola LAB 
            </div>
            <div class="body">
                {{$laporan->first()->admin->nama ?? 'Admin'}}
            </div>
       </div>
            <p style="margin-top: 160px !important;">
            <b>Keterangan</b> : Harap Membayar biaya perawatan alat sebesar Rp 25.000
            </p>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>