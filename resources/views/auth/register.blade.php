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
			<div class="card">
				<div class="card-header">
				Form Pendaftaran
				</div>
				<div class="card-body">		
					<form class="form-detail" action="{{route('register')}}" method="post" id="myform" style="width: 100%;">
						@csrf
						<h2>Form Pendaftaran</h2>
						<div class="form-row">
							<label for="nama">Guru Pembimbing :</label>
							<input type="text" name="nama" id="nama" class="form-control" required>
						</div>
						<div class="form-row">
							<label for="instansi">Instansi :</label>
							<input type="text" name="instansi" id="instansi" class="form-control" required>
						</div>
						<div class="form-row">
							<label for="guru_pembimbing">No HP :</label>
							<input type="number" name="guru_pembimbing" id="guru_pembimbing" class="form-control" required>
						</div>
						<div class="form-row">
							<label for="username">Username :</label>
							<input type="text" name="username" id="username" class="form-control" required>
						</div>
						<div class="form-row">
							<label for="password">Password :</label>
							<input type="password" name="password" id="password" class="form-control" required>
						</div>
						<br>	
					
						<div class="form-row">
							<input type="submit" class="form-control" value="Daftar" style="background: #4254f5;color:white;cursor:pointer;width:99%;">
						</div>

						<div class="form-group mt-5">
							<a href="{{route('login')}}">Masuk</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
	
</body>
</html>