<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="<?php echo base_url()?>assets/bootstrap/css/bootstrap.min.css" />
	<link href="<?php echo base_url()?>assets/select2/dist/css/select2.min.css" rel="stylesheet" />
	<script src="<?php echo base_url()?>assets/bootstrap/js/jquery-3.3.1.slim.min.js"></script>
	<script src="<?php echo base_url()?>assets/bootstrap/js/popper.min.js"></script>
	<script src="<?php echo base_url()?>assets/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url()?>assets/select2/dist/select2.min.js"></script>
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
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
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
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>


<style type="text/css">
	.jumbotron{
		width: 100%;
		height: 100%;
	}
</style>
<div class="jumbotron jumbotron-fluid">
	<div class="container">
  		<div class="row">
    		<div class="col">
	   		<h1 class="display-4">Fluid jumbotron</h1>
	    		<p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p>
	    	</div>
			<div class="col">	    
	    		<form>
					<div class="form-group">
						<label for="exampleInputEmail1">Email address</label>
						<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
						<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
			  		</div>
			  		<div class="form-group">
			    		<label for="exampleInputPassword1">Password</label>
			    		<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
			  		</div>
			  		<button type="submit" class="btn btn-primary">Submit</button>
				</form>
			</div>
  		</div>
	</div>
</div>
