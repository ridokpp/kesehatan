<!-- 
CATATAN :

http://www.fpdf.org/en/script/script3.php


 -->
<script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable( {
      dom: 'Bfrtip',
      buttons: [
        {
            extend: 'print',
            text: 'Print all',
            exportOptions: {
                modifier: {
                    selected: null
                },
                columns: [ 6, ':visible' ]
            }
        }
      ],columnDefs: [ 
        { 
          orderable: false, 
          targets: [2,3,4,5,6] 
        } 
      ],
      select: true
    });

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
            <th>Assessment</th>
            <th>Planing</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          // echo "<pre>";
          // var_dump($assessment);
          // echo "</pre>";
          $i = 1;
          foreach($rekam_medis as $key => $value) {
          ?>
            <tr>
              <td>
                <?=$i?>
              </td>
              <td>
                <ul>
                  <li class="no-bullets">
                    <?=tgl_indo(substr($value->tgl_jam,0,10))?>
                  </li>
                  <li class="no-bullets">
                    <?=substr($value->tgl_jam,10,6)?>
                  </li>
                </ul>
              </td>
              <td>
                <?=$value->subjek?>
              </td>
              <td>
                <ul>
                  <li class="no-bullets">TB/BB : <?=$objektif[$key]->tb?> cm/ <?=$objektif[$key]->bb?> Kg</li>
                  <li class="no-bullets">TD : <?=$objektif[$key]->td1?>/<?=$objektif[$key]->td2?> mmHg</li>
                  <li class="no-bullets">RR : <?=$objektif[$key]->RR?></li>
                  <li class="no-bullets">N  : <?=$objektif[$key]->N?> rpm</li>
                  <li class="no-bullets">TAx: <?=$objektif[$key]->TAx?> &deg;C</li>
                  <li class="no-bullets">Head to Toe : <?=$objektif[$key]->text_headtotoe?></li>
                  <?php
                  if ($objektif[$key]->kd_headtotoe) { ?>
                    <li class="no-bullets">keluhan: <?=$value->keluhan?></li>
                    <li class="no-bullets">GCS E : <?=$value->GCS_E?>; V: <?=$value->GCS_V?>; M:<?=$value->GCS_M?> (<?=$value->GCS_opsi?>)</li>
                    <li class="no-bullets">TB/BB: <?=$value->tb?> cm / <?=$value->bb?> kg</li>
                    <?php
                  }?>
                </ul>
              </td>
              <td><?=$value->kelompok?></td>
              <td><?=$value->planning?></td>
              <td><button type="button" class="btn btn-primary" >CETAK</button> </td>
            </tr>
          <?php $i++; }
          ?>
        </tbody>
      </table>
    </div>
	</div>
</div>

<form method="POST" action="<?=base_url()?>Dokter_handler/cetak_RM" target="_blank">
  <input type="text" name="nomor_pasien" value="<?=$pasien[0]->nomor_pasien?>">
  <input type="radio" name="bool_halaman_awal" value="1">
  <input type="radio" name="bool_halaman_awal" value="0">
  <input type="checkbox" name="idS_rekam_medis[]" value="1">
  <input type="checkbox" name="idS_rekam_medis[]" value="2">
  <input type="checkbox" name="idS_rekam_medis[]" value="3">
  <input type="checkbox" name="idS_rekam_medis[]" value="4">
  <input type="checkbox" name="idS_rekam_medis[]" value="5">
  <input type="checkbox" name="idS_rekam_medis[]" value="6">
  <input type="checkbox" name="idS_rekam_medis[]" value="7">
  <input type="submit" name="submit">
</form>