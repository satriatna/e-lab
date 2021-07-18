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
						<div class="form-row">
							<label for="nip">NIP :</label>
							<input type="text" name="nip" id="nip" class="form-control" required value="{{ old('nip') }}">
						</div>
						<div class="form-row">
							<label for="nama">Guru Pembimbing :</label>
							<input type="text" name="nama" id="nama" class="form-control" required value="{{ old('nama') }}">
						</div>
						<div class="form-row">
							<label for="instansi">Instansi :</label>
							<input type="text" name="instansi" id="instansi" class="form-control" required value="{{ old('instansi') }}">
						</div>
						<div class="form-row">
							<label for="guru_pembimbing">No HP :</label>
							<input type="number" name="guru_pembimbing" id="guru_pembimbing" class="form-control" required value="{{ old('guru_pembimbing') }}">
						</div>
						<div class="form-row">
							<label for="alamat">Alamat :</label>
							<textarea name="alamat" id="alamat" class="form-control" required>{{ old('alamat') }}</textarea>
						</div>
						<div class="form-row">
							<label for="username">Username :</label>
							<input type="text" name="username" id="username" class="form-control" required value="{{ old('username') }}">
						</div>
						<div class="form-row">
							<label for="password">Password :</label>
							<input type="password" name="password" id="password" class="form-control" required>
							@error('password')
								<div class="error text-danger">Password minimal 8 karakter</div>
							@enderror
						</div>
						<br>	
					
						<div class="form-row">
							<input type="submit" class="form-control" value="Daftar" style="background: #4254f5;color:white;cursor:pointer;width:99%;">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
	
</body>
</html>