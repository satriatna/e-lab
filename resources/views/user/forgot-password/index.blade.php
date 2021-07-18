<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
	<!-- Scripts -->
	<script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
<div class="container">
	<div class="row justify-content-center mt-5">
		<div class="col-8">
				@if ($message = Session::get('success'))
					<div class="alert alert-success alert-block">
						<button type="button" class="close" data-dismiss="alert">×</button>	
						<strong>Permintaan berhasil dikirim</strong>
					</div>
				@endif
				@if ($message = Session::get('alert'))
					<div class="alert alert-danger alert-block">
						<button type="button" class="close" data-dismiss="alert">×</button>	
						<strong>Username tidak ditemukan</strong>
					</div>
				@endif
			<div class="card">
				<div class="card-header">
				Lupa Password
				</div>
				<div class="card-body">		
					<form class="form-detail" action="{{route('forgot-password')}}" method="post" id="myform" style="width: 100%;">
						@csrf
						<div class="form-row">
							<label for="username">Ketik Username Anda :</label>
							<input type="text" name="username" id="username" class="form-control" required value="{{ old('username') }}">
						</div><br>
						<div class="form-row">
							<input type="submit" class="btn btn-primary" value="Kirim">
							<a href="{{route('login')}}" class="btn btn-success ml-1">Kembali</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
	
</body>
</html>