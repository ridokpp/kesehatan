<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="<?php echo base_url()?>assets/bootstrap/css/bootstrap.min.css"/>
	<link rel="stylesheet" href="<?php echo base_url()?>assets/select2/dist/css/select2.min.css"/>
	<link rel="stylesheet" href="<?php echo base_url()?>assets/bootstrap-datepicker/css/bootstrap-datepicker3.css"/>
	<script src="<?php echo base_url()?>assets/bootstrap/js/jquery-3.3.1.slim.min.js"></script>
	<script src="<?php echo base_url()?>assets/bootstrap/js/popper.min.js"></script>
	<script src="<?php echo base_url()?>assets/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url()?>assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
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
      <li class="nav-item active">
        <a class="nav-link" href="#">Pendafataran<span class="sr-only">(current)</span></a>
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

<form action="action">
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="form-group">
					<label for="" class="control-label">Nama Lengkap</label>
					<input type="text" class="form-control" id="" name="" placeholder="Nama Lengkap" required="">
				</div>	

				<div class="form-group"> 
					<label for="" class="control-label">NIK</label>
					<input type="" class="form-control" id="" name="" placeholder="NIK" required="">
				</div>

				<div class="form-row">
					<div class="col">
						<label class="control-label">Tempat Lahir</label>
				      <input type="text" class="form-control" id="" name="" placeholder="Tempat Lahir" required="">
				   </div>
				   <div class="col">
				   	<label class="control-label">Tanggal Lahir</label>
				      <input type="date" class="form-control" required="">
				      <br>
				   </div>
				</div>

				<div class="form-group">
					<label for="" class="control-label">Alamat</label>
					<select class="form-control" id="" required="">
						<option value="" disabled="" selected="">Kota / Kabupaten</option>
						<option value="">Kota Malang</option>
						<option value="">Kabupaten Malang</option>
					</select>
					<br>
					<select class="form-control" id="" required="">
						<option value="" disabled="" selected="">Kecamatan</option>
						<option value="">Kedungkandang</option>
						<option value="">Lowokwaru</option>
						<option value="">Klojen</option>
						<option value="">Sukun</option>
						<option value="">Blimbing</option>
					</select>
					<br>
					<select class="form-control" id="" required="">
						<option value="" disabled="" selected="">Kelurahan</option>
						<option value="">001 Arjowinangun</option>
						<option value="">002 Bumiayu</option>
						<option value="">003 Buring</option>
						<option value="">004 Cemoro Kandang</option>
						<option value="">005 Kedung Kandang</option>
						<option value="">006 Kota Lama</option>
						<option value="">007 Lesanpuro</option>
						<option value="">008 Madyopuro</option>
						<option value="">009 Mergosono</option>
						<option value="">010 Sawojajar</option>
						<option value="">011 Tlogowaru</option>
						<option value="">012 Wonokoyo</option>
						<option value="">013 Lain-Lain</option>
					</select>
					<br>
					<input type="text" class="form-control" id="" name="" placeholder="Jalan" required="">
				</div>	

										
				<div class="form-group"> 
					<label for="state_id" class="control-label">Jenis Kelamin</label>
					<select class="form-control" id="state_id" required="">
						<option value="">Laki - Laki</option>
						<option value="">Perempuan</option>
					</select>					
				</div>
				
				<div class="form-group"> 
					<label for="" class="control-label">Pembayaran</label>
					<select class="form-control" id="" required="">
						<option value="">Umum</option>
						<option value="">BPJS</option>
						<option value="">Royale Family</option>
					</select>
				</div>

				<div class="form-group">
					<label for="" class="control-label">Pekerjaan</label>
					<input type="text" class="form-control" id="" name="" placeholder="Pekerjaan" required="">
				</div>		
				
				<div class="form-group">
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>  
			</div>   
		</div>
	</div>
</form>			



