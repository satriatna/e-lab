<title>
    Laporan Data Yang {{$tipe == 'pinjam' ? 'Dipinjam' : 'Dikembalikan'}}
</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<div class="card">
    <div class="card-body">
    LAPORAN DATA YANG {{$tipe == 'pinjam' ? 'DIPINJAM' : 'DIKEMBALIKAN'}}
    <br>
    Dari Tanggal : {{date("d-m-Y",strtotime($dari))}} <br>
    Sampai Tanggal : {{date("d-m-Y",strtotime($ke))}}
    </div>
</div>
<style>

table {
  border: 1px solid black !important;
  border-collapse: collapse;
}
</style>
<div class="card">
    <div class="card-body">
        <table class="table table-bordered" border="5px solid black">
            <tr>
                <th colspan="5">Data Yang {{$tipe == 'pinjam' ? 'Dipinjam' : 'Dikembalikan'}}</th>
            </tr>
            <thead>
            <tr>
                <th>Nama User</th>
                <th>Nama Alat</th>
                <th>Jumlah</th>
                <th>Keterangan</th>
                <th>Tanggal</th>
            </tr>
            </thead>
            <tbody>
            @forelse($laporan->get() as $lap)
            <tr>
                <td>{{$lap->transaksi->user->nama}} </td>
                <td>{{$lap->alat->nama}} </td>
                <td>{{$lap->jumlah}} </td>
                <td>{{$lap->keterangan}} </td>
                <td>
                    {{date('l / m-d-Y', strtotime($lap->created_at))}}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5">Tidak ada data</td>
            </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
<hr>

<div class="container-fluid">

<div class="row">
    <div class="col-4">
        <div class="card mt-5">
            <div class="card-header">
                Pengelola LAB <hr>
                <br>
                {{$laporan->first()->admin->nama}}

            </div>
        </div>
    </div>
</div>

</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>