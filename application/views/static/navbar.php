<?php
$method = $this->router->fetch_method();
$menu = $this->uri->segment(3, 0);

?>
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
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url()?>Account/logout_handler/">Sign Out</a>
      </li>
    </ul>
  </div>
</nav>