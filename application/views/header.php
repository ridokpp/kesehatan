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
    	<span class="navbar-toggler-icon"></span></button>
  		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
      			<li class="nav-item active">
        			<a class="nav-link" href="<?php echo base_url()?>Welcome/">Pendaftaran<span class="sr-only">(current)</span></a>
      			</li>

      			<li class="nav-item">
        			<a class="nav-link" href="<?php echo base_url()?>Welcome/pemeriksaan_awal">Pemeriksaan Awal</a>
      			</li>

      			<li class="nav-item">
        			<a class="nav-link" href="<?php echo base_url()?>Welcome/pemeriksaan_awal">Rekam Medis</a>
      			</li>

      			<li class="nav-item dropdown">
        			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
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

<h3 class="text-center mt-3">Pendafataran Awal Pasien</h3>

<form action="action">
	<div class="container">
		<div class="row">
			<div class="col">

				<div class="form-group row">
				    <label class="col-sm-1 col-form-label">Nama</label>
				    <div class="input-group-prepend col-sm-7">
				      	<input type="text" class="form-control" id="" name="" placeholder="Nama Lengkap" required="">
				    </div>
				</div>

				<div class="form-group row">
				    <label class="col-sm-1 col-form-label">NIK</label>
				    <div class="input-group-prepend col-sm-7">
				      	<input type="text" class="form-control" id="" name="" placeholder="Nomor Induk Kependudukan" required="">
				    </div>
				</div>

				<div class="form-group row">
					<div class="col">	
					    <label class="control-label"><strong>Tempat, Tanggal Lahir</strong></label> 
					</div>
				</div>

				<div class="row">
			 		<div class="col">
				     	<div class="form-group row">
				   			<label for="inputEmail3" class="col-sm-3 col-form-label">Tempat</label>
				  		  	<div class="input-group-prepend col-sm-9">
				      			<input type="text" class="form-control" id="" name="" placeholder="Tempat Lahir" required="">
				    		</div>
						</div>
					</div>
			    	<div class="col">
				     	<div class="form-group row">
				    		<label for="inputEmail3" class="col-sm-4 col-form-label">Tanggal</label>
				    		<div class="input-group-prepend col-sm-8">
				      			<input type="date" class="form-control" required="">
				   			</div>
						</div>
					</div>
					<div class="col">
				     	<div class="form-group row">
				    		<label for="inputEmail3" class="col-sm-2 col-form-label"></label>
				    		<div class="input-group-prepend col-sm-10">
				      		
				   			</div>
						</div>
					</div>

			 	</div>

			 	<div class="form-group row">
					<div class="col">	
					    <label class="control-label"><strong>Alamat</strong></label> 
					</div>
				</div>

				<div class="form-group row">
					<div class="col">
						<div class="form-group row">
						    <label class="col-sm-3 col-form-label">Kota</label>
						    <div class="input-group-prepend col-sm-9">
						      	<select class="form-control" id="" required="">
									<option value="" disabled="" selected="">Kota / Kabupaten</option>
									<option value="">Kota Malang</option>
									<option value="">Kabupaten Malang</option>
								</select>
						    </div>
						</div>
					</div>

					<div class="col">
						<div class="form-group row">
						    <label class="col-sm-4 col-form-label">Kecamatan</label>
						    <div class="input-group-prepend col-sm-8">
						      	<select class="form-control" id="" required="">
									<option value="" disabled="" selected="">Kecamatan</option>
									<option value="">Kedungkandang</option>
									<option value="">Lowokwaru</option>
									<option value="">Klojen</option>
									<option value="">Sukun</option>
									<option value="">Blimbing</option>
								</select>
						    </div>
						</div>	
					</div>

					<div class="col">
						<div class="form-group row">
						    <label class="col-sm-4 col-form-label">Kelurahan</label>
						    <div class="input-group-prepend col-sm-8">
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
						    </div>
						</div>	
					</div>
				</div>	

				<div class="form-group row">
				    <label class="col-sm-1 col-form-label">Jalan</label>
				    <div class="input-group-prepend col-sm-7">
				      	<input type="text" class="form-control" id="" name="" placeholder="Jalan" required="">
				    </div>
				</div>

				<div class="form-group row">
				    <label class="col-sm-1 col-form-label">Genre</label>
				    <div class="input-group-prepend col-sm-7">
				      	<select class="form-control" id="state_id" required="">
							<option value="">Laki - Laki</option>
							<option value="">Perempuan</option>
						</select>	
				    </div>
				</div>
				
				<div class="form-group row">
				    <label class="col-sm-1 col-form-label">Pembayaran</label>
				    <div class="input-group-prepend col-sm-7">
				      	<select class="form-control" id="state_id" required="">
							<option value="">Umum</option>
							<option value="">BPJS</option>
							<option value="">Royale Family</option>
						</select>	
				    </div>
				</div>

				<div class="form-group row">
				    <label class="col-sm-1 col-form-label">Pekerjaan</label>
				    <div class="input-group-prepend col-sm-7">
				      	<input type="text" class="form-control" id="" name="" placeholder="Pekerjaan" required="">
				    </div>
				</div>		
				
				<div class="form-group">
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>  
			</div>   
		</div>
	</div>
</form>			



