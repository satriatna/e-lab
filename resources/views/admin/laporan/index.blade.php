<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<style>
    .question p:last-child {
        margin-bottom: 10px;
    }

    .option-list, .question-list {
        padding-left: 20px;
        margin-top: 15px;
    }

    .option-list {
        margin-top: 0px;
    }

    .option-item, .question-item {
        padding-left: 10px;
    }

    .question-item {
        margin-bottom: 20px;
    }
    .option-item{
        margin-top: -3px;
    }
    .option-item.correct {
        color: #47c363;
        font-weight: 900 !important;
    }
</style>
<div class="card">
    <div class="card-body">
        <div>
            <table class="table table-bordered">
                @foreach($transaksi as $transaksi)
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td>{{$transaksi->user->nama}}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>