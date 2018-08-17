 <script type="text/javascript">
    <?php date_default_timezone_set('Asia/Jakarta'); ?>
    var serverTime = new Date(<?php print date('Y, m, d, H, i, s, 0'); ?>);
    var clientTime = new Date();
    var Diff = serverTime.getTime() - clientTime.getTime();    
    function displayServerTime(){
        var clientTime = new Date();
        var time = new Date(clientTime.getTime() + Diff);
        var sh = time.getHours().toString();
        var sm = time.getMinutes().toString();
        var ss = time.getSeconds().toString();
        document.getElementById("clock").innerHTML = (sh.length==1?"0"+sh:sh) + ":" + (sm.length==1?"0"+sm:sm) + ":" + (ss.length==1?"0"+ss:ss);
    }	
</script>

<h3 class="text-center mt-3">Pemeriksaan Dokter</h3>

<div class="container">
	<div class="row justify-content-md-center">
		<div class="col col-lg-1">
	     	<h5><span class="badge badge-secondary">RF</span></h5>
	    </div>
	    <div class="col-md-auto">
	      	Nomor ID Pasien 
	    </div>
	</div>

	<div class="row">
		<div class="col" >
			<h5><?php
				$hari = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
				$bulan = array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
				echo $hari[date("w")].", ".date("j")." ".$bulan[date("n")]." ".date("Y"); ?></h5>	
		</div>

		<div class="col-1">
			<body onload="setInterval('displayServerTime()', 1000);">
				<h5><span id="clock"><?php echo date('H:i:s'); ?></span></h5>
			</body>
		</div>
	</div>

	<div class="row">
		<div class="col border rounded">

			<h5 class="text-center mt-3">Data Pasien</h5>

			<div class="row mt-2">
				<div class="col-3">
					Nama 
				</div>
				<div class="col-1">
					:
				</div>
				<div class="col">
					<?=$pasien[0]->nama?>
				</div>
			</div>

			<div class="row mt-2">
				<div class="col-3">
					NIK
				</div>
				<div class="col-1">
					:
				</div>
				<div class="col">
					<?=$pasien[0]->nik?>
				</div>
			</div>

			<div class="row mt-2">
				<div class="col-3">
					TTL 
				</div>
				<div class="col-1">
					:
				</div>
				<div class="col">
					<?=$pasien[0]->tmp_lahir.", ".tgl_indo($pasien[0]->tgl_lahir)?>
				</div>
			</div>

			<div class="row mt-2">
				<div class="col-3">
					Alamat
				</div>
				<div class="col-1">
					:
				</div>
				<div class="col">
					<?=$pasien[0]->alamat?>
				</div>
			</div>

			<div class="row mt-2">
				<div class="col-3">
					Jenis Kelamin
				</div>
				<div class="col-1">
					:
				</div>
				<div class="col">
					<?=$pasien[0]->jkelamin?>
				</div>
			</div>

			<div class="row mt-2">
				<div class="col-3">
					Pekerjaan 
				</div>
				<div class="col-1">
					:
				</div>
				<div class="col">
					<?=$pasien[0]->pekerjaan?>
				</div>
			</div>
		</div>

		<div class="col border rounded">
			<h5 class="text-center mt-3">Objektif</h5>

			<div class="row mt-2">
				<div class="col-4">
					Tinggi Badan
				</div>
				<div class="col-1">
					:
				</div>
				<div class="col">
					<?=$objek[0]->tb?> cm
				</div>
			</div>

			<div class="row mt-2">
				<div class="col-4">
					Berat Badan
				</div>
				<div class="col-1">
					:
				</div>
				<div class="col">
					<?=$objek[0]->bb?> kg
				</div>
			</div>

			<div class="row mt-2">
				<div class="col-4">
					Tekanan Darah
				</div>
				<div class="col-1">
					:
				</div>
				<div class="col">
					<?=$objek[0]->td1?> / <?=$objek[0]->td2?>
				</div>
			</div>

			<div class="row mt-2">
				<div class="col-4">
					Nadi
				</div>
				<div class="col-1">
					:
				</div>
				<div class="col">
					<?=$objek[0]->N?> rpm
				</div>
			</div>

			<div class="row mt-2">
				<div class="col-4">
					Respiratory R.
				</div>
				<div class="col-1">
					:
				</div>
				<div class="col">
					<?=$objek[0]->RR?> rpm
				</div>
			</div>

			<div class="row mt-2">
				<div class="col-4">
					Temperature Ax.
				</div>
				<div class="col-1">
					:
				</div>
				<div class="col">
					<?=$objek[0]->TAx?> &deg;C
				</div>
			</div>

			<div class="form-group row">

				<label class="col-4 col-form-label">Head To Toe</label>
				<div class="input-group col-8">
				    <textarea class="form-control" id="" name="text_headtotoe"></textarea>
			 	</div>
			</div>
		</div>
	</div>

	<div class="row mb-3">
		<div class="col-4">
			<h5 class="text-center mt-3">Subjektif</h5>
			<textarea class="form-control" aria-label="With textarea" required="" placeholder="Subjektif" name="subjektif"></textarea>
		</div>
	
		<div class="col-4">
			<h5 class="text-center mt-3">Assessment</h5>
			<textarea class="form-control" aria-label="With textarea" required="" placeholder="Assessment" name="assessment"></textarea>
		</div>

		<div class="col-4">
			<h5 class="text-center mt-3">Planing</h5>
			<textarea class="form-control" aria-label="With textarea" required="" placeholder="Planing" name="planning"></textarea>
		</div>
	</div>
<style type="text/css">
	body .modal {
	    /* new custom width */
	    /*width: 1300px;*/
	    /* must be half of the width, minus scrollbar on the left (30px) */
	    /*margin-left: -150px;*/
	    /*overflow-y: hidden;*/
	}
	.modal-open .modal{
		/*overflow-y: hidden;*/
	}
</style>
	<div class="row">

		<div class="col">
			<button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#exampleModalCenter">SURAT SAKIT</button>
			
			<!-- SURAT SAKIT -->
			<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
				      	<div class="modal-header">
				        	<h5 class="modal-title" id="exampleModalCenterTitle">Surat Sakit</h5>
				        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          		<span aria-hidden="true">&times;</span>
				        	</button>
				      	</div>

				    	<div class="modal-body">
				    		<div class="form-group row">
				    			<label class="col-4 col-form-label">Alasan</label>
				    			<div class="input-group col-8">
						    		<select class="custom-select">
										<option value="1">Sakit</option>
										<option value="2">Pelakuan Khusus</option>
									</select>
								</div>
				    		</div>
				    		<div class="form-group row">
							    <label class="col-4 col-form-label">Selama</label>
							    <div class="input-group col-8">
							      	<input type="number" class="form-control" id="" name="" placeholder="Hari" required="">
							    	<div class="input-group-append">
							          	<div class="input-group-text">Hari</div>
						    		</div>
							    </div>
							</div>

							<div class="form-group row">
					    		<label for="inputEmail3" class="col-sm-4 col-form-label">Tanggal Awal</label>
					    		<div class="input-group-prepend col-sm-8">
					      			<input type="date" class="form-control" name="tanggal_lahir" required="">
					   			</div>
							</div>

							<div class="form-group row">
					    		<label for="inputEmail3" class="col-sm-4 col-form-label">Tanggal Akhir</label>
					    		<div class="input-group-prepend col-sm-8">
					      			<input type="date" class="form-control" name="tanggal_lahir" required="">
					   			</div>
							</div>
					    </div>

				    	<div class="modal-footer">
				    		<button type="button" class="btn btn-primary">Cetak</button>
				    	</div>

				    </div>
				</div>
			</div>
			<!-- END SURAT SAKIT -->

		</div>

		<div class="col">
			<button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#modalsuratsehat">SURAT SEHAT</button>
			
			<!-- SURAT SEHAT -->
			<div class="modal fade" id="modalsuratsehat" tabindex="-1" role="dialog" aria-labelledby="modalsuratsehatTitle" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">

				      	<div class="modal-header">
				        	<h5 class="modal-title" id="modalsuratsehat">Surat Sehat</h5>
				        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          		<span aria-hidden="true">&times;</span>
				        	</button>
				      	</div>

				    	<div class="modal-body">
				    	<label class="col-6 col-form-label"><strong>Tes Buta Warna</strong></label>
				    	<div class="custom-control custom-radio">
	 							<input type="radio" class="custom-control-input" id="defaultGroupExample1" name="groupOfDefaultRadios">
	  							<label class="custom-control-label" for="defaultGroupExample1">Ya</label>
						</div>

						<!-- Group of default radios - option 2 -->
						<div class="custom-control custom-radio">
	  						<input type="radio" class="custom-control-input" id="defaultGroupExample2" name="groupOfDefaultRadios" checked>
	  						<label class="custom-control-label" for="defaultGroupExample2">Tidak</label>
						</div>

						<!-- Group of default radios - option 3 -->
						<div class="custom-control custom-radio">
							  <input type="radio" class="custom-control-input" id="defaultGroupExample3" name="groupOfDefaultRadios">
							  <label class="custom-control-label" for="defaultGroupExample3">Parsial</label>
						</div>
					</div>
					<div class="col-10">
						
						<h5 class="col-6 col-form-label"><strong>Keperluan</strong></h5>
						<textarea class="form-control" aria-label="With textarea" required=""></textarea>

					</div>
				    	<div class="modal-footer">
				    		<button type="button" class="btn btn-primary">Cetak</button>
				    	</div>

				    </div>
				</div>
			</div>
			<!-- END SURAT SEHAT -->

		</div>
		<div class="col">
			<button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#modalrujukan">RUJUKAN</button>
			
			<!-- SURAT RUJUKAN -->
			<div class="modal fade" id="modalrujukan" tabindex="-1" role="dialog" aria-labelledby="modalrujukanTitle" aria-hidden="true" >
				<div class="modal-dialog modal-dialog-centered" role="document" >
					<div class="modal-content">
				      	<div class="modal-header">
				        	<h5 class="modal-title" id="modalrujukanTitle">Surat Rujukan</h5>
				        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          		<span aria-hidden="true">&times;</span>
				        	</button>
				      	</div>
				    	<div class="modal-body" >
				    		<div class="form-group row">
						    	<label class="col-sm-2 col-form-label">Nama</label>
						    	<div class="input-group-prepend col">
						      		<input type="text" class="form-control" id="" name="nama_lengkap" placeholder="Nama Lengkap" required="">
						    	</div>
							</div>
							<div class="form-group row">
							    <label class="col-sm-2 col-form-label">NIK</label>
							    <div class="input-group-prepend col">
							      	<input type="text" class="form-control" id="" name="nik" placeholder="Nomor Induk Kependudukan" required="">
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
							   			<label for="inputEmail3" class="col-sm-2 col-form-label">Tempat</label>
							  		  	<div class="input-group-prepend col">
							      			<input type="text" class="form-control" id="" name="tempat_lahir" placeholder="Tempat Lahir" required="">
							    		</div>
									</div>
								</div>
							</div>
							<div class="row">
						    	<div class="col">
							     	<div class="form-group row">
							    		<label for="inputEmail3" class="col-sm-2 col-form-label">Tanggal</label>
							    		<div class="input-group-prepend col">
							      			<input type="date" class="form-control" name="tanggal_lahir" required="">
							   			</div>
									</div>
								</div>
						    </div>
						    <div class="form-group row">
							    <label class="col-sm-2 col-form-label">Gender</label>
							    <div class="input-group-prepend col">
							      	<select class="form-control" id="state_id" name="jenis_kelamin" required="">
										<option value="Laki-laki">Laki - Laki</option>
										<option value="Perempuan">Perempuan</option>
									</select>	
							    </div>
							</div>
						    <div class="form-group row">
							    <label class="col-sm-2 col-form-label">Pekerjaan</label>
							    <div class="input-group-prepend col">
							      	<input type="text" class="form-control" id="" name="pekerjaan" placeholder="Pekerjaan" required="">
							    </div>
							</div>
						    <div class="form-group row">
							    <label class="col-sm-2 col-form-label">Alamat</label>
							    <div class="input-group-prepend col">
							      	<input type="text" class="form-control" id="" name="alamat" placeholder="Alamat" required="">
							    </div>
							</div>
						    <div class="form-group row">
								<label class="col-sm-2 col-form-label">Keluhan</label>
							    <div class="input-group-prepend col">
								<textarea class="form-control" aria-label="With textarea" required="">Keluhan</textarea>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label">GCS</label>
							    <div class="input-group-prepend col-sm-2">
								<input type="text" class="form-control" id="" name="gcs" placeholder="E" required="">
								</div>
								<div class="input-group-prepend col-sm-2">
								<input type="text" class="form-control" id="" name="gcs" placeholder="V" required="">
								</div>
								<div class="input-group-prepend col-sm-2">
								<input type="text" class="form-control" id="" name="gcs" placeholder="M" required="">
								</div>							
							</div>
						 	<div class="form-group row">
						 		<label class="col-sm-1 col-form-label">CM</label>
								<div class="input-group-prepend col-sm-1">
									<input type="checkbox" class="form-control" id="" name="CM" placeholder="M" required="">
								</div>
								<label class="col-sm-1 col-form-label">Iteris</label>
								<div class="input-group-prepend col-sm-1">
									<input type="checkbox" class="form-control" id="" name="Iteris" placeholder="M" required="">
								</div>
								<label class="col-sm-2 col-form-label">delirium</label>
								<div class="input-group-prepend col-sm-1">
									<input type="checkbox" class="form-control" id="" name="delirium" placeholder="M" required="">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-1 col-form-label">somnolen</label>
								<div class="input-group-prepend col-sm-3">
									<input type="checkbox" class="form-control" id="" name="somnolen" placeholder="M" required="">
								</div>
								<label class="col-sm-1 col-form-label">Stupor</label>
								<div class="input-group-prepend col-sm-2">
									<input type="checkbox" class="form-control" id="" name="Stupor" placeholder="M" required="">
								</div>
								<label class="col-sm-1 col-form-label">Coma</label>
								<div class="input-group-prepend col-sm-2">
									<input type="checkbox" class="form-control" id="" name="Coma" placeholder="M" required="">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label">TB</label>
							    <div class="input-group-prepend col-sm-2">
							      	<input type="text" class="form-control" id="" name="tb" placeholder="TB" required="">cm
							    </div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label">BB</label>
							    <div class="input-group-prepend col-sm-2">
							      	<input type="text" class="form-control" id="" name="bb" placeholder="BB" required="">kg
							    </div>
							</div>

							<div class="form-group row">
								<label class="col-sm-4 col-form-label">Tekanan Darah</label>
							    <div class="input-group-prepend col-sm-2">
							      	<input type="text" class="form-control" id="" name="tekanan_darah" placeholder="" required="">
							      	&nbsp;/&nbsp;
							      	<input type="text" class="form-control" id="" name="tekanan_darah" placeholder="" required="">mmHg
							    </div>
							</div>
							
							<div class="form-group row">
								<label class="col-sm-2 col-form-label">Nadi</label>
							    <div class="input-group-prepend col-sm-2">
							      	<input type="text" class="form-control" id="" name="nadi" placeholder="" required="">rpm
							    </div>
							</div>

							<div class="form-group row">
								<label class="col-sm-3 col-form-label">Respiratory R.</label>
							    <div class="input-group-prepend col-sm-2">
							      	<input type="text" class="form-control" id="" name="respiratory" placeholder="" required="">rpm
							    </div>
							</div>

							<div class="form-group row">
								<label class="col-sm-3 col-form-label">TᵒAxilla</label>
							    <div class="input-group-prepend col-sm-2">
							      	<input type="text" class="form-control" id="" name="respiratory" placeholder="" required="">ᵒc
							    </div>
							</div>
							Head to Toe
							<br>
							Kepala :
							<div class="form-group row">
							 	<label class="col-sm-1 col-form-label">Anemis</label>
							 	<div class="input-group-prepend col-sm-3">
								<input type="checkbox" class="form-control" id="" name="anemis_kiri" placeholder="" required="">
								</div>/
							 	 <div class="input-group-prepend col-sm-3">
								<input type="checkbox" class="form-control" id="" name="anemis_kiri" placeholder="" required="">
								</div>
							</div>

							<div class="form-group row">
							 	<label class="col-sm-1 col-form-label">Ikterik</label>
							 	<div class="input-group-prepend col-sm-3">
								<input type="checkbox" class="form-control" id="" name="anemis_kiri" placeholder="" required="">
								</div>/
							 	 <div class="input-group-prepend col-sm-3">
								<input type="checkbox" class="form-control" id="" name="anemis_kiri" placeholder="" required="">
								</div>
							</div>	

							<div class="form-group row">
							 	<label class="col-sm-1 col-form-label">Cianosis</label>
							 	<div class="input-group-prepend col-sm-3">
								<input type="checkbox" class="form-control" id="" name="anemis_kiri" placeholder="" required="">
								</div>/
							 	 <div class="input-group-prepend col-sm-3">
								<input type="checkbox" class="form-control" id="" name="anemis_kiri" placeholder="" required="">
								</div>
							</div>
							
							<div class="form-group row">
							 	<label class="col-sm-1 col-form-label">Deformitas</label>
							 	<div class="input-group-prepend col-sm-3">
								<input type="checkbox" class="form-control" id="" name="anemis_kiri" placeholder="" required="">
								</div>/
							 	 <div class="input-group-prepend col-sm-3">
								<input type="checkbox" class="form-control" id="" name="anemis_kiri" placeholder="" required="">
								</div>
							</div>

							<div class="form-group row">
							 	<label class="col-sm-1 col-form-label">Refleks Cahaya</label>
							 	<div class="input-group-prepend col-sm-3">
								<input type="checkbox" class="form-control" id="" name="anemis_kiri" placeholder="" required="">
								</div>/
							 	 <div class="input-group-prepend col-sm-3">
								<input type="checkbox" class="form-control" id="" name="anemis_kiri" placeholder="" required="">
								</div>
							</div>

							<div class="form-group row">
							 	<label class="col-sm-1 col-form-label">isokor</label>
							 	<div class="input-group-prepend col-sm-3">
								<input type="radio" class="form-control" id="" name="anemis_kiri" placeholder="" required="">
								</div>
							 	<label class="col-sm-1 col-form-label">anisokor</label>
							 	 <div class="input-group-prepend col-sm-3">
								<input type="radio" class="form-control" id="" name="anemis_kiri" placeholder="" required="">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label">Keterangan Tambahan</label>
								<div class="input-group-prepend col">
								<textarea class="form-control" aria-label="With textarea" required=""></textarea>
								</div>
							</div>

							Thorak
							
							<div class="form-group row">
								<label class="col-sm-1 col-form-label">Paru</label>
								<label class="col-sm-1 col-form-label">:</label>
							 	<label class="col-sm-1 col-form-label">Simetris</label>
							 	<div class="input-group-prepend col-sm-3">
								<input type="radio" class="form-control" id="" name="anemis_kiri" placeholder="" required="">
								</div>
							 	<label class="col-sm-1 col-form-label">Asimetris</label>
							 	 <div class="input-group-prepend col-sm-3">
								<input type="radio" class="form-control" id="" name="anemis_kiri" placeholder="" required="">
								</div>
							</div>
							<div class="form-group row">
							 	<label class="col-sm-1 col-form-label">Wheezing</label>
							 	<div class="input-group-prepend col-sm-3">
								<input type="checkbox" class="form-control" id="" name="anemis_kiri" placeholder="" required="">
								</div>/
							 	 <div class="input-group-prepend col-sm-3">
								<input type="checkbox" class="form-control" id="" name="anemis_kiri" placeholder="" required="">
								</div>						
							</div>

							<div class="form-group row">
							 	<label class="col-sm-1 col-form-label">Ronkhi</label>
							 	<div class="input-group-prepend col-sm-3">
								<input type="checkbox" class="form-control" id="" name="anemis_kiri" placeholder="" required="">
								</div>/
							 	 <div class="input-group-prepend col-sm-3">
								<input type="checkbox" class="form-control" id="" name="anemis_kiri" placeholder="" required="">
								</div>						
							</div>

							<div class="form-group row">
							 	<label class="col-sm-1 col-form-label">Vesikuler</label>
							 	<div class="input-group-prepend col-sm-3">
								<input type="checkbox" class="form-control" id="" name="anemis_kiri" placeholder="" required="">
								</div>/
							 	 <div class="input-group-prepend col-sm-3">
								<input type="checkbox" class="form-control" id="" name="anemis_kiri" placeholder="" required="">
								</div>						
							</div>

							<div class="form-group row">
								<label class="col-sm-2 col-form-label">Jantung</label>
								<label class="col-sm-1 col-form-label">:</label>
							 	<label class="col-sm-1 col-form-label">Tampak</label>
							 	<div class="input-group-prepend col-sm-3">
								<input type="radio" class="form-control" id="" name="anemis_kiri" placeholder="" required="">
								</div>
							 	<label class="col-sm-1 col-form-label">Tak Tampak</label>
							 	 <div class="input-group-prepend col-sm-3">
								<input type="radio" class="form-control" id="" name="anemis_kiri" placeholder="" required="">
								</div>
							</div>

							<div class="form-group row">
								<label class="col-sm-2 col-form-label">S1 / S2</label>
							 	<label class="col-sm-1 col-form-label">Reguler</label>
							 	<div class="input-group-prepend col-sm-3">
								<input type="radio" class="form-control" id="" name="tampak" placeholder="" required="">
								</div>
							 	<label class="col-sm-1 col-form-label">Irreguler</label>
							 	 <div class="input-group-prepend col-sm-3">
								<input type="radio" class="form-control" id="" name="tak_tampak" placeholder="" required="">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label">Suara Tambahan</label>
								<div class="input-group-prepend col">
								<input type="text" class="form-control" id="" name="s_tambahan" placeholder="Suara Tambahan" required="">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label">Keterangan Tambahan</label>
								<div class="input-group-prepend col">
								<textarea class="form-control" aria-label="With textarea" required=""></textarea>
								</div>
							</div>	

							<div class="form-group row">
								<label class="col-sm-2 col-form-label">Abdomen</label>
								<label class="col-sm-1 col-form-label">:</label>
							 	<label class="col-sm-1 col-form-label">BU Normal</label>
							 	<div class="input-group-prepend col-sm-3">
								<input type="radio" class="form-control" id="" name="anemis_kiri" placeholder="" required="">
								</div>
							 	<label class="col-sm-1 col-form-label">Meningkat</label>
							 	 <div class="input-group-prepend col-sm-3">
								<input type="radio" class="form-control" id="" name="anemis_kiri" placeholder="" required="">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-1 col-form-label">Menurun</label>
							 	<div class="input-group-prepend col-sm-3">
								<input type="radio" class="form-control" id="" name="anemis_kiri" placeholder="" required="">
								</div>
							 	<label class="col-sm-1 col-form-label">Negatif</label>
							 	 <div class="input-group-prepend col-sm-3">
								<input type="radio" class="form-control" id="" name="anemis_kiri" placeholder="" required="">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-3 col-form-label">Nyeri Tekan</label>
							 	<div class="input-group-prepend col-sm-3">
								<input type="checkbox" class="form-control" id="" name="anemis_kiri" placeholder="" required="">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-3 col-form-label">Hepatomegali</label>
							    <div class="input-group-prepend col-sm-2">
							      	<input type="text" class="form-control" id="" name="nadi" placeholder="" required="">
							    </div>
							</div>
							<div class="form-group row">
								<label class="col-sm-3 col-form-label">Spleenomegali</label>
							    <div class="input-group-prepend col-sm-2">
							      	<input type="text" class="form-control" id="" name="nadi" placeholder="" required="">
							    </div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label">Keterangan Tambahan</label>
								<div class="input-group-prepend col">
								<textarea class="form-control" aria-label="With textarea" required=""></textarea>
								</div>
							</div>	
							<div class="form-group row">
								<label class="col-sm-3 col-form-label">Lain-lain</label>
								<div class="input-group-prepend col">
								<input type="text" class="form-control" id="" name="lain_lain" placeholder="Lain-lain" required="">
								</div>
							</div>	
							<div class="form-group row">
								<label class="col-sm-3 col-form-label">Diagnosa</label>
								<div class="input-group-prepend col">
								<input type="text" class="form-control" id="" name="diagnosa" placeholder="Diagnosa" required="">
								</div>
							</div>	
							<div class="form-group row">
								<label class="col-sm-3 col-form-label">Terapi</label>
								<div class="input-group-prepend col">/R
								<input type="text" class="form-control" id="" name="terapi" placeholder="..." required="">
								</div>
							</div>	
							<div class="form-group row">
							<label class="col-sm-3 col-form-label"></label>
								<div class="input-group-prepend col">/R
								<input type="text" class="form-control" id="" name="terapi" placeholder="..." required="">
								</div>
							</div>	
							<div class="form-group row">
							<label class="col-sm-3 col-form-label"></label>
								<div class="input-group-prepend col">/R
								<input type="text" class="form-control" id="" name="terapi" placeholder="..." required="">
								</div>
							</div>
					    	<div class="modal-footer">
					    		<button type="button" class="btn btn-primary">Cetak</button>
					    	</div>
				    	</div>
					</div>
				</div>
				<!-- SURAT RUJUKAN-->
			</div>
		</div>
		<div class="col">
			<input type="submit" class="btn btn-primary btn-block" value="SUBMIT">
		</div>
	</div>
</div>