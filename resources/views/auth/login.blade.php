<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
	<link rel="stylesheet" href="{{url('css/app.css')}}">
</head>
<style>
.btn-biru{
	background: #4254F5;
	color: white;
}
</style>
<body style="background: #9BC5FD;">
	<div class="container">
		<div class="row justify-content-center mt-5">
			<center><h1>Laboratorium Kimia SMA N 1 GADING REJO </h1></center>
			<div class="col-10 mt-4">
				<div class="card">
						<div class="row">
							<div class="col-4">				
								<img src="{{url('images/logo/logo.jpeg')}}" style="height:500px;width:110%;">
							</div>
							<div class="col-8">
								<div class="card">
									<div class="card-header bg-white">
										<h4 class="mt-2"><b class="text-bold">Silahkan Masuk</b></h4>
									</div>
									<div class="card-body">
										<form action="{{route('login')}}" method="post" id="myform">
											@csrf
											<div class="form-group">
												<label for="username">Username :</label>
												<input type="text" name="username" class="form-control" required>
											</div>
											<div class="form-group">
												<label for="password">Password :</label>
												<input type="password" name="password" class="form-control" required>
											</div>
											<div class="form-group">
												<label for="role">Masuk Sebagai :</label>
												<select name="role" id="role" class="custom-select" required>
													<option value="admin">Admin</option>
													<option value="user">User</option>
												</select>
											</div>
											<div class="form-group">
												<button type="submit" class="btn btn-biru btn-block">Masuk</button>
											</div>
										</form>
									</div>
									<div class="card-footer">
										<div class="form-group mt-3">
											<a href="{{route('register')}}">Daftar</a>
										</div>
									</div>
								</div>
							</div>
						</div>				
				</div>
			</div>
		</div>
	</div>
</body>
</html>
<script src="{{url('js/app.js')}}"></script>