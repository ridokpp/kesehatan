<style type="text/css">
	.my-error-class {color:#FF0000;}
	.my-valid-class {color:#00CC00;}
	.linone {display: none;}
	.no-bullets {list-style-type: none;}
</style>
<script type="text/javascript">

	// inisialisasi tabel rekam medis
	var addObat;
 	$(document).ready(function() {
 		$('#example').DataTable({
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
			],
			columnDefs: [ 
				{ 
				  orderable: false, 
				  targets: [2,3,4,5,6] 
				} 
			],
			select: true
		});
 		
		// inisialisasi dengan select2
		$('#diagnosaPrimaryId').select2();
    	$('#diagnosaSecondaryId').select2();
    	$('#diagnosaLainId').select2();

    	// inisialisasi dengan ajax 
    	$('.js-data-example-ajax').select2({
    		placeholder: "Pilih Sesuai ICD 10",
			ajax: {
				url: '<?=base_url()?>Dokter/cariICD/',
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
		$("#formSuratSehat").validate({
			rules:{
				keperluan:{
					required:true,
				}
			},messages:{
				keperluan:{
					required:"Mohon isi data yang dibutuhkan",
				}
			},
			errorClass: "my-error-class",
			validClass: "my-valid-class"
		});

		
		// untuk add input form obat
		var flagid = 0;
		addObat = function addObat() {
			$(".obat").select2();
			flagid += 1;
			$('#renderInputObat').append(	"<div class=row mt-5 mb-5'>"+
												"<div class='col-6'>"+
													"<select class='obat form-control' name='obat[]' style='height: 90%' id='obat"+flagid+"'>"+
														"<option selected=' disabled='>PIlih obat</option>"+
													"</select>"+
												"</div>"+
												"<div class='col-4'>"+
													"<input type='number' class='form-control' name='jumlah_obat[]' placeholder='jumlah yg diberikan' id='jumlah"+flagid+"' min='0'></input>"+
												"</div>"+
												"<div class='col'>"+
													"<input type='text' class='form-control' name='satuan[]' placeholder='satuan' id='satuan"+flagid+"' readonly=''></input>"+
												"</div>"+
											"</div>");
			$(".obat").select2({
				ajax: {
					url: '<?=base_url()?>Dokter/cariObat/',
					dataType: 'json',
					delay: 1000,
					data: function (term, page) {
						return {
							term: term, // search term
							page: 10
						};
					},
					processResults: function (data, page) {
						$('#jumlah'+flagid).attr({"max" : data[0].stok});
						$('#satuan'+flagid).val(data[0].satuan);
						return {
							results: data
						};
					},
					cache: true
				},
				escapeMarkup: function (markup) { return markup; },
				minimumInputLength: 1,
				theme : "bootstrap",
				templateResult: formatRepo,
	  			templateSelection: formatRepoSelection
			});
			function formatRepo (data) {
				if (data.loading) {
					return data.text;
				}

				var markup = "<div class='clearfix'>";

				markup += data.text+" :: Stok sekarang "+data.stok+
				"</div>";

				return markup;
			}

			function formatRepoSelection (data) {
				return data.text;
			}
		}
	});

	// setting tampilan live clock
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

	// setelah cetak surat sakit, tambahkan nomor surat sakit yang telah tercetak ke kolom planning untuk dokumnetasi lebih jelas
	function SuratSakit() {
		var jqxhr = $.get( "<?=base_url()?>Dokter/getTabelSurat/sakit/<?=$pasien[0]->nomor_pasien?>", function(data) {
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
		}).delay( 2000 )
		.fail(function() {
		alert( "error" );
		})
	}

	// function untuk menyalurkan tinggi badan via submit form surat sehat. executenya nyalip open blank page.
	function formSuratSehat() {
		document.getElementById('sistol_sehat').value 			= document.getElementById('sistol_pemeriksaan').value;
		document.getElementById('diastol_sehat').value 			= document.getElementById('diastol_pemeriksaan').value;
		if (document.getElementById('tinggi_badan_pemeriksaan').value !== 'undefined' && document.getElementById('berat_badan_pemeriksaan').value !== 'undefined' && document.getElementById('nadi_pemeriksaan').value !== 'undefined' && document.getElementById('respiratory_rate_pemeriksaan').value !== 'undefined' && document.getElementById('temperature_ax_pemeriksaan').value !== 'undefined') {
			document.getElementById('tinggi_badan_sehat').value 		= document.getElementById('tinggi_badan_pemeriksaan').value;
			document.getElementById('berat_badan_sehat').value 		= document.getElementById('berat_badan_pemeriksaan').value;
			document.getElementById('nadi_sehat').value 				= document.getElementById('nadi_pemeriksaan').value;
			document.getElementById('respiratory_rate_sehat').value 	= document.getElementById('respiratory_rate_pemeriksaan').value;
			document.getElementById('temperature_ax_sehat').value 	= document.getElementById('temperature_ax_pemeriksaan').value;
			return true;
		}else{
			alert('Mohon lengkapi data pemeriksaan objektif kecuali Head To Toe');
			return false;

		}
	}

	// setelah cetak surat sehat, tambahkan nomor surat sakit yang telah tercetak ke kolom planning untuk dokumnetasi lebih jelas
	function SuratSehat() {
		
		var jqxhr = $.get( "<?=base_url()?>Dokter/getTabelSurat/sehat/<?=$pasien[0]->nomor_pasien?>", function(data) {
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

		}).fail(function() {
		alert( "error" );
		})
	}

	// saat klik tombol surat rujukan. isi hidden form surat rujukan, karena secara tampilan satu form dengan pemeriksaan tapi secara koding beda tag form
	function formSuratRujukan() {
		// set input type hidden
		$('#nomor_pasien_rujukan').val($('#nomor_pasien_pemeriksaan').val());
		
		$('#subjektif_rujukan').val($('#subjektif_pemeriksaan').val());
		$('#gcs_e_rujukan').val($('#gcs_e_pemeriksaan').val());
		$('#gcs_v_rujukan').val($('#gcs_v_pemeriksaan').val());
		$('#gcs_m_rujukan').val($('#gcs_m_pemeriksaan').val());
		
		// set select2 untuk clear all option yang ada di hidden form. (restart). defaultya kosong
		$('#primary_rujukan').val(null).trigger('change');
		$('#secondary_rujukan').val(null).trigger('change');
		$('#lain_rujukan').val(null).trigger('change');
		
		// CREATE PRIMARY SELECT ELEMENT
		var primarySelected = $("#primary_pemeriksaan").select2('data');
		for (i in primarySelected){
			var primaryDescOnly = primarySelected[i].text.split(" / ");
			var newOption = new Option(primaryDescOnly[1], primaryDescOnly[1], true, true);
			$('#primary_rujukan').append(newOption).trigger('change');
		}
		// CREATE SECONDARY SELECT ELEMENT
		var secondarySelected = $("#secondary_pemeriksaan").select2('data');
		for (i in secondarySelected){
			var secondaryDescOnly = secondarySelected[i].text.split(" / ");
			var newOption = new Option(secondaryDescOnly[1], secondaryDescOnly[1], true, true);
			$('#secondary_rujukan').append(newOption).trigger('change');
		}
		// CREATE LAINLAIN SELECT ELEMENT
		var lainlainSelected = $("#lain_pemeriksaan").select2('data');
		for (i in lainlainSelected){
			lainlainDescOnly = lainlainSelected[i].text.split(" / ");
			var newOption = new Option(lainlainDescOnly[1], lainlainDescOnly[1], true, true);
			$('#lain_rujukan').append(newOption).trigger('change');
		}
		// get and set element text area
		var pemeriksaanLab = $("#pemeriksaan_lab_pemeriksaan").val();
		$("#pemeriksaan_lab_rujukan").val(pemeriksaanLab);

		$('#gcs_opsi_cm_rujukan').prop("checked" , $('#gcs_opsi_cm_pemeriksaan').prop("checked"));
		$('#gcs_opsi_apatis_rujukan').prop("checked" , $('#gcs_opsi_apatis_pemeriksaan').prop("checked"))
		$('#gcs_opsi_derilium_rujukan').prop("checked" , $('#gcs_opsi_derilium_pemeriksaan').prop("checked"))
		$('#gcs_opsi_somnolen_rujukan').prop("checked" , $('#gcs_opsi_somnolen_pemeriksaan').prop("checked"))
		$('#gcs_opsi_stupor_rujukan').prop("checked" , $('#gcs_opsi_stupor_pemeriksaan').prop("checked"))
		$('#gcs_opsi_coma_rujukan').prop("checked" , $('#gcs_opsi_coma_pemeriksaan').prop("checked"))

		$('#tinggi_badan_rujukan').val($('#tinggi_badan_pemeriksaan').val());
		$('#berat_badan_rujukan').val($('#berat_badan_pemeriksaan').val());
		$('#sistol_rujukan').val($('#sistol_pemeriksaan').val());
		$('#diastol_rujukan').val($('#diastol_pemeriksaan').val());
		$('#respiratory_rate_rujukan').val($('#respiratory_rate_pemeriksaan').val());
		$('#nadi_rujukan').val($('#nadi_pemeriksaan').val());
		$('#temperature_ax_rujukan').val($('#temperature_ax_pemeriksaan').val());

		$('#anemis_kiri_rujukan').prop("checked" , $('#anemis_kiri_pemeriksaan').prop("checked"))
		$('#anemis_kanan_rujukan').prop("checked" , $('#anemis_kanan_pemeriksaan').prop("checked"))
		$('#ikterik_kiri_rujukan').prop("checked" , $('#ikterik_kiri_pemeriksaan').prop("checked"))
		$('#ikterik_kanan_rujukan').prop("checked" , $('#ikterik_kanan_pemeriksaan').prop("checked"))
		$('#cianosis_kiri_rujukan').prop("checked" , $('#cianosis_kiri_pemeriksaan').prop("checked"))
		$('#cianosis_kanan_rujukan').prop("checked" , $('#cianosis_kanan_pemeriksaan').prop("checked"))
		$('#deformitas_kiri_rujukan').prop("checked" , $('#deformitas_kiri_pemeriksaan').prop("checked"))
		$('#deformitas_kanan_rujukan').prop("checked" , $('#deformitas_kanan_pemeriksaan').prop("checked"))
		$('#refchy_kiri_rujukan').prop("checked" , $('#refchy_kiri_pemeriksaan').prop("checked"))
		$('#refchy_kanan_rujukan').prop("checked" , $('#refchy_kanan_pemeriksaan').prop("checked"))
		$('#kepala_ket_tambahan_rujukan').val($('#kepala_ket_tambahan_pemeriksaan').val());

		$('#wheezing_kiri_rujukan').prop("checked" , $('#wheezing_kiri_pemeriksaan').prop("checked"))
		$('#wheezing_kanan_rujukan').prop("checked" , $('#wheezing_kanan_pemeriksaan').prop("checked"))
		$('#ronkhi_kiri_rujukan').prop("checked" , $('#ronkhi_kiri_pemeriksaan').prop("checked"))
		$('#ronkhi_kanan_rujukan').prop("checked" , $('#ronkhi_kanan_pemeriksaan').prop("checked"))
		$('#vesikuler_kiri_rujukan').prop("checked" , $('#vesikuler_kiri_pemeriksaan').prop("checked"))
		$('#vesikuler_kanan_rujukan').prop("checked" , $('#vesikuler_kanan_pemeriksaan').prop("checked"))
		$('#jantung_suaratambahan_rujukan').val($('#jantung_suaratambahan_pemeriksaan').val());
		$('#jantung_ket_tambahan_rujukan').val($('#jantung_ket_tambahan_pemeriksaan').val());

		$('#nyeri_tekan1_rujukan').prop("checked" , $('#nyeri_tekan1_pemeriksaan').prop("checked"))
		$('#nyeri_tekan2_rujukan').prop("checked" , $('#nyeri_tekan2_pemeriksaan').prop("checked"))
		$('#nyeri_tekan3_rujukan').prop("checked" , $('#nyeri_tekan3_pemeriksaan').prop("checked"))
		$('#nyeri_tekan4_rujukan').prop("checked" , $('#nyeri_tekan4_pemeriksaan').prop("checked"))
		$('#nyeri_tekan5_rujukan').prop("checked" , $('#nyeri_tekan5_pemeriksaan').prop("checked"))
		$('#nyeri_tekan6_rujukan').prop("checked" , $('#nyeri_tekan6_pemeriksaan').prop("checked"))
		$('#nyeri_tekan7_rujukan').prop("checked" , $('#nyeri_tekan7_pemeriksaan').prop("checked"))
		$('#nyeri_tekan8_rujukan').prop("checked" , $('#nyeri_tekan8_pemeriksaan').prop("checked"))
		$('#nyeri_tekan9_rujukan').prop("checked" , $('#nyeri_tekan9_pemeriksaan').prop("checked"))
		$('#hepatomegali_rujukan').val($('#hepatomegali_pemeriksaan').val());
		$('#spleenomegali_rujukan').val($('#spleenomegali_pemeriksaan').val());
		$('#abdomen_ket_tambahan_rujukan').val($('#abdomen_ket_tambahan_pemeriksaan').val());
		$('#akral_hangat1_rujukan').prop("checked" , $('#akral_hangat1_pemeriksaan').prop("checked"))
		$('#akral_hangat2_rujukan').prop("checked" , $('#akral_hangat2_pemeriksaan').prop("checked"))
		$('#akral_hangat3_rujukan').prop("checked" , $('#akral_hangat3_pemeriksaan').prop("checked"))
		$('#akral_hangat4_rujukan').prop("checked" , $('#akral_hangat4_pemeriksaan').prop("checked"))
		$('#crt1_rujukan').prop("checked" , $('#crt1_pemeriksaan').prop("checked"))
		$('#crt2_rujukan').prop("checked" , $('#crt2_pemeriksaan').prop("checked"))
		$('#crt3_rujukan').prop("checked" , $('#crt3_pemeriksaan').prop("checked"))
		$('#crt4_rujukan').prop("checked" , $('#crt4_pemeriksaan').prop("checked"))
		$('#edema1_rujukan').prop("checked" , $('#edema1_pemeriksaan').prop("checked"))
		$('#edema2_rujukan').prop("checked" , $('#edema2_pemeriksaan').prop("checked"))
		$('#edema3_rujukan').prop("checked" , $('#edema3_pemeriksaan').prop("checked"))
		$('#edema4_rujukan').prop("checked" , $('#edema4_pemeriksaan').prop("checked"))
		$('#ekstermitas_kettambahan_rujukan').val($('#ekstermitas_kettambahan_pemeriksaan').val());
		$('#lain_lain_rujukan').val($('#lain_lain_pemeriksaan').val());
		$('#planning_rujukan').val($('#planning_pemeriksaan').val());
		$('#terapi1_rujukan').val($('#terapi1_pemeriksaan').val());
		$('#terapi2_rujukan').val($('#terapi2_pemeriksaan').val());
		$('#terapi3_rujukan').val($('#terapi3_pemeriksaan').val());

		$("input[name='refchy_opsi_rujukan'][value='"+$("input[name=refchy_opsi_pemeriksaan]:checked").val()+"']").prop('checked', true);
 		$("input[name='paru_simetris_asimetris_rujukan'][value='"+$("input[name=paru_simetris_asimetris_pemeriksaan]:checked").val()+"']").prop('checked', true);
		$("input[name='jantung_ictuscordis_rujukan'][value='"+$("input[name=jantung_ictuscordis_pemeriksaan]:checked").val()+"']").prop('checked', true);
		$("input[name='jantung_s1_s2_rujukan'][value='"+$("input[name=jantung_s1_s2_pemeriksaan]:checked").val()+"']").prop('checked', true);

		$("input[name='BU_rujukan'][value='"+$("input[name=BU_pemeriksaan]:checked").val()+"']").prop('checked', true);

		$("input[name='pitting_rujukan'][value='"+$("input[name=pitting_pemeriksaan]:checked").val()+"']").prop('checked', true);
		
		$('#headtotoe_rujukan').val($('#headtotoe_pemeriksaan').val());

		$('#suratrujukan')[0].submit();

	}

	// saat submit cetak surat rujukan, tambahkan nomor surat sakit yang telah tercetak ke kolom planning untuk dokumnetasi lebih jelas
	function SuratRujukan() {
		var jqxhr = $.get( "<?=base_url()?>Dokter/getTabelSurat/rujukan/<?=$pasien[0]->nomor_pasien?>", function(data) {
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


</script>

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
			</div>

			<div class="row mt-3 text-center">
				<div class="col"><strong><?=$pasien[0]->nomor_pasien?></strong></div>
			</div>

			<div class="row mt-3">
				<div class="col-3">Nama</div>
				<div class="col-1">:</div>
				<div class="col"><?=$pasien[0]->nama?></div>
			</div>

			<div class="row">
				<div class="col-3">NIK</div>
				<div class="col-1">:</div>
				<div class="col"><?=$pasien[0]->nik?></div>
			</div>

			<div class="row">
				<div class="col-3">TTL</div>
				<div class="col-1">:</div>
				<div class="col"><?=$pasien[0]->tempat_lahir?>, <?=tgl_indo($pasien[0]->tanggal_lahir)?></div>
			</div>

			<div class="row mt-3">
				<div class="col-3">Usia</div>
				<div class="col-1">:</div>
				<div class="col"><?=$pasien[0]->usia?> Tahun</div>
			</div>

			<div class="row">
				<div class="col-3">Alamat</div>
				<div class="col-1">:</div>
				<div class="col"><?=$pasien[0]->alamat?></div>
			</div>
			
			<div class="row">
				<div class="col-3">Jenis Kelamin</div>
				<div class="col-1">:</div>
				<div class="col"><?=$pasien[0]->jenis_kelamin?></div>
			</div>

			<div class="row">
				<div class="col-3">Pekerjaan</div>
				<div class="col-1">:</div>
				<div class="col"><?=$pasien[0]->pekerjaan?></div>
			</div>
			
		</div>
		<div class="col-9 border rounded">
			<ul class="nav nav-tabs mt-3" id="myTab" role="tablist">
				<li class="nav-item">
					<a class="nav-link" id="home-tab" data-toggle="tab" href="#rekam_medis" role="tab" aria-controls="rekam_medis" aria-selected="true">Rekam Medis</a>
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


<!-- REKAM MEDIS -->
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
											<?=tgl_indo(substr($value->tanggal_jam,0,10))?>
									 	</td>
									  	<td>
											<?=$value->subjektif?>
									  	</td>
									  	<td>
											<ul>
												<li class="no-bullets">TB/BB : <?=$value->tinggi_badan?> cm/ <?=$value->berat_badan?> Kg</li>
												<li class="no-bullets">TD : <?=$value->sistol?>/<?=$value->diastol?> mmHg</li>
												<li class="no-bullets">RR : <?=$value->respiratory_rate?></li>
												<li class="no-bullets">N  : <?=$value->nadi?> rpm</li>
												<li class="no-bullets">TAx: <?=$value->temperature_ax?> &deg;C</li>
												<li class="no-bullets">Head to Toe : <?=$value->headtotoe?></li>
											</ul>
									  	</td>
										<td></td>
										<td></td>
										<td><button type="button" class="btn btn-primary" >CETAK</button> </td>
									</tr>
								 	<?php $i++; }
									?>
									</tbody>
							  	</table>
							</div>
						</div>
						<form method="POST" action="<?=base_url()?>Dokter/cetakRM" target="_blank">
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
<!-- REKAM MEDIS -->


<!-- TAB PEMERIKSAAN -->
				<div class="tab-pane fade show active" id="pemeriksaan" role="tabpanel" aria-labelledby="profile-tab">
					<form method="POST" action="<?=base_url('Dokter/submitPemeriksaan')?>">
						<input type="hidden" name="nomor_pasien" value="<?=$pasien[0]->nomor_pasien?>" id="nomor_pasien_pemeriksaan">
						<div class="container">
							<h5 class="text-center mt-3">Subjektif</h5>
								<textarea class="form-control" aria-label="With textarea" placeholder="Subjektif" name="subjektif" id="subjektif_pemeriksaan"></textarea>
							<hr>

							<h5 class="text-center mt-3">Objektif</h5>
<!-- START FORM OBJEKTIF -->
							<div class="row mt-3">
								<div class="col-6">
									<div class="row">
										<div class="col-4">Tinggi Badan</div>
										<div class="col-1">:</div>
										<div class="col">
											<div class="input-group">
										      	<input type="number" class="form-control" id="tinggi_badan_pemeriksaan" name="tinggi_badan" value="<?=(isset($rekam_medis[0]->tinggi_badan) ? $rekam_medis[0]->tinggi_badan : '')?>">
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
										      	<input type="number" class="form-control" id="berat_badan_pemeriksaan" name="berat_badan" value="<?=(isset($rekam_medis[0]->berat_badan) ? $rekam_medis[0]->berat_badan : '')?>">
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
										      	<input type="number" class="form-control mr-1" id="sistol_pemeriksaan" name="sistol" value="<?=(isset($rekam_medis[0]->sistol) ? $rekam_medis[0]->sistol : '')?>" <?=($pasien[0]->pembayaran == 'RF' ? '' : 'disabled=""' )?>>
										      	/
										      	<input type="number" class="form-control ml-1" id="diastol_pemeriksaan" name="diastol" value="<?=(isset($rekam_medis[0]->diastol) ? $rekam_medis[0]->diastol : '')?>" <?=($pasien[0]->pembayaran == 'RF' ? '' : 'disabled=""' )?>><div class="input-group-append">
										          	<div class="input-group-text">mmHg</div>
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
										      	<input type="number" class="form-control" id="nadi_pemeriksaan" name="nadi" value="<?=(isset($rekam_medis[0]->nadi) ? $rekam_medis[0]->nadi : '')?>">
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
										      	<input type="number" class="form-control" id="respiratory_rate_pemeriksaan" name="respiratory_rate" value="<?=(isset($rekam_medis[0]->respiratory_rate) ? $rekam_medis[0]->respiratory_rate : '')?>">
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
										      	<input type="number" class="form-control" id="temperature_ax_pemeriksaan" name="temperature_ax" value="<?=(isset($rekam_medis[0]->temperature_ax) ? $rekam_medis[0]->temperature_ax : '')?>">
										    	<div class="input-group-append">
										          	<div class="input-group-text">&deg;C</div>
									    		</div>
										    </div>
										</div>
									</div>
								</div>
							</div>

							<div class="row mt-3">
									<div class="col-2">Head To Toe</div>
									<div class="col-1">:</div>
									<div class="col">
										<input type="text" class="form-control" id="headtotoe_pemeriksaan" name="headtotoe">
									</div>
							</div>
<!-- END FORM OBJEKTIF -->							

							<hr>

							<h5 class="text-center mt-3">Assesment</h5>
							<div class="row mt-3">
								<div class="col-2">Primary</div>
								<div class="col-1">:</div>
								<div class="col-9">
									<select class="js-data-example-ajax" id="primary_pemeriksaan" name="assessmentPrimary[]" multiple="multiple" style="width: 99%"></select>
								</div>	
							</div>

							<div class="row mt-3">
								<div class="col-2">Sekunder</div>
								<div class="col-1">:</div>
								<div class="col-9">
									<select class="js-data-example-ajax" id="secondary_pemeriksaan" name="assessmentSecondary[]" multiple="multiple" style="width: 99%"></select>
								</div>	
							</div>

							<div class="row mt-3">
								<div class="col-2">Lain-lain</div>
								<div class="col-1">:</div>
								<div class="col-9">
									<select class="js-data-example-ajax" id="lain_pemeriksaan" name="assessmentLain[]" multiple="multiple" style="width: 99%"></select>
								</div>	
							</div>

							<div class="row mt-3">
								<div class="col-2">Laboratorium</div>
								<div class="col-1">:</div>
								<div class="col-9">
									<input class="form-control" type="text" name="assessmentPemeriksaanLab" placeholder="Pemeriksaan Laboratorium" id="pemeriksaan_lab_pemeriksaan">
								</div>	
							</div>

							<hr>

<!-- Start Form GCS -->
							<div class="row mt-3">
								<div class="col-2">GCS</div>
								<div class="col-1">:</div>
								<div class="col"><input type="text" class="form-control" id="gcs_e_pemeriksaan" name="gcs_e" placeholder="E" ></div>
								<div class="col"><input type="text" class="form-control" id="gcs_v_pemeriksaan" name="gcs_v" placeholder="V" ></div>
								<div class="col"><input type="text" class="form-control" id="gcs_m_pemeriksaan" name="gcs_m" placeholder="M" ></div>	
							</div>

							<div class="row mt-3">
								<div class="col-3"></div>
								<div class="col form-check ml-3">
									<input class="form-check-input" type="checkbox" id="gcs_opsi_cm_pemeriksaan" name="gcs_opsi[]" value="CM">
									<label class="form-check-label">CM</label>
								</div>
								<div class="col form-check">
									<input class="form-check-input" type="checkbox" id="gcs_opsi_apatis_pemeriksaan" name="gcs_opsi[]" value="Apatis">
									<label class="form-check-label">Apatis</label>
								</div>
								<div class="col form-check">
									<input class="form-check-input" type="checkbox" id="gcs_opsi_derilium_pemeriksaan" name="gcs_opsi[]" value="Derilium">
									<label class="form-check-label">Derilium</label>
								</div>
							</div>

							<div class="row">
								<div class="col-3"></div>
								<div class="col form-check ml-3">
									<input class="form-check-input" type="checkbox" id="gcs_opsi_somnolen_pemeriksaan" name="gcs_opsi[]" value="Somnolen">
									<label class="form-check-label">Somnolen</label>
								</div>
								<div class="col form-check">
									<input class="form-check-input" type="checkbox" id="gcs_opsi_stupor_pemeriksaan" name="gcs_opsi[]" value="Stupor">
									<label class="form-check-label">Stupor</label>
								</div>
								<div class="col form-check">
									<input class="form-check-input" type="checkbox" id="gcs_opsi_coma_pemeriksaan" name="gcs_opsi[]" value="Coma">
									<label class="form-check-label">Coma</label>
								</div>
							</div>
<!-- End Form GCS -->
							<hr>
<!-- KEPALA -->							
							<h5 class="text-center mt-3">Head Toe To</h5>
							<h6 class="text-center">Kepala</h6>

							<div class="row mt-3">
								<div class="col-6">
									<div class="row">
										<div class="col-4">Anemis</div>
										<div class="col-1">:</div>
										<div class="col-3 mt-2">
											<input type="checkbox" class="form-control" id="anemis_kiri_pemeriksaan" name="anemis_kiri" value="1">
										</div>
										<div class="col-1">/</div>
										<div class="col-3 mt-2">
											<input type="checkbox" class="form-control" id="anemis_kanan_pemeriksaan" name="anemis_kanan" value="1">
										</div>
									</div>
								</div>
								<div class="col-6">
									<div class="row">
										<div class="col-4">Ikterik</div>
										<div class="col-1">:</div>
										<div class="col-3 mt-2">
											<input type="checkbox" class="form-control" id="ikterik_kiri_pemeriksaan" name="ikterik_kiri" value="1">
										</div>
										<div class="col-1">/</div>
										<div class="col-3 mt-2">
											<input type="checkbox" class="form-control" id="ikterik_kanan_pemeriksaan" name="ikterik_kanan" value="1">
										</div>
									</div>
								</div>
							</div>
							<div class="row mt-3">
								<div class="col-6">
									<div class="row">
										<div class="col-4">Cianosis</div>
										<div class="col-1">:</div>
										<div class="col-3 mt-2">
											<input type="checkbox" class="form-control" id="cianosis_kiri_pemeriksaan" name="cianosis_kiri" value="1">
										</div>
										<div class="col-1">/</div>
										<div class="col-3 mt-2">
											<input type="checkbox" class="form-control" id="cianosis_kanan_pemeriksaan" name="cianosis_kanan" value="1">
										</div>
									</div>
								</div>
								<div class="col-6">
									<div class="row">
										<div class="col-4">Deformitas</div>
										<div class="col-1">:</div>
										<div class="col-3 mt-2">
											<input type="checkbox" class="form-control" id="deformitas_kiri_pemeriksaan" name="deformitas_kiri" value="1">
										</div>
										<div class="col-1">/</div>
										<div class="col-3 mt-2">
											<input type="checkbox" class="form-control" id="deformitas_kanan_pemeriksaan" name="deformitas_kanan" value="1">
										</div>
									</div>
								</div>
							</div>
							<div class="row mt-3">
								<div class="col-6">
									<div class="row">
										<div class="col-4">Reflek Cahaya</div>
										<div class="col-1">:</div>
										<div class="col-3 mt-2">
											<input type="checkbox" class="form-control" id="refchy_kiri_pemeriksaan" name="refchy_kiri" value="1">
										</div>
										<div class="col-1">/</div>
										<div class="col-3 mt-2">
											<input type="checkbox" class="form-control" id="refchy_kanan_pemeriksaan" name="refchy_kanan" value="1">
										</div>
									</div>
								</div>
								<div class="col-6">
									<div class="row">
										<div class="col">Isokor</div>
										<div class="col mt-2"><input type="radio" class="form-control" id="refchy_opsi_pemeriksaan" name="refchy_opsi_pemeriksaan" value="Isokor"></div>
										<div class="col ml">Anisokor</div>
										<div class="col mt-2"><input type="radio" class="form-control" id="refchy_opsi_pemeriksaan" name="refchy_opsi_pemeriksaan" value="Anisokor"></div>
									</div>
								</div>
							</div>

							<div class="row mt-3">
								<div class="col-2">Ket. Tambahan</div>
								<div class="col-1">:</div>
								<div class="col">
									<input class="form-control" type="text" name="kepala_ket_tambahan" placeholder="Keterangan tambahan kepala" id="kepala_ket_tambahan_pemeriksaan">
								</div>		
							</div>
<!-- END KEPALA -->							
							<hr>

							<h6 class="text-center mt-3">Thorak</h6>
							<h6 class="text-center">Paru</h6>

							<div class="row mt-3">
								<div class="col-6">
									<div class="row">
										<div class="col">Simetris</div>
										<div class="col mt-2"><input type="radio" class="form-control" id="" name="paru_simetris_asimetris_pemeriksaan" value="Simetris"></div>
										<div class="col ml">Asimetris</div>
										<div class="col mt-2"><input type="radio" class="form-control" id="" name="paru_simetris_asimetris_pemeriksaan" value="Asimetris"></div>
									</div>
								</div>
								<div class="col-6">
									<div class="row">
										<div class="col-4">Wheezing</div>
										<div class="col-1">:</div>
										<div class="col-3 mt-2">
											<input type="checkbox" class="form-control" id="wheezing_kiri_pemeriksaan" name="wheezing_kiri" value="1">
										</div>
										<div class="col-1">/</div>
										<div class="col-3 mt-2">
											<input type="checkbox" class="form-control" id="wheezing_kanan_pemeriksaan" name="wheezing_kanan" value="1">
										</div>
									</div>
								</div>
							</div>

							<div class="row mt-3">
								<div class="col-6">
									<div class="row">
										<div class="col-4">Ronkhi</div>
										<div class="col-1">:</div>
										<div class="col-3 mt-2">
											<input type="checkbox" class="form-control" id="ronkhi_kiri_pemeriksaan" name="ronkhi_kiri" placeholder="" value="1">
										</div>
										<div class="col-1">/</div>
										<div class="col-3 mt-2">
											<input type="checkbox" class="form-control" id="ronkhi_kanan_pemeriksaan" name="ronkhi_kanan" placeholder="" value="1">
										</div>
									</div>
								</div>
								<div class="col-6">
									<div class="row">
										<div class="col-4">Vesikular</div>
										<div class="col-1">:</div>
										<div class="col-3 mt-2">
											<input type="checkbox" class="form-control" id="vesikuler_kiri_pemeriksaan" name="vesikuler_kiri" placeholder="" value="1">
										</div>
										<div class="col-1">/</div>
										<div class="col-3 mt-2">
											<input type="checkbox" class="form-control" id="vesikuler_kanan_pemeriksaan" name="vesikuler_kanan" placeholder="" value="1">
										</div>
									</div>
								</div>
							</div>

							<hr>

							<h6 class="text-center mt-3">Jantung</h6>

							<div class="row mt-3">
								<div class="col-6">
									<div class="row">
										<div class="col-4">Tampak</div>
										<div class="col mt-2"><input type="radio" class="form-control" id="" name="jantung_ictuscordis_pemeriksaan" value="Tampak"></div>
										<div class="col-4ml">Tak Tampak</div>
										<div class="col mt-2"><input type="radio" class="form-control" id="" name="jantung_ictuscordis_pemeriksaan" value="Tak Tampak"></div>
									</div>
								</div>
								<div class="col-6">
									<div class="row">
										<div class="col">Reguler</div>
										<div class="col mt-2"><input type="radio" class="form-control" id="" name="jantung_s1_s2_pemeriksaan" value="Reguler"></div>
										<div class="col ml">Irreguler</div>
										<div class="col mt-2"><input type="radio" class="form-control" id="" name="jantung_s1_s2_pemeriksaan" value="Irreguler"></div>
									</div>
								</div>
							</div>

							<div class="row mt-3">
								<div class="col-6">
									<div class="row">
										<div class="col-4">Suara Tambahan</div>
										<div class="col-1">:</div>
										<div class="col">
									      	<input type="text" class="form-control" id="jantung_suaratambahan_pemeriksaan" name="jantung_suaratambahan">
										</div>
									</div>
								</div>
								<div class="col-6">
									<div class="row">
										<div class="col-4">Keterangan Tambahan</div>
										<div class="col-1">:</div>
										<div class="col">
									      	<input type="text" class="form-control" id="jantung_ket_tambahan_pemeriksaan" name="jantung_ket_tambahan">
										</div>
									</div>
								</div>
							</div>

							<hr>

							<h6 class="text-center mt-3">Abdomen</h6>

							<div class="row mt-3">
								<div class="col-2">BU</div>
								<div class="col-1">:</div>
								<div class="col-1">Normal</div>
								<div class="col-1 mt-2"><input type="radio" class="form-control" id="" name="BU_pemeriksaan" placeholder="" value="Normal"></div>
								<div class="col-1">Menurun</div>
								<div class="col-1 mt-2"><input type="radio" class="form-control" id="" name="BU_pemeriksaan" placeholder="" value="Menurun"></div>
								<div class="col-1">Meningkat</div>
								<div class="col-1 mt-2"><input type="radio" class="form-control" id="" name="BU_pemeriksaan" placeholder="" value="Meningkat"></div>
								<div class="col-1">Negatif</div>
								<div class="col-1 mt-2"><input type="radio" class="form-control" id="" name="BU_pemeriksaan" placeholder="" value="Negatif"></div>
							</div>

							<div class="row mt-3">
								<div class="col-2">Nyeri Tekan</div>
								<div class="col-1">:</div>
								<div class="col-1">
									<input class="form-check-input" type="checkbox" id="nyeri_tekan1_pemeriksaan" name="nyeri_tekan1" value="1">
									<label class="form-check-label">1</label>
								</div>
								<div class="col-1">
									<input class="form-check-input" type="checkbox" id="nyeri_tekan2_pemeriksaan" name="nyeri_tekan2" value="1">
									<label class="form-check-label">2</label>
								</div>
								<div class="col-1">
									<input class="form-check-input" type="checkbox" id="nyeri_tekan3_pemeriksaan" name="nyeri_tekan3" value="1">
									<label class="form-check-label">3</label>
								</div>
								<div class="col-1">
									<input class="form-check-input" type="checkbox" id="nyeri_tekan4_pemeriksaan" name="nyeri_tekan4" value="1">
									<label class="form-check-label">4</label>
								</div>
								<div class="col-1">
									<input class="form-check-input" type="checkbox" id="nyeri_tekan5_pemeriksaan" name="nyeri_tekan5" value="1">
									<label class="form-check-label">5</label>
								</div>
								<div class="col-1">
									<input class="form-check-input" type="checkbox" id="nyeri_tekan6_pemeriksaan" name="nyeri_tekan6" value="1">
									<label class="form-check-label">6</label>
								</div>
								<div class="col-1">
									<input class="form-check-input" type="checkbox" id="nyeri_tekan7_pemeriksaan" name="nyeri_tekan7" value="1">
									<label class="form-check-label">7</label>
								</div>
								<div class="col-1">
									<input class="form-check-input" type="checkbox" id="nyeri_tekan8_pemeriksaan" name="nyeri_tekan8" value="1">
									<label class="form-check-label">8</label>
								</div><div class="col-1">
									<input class="form-check-input" type="checkbox" id="nyeri_tekan9_pemeriksaan" name="nyeri_tekan9" value="1">
									<label class="form-check-label">9</label>
								</div>
							</div>

							<div class="row mt-3">
								<div class="col-2">Hepatomegali</div>
								<div class="col-1">:</div>
								<div class="col">
									<input type="text" class="form-control" id="hepatomegali_pemeriksaan" name="hepatomegali" placeholder="">
								</div>
							</div>

							<div class="row mt-3">
								<div class="col-2">Spleenomegali</div>
								<div class="col-1">:</div>
								<div class="col-9">
									<input type="text" class="form-control" id="spleenomegali_pemeriksaan" name="spleenomegali" placeholder="">
								</div>
							</div>
							<div class="row mt-3">
								<div class="col-2">Keterangan Tambahan Abdomen</div>
								<div class="col-1">:</div>
								<div class="col">
									<textarea class="form-control" aria-label="With textarea" id="abdomen_ket_tambahan_pemeriksaan" name="abdomen_ket_tambahan" placeholder="Keterangan Tambahan" ></textarea>
								</div>
							</div>

							<hr>

							<h6 class="text-center mt-3">Ekstermitas</h6>

							<div class="row mt-3">
								<div class="col-2">Akral Hangat</div>
								<div class="col-1">:</div>
								<div class="col-1">
									<input class="form-check-input" type="checkbox" id="akral_hangat1_pemeriksaan" name="akral_hangat_1" value="1">
									<label class="form-check-label">1</label>
								</div>
								<div class="col-1">
									<input class="form-check-input" type="checkbox" id="akral_hangat2_pemeriksaan" name="akral_hangat_2" value="1">
									<label class="form-check-label">2</label>
								</div>
								<div class="col-1">
									<input class="form-check-input" type="checkbox" id="akral_hangat3_pemeriksaan" name="akral_hangat_3" value="1">
									<label class="form-check-label">3</label>
								</div>
								<div class="col-1">
									<input class="form-check-input" type="checkbox" id="akral_hangat4_pemeriksaan" name="akral_hangat_4" value="1">
									<label class="form-check-label">4</label>
								</div>
							</div>

							<div class="row mt-3">
								<div class="col-2">CRT</div>
								<div class="col-1">:</div>
								<div class="col-1">
									<input class="form-check-input" type="checkbox" id="crt1_pemeriksaan" name="crt_1" value="1">
									<label class="form-check-label">1</label>
								</div>
								<div class="col-1">
									<input class="form-check-input" type="checkbox" id="crt2_pemeriksaan" name="crt_2" value="1">
									<label class="form-check-label">2</label>
								</div>
								<div class="col-1">
									<input class="form-check-input" type="checkbox" id="crt3_pemeriksaan" name="crt_3" value="1">
									<label class="form-check-label">3</label>
								</div>
								<div class="col-1">
									<input class="form-check-input" type="checkbox" id="crt4_pemeriksaan" name="crt_4" value="1">
									<label class="form-check-label">4</label>
								</div>
								<div class="col-1">/</div>
								<div class="col-2">2 Detik</div>
							</div>

							<div class="row mt-3">
								<div class="col-2">Edema</div>
								<div class="col-1">:</div>
								<div class="col-1">
									<input class="form-check-input" type="checkbox" id="edema1_pemeriksaan" name="edema_1" value="1">
									<label class="form-check-label">1</label>
								</div>
								<div class="col-1">
									<input class="form-check-input" type="checkbox" id="edema2_pemeriksaan" name="edema_2" value="1">
									<label class="form-check-label">2</label>
								</div>
								<div class="col-1">
									<input class="form-check-input" type="checkbox" id="edema3_pemeriksaan" name="edema_3" value="1">
									<label class="form-check-label">3</label>
								</div>
								<div class="col-1">
									<input class="form-check-input" type="checkbox" id="edema4_pemeriksaan" name="edema_4" value="1">
									<label class="form-check-label">4</label>
								</div>
							</div>

							<div class="row mt-3">
								<div class="col-2">Ekstermitas</div>
								<div class="col-1">:</div>
								<div class="col">
									<input class="form-check-input" type="radio" name="pitting_pemeriksaan" value="Non-pitting">
						        	<label class="form-check-label">Non-pitting</label>
								</div>
								<div class="col">
									<input class="form-check-input" type="radio" name="pitting_pemeriksaan" value="Pitting">
						        	<label class="form-check-label">Pitting</label>
								</div>
							</div>

							<div class="row mt-3">
								<div class="col-2">Keterangan Tambahan Ekstermitas</div>
								<div class="col-1">:</div>
								<div class="col">
									<textarea class="form-control" aria-label="With textarea" id="ekstermitas_kettambahan_pemeriksaan" name="ekstermitas_ket_tambahan" placeholder="Keterangan Tambahan"></textarea>
								</div>
							</div>
							<hr>

							<h6 class="text-center mt-3">Lain-lain</h6>
							
							<div class="row mt-3">
								<div class="col">
									<textarea class="form-control" aria-label="With textarea" id="lain_lain_pemeriksaan" name="lain_lain" placeholder="Lain-lain"></textarea>
								</div>
							</div>

							<hr>
							<h5 class="text-center mt-3">Planing</h5>
							<textarea class="form-control" aria-label="With textarea" placeholder="Planing" id="planning_pemeriksaan" name="planning"></textarea>

							<hr>
							<h6 class="text-center mt-3">Terapi</h6>

							<div class="row mt-3">
								<div class="col">
									<textarea class="form-control" aria-label="With textarea" id="terapi1_pemeriksaan" name="terapi1" placeholder="Terapi 1"></textarea>
								</div>
							</div>
							<div class="row mt-3">
								<div class="col">
									<textarea class="form-control" aria-label="With textarea" id="terapi2_pemeriksaan" name="terapi2" placeholder="Terapi 2"></textarea>
								</div>
							</div>
							<div class="row mt-3">
								<div class="col">
									<textarea class="form-control" aria-label="With textarea" id="terapi3_pemeriksaan" name="terapi3" placeholder="Terapi 3"></textarea>
								</div>
							</div>
							<hr>

							<h6 class="text-center mt-3">Obat</h6>
							<div class="row mt-3">
								<button type="button" class="btn btn-primary btn-block ml-3" onclick="addObat()">Tambah Obat</button>
							</div>
							<div id="renderInputObat"></div>



							<div class="row mb-3">
								<div class="col text-right">
									<button type="submit" class="btn btn-primary mt-3">Simpan Rekam Medis</button>
									<a role="button" class="btn btn-primary mt-3 text-white" onclick="formSuratRujukan()">Cetak Rujukan</a>
								</div>
							</div>
						</div>
					</form>
				</div>

<!-- HIDDEN FORM SURAT RUJUKAN -->
<form method="POST" action="<?=base_url()?>Dokter/submitCetak/suratrujukan" target="_blank" onsubmit="SuratRujukan()" id="suratrujukan">
	<style type="text/css">
		.sembunyikan {
			display: none
		}
	</style>
	<input type="text" name="nomor_pasien" id="nomor_pasien_rujukan" class="sembunyikan">
	
	<textarea id="subjektif_rujukan" name="subjektif" class="sembunyikan"></textarea>
	
	<input type="text" name="gcs_e" id="gcs_e_rujukan" class="sembunyikan">
	<input type="text" name="gcs_v" id="gcs_v_rujukan" class="sembunyikan">
	<input type="text" name="gcs_m" id="gcs_m_rujukan" class="sembunyikan">

	<input type="checkbox" id="gcs_opsi_cm_rujukan" name="gcs_opsi[]" value="CM"  class="sembunyikan">
	<input type="checkbox" id="gcs_opsi_apatis_rujukan" name="gcs_opsi[]" value="Apatis"  class="sembunyikan">
	<input type="checkbox" id="gcs_opsi_derilium_rujukan" name="gcs_opsi[]" value="Derilium"  class="sembunyikan">
	<input type="checkbox" id="gcs_opsi_somnolen_rujukan" name="gcs_opsi[]" value="Somnolen"  class="sembunyikan">
	<input type="checkbox" id="gcs_opsi_stupor_rujukan" name="gcs_opsi[]" value="Stupor"  class="sembunyikan">
	<input type="checkbox" id="gcs_opsi_coma_rujukan" name="gcs_opsi[]" value="Coma"  class="sembunyikan">
	<select id="primary_rujukan" name="diagnosaPrimary[]" multiple="multiple" style="width: 100%"  class="sembunyikan"></select>
	<select id="secondary_rujukan" name="diagnosaSecondary[]" multiple="multiple" style="width: 100%"  class="sembunyikan"></select>
	<select id="lain_rujukan" name="diagnosaLain[]" multiple="multiple" style="width: 100%"  class="sembunyikan"></select>
	<textarea id="pemeriksaan_lab_rujukan" name="diagnosaPemeriksaanLab" class="sembunyikan"></textarea>

	<input type="text" name="tinggi_badan" id="tinggi_badan_rujukan" class="sembunyikan">
	<input type="text" name="berat_badan" id="berat_badan_rujukan" class="sembunyikan">
	<input type="text" name="sistol" id="sistol_rujukan" class="sembunyikan">
	<input type="text" name="diastol" id="diastol_rujukan" class="sembunyikan">
	<input type="text" name="respiratory_rate" id="respiratory_rate_rujukan" class="sembunyikan">
	<input type="text" name="nadi" id="nadi_rujukan" class="sembunyikan">
	<input type="text" name="temperature_ax" id="temperature_ax_rujukan" class="sembunyikan">
	<input type="text" name="headtotoe" id="headtotoe_rujukan" class="sembunyikan">

	<input type="checkbox" id="anemis_kiri_rujukan" name="anemis_kiri" value="1" class="sembunyikan">
	<input type="checkbox" id="anemis_kanan_rujukan" name="anemis_kanan" value="1" class="sembunyikan">
	<input type="checkbox" id="ikterik_kiri_rujukan" name="ikterik_kiri" value="1" class="sembunyikan">
	<input type="checkbox" id="ikterik_kanan_rujukan" name="ikterik_kanan" value="1" class="sembunyikan">
	<input type="checkbox" id="cianosis_kiri_rujukan" name="cianosis_kiri" value="1" class="sembunyikan">
	<input type="checkbox" id="cianosis_kanan_rujukan" name="cianosis_kanan" value="1" class="sembunyikan">
	<input type="checkbox" id="deformitas_kiri_rujukan" name="deformitas_kiri" value="1" class="sembunyikan">
	<input type="checkbox" id="deformitas_kanan_rujukan" name="deformitas_kanan" value="1" class="sembunyikan">
	<input type="checkbox" id="refchy_kiri_rujukan" name="refchy_kiri" value="1" class="sembunyikan">
	<input type="checkbox" id="refchy_kanan_rujukan" name="refchy_kanan" value="1" class="sembunyikan">
	
	<input type="radio" id="refchy_opsi_rujukan" name="refchy_opsi_rujukan" value="Isokor" class="sembunyikan">
	<input type="radio" id="refchy_opsi_rujukan" name="refchy_opsi_rujukan" value="Anisokor" class="sembunyikan">
	<input type="text" name="kepala_ket_tambahan" id="kepala_ket_tambahan_rujukan" class="sembunyikan">

	<input type="radio" id="paru_simetris_asimetris_rujukan" name="paru_simetris_asimetris" value="Simetris" class="sembunyikan">
	<input type="radio" id="paru_simetris_asimetris_rujukan" name="paru_simetris_asimetris" value="Asimetris" class="sembunyikan">
	<input type="checkbox" id="wheezing_kiri_rujukan" name="wheezing_kiri" value="1" class="sembunyikan">
	<input type="checkbox" id="wheezing_kanan_rujukan" name="wheezing_kanan" value="1" class="sembunyikan">
	<input type="checkbox" id="ronkhi_kiri_rujukan" name="ronkhi_kiri" value="1" class="sembunyikan">
	<input type="checkbox" id="ronkhi_kanan_rujukan" name="ronkhi_kanan" value="1" class="sembunyikan">
	<input type="checkbox" id="vesikuler_kiri_rujukan" name="vesikuler_kiri" value="1" class="sembunyikan">
	<input type="checkbox" id="vesikuler_kanan_rujukan" name="vesikuler_kanan" value="1" class="sembunyikan">
	
	<input type="radio" id="jantung_ictuscordis_rujukan" name="jantung_ictuscordis" value="Tampak" class="sembunyikan">
	<input type="radio" id="jantung_ictuscordis_rujukan" name="jantung_ictuscordis" value="Tak Tampak" class="sembunyikan">
	<input type="radio" id="jantung_s1_s2_rujukan" name="jantung_s1_s2" value="Reguler" class="sembunyikan">
	<input type="radio" id="jantung_s1_s2_rujukan" name="jantung_s1_s2" value="Irreguler" class="sembunyikan">
	<input type="text" name="jantung_suaratambahan" id="jantung_suaratambahan_rujukan" class="sembunyikan">
	<input type="text" name="jantung_ket_tambahan" id="jantung_ket_tambahan_rujukan" class="sembunyikan">

	<input type="radio" id="BU_rujukan" name="BU" value="Normal" class="sembunyikan">
	<input type="radio" id="BU_rujukan" name="BU" value="Menurun" class="sembunyikan">
	<input type="radio" id="BU_rujukan" name="BU" value="Meningkat" class="sembunyikan">
	<input type="radio" id="BU_rujukan" name="BU" value="Negatif" class="sembunyikan">
	<input type="checkbox" id="nyeri_tekan1_rujukan" name="nyeri_tekan1" value="1" class="sembunyikan">
	<input type="checkbox" id="nyeri_tekan2_rujukan" name="nyeri_tekan2" value="1" class="sembunyikan">
	<input type="checkbox" id="nyeri_tekan3_rujukan" name="nyeri_tekan3" value="1" class="sembunyikan">
	<input type="checkbox" id="nyeri_tekan4_rujukan" name="nyeri_tekan4" value="1" class="sembunyikan">
	<input type="checkbox" id="nyeri_tekan5_rujukan" name="nyeri_tekan5" value="1" class="sembunyikan">
	<input type="checkbox" id="nyeri_tekan6_rujukan" name="nyeri_tekan6" value="1" class="sembunyikan">
	<input type="checkbox" id="nyeri_tekan7_rujukan" name="nyeri_tekan7" value="1" class="sembunyikan">
	<input type="checkbox" id="nyeri_tekan8_rujukan" name="nyeri_tekan8" value="1" class="sembunyikan">
	<input type="checkbox" id="nyeri_tekan9_rujukan" name="nyeri_tekan9" value="1" class="sembunyikan">
	<input type="text" name="hepatomegali" id="hepatomegali_rujukan" class="sembunyikan">
	<input type="text" name="spleenomegali" id="spleenomegali_rujukan" class="sembunyikan">
	<input type="text" name="abdomen_ket_tambahan" id="abdomen_ket_tambahan_rujukan" class="sembunyikan">
	
	<input type="checkbox" id="akral_hangat1_rujukan" name="akral_hangat1" value="1" class="sembunyikan">
	<input type="checkbox" id="akral_hangat2_rujukan" name="akral_hangat2" value="1" class="sembunyikan">
	<input type="checkbox" id="akral_hangat3_rujukan" name="akral_hangat3" value="1" class="sembunyikan">
	<input type="checkbox" id="akral_hangat4_rujukan" name="akral_hangat4" value="1" class="sembunyikan">
	<input type="checkbox" id="crt1_rujukan" name="crt1" value="1" class="sembunyikan">
	<input type="checkbox" id="crt2_rujukan" name="crt2" value="1" class="sembunyikan">
	<input type="checkbox" id="crt3_rujukan" name="crt3" value="1" class="sembunyikan">
	<input type="checkbox" id="crt4_rujukan" name="crt4" value="1" class="sembunyikan">
	<input type="checkbox" id="edema1_rujukan" name="edema1" value="1" class="sembunyikan">
	<input type="checkbox" id="edema2_rujukan" name="edema2" value="1" class="sembunyikan">
	<input type="checkbox" id="edema3_rujukan" name="edema3" value="1" class="sembunyikan">
	<input type="checkbox" id="edema4_rujukan" name="edema4" value="1" class="sembunyikan">
	<input type="radio" id="pitting_rujukan" name="pitting" value="Non-pitting" class="sembunyikan">
	<input type="radio" id="pitting_rujukan" name="pitting" value="Pitting" class="sembunyikan">
	<input type="text" name="ekstermitas_ket_tambahan" id="ekstermitas_kettambahan_rujukan" class="sembunyikan">
	
	<input type="text" name="lain_lain" id="lain_lain_rujukan" class="sembunyikan">
	<input type="text" name="planning" id="planning_rujukan" class="sembunyikan">
	<input type="text" name="terapi1" id="terapi1_rujukan" class="sembunyikan">
	<input type="text" name="terapi2" id="terapi2_rujukan" class="sembunyikan">
	<input type="text" name="terapi3" id="terapi3_rujukan" class="sembunyikan">


</form>
<!-- HIDDEN FORM SURAT RUJUKAN -->

<!-- TAB PEMERIKSAAN -->

<!-- TAB SURAT SAKIT -->
				<div class="tab-pane fade" id="surat_sakit" role="tabpanel" aria-labelledby="home-tab">
					<h5 class="text-center mt-3">Surat Sakit</h5>
					<div class="container">	
						<form id="formSuratSakit" action="<?=base_url()?>Dokter/submitCetak/suratsakit" target="_blank" method="POST">
							<input type="hidden" name="nomor_pasien" value="<?=$pasien[0]->nomor_pasien?>" readonly="">
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

							<div class="row mt-3">
								<div class="col text-right">
									<button type="submit" class="btn btn-primary" onclick="setTimeout(SuratSakit, 1000)">Cetak</button>		
								</div>
							</div>
						</form>
					</div>
				</div>
<!-- TAB SURAT SAKIT -->


<!-- TAB SURAT SEHAT -->
				<div class="tab-pane fade" id="surat_sehat" role="tabpanel" aria-labelledby="home-tab">
					<div class="container">
						<h5 class="text-center mt-3">Surat Sehat</h5>
						<form action="<?=base_url()?>Dokter/submitCetak/suratsehat" onsubmit="return formSuratSehat()" target="_blank" method="POST" id="formSuratSehat">
							<input type="hidden" name="nomor_pasien" value="<?=$pasien[0]->nomor_pasien?>">
							<div class="row mt-3">
								<div class="col-3">Tes Buta Warna</div>
								<div class="col">:</div>
								<div class="col">
									<input type="radio" class="custom-control-input" id="tesButaWarna1" name="tes_buta_warna" value="Ya" required="">
					  				<label class="custom-control-label" for="tesButaWarna1">Ya</label>
								</div>
								<div class="col">
									<input type="radio" class="custom-control-input" id="tesButaWarna2" name="tes_buta_warna" value="Tidak" required="">
						  			<label class="custom-control-label" for="tesButaWarna2">Tidak</label>
								</div>
								<div class="col">
									<input type="radio" class="custom-control-input" id="tesButaWarna3" name="tes_buta_warna" value="Parsial" required="">
									<label class="custom-control-label" for="tesButaWarna3">Parsial</label>
								</div>
							</div>

							<div class="row mt-3">
								<div class="col-3">Keperluan</div>
								<div class="col">:</div>
								<div class="col-8">
									<input type="text" class="form-control" id="keperluan" name="keperluan" required="">
									<input type="hidden" class="form-control" name="tinggi_badan" id="tinggi_badan_sehat">
									<input type="hidden" class="form-control" name="berat_badan" id="berat_badan_sehat">
									<input type="hidden" class="form-control" name="sistol" id="sistol_sehat">
									<input type="hidden" class="form-control" name="diastol" id="diastol_sehat">
									<input type="hidden" class="form-control" name="nadi" id="nadi_sehat">
									<input type="hidden" class="form-control" name="respiratory_rate" id="respiratory_rate_sehat">
									<input type="hidden" class="form-control" name="temperature_ax" id="temperature_ax_sehat">
								</div>
							</div>
							
							<div class="row mt-3">
								<div class="col text-right">
									<button type="submit" class="btn btn-primary" onclick="setTimeout(SuratSehat, 1000)" >Cetak</button>		
								</div>
							</div>
						</form>
					</div>
				</div>
<!-- TAB SURAT SEHAT -->
			</div>
		</div>	
	</div>
</div>