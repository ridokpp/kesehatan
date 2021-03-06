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

    $(document).ready(function() {

    $('.js-data-example-ajax').select2({
    		placeholder: "Pilih Sesuai ICD 10",
		ajax: {
			url: '<?=base_url()?>Dokter_handler/cari_icd/',
		    dataType: 'json',
		    delay: 250,
			data: function (term, page) {
				return {
					term: term, // search term
					page: 10
				};
			},
			processResults: function (data, page) {
				console.log(data);
				return {
					results: data
				};
			},
			cache: true
		},
		escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
		minimumInputLength: 1,
		});
	});	


</script>

<h3 class="text-center mt-3">Pemeriksaan Dokter</h3>

<div class="container">
	<div class="row justify-content-md-center">
		<div class="col col-lg-1">
	     	<h5><span class="badge <?=($pasien[0]->pembayaran != 'rf' OR $pasien[0]->pembayaran != 'RF') ? 'badge-success' : 'badge-secondary' ?>"><?=$pasien[0]->pembayaran?></span></h5>
	    </div>
	    <div class="col-md-auto">
	      	<?= $pasien[0]->nomor_pasien?>
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
		<div class="col">
			<h5 class="text-center mt-3">Subjektif</h5>
			<textarea class="form-control" aria-label="With textarea" required="" placeholder="Subjektif" name="subjektif"></textarea>
		</div>

		<div class="col">
			<h5 class="text-center mt-3">Planing</h5>
			<textarea class="form-control" id="planning" aria-label="With textarea" required="" placeholder="Planing" name="planning"></textarea>
		</div>
	</div>

	<div class="row"><div class="col"><h5 class="text-center mt-3">Assesment</h5></div></div>

	<div class="row mb-3">	
		<div class="col-4">
			<h6 class="text-center">Primary</h6>
			<form action="<?=base_url().'Petugas_handler/redirector'?>" method="GET">
			 	<div class="form-group row">
			      	<select class="js-data-example-ajax" id="primary" name="states[]" multiple="multiple" style="width: 99%">
					</select>
				</div> 
			</form>
		</div>
		<div class="col-4">
			<h6 class="text-center">Sekunder</h6>
			<form action="<?=base_url().'Petugas_handler/redirector'?>" method="GET">
			 	<div class="form-group row">
			      	<select class="js-data-example-ajax" id="sekunder" name="states[]" multiple="multiple" style="width: 99%">
					</select>
				</div> 
			</form>
		</div>
		<div class="col-4">
			<h6 class="text-center">Lain-lain</h6>
			<form action="<?=base_url().'Petugas_handler/redirector'?>" method="GET">
			 	<div class="form-group row">
			      	<select class="js-data-example-ajax" id="lain" name="states[]" multiple="multiple" style="width: 99%">
					</select>
				</div> 
			</form>
		</div>
	</div>

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
			    		<form id="formSuratSakit" target="_blank" method="POST" action="<?=base_url()?>Dokter_handler/cetak/suratsakit">
					    	<div class="modal-body">
					    		<input type="hidden" name="nomor_pasien" value="<?=$pasien[0]->nomor_pasien?>">
					    		<div class="form-group row">
					    			<label class="col-4 col-form-label">Alasan</label>
					    			<div class="input-group col-8">
							    		<select class="custom-select" id="alasan" name="alasan" required="">
											<option value="1">Istirahat Sakit</option>
											<option value="2">Pelakuan Khusus</option>
										</select>
									</div>
					    		</div>
								<div class="form-group row">
						    		<label for="inputEmail3" class="col-sm-4 col-form-label">Tanggal Awal</label>
						    		<div class="input-group-prepend col-sm-8">
						      			<input type="date" class="form-control" id="tanggal_awal" name="tanggal_awal" required="" value="<?=date("Y-m-d")?>" readonly="">
						   			</div>
								</div>
					    		<div class="form-group row">
								    <label class="col-4 col-form-label">Selama</label>
								    <div class="input-group col-8">
								      	<input type="number" class="form-control" id="selama" name="selama" placeholder="Angka" >
								    	<div class="input-group-append">
								          	<!-- <div class="input-group-text"> -->
								          		<select class="custom-select" name="selama_satuan" id="selama_satuan" onchange="updateTglAkhir()" required="">
								          			<option selected="" disabled="">Satuan</option>
								          			<option value="hari">Hari</option>
								          			<option value="minggu">Minggu</option>
								          			<option value="bulan">Bulan</option>
								          		</select>
								          	<!-- </div> -->
								          	<!-- <div class="input-group-text">Hari</div> -->
							    		</div>
								    </div>
								</div>
								<div class="form-group row">
						    		<label for="inputEmail3" class="col-sm-4 col-form-label">Tanggal Akhir</label>
						    		<div class="input-group-prepend col-sm-8">
						      			<input type="date" class="form-control" name="tanggal_akhir" id="tanggal_akhir" required="" readonly="">
						   			</div>
								</div>
						    </div>
					    	<div class="modal-footer">
					    		<button type="submit" class="btn btn-primary btn-sm" onclick="cetakSuratSakit()">CETAK</button>
					    	</div>
				    	</form>
				    </div>
				</div>
			</div>
			<script type="text/javascript">

				function updateTglAkhir() {
					// function untuk update tanggal akhir
					var tanggal_awal 	= document.getElementById("tanggal_awal").value;
					var jumlah			= document.getElementById("selama").value;
					var date 			= new Date(tanggal_awal);
					var newdate			= new Date(date);
					var selama_satuan 	= document.getElementById("selama_satuan").value;
					
					// bagian yang ngeset tanggal terakhir berdsarkan satuan HARI|MINGGU|BULAN yang dipilih
					if (selama_satuan == 'hari') {
						newdate.setDate(newdate.getDate() + parseInt(jumlah));
					}else if (selama_satuan == 'minggu') {
						newdate.setDate(newdate.getDate() + (parseInt(jumlah) * 7));
					}else if (selama_satuan == 'bulan') {
						newdate.setMonth(newdate.getMonth() + parseInt(jumlah));
					}

					// finishing set tanggal terakhir untuk ditampilkan
					var dd 	= newdate.getDate();
					var mm 	= newdate.getMonth() + 1;
					var y 	= newdate.getFullYear();
					if(dd<10){
				        dd='0'+dd
				    } 
				    if(mm<10){
				        mm='0'+mm
				    }
					document.getElementById("tanggal_akhir").value = y+'-'+mm+'-'+dd;
				}

				function cetakSuratSakit(){
					document.getElementById('planning').innerHTML='Surat Sakit, ';
				}
			</script>
			<!-- END SURAT SAKIT -->

		</div>

		<div class="col">
			<button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#modalsuratsehat">SURAT SEHAT</button>
			
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

				    	<form action="<?=base_url()?>Dokter_handler/cetak/suratsehat" target="_blank" method= "POST">
					    	<div class="modal-body">
								<input type="hidden" name="nomor_pasien" value="<?=$pasien[0]->nomor_pasien?>">
						    	<label class="col-6 col-form-label"><strong>Tes Buta Warna</strong></label>
						    	<div class="custom-control custom-radio">
		 							<input type="radio" class="custom-control-input" id="defaultGroupExample1" name="tes_buta_warna" value="Ya">
		  							<label class="custom-control-label" for="defaultGroupExample1">Ya</label>
								</div>

								<!-- Group of default radios - option 2 -->
								<div class="custom-control custom-radio">
			  						<input type="radio" class="custom-control-input" id="defaultGroupExample2" name="tes_buta_warna" value="Tidak" checked>
			  						<label class="custom-control-label" for="defaultGroupExample2">Tidak</label>
								</div>

								<!-- Group of default radios - option 3 -->
								<div class="custom-control custom-radio">
									  <input type="radio" class="custom-control-input" id="defaultGroupExample3" name="tes_buta_warna" value="Parsial">
									  <label class="custom-control-label" for="defaultGroupExample3">Parsial</label>
								</div>
								<h5 class="col-6 col-form-label"><strong>Keperluan</strong></h5>
								<textarea class="form-control" aria-label="With textarea" name="keperluan" required=""></textarea>

							</div>
					    	<div class="modal-footer">
					    		<button type="submit" class="btn btn-primary" onclick="cetakSuratSehat()">Cetak</button>
					    	</div>
			    		</form>
					</div>
				</div>
			</div>
			<script type="text/javascript">
				function cetakSuratSehat(){
					document.getElementById('planning').innerHTML='Surat Sehat, ';
				}
			</script>
			<!-- END SURAT SEHAT -->

		</div>
		<div class="col">
			<button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#modalrujukan" onclick="getassesment()">RUJUKAN</button>
			
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
				      	<form action="<?=base_url()?>Dokter_handler/cetak/suratrujukan" target="_blank" method= "POST">
					    	<div class="modal-body" >
								<input type="hidden" class="form-control" value="<?=$pasien[0]->nomor_pasien?>" name="kd_pasien" readonly="">
								<input type="hidden" class="form-control" value="<?=$pasien[0]->nama?>" name="nama" readonly="">
							    <div class="form-group row">
									<label class="col-sm-2 col-form-label">Keluhan</label>
								    <div class="input-group-prepend col">
									<textarea class="form-control" aria-label="With textarea" name="keluhan" required="">Keluhan</textarea>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-sm-2 col-form-label">GCS</label>
								    <div class="input-group-prepend col">
									<input type="text" class="form-control" id="" name="GCS_E" placeholder="E" required="">
									</div>
									<div class="input-group-prepend col">
									<input type="text" class="form-control" id="" name="GCS_V" placeholder="V" required="">
									</div>
									<div class="input-group-prepend col">
									<input type="text" class="form-control" id="" name="GCS_M" placeholder="M" required="">
									</div>							
								</div>
								<fieldset class="form-group">
								    <div class="row">
								    <label class="col-sm-2"></label>
								      <div class="col">
								        <div class="form-check">
								          <input class="form-check-input" type="checkbox" name="GCS_opsi" value="CM">
								          <label class="form-check-label">
								            CM
								          </label>
								        </div>
								        <div class="form-check">
								          <input class="form-check-input" type="checkbox" name="GCS_opsi" value="Iteris">
								          <label class="form-check-label">
								            Iteris
								          </label>
								        </div>
								       </div>
								       <div class="col">
								        <div class="form-check">
								          <input class="form-check-input" type="checkbox" name="GCS_opsi" value="Delirium">
								          <label class="form-check-label">
								            Delirium
								          </label>
								        </div>
								        <div class="form-check">
								          <input class="form-check-input" type="checkbox" name="GCS_opsi" value="Somnolen">
								          <label class="form-check-label">
								            Somnolen
								          </label>
								        </div>
								       </div>
								       <div class="col">
								        <div class="form-check">
								          <input class="form-check-input" type="checkbox" name="GCS_opsi" value="Stupor">
								          <label class="form-check-label">
								            Stupor
								          </label>
								        </div>
								        <div class="form-check">
								          <input class="form-check-input" type="checkbox" name="GCS_opsi" value="Coma">
								          <label class="form-check-label">
								            Coma
								          </label>
								        </div>
								       </div>
								    </div>
								</fieldset>
						      	<input type="hidden" class="form-control" value="<?=$objek[0]->tb?>" id="" name="tb" placeholder="TB"  readonly="">
						      	<input type="hidden" class="form-control" value="<?=$objek[0]->bb?>" id="" name="bb" placeholder="BB"  readonly="">
						      	<input type="hidden" class="form-control" value="<?=$objek[0]->td1?>" id="" name="tekanan_darah" placeholder=""  readonly="">
								<input type="hidden" class="form-control" value="<?=$objek[0]->td2?>" id="" name="tekanan_darah" placeholder=""  readonly="">
						      	<input type="hidden" class="form-control" value="<?=$objek[0]->N?>" id="" name="nadi" placeholder=""  readonly="">
					      		<input type="hidden" class="form-control" value="<?=$objek[0]->RR?>" id="" name="respiratory" placeholder=""  readonly="">
					      		<input type="hidden" class="form-control" value="<?=$objek[0]->TAx?>" id="" name="respiratory" placeholder=""  readonly="">
								<hr></hr>
								<center><h4>Head to Toe</h4></center>
								<hr></hr>
								<div class="ml-1">
									<div class="row ml-0">
										<strong>Kepala :</strong>
									</div>
									<div class="form-group row">
										<div class="col-3" >
									 		<label class="col-form-label">Anemis</label>
										</div>
									 	<div class="col">
										 	<div class="form-check" style="margin-top: 10px">
										 		<div class="row">
											 		<div class="col">
														<input type="checkbox" class="form-check-inline" id="anemis_kiri" name="anemis_kiri" value="1">
														<label class="form-check-label" id="anemis_kiri">Anemis Kiri</label>
											 		</div>
											 		<div class="col">
														<input type="checkbox" class="form-check-inline" id="anemis_kanan" name="anemis_kanan" value="1">
														<label class="form-check-label" id="anemis_kanan">Anemis Kiri</label>
											 		</div>
										 		</div>
											</div>
									 	</div>
									</div>

									<div class="form-group row">
										<div class="col-3" >
									 		<label class="col-form-label">Ikterik</label>
									 	</div>
									 	<div class="col">
										 	<div class="form-check" style="margin-top: 10px">
										 		<div class="row">
											 		<div class="col">
														<input type="checkbox" class="form-check-inline" id="ikterik_kiri" name="ikterik_kiri" value="1">
														<label class="form-check-label" id="ikterik_kiri">Ikterik Kiri</label>
											 		</div>
											 		<div class="col">
														<input type="checkbox" class="form-check-inline" id="ikterik_kanan" name="ikterik_kanan" value="1">
														<label class="form-check-label" id="ikterik_kanan">Ikterik Kanan</label>
											 		</div>
										 		</div>
											</div>
									 	</div>
									</div>	

									<div class="form-group row">
										<div class="col-3" >
									 		<label class="col-form-label">Cianosis</label>
									 	</div>
									 	<div class="col">
										 	<div class="form-check" style="margin-top: 10px">
										 		<div class="row">
											 		<div class="col">
														<input type="checkbox" class="form-check-inline" id="" name="cianosis_kiri" value="1">
														<label class="form-check-label" id="cianosis_kiri">Cianosis Kiri</label>
											 		</div>
											 		<div class="col">
														<input type="checkbox" class="form-check-inline" id="" name="cianosis_kanan" value="1">
														<label class="form-check-label" id="cianosis_kanan">Cianosis Kanan</label>
											 		</div>
										 		</div>
											</div>
									 	</div>
									</div>
									
									<div class="form-group row">
									 	<label class="col-sm-1 col-form-label">Deformitas</label>
									 	<div class="input-group-prepend col-sm-3">
										<input type="checkbox" class="form-control" id="" name="deformitas_kiri" value="1">
										</div>/
									 	 <div class="input-group-prepend col-sm-3">
										<input type="checkbox" class="form-control" id="" name="deformitas_kanan" value="1">
										</div>
									</div>

									<div class="form-group row">
									 	<label class="col-sm-1 col-form-label">Refleks Cahaya</label>
									 	<div class="input-group-prepend col-sm-3">
										<input type="checkbox" class="form-control" id="" name="refchy_kiri" value="1">
										</div>/
									 	 <div class="input-group-prepend col-sm-3">
										<input type="checkbox" class="form-control" id="" name="refchy_kanan" value="1">
										</div>
									</div>

									<div class="form-group row">
									 	<label class="col-sm-1 col-form-label">isokor</label>
									 	<div class="input-group-prepend col-sm-3">
										<input type="radio" class="form-control" id="" name="refchy_opsi" value="1" required="">
										</div>
									 	<label class="col-sm-1 col-form-label">anisokor</label>
									 	 <div class="input-group-prepend col-sm-3">
										<input type="radio" class="form-control" id="" name="refchy_opsi" value="0" required="">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Keterangan Tambahan</label>
										<div class="input-group-prepend col">
										<textarea class="form-control" aria-label="With textarea" name="ket_tambahankpl" placeholder="Keterangan Tambahan"></textarea>
										</div>
									</div>
									<hr></hr>
									<strong>Thorak</strong>
									
									<div class="form-group row">
										<label class="col-sm-1 col-form-label">Paru</label>
										<label class="col-sm-1 col-form-label">:</label>
									 	<label class="col-sm-1 col-form-label">Simetris</label>
									 	<div class="input-group-prepend col-sm-3">
										<input type="radio" class="form-control" id="" name="metris" placeholder="" value="1" required="">
										</div>
									 	<label class="col-sm-1 col-form-label">Asimetris</label>
									 	 <div class="input-group-prepend col-sm-3">
										<input type="radio" class="form-control" id="" name="metris" placeholder="" value="0" required="">
										</div>
									</div>
									<div class="form-group row">
									<label class="col-sm-2 col-form-label"></label>
									 	<label class="col-sm-1 col-form-label">Wheezing</label>
									 	<div class="input-group-prepend col-sm-3">
										<input type="checkbox" class="form-control" id="" name="wheezing_kiri" placeholder="" value="1">
										</div>/
									 	 <div class="input-group-prepend col-sm-3">
										<input type="checkbox" class="form-control" id="" name="wheezing_kanan" placeholder="" value="0">
										</div>						
									</div>

									<div class="form-group row">
									<label class="col-sm-2 col-form-label"></label>
									 	<label class="col-sm-1 col-form-label">Ronkhi</label>
									 	<div class="input-group-prepend col-sm-3">
										<input type="checkbox" class="form-control" id="" name="ronkhi_kiri" placeholder="" value="1">
										</div>/
									 	 <div class="input-group-prepend col-sm-3">
										<input type="checkbox" class="form-control" id="" name="ronkhi_kanan" placeholder="" value="0">
										</div>						
									</div>

									<div class="form-group row">
									<label class="col-sm-2 col-form-label"></label>
									 	<label class="col-sm-1 col-form-label">Vesikuler</label>
									 	<div class="input-group-prepend col-sm-3">
										<input type="checkbox" class="form-control" id="" name="vesikuler_kiri">
										</div>/
									 	 <div class="input-group-prepend col-sm-3">
										<input type="checkbox" class="form-control" id="" name="vesikuler_kanan">
										</div>						
									</div>
									 <fieldset class="form-group">
									    <div class="row">
									      <legend class="col-form-label col-sm-2 pt-0">Jantung</legend>
										  <legend class="col-form-label col-sm-1 pt-0">:</legend>
									      <div class="col-sm-5">
									        <div class="form-check">
									          <input class="form-check-input" type="radio" name="jantung_icor" value="1" required="">
									          <label class="form-check-label">
									            Tampak
									          </label>
									        </div>
									        <div class="form-check">
									          <input class="form-check-input" type="radio" name="jantung_icor" value="0" required="">
									          <label class="form-check-label">
									            Tak Tampak
									          </label>
									        </div>
									    <div class="row">
									      <legend class="col-form-label col-sm-5 pt-0">S1 / S2</legend>
									      <div class="col-sm-5">
									        <div class="form-check">
									          <input class="form-check-input" type="radio" name="s1_s2" value="1" required="">
									          <label class="form-check-label">
									            Reguler
									          </label>
									        </div>
									        <div class="form-check">
									          <input class="form-check-input" type="radio" name="s1_s2" value="0" required="">
									          <label class="form-check-label">
									            Irreguler
									          </label>
									        </div>
									  </fieldset>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Suara Tambahan</label>
										<div class="input-group-prepend col">
										<input type="text" class="form-control" id="" name="s_tambahan" placeholder="Suara Tambahan">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Keterangan Tambahan</label>
										<div class="input-group-prepend col">
										<textarea class="form-control" aria-label="With textarea" name="ket_tambahantr" placeholder="Keterangan Tambahan"></textarea>
										</div>
									</div>	
									<hr></hr>
									<strong>Abdomen</strong>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">BU </label>
									 	<label class="col-sm-1 col-form-label">Normal</label>
									 	<div class="input-group-prepend col-sm-3">
										<input type="radio" class="form-control" id="" name="BU" placeholder="" value="0" required="">
										</div>
									 	<label class="col-sm-1 col-form-label">Meningkat</label>
									 	 <div class="input-group-prepend col-sm-3">
										<input type="radio" class="form-control" id="" name="BU" placeholder="" value="1" required="">
										</div>
									</div>
									<div class="form-group row">
									<label class="col-sm-2 col-form-label"></label>
										<label class="col-sm-1 col-form-label">Menurun</label>
									 	<div class="input-group-prepend col-sm-3">
										<input type="radio" class="form-control" id="" name="BU" placeholder="" value="2" required="">
										</div>
									 	<label class="col-sm-1 col-form-label">Negatif</label>
									 	 <div class="input-group-prepend col-sm-3">
										<input type="radio" class="form-control" id="" name="BU" placeholder="" value="3" required="">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Nyeri Tekan</label>
									 	<div class="input-group-prepend col-sm-3">
										<div class="form-check form-check-inline">
										  <input class="form-check-input" type="checkbox" name="ny1" value="1">
										  <label class="form-check-label" >1</label>
										</div>
										<div class="form-check form-check-inline">
										  <input class="form-check-input" type="checkbox" name="ny2" value="2">
										  <label class="form-check-label" >2</label>
										</div>
										<div class="form-check form-check-inline">
										  <input class="form-check-input" type="checkbox" name="ny3" value="3">
										  <label class="form-check-label" >3</label>
										</div>
										<div class="form-check form-check-inline">
										  <input class="form-check-input" type="checkbox" name="ny4" value="4">
										  <label class="form-check-label" >4</label>
										</div>
										<div class="form-check form-check-inline">
										  <input class="form-check-input" type="checkbox" name="ny5" value="5">
										  <label class="form-check-label" >5</label>
										</div>
										<div class="form-check form-check-inline">
										  <input class="form-check-input" type="checkbox" name="ny6" value="6">
										  <label class="form-check-label" >6</label>
										</div>
										<div class="form-check form-check-inline">
										  <input class="form-check-input" type="checkbox" name="ny7" value="7">
										  <label class="form-check-label" >7</label>
										</div>
										<div class="form-check form-check-inline">
										  <input class="form-check-input" type="checkbox" name="ny8" value="8">
										  <label class="form-check-label" >8</label>
										</div>
										<div class="form-check form-check-inline">
										  <input class="form-check-input" type="checkbox" name="ny9" value="9">
										  <label class="form-check-label" >9</label>
										</div>
									    </div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Hepatomegali</label>
									    <div class="input-group-prepend col-sm-2">
									      	<input type="text" class="form-control" id="" name="hpmgl" placeholder="" value="1" required="">
									    </div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Spleenomegali</label>
									    <div class="input-group-prepend col-sm-2">
									      	<input type="text" class="form-control" id="" name="spmgl" placeholder="" value="1" required="">
									    </div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Keterangan Tambahan</label>
										<div class="input-group-prepend col">
										<textarea class="form-control" aria-label="With textarea" name="ket_tambahanab" placeholder="Keterangan Tambahan" ></textarea>
										</div>
									</div>	
									<hr></hr>
									<strong>Ekstermitas</strong>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Akral Hangat</label>
									 	<div class="input-group-prepend col-sm-3">
										<div class="form-check form-check-inline">
										  <input class="form-check-input" type="checkbox" name="ah1" value="1">
										  <label class="form-check-label" >1</label>
										</div>
										<div class="form-check form-check-inline">
										  <input class="form-check-input" type="checkbox" name="ah2" value="2">
										  <label class="form-check-label" >2</label>
										</div>
										<div class="form-check form-check-inline">
										  <input class="form-check-input" type="checkbox" name="ah3" value="3">
										  <label class="form-check-label" >3</label>
										</div>
										<div class="form-check form-check-inline">
										  <input class="form-check-input" type="checkbox" name="ah4" value="4">
										  <label class="form-check-label" >4</label>
										</div>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">CRT</label>
									 	<div class="input-group-prepend col-sm-3">
										<div class="form-check form-check-inline">
										  <input class="form-check-input" type="checkbox" name="crt1" value="1">
										  <label class="form-check-label" >1</label>
										</div>
										<div class="form-check form-check-inline">
										  <input class="form-check-input" type="checkbox" name="crt2" value="2">
										  <label class="form-check-label" >2</label>
										</div>
										<div class="form-check form-check-inline">
										  <input class="form-check-input" type="checkbox" name="crt3" value="3">
										  <label class="form-check-label" >3</label>
										</div>
										<div class="form-check form-check-inline">
										  <input class="form-check-input" type="checkbox" name="crt4" value="4">
										  <label class="form-check-label" >4</label>
										</div>
										<label class="col-sm-3 col-form-label">/2Detik</label>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Edema</label>
									 	<div class="input-group-prepend col-sm-3">
										<div class="form-check form-check-inline">
										  <input class="form-check-input" type="checkbox" name="edm1" value="1">
										  <label class="form-check-label" >1</label>
										</div>
										<div class="form-check form-check-inline">
										  <input class="form-check-input" type="checkbox" name="edm2" value="2">
										  <label class="form-check-label" >2</label>
										</div>
										<div class="form-check form-check-inline">
										  <input class="form-check-input" type="checkbox" name="edm3" value="3">
										  <label class="form-check-label" >3</label>
										</div>
										<div class="form-check form-check-inline">
										  <input class="form-check-input" type="checkbox" name="edm4" value="4">
										  <label class="form-check-label" >4</label>
										</div>
										</div>
									</div>
									 <fieldset class="form-group">
									    <div class="row">
									      <legend class="col-form-label col-sm-2 pt-0"></legend>
									      <div class="col-sm-4">
									        <div class="form-check">
									          <input class="form-check-input" type="radio" name="pitting" value="1" required="">
									          <label class="form-check-label">
									            non-pitting
									          </label>
									        </div>
									        </div>
									         <div class="col-sm-4">
									        <div class="form-check">
									          <input class="form-check-input" type="radio" name="pitting" value="0" required="">
									          <label class="form-check-label">
									            pitting
									          </label>
									        </div>
									   </fieldset>
									   <div class="form-group row">
										<label class="col-sm-2 col-form-label">Keterangan Tambahan</label>
										<div class="input-group-prepend col">
										<textarea class="form-control" aria-label="With textarea" name="ket_tambahaneks" placeholder="Keterangan Tambahan"></textarea>
										</div>
									</div>	
									<hr></hr>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Lain-lain</label>
										<div class="input-group-prepend col">
										<input type="text" class="form-control" id="" name="lain_lain" placeholder="Lain-lain" >
										</div>
									</div>	
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Diagnosa</label>
										<div class="input-group-prepend col">
										<input type="text" class="form-control" id="" name="diagnosa" placeholder="Diagnosa" >
										</div>
									</div>	
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Terapi</label>
										<div class="input-group-prepend col">/R
										<input type="text" class="form-control" id="" name="terapi1" placeholder="..." >
										</div>
									</div>	
									<div class="form-group row">
									<label class="col-sm-3 col-form-label"></label>
										<div class="input-group-prepend col">/R
										<input type="text" class="form-control" id="" name="terapi2" placeholder="..." >
										</div>
									</div>	
									<div class="form-group row">
									<label class="col-sm-3 col-form-label"></label>
										<div class="input-group-prepend col">/R
										<input type="text" class="form-control" id="" name="terapi3" placeholder="..." >
										</div>
									</div>
								</div>
								</div>
					    	<div class="modal-footer">
					    		<button type="submit" class="btn btn-primary">Cetak</button>
					    	</div>
					    	</form>
						</div>
					</div>
					<script type="text/javascript">
						function getassesment(){
							console.log($("#primary").select2('data'));

						}

					</script>
					<!-- SURAT RUJUKAN-->
				</div>
				<!-- SURAT RUJUKAN -->

			</div>
			<div class="col">
				<input type="submit" class="btn btn-primary btn-block" value="SUBMIT">
			</div>
		</form>
	</div>
</div>