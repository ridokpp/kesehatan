<script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable({
    	columnDefs: [{	orderable: false,	targets: [1,3]},{	width: "20px",	targets: [0]},{	width: "200px",	targets: [1]},{	width: "600px",	targets: [2]}]
    });
} );
</script>

<h3 class="text-center mt-4">Daftar Pasien</h3>
<div class="container">
	<div class=" row mt-5">	
		<div class="col">
			<table id="example" class="display">
				<thead>
					<tr>
						<th><div class="text-center">No.</div></th>
						<th><div class="text-center">Foto</div></th>
						<th><div class="text-center">Biodata</div></th>							
						<th><div class="text-center">Keterangan</div></th>
					</tr>
				</thead>
				<tbody>
					<?php $i = 1; foreach ($pasien as $key => $value) { ?>
					<tr>
						<td>	
							<div class="text-center"><?=$i?>.</div>
						</td>
						<td>
							<div class="text-center">
							 	<!-- <img src="<?php echo base_url()?>assets/images/users_photo/juragan2.jpg" class="rounded"> -->
							</div>
						</td>
						<td>
							<div class="row">
								<div class="col-2">No. Pasien</div>
								<div class="col-0">:</div>
								<div class="col-9"><?=ucwords($value->nomor_pasien)?></div>
							</div>
							<div class="row">
								<div class="col-2">Nama</div>
								<div class="col-0">:</div>
								<div class="col-9"><?=ucwords($value->nama)?></div>
							</div>
							<div class="row">
								<div class="col-2">Alamat</div>
								<div class="col-0">:</div>
								<div class="col-9"><?php
								echo ucwords("Jalan ".$value->jalan." ");
								if ($value->rt !== '') {
									echo "RT".$value->rt." ";
								}
								if ($value->rw !== '') {
									echo "RW".$value->rw." ";
								}
								if ($value->kelurahan == '013 Lain-lain') {
									if ($value->kelurahan_lain !== NULL AND $value->kelurahan_lain !== "") {
										echo "Kelurahan ".$value->kelurahan_lain." ";
									}else{
										echo " ";
									}
								}else{
									echo "Kelurahan ".$value->kelurahan." ";
								}

								if ($value->kecamatan == 'other') {
									if ($value->kecamatan_lain !== NULL AND $value->kecamatan_lain !== "") {
										echo "Kecamatan ".$value->kecamatan_lain." ";
									}else{
										echo " ";
									}
								}else{
									echo "Kecamatan ".$value->kecamatan." ";
								}

								if ($value->kota == 'other') {
									echo $value->kota_lain;
								}else{
									echo $value->kota;
								}
								
								?></div>
							</div>
							<div class="row">
								<div class="col-2">Pembayaran</div>
								<div class="col-0">:</div>
								<div class="col-9"><?=ucwords($value->pembayaran)?></div>
							</div>
						</td>
						<td>
							<button type="button" class="btn btn-danger">Reset</button>
							<a href="<?=base_url()?>Admin/detail_pasien/<?=$value->id?>" class="btn btn-primary" >Detail</a>
						</td>
					</tr>
					<?php $i++; } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>