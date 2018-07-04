<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="<?php echo base_url()?>assets/bootstrap/css/bootstrap.min.css"/>
	<link rel="stylesheet" href="<?php echo base_url()?>assets/select2/dist/css/select2.min.css"/>
	<script src="<?php echo base_url()?>assets/bootstrap/js/jquery-3.3.1.slim.min.js"></script>
	<script src="<?php echo base_url()?>assets/bootstrap/js/popper.min.js"></script>
	<script src="<?php echo base_url()?>assets/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url()?>assets/select2/dist/js/select2.min.js"></script>
  	<style>
        body{padding: 20px}
   	</style>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">KLINIK PRATAMA</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url()?>Welcome/">Pendaftaran</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo base_url()?>Welcome/pemeriksaan_awal">Pemeriksaan Awal<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>

<br>

<h3 class="text-center">Profile Pasien</h3>

<form action="action">
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="form-group">
				 	<div class="input-group-prepend">
			          	<input type="number" class="form-control" id="" name="" placeholder="Tinggi Badan" required="">
			          	<span class="input-group-text" id="inputGroupPrepend">cm</span>
			     	</div>
			    </div>

			    <div class="form-group">
			     	<div class="input-group-prepend">
			          	<input type="number" class="form-control" id="" name="" placeholder="Berat Badan" required="">
			          	<span class="input-group-text" id="inputGroupPrepend">kg</span>
			     	</div>
			    </div>

			    <div class="form-row">
				    <div class="col">
				     	<div class="input-group-prepend">
				          	<input type="number" class="form-control" id="" name="" placeholder="Tekanan Darah Atas" required="">
				          	<span class="input-group-text" id="inputGroupPrepend">mmHg</span>
				     	</div>
				    </div>
				    <div class="col">
				     	<div class="input-group-prepend">
				          	<input type="number" class="form-control" id="" name="" placeholder="Tekanan Darah Bawah" required="">
				          	<span class="input-group-text" id="inputGroupPrepend">mmHg</span>
				     	</div>
				    </div>
			    </div>

			    <div class="form-group mt-3">
				 	<div class="input-group-prepend">
			          	<input type="number" class="form-control" id="" name="" placeholder="Denyut Nadi" required="">
			          	<span class="input-group-text" id="inputGroupPrepend">rpm</span>
			     	</div>
			    </div>

			    <div class="form-group mt-3">
				 	<div class="input-group-prepend">
			          	<input type="number" class="form-control" id="" name="" placeholder="Respiration Rate" required="">
			          	<span class="input-group-text" id="inputGroupPrepend">rpm</span>
			     	</div>
			    </div>

			    <div class="form-group mt-3">
				 	<div class="input-group-prepend">
			          	<input type="number" class="form-control" id="" name="" placeholder="Temperature Axilla" required="">
			          	<span class="input-group-text" id="inputGroupPrepend">&deg;C</span>
			     	</div>
			    </div>

			    <div class="form-group">
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>  
			</div>   
		</div>
	</div>
</form>			



