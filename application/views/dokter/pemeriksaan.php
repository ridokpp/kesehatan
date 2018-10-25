<!-- https://pdfcrowd.com/i/how-to-export-html-to-pdf-with-php.html -->
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

	// untuk menyalurkan kolom assessment pada halaman pemeriksaan ke modal rujukan untuk masuk ke headtotoe
	function getassesment(){

		// set select2 untuk clear all option yang ada. (restart). defaultya kosong
		$('#diagnosaPrimaryId').val(null).trigger('change');
		$('#diagnosaSecondaryId').val(null).trigger('change');
		$('#diagnosaLainId').val(null).trigger('change');

		// CREATE PRIMARY SELECT ELEMENT
		var primarySelected = $("#primary").select2('data');
		for (i in primarySelected){
			var primaryDescOnly = primarySelected[i].text.split(" / ");
			var newOption = new Option(primaryDescOnly[1], primaryDescOnly[1], true, true);
			$('#diagnosaPrimaryId').append(newOption).trigger('change');
		}

		// CREATE SECONDARY SELECT ELEMENT
		var secondarySelected = $("#secondary").select2('data');
		for (i in secondarySelected){
			var secondaryDescOnly = secondarySelected[i].text.split(" / ");
			var newOption = new Option(secondaryDescOnly[1], secondaryDescOnly[1], true, true);
			$('#diagnosaSecondaryId').append(newOption).trigger('change');
		}

		// CREATE LAINLAIN SELECT ELEMENT
		var lainlainSelected = $("#lain").select2('data');
		for (i in lainlainSelected){
			lainlainDescOnly = lainlainSelected[i].text.split(" / ");
			var newOption = new Option(lainlainDescOnly[1], lainlainDescOnly[1], true, true);
			$('#diagnosaLainId').append(newOption).trigger('change');
		}

		// get and set element text area
		var pemeriksaanLab = $("#pemeriksaanLab").val();
		$("#diagnosaPemeriksaanLab").val(pemeriksaanLab);

	}

	// meneruskan textarea headtotoe ke form pemeriksaan karena diluar tag form. disebabkan struktur desain
	function headtotoeToPemeriksaan(){
		$('#textareaHeadToToePemeriksaan').val($('#textareaHeadToToe').val());
	} 

	// saat tutup modal surat sakit, tambahkan nomor surat sakit yang telah tercetak ke kolom planning untuk dokumnetasi lebih jelas
	function SuratSakit() {
		var jqxhr = $.get( "<?=base_url()?>Dokter_handler/getTabelSurat/sakit/<?=$pasien[0]->nomor_pasien?>", function(data) {
			data = JSON.parse(data);
			if (data[0].nomor_surat < 10 ) {
				data[0].nomor_surat = "00"+data[0].nomor_surat;
			}else{
				data[0].nomor_surat = "0"+data[0].nomor_surat;
			}
			if(document.getElementById('planning').value == ''){
				document.getElementById('planning').value += "Surat Sakit : "+ data[0].nomor_surat +" / 002 / 0"+ data[0].tanggal_awal.substring(5, 7) +" / "+ data[0].tanggal_awal.substring(0, 4) +" ";
			}else{
				document.getElementById('planning').value += ", Surat Sakit : "+ data[0].nomor_surat +" / 002 / 0"+ data[0].tanggal_awal.substring(5, 7) +" / "+ data[0].tanggal_awal.substring(0, 4) +" ";
			}
		})
		.fail(function() {
		alert( "error" );
		})
	}

	// saat tutup modal surat sakit, tambahkan nomor surat sakit yang telah tercetak ke kolom planning untuk dokumnetasi lebih jelas
	function SuratSehat() {
		var jqxhr = $.get( "<?=base_url()?>Dokter_handler/getTabelSurat/sehat/<?=$pasien[0]->nomor_pasien?>", function(data) {
			data = JSON.parse(data);
			if (data[0].nomor_surat < 10 ) {
				data[0].nomor_surat = "00"+data[0].nomor_surat;
			}else{
				data[0].nomor_surat = "0"+data[0].nomor_surat;
			}
			if(document.getElementById('planning').value == ''){
				document.getElementById('planning').value += "Surat Sehat : "+ data[0].nomor_surat +" / 001 / 0"+ data[0].tanggal_terbit.substring(5, 7) +" / "+ data[0].tanggal_terbit.substring(0, 4) +" ";
			}else{
				document.getElementById('planning').value += ", Surat Sehat : "+ data[0].nomor_surat +" / 001 / 0"+ data[0].tanggal_terbit.substring(5, 7) +" / "+ data[0].tanggal_terbit.substring(0, 4) +" ";
			}
		})
		.fail(function() {
		alert( "error" );
		})
	}

	// saat tutup modal surat sakit, tambahkan nomor surat sakit yang telah tercetak ke kolom planning untuk dokumnetasi lebih jelas
	function SuratRujukan() {
		var jqxhr = $.get( "<?=base_url()?>Dokter_handler/getTabelSurat/rujukan/<?=$pasien[0]->nomor_pasien?>", function(data) {
			data = JSON.parse(data);
			if (data[0].nomor_surat < 10 ) {
				data[0].nomor_surat = "00"+data[0].nomor_surat;
			}else{
				data[0].nomor_surat = "0"+data[0].nomor_surat;
			}
			// console.log(document.getElementById('planning').value);
			if(document.getElementById('planning').value == ''){
				document.getElementById('planning').value += "Surat Rujukan : "+ data[0].nomor_surat +" / 003 / 0"+ data[0].tanggal.substring(5, 7) +" / "+ data[0].tanggal.substring(0, 4) +" ";
			}else{
				document.getElementById('planning').value += ", Surat Rujukan : "+ data[0].nomor_surat +" / 003 / 0"+ data[0].tanggal.substring(5, 7) +" / "+ data[0].tanggal.substring(0, 4) +" ";
			}
			document.getElementById('planning').value += ", Terapi : " + document.getElementById('terapi1').value + ", Perencanaan Lab : " + document.getElementById('terapi2').value + ", Perencanaan Rujuk : " + document.getElementById('terapi3').value;

		})
		.fail(function() {
		alert( "error" );
		})
	}

	function Save()	{
		// var formData = new FormData($("#formHeadtotoeDetil")[0]);
		var formData = $("#formHeadtotoeDetil").serialize();
		console.log(formData);
		$.ajax({
			url : "<?=base_url('Dokter_handler/addheadtotoe')?>",
			type : "POST",
			data: formData,
			success: function(data){
				// $("#modalSuratRujukan").modal("hide");
				console.log(data);
			},
			error: function(jqXHR, textStatus, errorThrown){
				alert('Error Add Data');
			}
		});
	}
</script>

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

<h3 class="text-center mt-3"><strong>Pemeriksaan Dokter</strong></h3>

<div class="container">
	<div class="row justify-content-md-center">
		<div class="col text-center">
	     	<h5><span class="badge <?=($pasien[0]->pembayaran != 'RF') ? 'badge-success' : 'badge-secondary' ?>"><?=$pasien[0]->pembayaran?></span></h5>
	    </div>
	</div>
	<div class="row">
		<div class="col" >
			<h5><?php
				$hari 	= array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
				$bulan 	= array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");

				echo $hari[date("w")].", ".date("j")." ".$bulan[date("n")]." ".date("Y"); ?></h5>	
		</div>
		<div class="col-1">
			<body onload="setInterval('displayServerTime()', 1000);">
				<h5><span id="clock"><?php echo date('H:i:s'); ?></span></h5>
			</body>
		</div>
	</div>
	<div class="row">
		<div class="col-3 border rounded">

			<div class="text-center">
				<h5 class="mt-3 mb-3">Data Pasien</h5>
				<img src="<?=base_url()?>assets/images/blank-none.jpg" class="rounded">
			</div>

			<div class="row mt-3 text-center">
				<div class="col"><strong><?= $pasien[0]->nomor_pasien?></strong></div>
			</div>

			<div class="row mt-3">
				<div class="col-3">Nama</div>
				<div class="col-1">:</div>
				<div class="col">Mochammad Fadhli Zhil Iqram</div>
			</div>

			<div class="row">
				<div class="col-3">NIK</div>
				<div class="col-1">:</div>
				<div class="col">124125132634623</div>
			</div>

			<div class="row">
				<div class="col-3">TTL</div>
				<div class="col-1">:</div>
				<div class="col">Malang, 16 Mei 1996</div>
			</div>

			<div class="row">
				<div class="col-3">Alamat</div>
				<div class="col-1">:</div>
				<div class="col">Jalan Tata Surya 1 Nomer 21</div>
			</div>
			
			<div class="row">
				<div class="col-3">Jenis Kelamin</div>
				<div class="col-1">:</div>
				<div class="col">Laki - laki</div>
			</div>

			<div class="row">
				<div class="col-3">Pekerjaan</div>
				<div class="col-1">:</div>
				<div class="col">Mahasiswa</div>
			</div>
			
		</div>
		<div class="col-9 border rounded">
			<ul class="nav nav-tabs mt-3" id="myTab" role="tablist">
				<li class="nav-item">
					<a class="nav-link" id="home-tab" data-toggle="tab" href="#rekam_medis" role="tab" aria-controls="rekam_medis" aria-selected="true">Rekam Media</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" id="profile-tab" data-toggle="tab" href="#pemeriksaan" role="tab" aria-controls="pemeriksaan" aria-selected="false">Pemeriksaan</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="profile-tab" data-toggle="tab" href="#surat_sakit" role="tab" aria-controls="surat_sakit" aria-selected="false">Surat Sakit</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="profile-tab" data-toggle="tab" href="#surat_sehat" role="tab" aria-controls="surat_sehat" aria-selected="false">Surat Sehat</a>
				</li>
			</ul>
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade" id="rekam_medis" role="tabpanel" aria-labelledby="home-tab">
					
					<h5 class="text-center mt-3">Rekam Medis</h5>
					<div class="container">
							
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
					</div>
				</div>

				<div class="tab-pane fade show active" id="pemeriksaan" role="tabpanel" aria-labelledby="profile-tab">
					<div class="container">
						<h5 class="text-center mt-3">Subjektif</h5>
							<textarea class="form-control" aria-label="With textarea" required="" placeholder="Subjektif" name="subjektif"></textarea>
						<hr>

						<h5 class="text-center mt-3">Objektif</h5>

						<div class="row mt-3">
							<div class="col-6">
								<div class="row">
									<div class="col-4">Tinggi Badan</div>
									<div class="col-1">:</div>
									<div class="col">
										<div class="input-group">
									      	<input type="number" class="form-control" id="" name="" value="<?=$objek[0]->tb?>">
									    	<div class="input-group-append">
									          	<div class="input-group-text">cm</div>
								    		</div>
									    </div>
									</div>
								</div>
							</div>
							<div class="col-6">
								<div class="row">
									<div class="col-4">Berat Badan</div>
									<div class="col-1">:</div>
									<div class="col">
										<div class="input-group">
									      	<input type="number" class="form-control" id="" name="" value="<?=$objek[0]->bb?>">
									    	<div class="input-group-append">
									          	<div class="input-group-text">kg</div>
								    		</div>
									    </div>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-6">
								<div class="row mt-3">
									<div class="col-4">Tekanan Darah</div>
									<div class="col-1">:</div>
									<div class="col">
										<div class="input-group">
									      	<input type="number" class="form-control mr-1" id="" name="" value="<?=$objek[0]->td1?>">
									      	/
									      	<input type="number" class="form-control ml-1" id="" name="" value="<?=$objek[0]->td2?>"><div class="input-group-append">
									          	<div class="input-group-text">mhg</div>
								    		</div>
									    </div>
									</div>
								</div>
							</div>
							<div class="col-6">
								<div class="row mt-3">
									<div class="col-4">Nadi</div>
									<div class="col-1">:</div>
									<div class="col">
										<div class="input-group">
									      	<input type="number" class="form-control" id="" name="" value="<?=$objek[0]->N?>">
									    	<div class="input-group-append">
									          	<div class="input-group-text">rpm</div>
								    		</div>
									    </div>
									</div>
								</div>
							</div>
						</div>

						<div class="row mt-3">
							<div class="col-6">
								<div class="row">
									<div class="col-4">Respiratory R.</div>
									<div class="col-1">:</div>
									<div class="col">
										<div class="input-group">
									      	<input type="number" class="form-control" id="" name="" value="<?=$objek[0]->RR?>">
									    	<div class="input-group-append">
									          	<div class="input-group-text">rpm</div>
								    		</div>
									    </div>
									</div>
								</div>
							</div>
							<div class="col-6">
								<div class="row">
									<div class="col-4">Temp. Axile</div>
									<div class="col-1">:</div>
									<div class="col">
										<div class="input-group">
									      	<input type="number" class="form-control" id="" name="" value="<?=$objek[0]->TAx?>">
									    	<div class="input-group-append">
									          	<div class="input-group-text">kg</div>
								    		</div>
									    </div>
									</div>
								</div>
							</div>
						</div>

						<div class="row mt-3">
							<div class="col-6">
								<div class="row">
									<div class="col-4">Head To Toe</div>
									<div class="col-1">:</div>
									<div class="col">
										<input type="text" class="form-control" id="" name="">
									</div>
								</div>
							</div>
							<div class="col-6">	
							</div>
						</div>

						<hr>

						<h5 class="text-center mt-3">Assesment</h5>
						<div class="row mt-3">
							<div class="col-2">Primary</div>
							<div class="col-1">:</div>
							<div class="col-9">
								<select class="js-data-example-ajax" id="primary" name="assessmentPrimary[]" multiple="multiple" style="width: 99%"></select>
							</div>	
						</div>

						<div class="row mt-3">
							<div class="col-2">Sekunder</div>
							<div class="col-1">:</div>
							<div class="col-9">
								<select class="js-data-example-ajax" id="secondary" name="assessmentSecondary[]" multiple="multiple" style="width: 99%"></select>
							</div>	
						</div>

						<div class="row mt-3">
							<div class="col-2">Lain-lain</div>
							<div class="col-1">:</div>
							<div class="col-9">
								<select class="js-data-example-ajax" id="lain" name="assessmentLain[]" multiple="multiple" style="width: 99%"></select>
							</div>	
						</div>

						<div class="row mt-3">
							<div class="col-2">Laboratorium</div>
							<div class="col-1">:</div>
							<div class="col-9">
								<input class="form-control" type="text" name="assessmentPemeriksaanLab" placeholder="Pemeriksaan Laboratorium" id="pemeriksaanLab">
							</div>	
						</div>

						<hr>

						<h5 class="text-center mt-3">Planing</h5>
						<textarea class="form-control" id="planning" aria-label="With textarea" required="" placeholder="Planing" name="planning"></textarea>
						<hr>

						<h5 class="text-center mt-3">Keperluan Rujukan</h5>

						<div class="row">
							<div class="col-2">Keluhan</div>
							<div class="col-1">:</div>
							<div class="col-9">
								<input class="form-control" type="text" name="">
							</div>	
						</div>

						<!-- Start Form GCS -->
						<div class="row mt-3">
							<div class="col-2">GCS</div>
							<div class="col-1">:</div>
							<div class="col"><input type="text" class="form-control" id="" name="GCS_E" placeholder="E" ></div>
							<div class="col"><input type="text" class="form-control" id="" name="GCS_V" placeholder="V" ></div>
							<div class="col"><input type="text" class="form-control" id="" name="GCS_M" placeholder="M" ></div>	
						</div>

						<div class="row mt-3">
							<div class="col-3"></div>
							<div class="col form-check ml-3">
								<input class="form-check-input" type="checkbox" name="">
								<label class="form-check-label">CM</label>
							</div>
							<div class="col form-check">
								<input class="form-check-input" type="checkbox" name="">
								<label class="form-check-label">Apatis</label>
							</div>
							<div class="col form-check">
								<input class="form-check-input" type="checkbox" name="">
								<label class="form-check-label">Derilium</label>
							</div>
						</div>

						<div class="row">
							<div class="col-3"></div>
							<div class="col form-check ml-3">
								<input class="form-check-input" type="checkbox" name="">
								<label class="form-check-label">Somnolen</label>
							</div>
							<div class="col form-check">
								<input class="form-check-input" type="checkbox" name="">
								<label class="form-check-label">Stupor</label>
							</div>
							<div class="col form-check">
								<input class="form-check-input" type="checkbox" name="">
								<label class="form-check-label">Coma</label>
							</div>
						</div>
						<!-- End Form GCS -->

						<h5 class="text-center mt-3">Head Toe To</h5>
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
									<input type="radio" class="form-control" id="" name="refchy_opsi" value="Isokor">
									</div>
								 	<label class="col-sm-1 col-form-label">anisokor</label>
								 	 <div class="input-group-prepend col-sm-3">
									<input type="radio" class="form-control" id="" name="refchy_opsi" value="Anisokor">
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
									<input type="radio" class="form-control" id="" name="metris" placeholder="" value="Simetris">
									</div>
								 	<label class="col-sm-1 col-form-label">Asimetris</label>
								 	 <div class="input-group-prepend col-sm-3">
									<input type="radio" class="form-control" id="" name="metris" placeholder="" value="Asimetris" >
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label"></label>
								 	<label class="col-sm-1 col-form-label">Wheezing</label>
								 	<div class="input-group-prepend col-sm-3">
									<input type="checkbox" class="form-control" id="" name="wheezing_kiri" placeholder="" value="1">
									</div>/
								 	 <div class="input-group-prepend col-sm-3">
									<input type="checkbox" class="form-control" id="" name="wheezing_kanan" placeholder="" value="1">
									</div>						
								</div>

								<div class="form-group row">
									<label class="col-sm-2 col-form-label"></label>
								 	<label class="col-sm-1 col-form-label">Ronkhi</label>
								 	<div class="input-group-prepend col-sm-3">
									<input type="checkbox" class="form-control" id="" name="ronkhi_kiri" placeholder="" value="1">
									</div>/
								 	 <div class="input-group-prepend col-sm-3">
									<input type="checkbox" class="form-control" id="" name="ronkhi_kanan" placeholder="" value="1">
									</div>						
								</div>

								<div class="form-group row">
									<label class="col-sm-2 col-form-label"></label>
								 	<label class="col-sm-1 col-form-label">Vesikuler</label>
								 	<div class="input-group-prepend col-sm-3">
									<input type="checkbox" class="form-control" id="" name="vesikuler_kiri" placeholder="" value="1">
									</div>/
								 	 <div class="input-group-prepend col-sm-3">
									<input type="checkbox" class="form-control" id="" name="vesikuler_kanan" placeholder="" value="1">
									</div>						
								</div>
								<fieldset class="form-group">
								    <div class="row">
								      	<legend class="col-form-label col-sm-2 pt-0">Jantung</legend>
									  	<legend class="col-form-label col-sm-1 pt-0">:</legend>
								      	<div class="col-sm-5">
								        	<div class="form-check">
								          		<input class="form-check-input" type="radio" name="jantung_icor" value="Tampak" >
								          		<label class="form-check-label">
								            		Tampak
								          		</label>
								        	</div>
								       		<div class="form-check">
								          		<input class="form-check-input" type="radio" name="jantung_icor" value="Tak Tampak">
								          		<label class="form-check-label">
								            		Tak Tampak
								          		</label>
								        	</div>
								    		<div class="row">
								      			<legend class="col-form-label col-sm-5 pt-0">S1 / S2</legend>
								      			<div class="col-sm-5">
								        			<div class="form-check">
								          				<input class="form-check-input" type="radio" name="s1_s2" value="Reguler" >
								          				<label class="form-check-label">
								            				Reguler
								          				</label>
								        			</div>
								        			<div class="form-check">
								          				<input class="form-check-input" type="radio" name="s1_s2" value="Irreguler" >
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
									<input type="radio" class="form-control" id="" name="BU" placeholder="" value="Normal">
									</div>
								 	<label class="col-sm-1 col-form-label">Meningkat</label>
								 	 <div class="input-group-prepend col-sm-3">
									<input type="radio" class="form-control" id="" name="BU" placeholder="" value="Meningkat">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label"></label>
									<label class="col-sm-1 col-form-label">Menurun</label>
								 	<div class="input-group-prepend col-sm-3">
									<input type="radio" class="form-control" id="" name="BU" placeholder="" value="Menurun">
									</div>
								 	<label class="col-sm-1 col-form-label">Negatif</label>
								 	 <div class="input-group-prepend col-sm-3">
									<input type="radio" class="form-control" id="" name="BU" placeholder="" value="Negatif">
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
								      	<input type="text" class="form-control" id="" name="hpmgl" placeholder="" value="">
								    </div>
								</div>
								<div class="form-group row">
									<label class="col-sm-3 col-form-label">Spleenomegali</label>
								    <div class="input-group-prepend col-sm-2">
								      	<input type="text" class="form-control" id="" name="spmgl" placeholder="" value="">
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
									        	<input class="form-check-input" type="radio" name="pitting" value="1">
									        	<label class="form-check-label">
									            	non-pitting
									          	</label>
									        </div>
								        </div>
								        <div class="col-sm-4">
								        	<div class="form-check">
								          		<input class="form-check-input" type="radio" name="pitting" value="0">
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
									<input type="text" class="form-control" id="terapi1" name="terapi1" placeholder="..." >
									</div>
								</div>	
								<div class="form-group row">
									<label class="col-sm-3 col-form-label"></label>
									<div class="input-group-prepend col">/R
									<input type="text" class="form-control" id="terapi2" name="terapi2" placeholder="..." >
									</div>
								</div>	
								<div class="form-group row">
									<label class="col-sm-3 col-form-label"></label>
									<div class="input-group-prepend col">/R
									<input type="text" class="form-control" id="terapi3" name="terapi3" placeholder="..." >
									</div>
								</div>







						
					</div>
				</div>

				<div class="tab-pane fade" id="surat_sakit" role="tabpanel" aria-labelledby="home-tab">
					<h5 class="text-center mt-3">Surat Sakit</h5>
					<div class="container">	
						<div class="row mt-3">
							<div class="col-2">Alasan</div>
							<div class="col">:</div>
							<div class="col-9">
								<select class="custom-select" id="alasan" name="alasan" required="">
									<option value="1">Istirahat Sakit</option>
									<option value="2">Pelakuan Khusus</option>
								</select>
							</div>
						</div>

						<div class="row mt-3">
							<div class="col-2">Tanggal Awal</div>
							<div class="col">:</div>
							<div class="col-9">
								<input type="date" class="form-control" id="tanggal_awal" name="tanggal_awal" required="" value="<?=date("Y-m-d")?>" readonly="">
							</div>
						</div>

						<div class="row mt-3">
							<div class="col-2">Selama</div>
							<div class="col">:</div>
							<div class="col-9">
								<div class="input-group">
						      	<input type="number" class="form-control" id="selama" name="selama" placeholder="Angka" >
							    	<div class="input-group-append">
						          		<select class="input-group-text custom-select" name="selama_satuan" id="selama_satuan" onchange="updateTglAkhir()" required="">
						          			<option selected="" disabled="">Satuan</option>
						          			<option value="hari">Hari</option>
						          			<option value="minggu">Minggu</option>
						          			<option value="bulan">Bulan</option>
						          		</select>
						    		</div>
							    </div>
							</div>
						</div>

						<div class="row mt-3">
							<div class="col-2">Tanggal Akhir</div>
							<div class="col">:</div>
							<div class="col-9">
								<input type="date" class="form-control" name="tanggal_akhir" id="tanggal_akhir" required="" readonly="" formart>
							</div>
						</div>

						<button type="submit" class="btn btn-primary mt-3 offset-11" onclick="SuratSakit()">Cetak</button>
					</div>
				</div>

				<div class="tab-pane fade" id="surat_sehat" role="tabpanel" aria-labelledby="home-tab">
					<div class="container">
						<h5 class="text-center mt-3">Surat Sehat</h5>

						<div class="row mt-3">
							<div class="col-3">Tes Buta Warna</div>
							<div class="col">:</div>
							<div class="col">
								<input type="radio" class="custom-control-input" id="tesButaWarna1" name="tes_buta_warna" value="Ya">
				  				<label class="custom-control-label" for="tesButaWarna1">Ya</label>
							</div>
							<div class="col">
								<input type="radio" class="custom-control-input" id="tesButaWarna2" name="tes_buta_warna" value="Tidak">
					  			<label class="custom-control-label" for="tesButaWarna2">Tidak</label>
							</div>
							<div class="col">
								<input type="radio" class="custom-control-input" id="tesButaWarna3" name="tes_buta_warna" value="Parsial">
								<label class="custom-control-label" for="tesButaWarna3">Parsial</label>
							</div>
						</div>

						<div class="row mt-3">
							<div class="col-3">Keperluan</div>
							<div class="col">:</div>
							<div class="col-8">
								<input type="text" class="form-control" name="keperluan" required="">
							</div>
						</div>

						<button type="submit" class="btn btn-primary mt-3 offset-11" onclick="SuratSehat()">Cetak</button>
					</div>
				</div>
			</div>
		</div>	
	</div>
</div>