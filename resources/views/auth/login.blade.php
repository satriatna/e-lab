<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Halaman Login</title>
	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- Font-->
	<link rel="stylesheet" type="text/css" href="css/roboto-font.css">
	<link rel="stylesheet" type="text/css" href="fonts/line-awesome/css/line-awesome.min.css">
	<!-- Jquery -->
	<link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.css">
	<!-- Main Style Css -->
    <link rel="stylesheet" href="{{url('template/login/css/style.css')}}"/>
</head>
<!-- <style>
.select {
  width: 100%;
  display: block;
  border: 1px grey var(--select-border);
  border-radius: 0.25em;
  padding: 0.25em 0.5em;
  font-size: 1.25rem;
  cursor: pointer;
  border-style: solid;
  line-height: 1.1;
  background-color: #fff;
  background-image: linear-gradient(to top, #f9f9f9, #fff 33%);
}
</style> -->
<body class="form-v2">
	<div class="page-content">
		<div class="form-v2-content">
			<div class="form-left">
				<img src="{{url('images/logo/logo.jpeg')}}" style="height:500px;width:110%;">
			</div>
			
			<form class="form-detail" action="{{route('login')}}" method="post" id="myform">
                @csrf
				<h2>Silahkan Masuk</h2>
				<div class="form-row">
					<label for="username">Username :</label>
					<input type="username" name="username" id="username" class="input-text" required>
				</div>
				<div class="form-row">
					<label for="password">Password :</label>
					<input type="password" name="password" id="password" class="input-text" required>
				</div>
				<div class="form-row">
					<label for="role">Masuk Sebagai :</label><br>
					<select name="role" id="role" class="select" required>
						<option value="admin">Admin</option>
						<option value="user">User</option>
					</select>
				</div><br>	
			
				<div class="form-row">
					<input type="submit" class="input-text" value="Masuk" style="background: #4254f5;color:white;cursor:pointer;width:99%;">
				</div>
			</form>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script>
	</script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>