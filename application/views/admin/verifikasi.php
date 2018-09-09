<div class="container">
<?php
if ($belum_terverifikasi != array()) {
?>
	<h3 class="text mt-3" style="margin-left: 65px">Verifikasi Akun</h3>
	<div class="row mt-4 mb-5">	
		<table class="table">
		  <thead>
		    <tr>
		      <th scope="col">Nama</th>
		      <th scope="col">SIP</th>
		      <th scope="col">Proses</th>
		    </tr>
		  </thead>

		  <tbody>
		  	<?php
		  	foreach ($belum_terverifikasi as $key => $value) {
			  	echo "<tr>";
			  	echo "<td>";
			  	echo $value->nama;
			  	echo "</td>";
			  	echo "<td>";
			  	echo $value->sip;
			  	echo "</td>";
			  	echo "<td>";
			  	echo "<a href=".base_url()."Admin_handler/verifikasi_user/$value->id_user class='btn btn-primary btn-block btn-sm'>Validasi</a>";
			  	echo "</td>";
			  	echo "</tr>";
		  	}
		  	?>
		  </tbody>
		</table>
	</div>
<?php
}
?>

<?php
if ($sudah_terverifikasi != array()) {
?>

	<h3 class="text mt-3">Reset Password</h3>
	<div class="row mt-5">
		<table class="table">
  		<thead>
			<tr>
		      <th scope="col">Nama</th>
		      <th scope="col">SIP</th>
		      <th scope="col">Password</th>
		    </tr>
  		</thead>

		  <tbody>
		  	<?php
		  	foreach ($sudah_terverifikasi as $key => $value) {
		  		echo "<tr>";
		  		echo "<td>";
		  		echo $value->nama;
		  		echo "</td>";
		  		echo "<td>";
		  		echo $value->sip;
		  		echo "</td>";
		  		echo "<td>";
			  	echo "<button type='button' class='btn btn-danger btn-block btn-sm'>Reset</button>";
			  	echo "</td>";
		  		echo "</tr>";
		  	}
		  	?>
		  </tbody>
		</table>
	</div>
<?php
}
?>
</div>
