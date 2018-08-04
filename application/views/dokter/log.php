<script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'print'
        ]
    } );
} );	
</script>
<style type="text/css">
	.linone {
		display: none;
	}
	.no-bullets {
    list-style-type: none;
	}
</style>
<h3 class="text mt-3" style="margin-left: 65px">Log Pemeriksaan Dokter</h3>
<div class="container">
	<div class="row mt-4">
		<div class="col-2">
			Nama 
		</div>
		
		<div class="col-4">
			: <?=$pasien[0]->nama?>
		</div>

		<div class="col-2">
			Alamat 
		</div>

		<div class="col-4">
			: <?=$pasien[0]->alamat?>
		</div>
	</div>

	<div class="row mt-2">
		<div class="col-2">
			NIK 
		</div>
		
		<div class="col-4">
			: <?=$pasien[0]->nik?>
		</div>

		<div class="col-2">
			Jenis Kelamin
		</div>

		<div class="col-4">
			: <?=$pasien[0]->jkelamin?>
		</div>
	</div>

	<div class="row mt-2 mb-3">
		<div class="col-2">
			Tempat / Tgl Lahir 
		</div>
		
		<div class="col-1">
			: <?=$pasien[0]->tmp_lahir?>
		</div>

		<div class="col-3">
			/ <?=tgl_indo($pasien[0]->tgl_lahir)?>
		</div>

		<div class="col-2">
			Pekerjaan
		</div>

		<div class="col-2">
			: <?=$pasien[0]->pekerjaan?>
		</div>
    <div class="col-3 offset-9 mt-4">
      <a class="btn btn-primary btn-lg btn-block" href="<?= base_url()?>Dokter/pemeriksaan/<?=$pasien[0]->nomor_pasien?>">Pemeriksaan</a>
    </div>
  </div>
	  	
	<div class=" row mt-5">	
		<div class="col-12">	
	<table class="table" id="example">
  <thead>
    <tr>
      <th>No</th>
      <th>Tanggal / Jam Periksa </th>
      <th>Subjektif</th>
      <th>Objektif</th>
      <th>Assement</th>
      <th>Planing</th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach ($rekam_medis as $key => $value) {
      
    }
    ?>
    <tr>
      <th>1</th>
      <td>
      	<ul>
      		<li class="no-bullets"> 10/12/2017 </li>
      		<li class="no-bullets"> 19:00 WIB </li>
      	</ul>
      </td>
      <td>Batuk</td>
      <td>
      	<ul>
      		<li class="no-bullets">TB/BB : 70 cm/ 46 Kg</li>
   			<li class="no-bullets">TD : ..../.... mmHg RR</li>
      		<li class="no-bullets">N  : ....rpm TAx: 36c</li>
      		<li class="no-bullets">Head to Toe :</li>
      	</ul>	 
      </td>
      <td>asu</td>
      <td>R/</td>
    </tr>
    <tr>
      <th>2</th>
       <td>
       	<ul>
      		<li class="no-bullets"> 10/12/2017 </li>
      		<li class="no-bullets"> 19:00 WIB </li>
      	</ul>
       </td>
      <td>Pilek</td>
      <td>
      	<ul>
      		<li class="no-bullets">TB/BB : 70 cm/ 46 Kg</li>
   			<li class="no-bullets">TD : .... /.... mmHg RR</li>
      		<li class="no-bullets">N  : .... rpm TAx: 36c</li>
      		<li class="no-bullets">Head to Toe :</li>
      	</ul>	 
      </td>
      <td>raimu</td>
      <td>R/</td>
    </tr>
    <tr>
      <th>3</th>
       <td>
       	<ul>
      		<li class="no-bullets"> 10/12/2017 </li>
      		<li class="no-bullets"> 19:00 WIB </li>
      	</ul>
       </td>
      <td>Pusing</td>
      <td>
      	<ul>
      		<li class="no-bullets">TB/BB : 70 cm/ 46 Kg</li>
   			<li class="no-bullets">TD : ..../.... mmHg RR</li>
      		<li class="no-bullets">N  : ....rpm TAx: 36c</li>
      		<li class="no-bullets">Head to Toe :</li>
      	</ul>	 
      </td>
      <td>krepek</td>
      <td>R/</td>
    </tr>
  </tbody>
</table>
</div>


	</div>

</div>
