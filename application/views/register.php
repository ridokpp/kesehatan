<?php
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Register Admin</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Register Admin</div>
				<div class="panel-body">
					<form role="form">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="Nama" name="Nama" type="text" autofocus="">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="NIK" type="number" min="1" max="100" step="1" >
							</div>
							<div class="form-group">
									<select class="form-control form-control-lg" name="jk" placeholder="Jenis Kelamin" style="height: 47px" required>
										<option value="Laki - Laki ">Laki - Laki</option>
										<option value="Perempuan">Perempuan</option>
									</select>
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Alamat" name="almt" type="text" autofocus="">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="No SIP" name="nosip" type="number" autofocus="">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Username" name="user" type="text" autofocus="">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="E-mail" name="email" type="email" autofocus="">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Password" name="password" type="password" value="">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Re-Password" name="password2" type="password" value="">
							</div>
							<button class="btn btn-primary " name="login">Sign Up</button>
						</fieldset>

					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	
	

<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>