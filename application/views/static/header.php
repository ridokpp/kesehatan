<?php
$method = $this->router->fetch_method();
$menu = $this->uri->segment(3, 0);
if (!isset($title) AND !isset($pasien)) {
  $title = "Klinik Pratama";
}else{
  $title = "Pasien : ".$pasien[0]->nama;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <title><?=$title?></title>
	<link rel="stylesheet" href="<?php echo base_url()?>assets/bootstrap/css/bootstrap.min.css"/>
	<link rel="stylesheet" href="<?php echo base_url()?>assets/select2/dist/css/select2.min.css"/>
	<link rel="stylesheet" href="<?php echo base_url()?>assets/bootstrap-datepicker/css/bootstrap-datepicker3.css"/>
	<script src="<?php echo base_url()?>assets/bootstrap/js/jquery-3.3.1.min.js"></script>
	<script src="<?php echo base_url()?>assets/bootstrap/js/popper.min.js"></script>
	<script src="<?php echo base_url()?>assets/bootstrap/js/bootstrap.min.js"></script>
	<!-- <script src="<?php echo base_url()?>assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script> -->
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
      <li class="nav-item <?=($menu == 'cari') ? 'active' : ''?>">
        <a class="nav-link" href="<?php echo base_url()?>Petugas/menu/cari">Cari</a>
      </li>
      <li class="nav-item <?=($menu == 'pendaftaran') ? 'active' : ''?>">
        <a class="nav-link" href="<?php echo base_url()?>Petugas/menu/pendaftaran">Pendaftaran</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>

