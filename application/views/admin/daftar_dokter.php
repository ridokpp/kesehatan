<script type="text/javascript">
	$(document).ready(function() {
    $('#example').DataTable({
    	columnDefs: [ 
            { 
            	orderable: false, 
            	targets: [1,3] 
            },
            {
            	width: "20px",
            	targets: [0]
            },
            {
            	width: "200px",
            	targets: [1]
            },
            {
            	width: "600px",
            	targets: [2]
            }
        ]
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

<h3 class="text-center mt-4">Daftar Dokter</h3>

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
					<tr>
						<td>	
							<div class="text-center">1.</div>
						</td>
						<td>
							<div class="text-center">
							 	<img src="<?php echo base_url()?>assets/images/users_photo/juragan2.jpg" class="rounded">
							</div>
						</td>
						<td>
								<div class="row">
								<div class="col-2">No. SIP</div>
								<div class="col-0">:</div>
								<div class="col-9"><?=ucwords($dokter[0]->sip)?></div>
							</div>
							<div class="row">
								<div class="col-2">Nama</div>
								<div class="col-0">:</div>
								<div class="col-9"><?=ucwords($dokter[0]->nm_lengkap)?></div>
							</div>
							<div class="row">
								<div class="col-2">Alamat</div>
								<div class="col-0">:</div>
								<div class="col-9"><?=ucwords($dokter[0]->alamat)?></div>
							</div>
							<td>
							<button type="button" class="btn btn-danger">Reset</button>
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalDetail">Detail</button>
						</td>
						</td>
					</tr>
				</tbody>
				<tfoot>
		            <tr>
		                <th></th>
		                <th></th>
		                <th></th>
		                <th></th>
		            </tr>
		        </tfoot>
			</table>
			<div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="modalDetailTitle" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
				      	<div class="modal-header">
				        	<h5 class="modal-title" id="modalSuratSakitTitle">Detail Dokter</h5>
				        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          		<span aria-hidden="true">&times;</span>
				        	</button>
				      	</div>
			    		<form id="formSuratSakit" action="<?=base_url()?>Dokter_handler/cetak/suratsakit" target="_blank" method="POST">
					    	<div class="modal-body">
					    		
					    		<div class="form-group row">
					    			<label class="col-4 col-form-label">No. SIP</label>
					    			<div class="input-group col-8">
							    		<input type="input" class="form-control" id="sip" name="sip" value="<?=$dokter[0]->sip?>">
									</div>
					    		</div>
								<div class="form-group row">
						    		<label for="inputEmail3" class="col-sm-4 col-form-label">NIK</label>
						    		<div class="input-group-prepend col-sm-8">
						      		<input type="input" class="form-control" id="nik" name="nik" value="<?=$dokter[0]->nik?>">
						   			</div>
								</div>
					    		<div class="form-group row">
								    <label class="col-4 col-form-label">Nama</label>
								    <div class="input-group col-8">
								      	<input type="input" class="form-control" id="nama" name="nama" value="<?=$dokter[0]->nm_lengkap?>">
								    </div>
								</div>
								<div class="form-group row">
						    		<label for="inputEmail3" class="col-sm-4 col-form-label">Alamat</label>
						    		<div class="input-group-prepend col-sm-8">
						      			<input type="input" class="form-control" name="alamat" id="alamat" value="<?=$dokter[0]->alamat?>">
						   			</div>
								</div>
								<div class="form-group row">
						    		<label for="inputEmail3" class="col-sm-4 col-form-label">jenis kelamin</label>
						    		<div class="input-group-prepend col-sm-8">
						      			<input type="input" class="form-control" name="jkelamin" id="jkelamin" value="<?=$dokter[0]->jkelamin?>">
						   			</div>
								</div>
															
						    </div>
					    	<div class="modal-footer">
					    		<button type="submit" class="btn btn-primary btn-sm">Save</button>
					    	</div>
				    	</form>
				    </div>
				</div>
			</div>
		</div>
	</div>
</div>