<style type="text/css">
	.my-error-class {color:#FF0000;}
	.my-valid-class {color:#00CC00;}
</style>
<script type="text/javascript">
 	$(document).ready(function() {

 		// inisialisasi dengan select2
		$('#diagnosaPrimaryId').select2();
    	$('#diagnosaSecondaryId').select2();
    	$('#diagnosaLainId').select2();

    	// inisialisasi dengan ajax 
    	$('.js-data-example-ajax').select2({
    		placeholder: "Pilih Sesuai ICD 10",
			ajax: {
				url: '<?=base_url()?>Dokter_handler/cari_icd/',
			    dataType: 'json',
			    delay: 1000,
				data: function (term, page) {
					return {
						term: term, // search term
						page: 10
					};
				},
				processResults: function (data, page) {
					return {
						results: data
					};
				},
				cache: true
			},
			escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
			minimumInputLength: 1,
		});

		// inisialisasi dan set alert form surat sakit
		$("#formSuratSakit").validate({
			rules:{
				alasan:{
					required:true,
				},selama:{
					required:true,
				},selama_satuan:{
					required:true,
				}
			},messages:{
				alasan:{
					required:"Mohon isi alasan",
				},selama:{
					required:"Mohon isi data yang dibutuhkan",
				},selama_satuan:{
					required:"Mohon isi data yang dibutuhkan",
				}
			},
			errorClass: "my-error-class",
			validClass: "my-valid-class"
		});

		// inisialisasi dan set alert form surat sehat
		$("#formSuratSakit").validate({
			rules:{
				alasan:{
					required:true,
				},selama:{
					required:true,
				},selama_satuan:{
					required:true,
				}
			},messages:{
				alasan:{
					required:"Mohon isi alasan",
				},selama:{
					required:"Mohon isi data yang dibutuhkan",
				},selama_satuan:{
					required:"Mohon isi data yang dibutuhkan",
				}
			},
			errorClass: "my-error-class",
			validClass: "my-valid-class"
		});

		// saat tutup modal surat sakit, tambahkan nomor surat sakit yang telah tercetak ke kolom planning untuk dokumnetasi lebih jelas
		$('#modalSuratSakit').on('hidden.bs.modal', function () {
			var jqxhr = $.get( "<?=base_url()?>Dokter_handler/getTabelSurat/sakit/<?=$pasien[0]->nomor_pasien?>", function(data) {
			console.log(data);
				data = JSON.parse(data);
				if (data[0].nomor_surat < 10 ) {
					data[0].nomor_surat = "00"+data[0].nomor_surat;
				}else{
					data[0].nomor_surat = "0"+data[0].nomor_surat;
				}
				document.getElementById('planning').value += "Surat Sakit : "+ data[0].nomor_surat +" / 002 / 0"+ data[0].tanggal_awal.substring(5, 7) +" / "+ data[0].tanggal_awal.substring(0, 4) +" , ";
			})
			.fail(function() {
			alert( "error" );
			})
		});

		// saat tutup modal surat sakit, tambahkan nomor surat sakit yang telah tercetak ke kolom planning untuk dokumnetasi lebih jelas
		$('#modalSuratSehat').on('hidden.bs.modal', function () {
			var jqxhr = $.get( "<?=base_url()?>Dokter_handler/getTabelSurat/sehat/<?=$pasien[0]->nomor_pasien?>", function(data) {
				data = JSON.parse(data);
				if (data[0].nomor_surat < 10 ) {
					data[0].nomor_surat = "00"+data[0].nomor_surat;
				}else{
					data[0].nomor_surat = "0"+data[0].nomor_surat;
				}
				document.getElementById('planning').value += "Surat Sehat : "+ data[0].nomor_surat +" / 001 / 0"+ data[0].tanggal_terbit.substring(5, 7) +" / "+ data[0].tanggal_terbit.substring(0, 4) +" , ";
			})
			.fail(function() {
			alert( "error" );
			})
		});

		// saat tutup modal surat sakit, tambahkan nomor surat sakit yang telah tercetak ke kolom planning untuk dokumnetasi lebih jelas
		$('#modalSuratRujukan').on('hidden.bs.modal', function () {
			var jqxhr = $.get( "<?=base_url()?>Dokter_handler/getTabelSurat/rujukan/<?=$pasien[0]->nomor_pasien?>", function(data) {
				data = JSON.parse(data);
				if (data[0].nomor_surat < 10 ) {
					data[0].nomor_surat = "00"+data[0].nomor_surat;
				}else{
					data[0].nomor_surat = "0"+data[0].nomor_surat;
				}
			
				document.getElementById('planning').value += "Surat Rujukan : "+ data[0].nomor_surat +" / 003 / 0"+ data[0].tanggal.substring(5, 7) +" / "+ data[0].tanggal.substring(0, 4) +" , ";

			})
			.fail(function() {
			alert( "error" );
			})
		});

	});	

	// setting tampilan live clock
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

    // set nilai tanggal terakhir setelah pengesetan durasi pada form surat sakit
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

	// untuk menyalurkan kolom assessment pada halaman pemeriksaan ke modal untuk masuk ke headtotoe
	function getassesment(){

		// set select2 untuk clear all option yang ada. (restart). defaultya kosong
		$('#diagnosaPrimaryId').val(null).trigger('change');
		$('#diagnosaSecondaryId').val(null).trigger('change');
		$('#diagnosaLainId').val(null).trigger('change');

		// CREATE PRIMARY SELECT ELEMENT
		var primarySelected = $("#primary").select2('data');
		for (i in primarySelected){
			var newOption = new Option(primarySelected[i].text, primarySelected[i].text, true, true);
			$('#diagnosaPrimaryId').append(newOption).trigger('change');
		}

		// CREATE SECONDARY SELECT ELEMENT
		var secondarySelected = $("#secondary").select2('data');
		for (i in secondarySelected){
			var newOption = new Option(secondarySelected[i].text, secondarySelected[i].text, true, true);
			$('#diagnosaSecondaryId').append(newOption).trigger('change');
		}

		// CREATE LAINLAIN SELECT ELEMENT
		var lainlainSelected = $("#lain").select2('data');
		for (i in lainlainSelected){
			var newOption = new Option(lainlainSelected[i].text, lainlainSelected[i].text, true, true);
			$('#diagnosaLainId').append(newOption).trigger('change');
		}

		// get and set element text area
		var pemeriksaanLab = $("#pemeriksaanLab").val();
		$("#diagnosaPemeriksaanLab").val(pemeriksaanLab);
	}

	// meneruskan textarea headtotoe ke form pemeriksaan karena diluar tag form. disebabkan struktur desain dan real condition
	function headtotoeToPemeriksaan(){
		$('#textareaHeadToToePemeriksaan').val($('#textareaHeadToToe').val());
	} 
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
				    <textarea class="form-control" id="textareaHeadToToe" name="text_headtotoe" onchange="headtotoeToPemeriksaan()"></textarea>
			 	</div>
			</div>
		</div>
	</div>
	<!-- FORM UNTUK SUBMIT PEMERIKSAAN -->
	<form action="<?=base_url()?>Dokter_handler/update_rm" method="POST">
		<!-- khusus text area dibawah ini nggk perlu styling-->
		<textarea id="textareaHeadToToePemeriksaan" name="headtotoeText" style="display: none;"></textarea>
		<input type="hidden" name="nomor_pasien" value="<?=$pasien[0]->nomor_pasien?>">
		<input type="hidden" name="kd_objek" value="<?=$objek[0]->kd_objek?>">

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

		<div class="row">
			<div class="col">
				<h5 class="text-center mt-3">Assesment</h5>
			</div>
		</div>

		<div class="row mb-3">	
			<div class="col-4">
				<h6 class="text-center">Primary</h6>
			 	<div class="form-group row">
			      	<select class="js-data-example-ajax" id="primary" name="assessmentPrimary[]" multiple="multiple" style="width: 99%">
					</select>
				</div> 
			</div>
			<div class="col-4">
				<h6 class="text-center">Sekunder</h6>
			 	<div class="form-group row">
			      	<select class="js-data-example-ajax" id="secondary" name="assessmentSecondary[]" multiple="multiple" style="width: 99%">
					</select>
				</div> 
			</div>
			<div class="col-4">
				<h6 class="text-center">Lain-lain</h6>
			 	<div class="form-group row">
			      	<select class="js-data-example-ajax" id="lain" name="assessmentLain[]" multiple="multiple" style="width: 99%">
					</select>
				</div> 
			</div>
			<textarea name="assessmentPemeriksaanLab" placeholder="pemeriksaan laboratorium" id="pemeriksaanLab"></textarea>
		</div>

	<div class="row">
		<div class="col">
			<input type="submit" class="btn btn-primary btn-block" value="SUBMIT">
		</div>
	<!-- form e nyalipbos -->
	</form>
		<div class="col">
			<button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#modalSuratSakit">SURAT SAKIT</button>
			
			<!-- SURAT SAKIT -->
			<div class="modal fade" id="modalSuratSakit" tabindex="-1" role="dialog" aria-labelledby="modalSuratSakitTitle" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
				      	<div class="modal-header">
				        	<h5 class="modal-title" id="modalSuratSakitTitle">Surat Sakit</h5>
				        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          		<span aria-hidden="true">&times;</span>
				        	</button>
				      	</div>
			    		<form id="formSuratSakit" action="<?=base_url()?>Dokter_handler/cetak/suratsakit" target="_blank" method="POST">
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
								          		<select class="input-group-text custom-select" name="selama_satuan" id="selama_satuan" onchange="updateTglAkhir()" required="">
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
						      			<input type="date" class="form-control" name="tanggal_akhir" id="tanggal_akhir" required="" readonly="" formart>
						   			</div>
								</div>
						    </div>
					    	<div class="modal-footer">
					    		<button type="submit" class="btn btn-primary btn-sm">CETAK</button>
					    	</div>
				    	</form>
				    </div>
				</div>
			</div>
			<!-- END SURAT SAKIT -->
		</div>
		<div class="col">
			<button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#modalSuratSehat">SURAT SEHAT</button>
			
			<!-- SURAT SEHAT -->
			<div class="modal fade" id="modalSuratSehat" tabindex="-1" role="dialog" aria-labelledby="modalSuratSehatTitle" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
				      	<div class="modal-header">
				        	<h5 class="modal-title" id="modalSuratSehat">Surat Sehat</h5>
				        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          		<span aria-hidden="true">&times;</span>
				        	</button>
				      	</div>

				    	<form action="<?=base_url()?>Dokter_handler/cetak/suratsehat" target="_blank" method="POST" id="formSuratSehat" >
					    	<div class="modal-body">
								<input type="hidden" name="nomor_pasien" value="<?=$pasien[0]->nomor_pasien?>">
						    	<label class="col-6 col-form-label"><strong>Tes Buta Warna</strong></label>
						    	<div class="custom-control custom-radio ml-5">
						    		<div class="row">
			 							<input type="radio" class="custom-control-input" id="tesButaWarna1" name="tes_buta_warna" value="Ya">
			  							<label class="custom-control-label" for="tesButaWarna1">Ya</label>
						    		</div>
						    		<div class="row">
				  						<input type="radio" class="custom-control-input" id="tesButaWarna2" name="tes_buta_warna" value="Tidak">
				  						<label class="custom-control-label" for="tesButaWarna2">Tidak</label>
						    		</div>
						    		<div class="row">
										<input type="radio" class="custom-control-input" id="tesButaWarna3" name="tes_buta_warna" value="Parsial">
										<label class="custom-control-label" for="tesButaWarna3">Parsial</label>
						    		</div>
						    	</div>
								<h5 class="col-6 col-form-label"><strong>Keperluan</strong></h5>
								<textarea class="form-control" aria-label="With textarea" name="keperluan" required=""></textarea>
							</div>
					    	<div class="modal-footer">
					    		<button type="submit" class="btn btn-primary">Cetak</button>
					    	</div>
			    		</form>
					</div>
				</div>
			</div>
			<!-- END SURAT SEHAT -->
		</div>
		<div class="col">
			<button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#modalSuratRujukan" onclick="getassesment()">RUJUKAN</button>
			
			<!-- SURAT RUJUKAN -->
			<div class="modal fade" id="modalSuratRujukan" tabindex="-1" role="dialog" aria-labelledby="modalSuratRujukanTitle" aria-hidden="true" >
				<div class="modal-dialog modal-dialog-centered" role="document" >
					<div class="modal-content">
				      	<div class="modal-header">
				        	<h5 class="modal-title" id="modalSuratRujukanTitle">Surat Rujukan</h5>
				        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          		<span aria-hidden="true">&times;</span>
				        	</button>
				      	</div>
				      	<form action="<?=base_url()?>Dokter_handler/cetak/suratrujukan" target="_blank" method= "POST">
					    	<div class="modal-body" >
								<input type="text" class="form-control" value="<?=$pasien[0]->nomor_pasien?>" name="kd_pasien" readonly="">
								<input type="text" class="form-control" value="<?=$pasien[0]->nama?>" name="nama" readonly="">
							    <div class="form-group row">
									<label class="col-sm-2 col-form-label">Keluhan</label>
								    <div class="input-group-prepend col">
									<textarea class="form-control" aria-label="With textarea" name="keluhan" required="">Keluhan</textarea>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-sm-2 col-form-label">GCS</label>
								    <div class="input-group-prepend col-sm-2">
									<input type="text" class="form-control" id="" name="GCS_E" placeholder="E" required="">
									</div>
									<div class="input-group-prepend col-sm-2">
									<input type="text" class="form-control" id="" name="GCS_V" placeholder="V" required="">
									</div>
									<div class="input-group-prepend col-sm-2">
									<input type="text" class="form-control" id="" name="GCS_M" placeholder="M" required="">
									</div>							
								</div>
								<fieldset class="form-group">
								    <div class="row">
								    <label class="col-sm-2"></label>
								      <div class="col-sm-3">
								        <div class="form-check">
								          <input class="form-check-input" type="checkbox" name="GCS_opsi[]" value="CM">
								          <label class="form-check-label">
								            CM
								          </label>
								        </div>
								        <div class="form-check">
								          <input class="form-check-input" type="checkbox" name="GCS_opsi[]" value="Apatis">
								          <label class="form-check-label">
								            Apatis
								          </label>
								        </div>
								       </div>
								       <div class="col-sm-3">
								        <div class="form-check">
								          <input class="form-check-input" type="checkbox" name="GCS_opsi[]" value="Delirium">
								          <label class="form-check-label">
								            Delirium
								          </label>
								        </div>
								        <div class="form-check">
								          <input class="form-check-input" type="checkbox" name="GCS_opsi[]" value="Somnolen">
								          <label class="form-check-label">
								            Somnolen
								          </label>
								        </div>
								       </div>
								       <div class="col-sm-3">
								        <div class="form-check">
								          <input class="form-check-input" type="checkbox" name="GCS_opsi[]" value="Stupor">
								          <label class="form-check-label">
								            Stupor
								          </label>
								        </div>
								        <div class="form-check">
								          <input class="form-check-input" type="checkbox" name="GCS_opsi[]" value="Coma">
								          <label class="form-check-label">
								            Coma
								          </label>
								        </div>
								       </div>
								    </div>
								</fieldset>
								<div class="form-group row">
									<label class="col-sm-4 col-form-label">TB</label>
								    <div class="input-group-prepend col-sm-2">
								      	<input type="text" class="form-control" value="<?=$objek[0]->tb?>" id="" name="tb" placeholder="TB"  readonly="">cm
								    </div>
								</div>
								<div class="form-group row">
									<label class="col-sm-4 col-form-label">BB</label>
								    <div class="input-group-prepend col-sm-2">
								      	<input type="text" class="form-control" value="<?=$objek[0]->bb?>" id="" name="bb" placeholder="BB"  readonly="">kg
								    </div>
								</div>

								<div class="form-group row">
									<label class="col-sm-4 col-form-label">Tekanan Darah</label>
								    <div class="input-group-prepend col-sm-2">
								      	<input type="text" class="form-control" value="<?=$objek[0]->td1?>" id="" name="tekanan_darah" placeholder=""  readonly="">
								      	&nbsp;/&nbsp;
								      	<input type="text" class="form-control" value="<?=$objek[0]->td2?>" id="" name="tekanan_darah" placeholder=""  readonly="">mmHg
								    </div>
								</div>
								
								<div class="form-group row">
									<label class="col-sm-4 col-form-label">Nadi</label>
								    <div class="input-group-prepend col-sm-2">
								      	<input type="text" class="form-control" value="<?=$objek[0]->N?>" id="" name="nadi" placeholder=""  readonly="">rpm
								    </div>
								</div>

								<div class="form-group row">
									<label class="col-sm-4 col-form-label">Respiratory R.</label>
								    <div class="input-group-prepend col-sm-2">
								      	<input type="text" class="form-control" value="<?=$objek[0]->RR?>" id="" name="respiratory" placeholder=""  readonly="">rpm
								    </div>
								</div>

								<div class="form-group row">
									<label class="col-sm-4 col-form-label">TᵒAxilla</label>
								    <div class="input-group-prepend col-sm-2">
								      	<input type="text" class="form-control" value="<?=$objek[0]->TAx?>" id="" name="respiratory" placeholder=""  readonly="">ᵒc
								    </div>
								</div>
								<hr></hr>
								<center><h4>Head to Toe</h4></center>
								<hr></hr>
								<strong>Kepala :</strong>
								<div class="form-group row">
								 	<label class="col-sm-1 col-form-label">Anemis</label>
								 	<div class="input-group-prepend col-sm-3">
										<input type="checkbox" class="form-control" id="" name="anemis_kiri" value="1">
									</div>/
								 		<div class="input-group-prepend col-sm-3">
									<input type="checkbox" class="form-control" id="" name="anemis_kanan" value="1">
									</div>
								</div>

								<div class="form-group row">
								 	<label class="col-sm-1 col-form-label">Ikterik</label>
								 	<div class="input-group-prepend col-sm-3">
										<input type="checkbox" class="form-control" id="" name="ikterik_kiri" value="1">
									</div>/
								 	<div class="input-group-prepend col-sm-3">
										<input type="checkbox" class="form-control" id="" name="ikterik_kanan" value="1">
									</div>
								</div>	

								<div class="form-group row">
								 	<label class="col-sm-1 col-form-label">Cianosis</label>
								 	<div class="input-group-prepend col-sm-3">
									<input type="checkbox" class="form-control" id="" name="cianosis_kiri" value="1">
									</div>/
								 	 <div class="input-group-prepend col-sm-3">
									<input type="checkbox" class="form-control" id="" name="cianosis_kanan" value="1">
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
									<input type="radio" class="form-control" id="" name="refchy_opsi" value="Isokor" required="">
									</div>
								 	<label class="col-sm-1 col-form-label">anisokor</label>
								 	 <div class="input-group-prepend col-sm-3">
									<input type="radio" class="form-control" id="" name="refchy_opsi" value="Anisokor" required="">
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
									<input type="radio" class="form-control" id="" name="metris" placeholder="" value="Simetris" required="">
									</div>
								 	<label class="col-sm-1 col-form-label">Asimetris</label>
								 	 <div class="input-group-prepend col-sm-3">
									<input type="radio" class="form-control" id="" name="metris" placeholder="" value="Asimetris" required="">
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
									<input type="checkbox" class="form-control" id="" name="vesikuler_kiri" placeholder="" value="Tampak">
									</div>/
								 	 <div class="input-group-prepend col-sm-3">
									<input type="checkbox" class="form-control" id="" name="vesikuler_kanan" placeholder="" value="Tak Tampak">
									</div>						
								</div>
								<fieldset class="form-group">
								    <div class="row">
								      	<legend class="col-form-label col-sm-2 pt-0">Jantung</legend>
									  	<legend class="col-form-label col-sm-1 pt-0">:</legend>
								      	<div class="col-sm-5">
								        	<div class="form-check">
								          		<input class="form-check-input" type="radio" name="jantung_icor" value="Reguler" required="">
								          		<label class="form-check-label">
								            		Tampak
								          		</label>
								        	</div>
								       		<div class="form-check">
								          		<input class="form-check-input" type="radio" name="jantung_icor" value="Irreguler" required="">
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
								        		</div>
								        	</div>
								        </div>
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
									<input type="radio" class="form-control" id="" name="BU" placeholder="" value="Normal" required="">
									</div>
								 	<label class="col-sm-1 col-form-label">Meningkat</label>
								 	 <div class="input-group-prepend col-sm-3">
									<input type="radio" class="form-control" id="" name="BU" placeholder="" value="Meningkat" required="">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label"></label>
									<label class="col-sm-1 col-form-label">Menurun</label>
								 	<div class="input-group-prepend col-sm-3">
									<input type="radio" class="form-control" id="" name="BU" placeholder="" value="Menurun" required="">
									</div>
								 	<label class="col-sm-1 col-form-label">Negatif</label>
								 	 <div class="input-group-prepend col-sm-3">
									<input type="radio" class="form-control" id="" name="BU" placeholder="" value="Negatif" required="">
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
								      	<input type="text" class="form-control" id="" name="hpmgl" placeholder="" value="" required="">
								    </div>
								</div>
								<div class="form-group row">
									<label class="col-sm-3 col-form-label">Spleenomegali</label>
								    <div class="input-group-prepend col-sm-2">
								      	<input type="text" class="form-control" id="" name="spmgl" placeholder="" value="" required="">
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
								        </div>
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
										<select id="diagnosaPrimaryId" name="diagnosaPrimary[]" multiple="multiple" style="width: 100%">
										</select>
									</div>
									<div class="input-group-prepend col">
										<select id="diagnosaSecondaryId" name="diagnosaSecondary[]" multiple="multiple" style="width: 100%">
										</select>
									</div>
									<div class="input-group-prepend col">
										<select id="diagnosaLainId" name="diagnosaLain[]" multiple="multiple" style="width: 100%">
										</select>
									</div>

									<textarea id="diagnosaPemeriksaanLab" name="diagnosaPemeriksaanLab"></textarea>
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
					    	<div class="modal-footer">
					    		<button type="submit" class="btn btn-primary">Cetak</button>
					    	</div>
						</form>
					</div>
				</div>
			</div>
			<!-- SURAT RUJUKAN END -->
		</div>
	</div>
</div>