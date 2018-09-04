<br>

<div class="container">
	<div class="row">
		<div class="col">
			<div class="row">
				<div class="col-2 offset-1 "> 
					<img class="img-responsive" src="<?=base_url()?>assets/images/LOGO YAYASAN.png" style="width:150px">
				</div>
				<div class="col-8">
					<div>
						<p class="text-success text-center mb-0 font-weight-bold">YAYASAN DARUL'ULUM AGUNG</p>
					</div>
					<div>
						<p class="text-center mb-3 font-weight-bold">PRAKTIK DOKTER UMUM</p>
					</div>
					<div>
						<p class="text-center mb-0 font-weight-bold">Jl. Mayjen Sungkono No 09 Bumiayu Kedungkandang Malang 65135</p>
					</div>
					<div>
						<p class="text-center mb-0 font-weight-bold">Telp. 0341-752866, Fax. 0341-752</p>
					</div>
					<div>
						<p class="text-center mb-0 font-weight-bold">Akte Notaris : H. Romlan, SH, M.Hum. No. 26 Tanggal 19 November 2015</p>
					</div>
				</div>
			</div>

			<hr class="mt-0 mb-0 ">
			<div class="ml-5">
			<div class="row">
				<div class="col mt-4">
					<div class="row">
						Perihal
					<div class= offset-1>
					:
					</div>	
					<div class="col-9">
					Rujukan Pasien
					</div>
				</div>
				<div class="row">
						No. Surat
						<div class= offset-1>
					:
					</div>	
					<div class="col-9">
					......... / 003 / .......... / 2018
					</div>
				</div>
					<div class="row">
						Lampiran
					</div>
				</div>
				<div class="col-4">
					<div class="row">
						Kepada YTH.
					</div>
					<div class="row"">
						Dr. <?=$nama_user?>
					</div>
					<div class="row">
						di RS
					</div>
					<div class="row">
						Kota
					</div>
				</div>	
			</div>
			<div class="row mb-4">
				Assalamu'allaikum Wr. Wb.<br>
				Mohon konsul dan penata laksanaan lebih lanjut pada penderita;
			</div>
			<div class="row">
				<div class="col-2"> 
					Nama
				</div>
				<div class="col-0">
					:
				</div>	
				<div class="col-9">
					<?=$pasien[0]->nama?>
				</div>		
			</div>
			<div class="row">
				<div class="col-2"> 
					NIK
				</div>
				<div class="col-0">
					:
				</div>	
				<div class="col-9">
					<?=$pasien[0]->nik?>
				</div>		
			</div>
			<div class="row">
				<div class="col-2"> 
					Tempat / Tgl Lahir
				</div>
				<div class="col-0">
					:
				</div>
				<div class="col-9">
					<?=$pasien[0]->tmp_lahir.", ".tgl_indo($pasien[0]->tgl_lahir)?>
				</div>	
			</div>
			<div class="row">
				<div class="col-2"> 
					Jenis Kelamin		
				</div>
				<div class="col-0">
					:
				</div>
				<div class="col-9">
					<?=$pasien[0]->jkelamin?>
				</div>
			</div>
			<div class="row">
				<div class="col-2"> 	
					Pekerjaan					
				</div>
				<div class="col-0">
					:
				</div>
				<div class="col-9">
					<?=$pasien[0]->pekerjaan?>
				</div>
			</div>
			<div class="row mb-4">
				<div class="col-2"> 
					Alamat		
				</div>
				<div class="col-0">
					:
				</div>
				<div class="col-9">
					<?=$pasien[0]->alamat?>
				</div>
			</div>
			<div class="row mb-4">
				Hasil Pemeriksaan
				<div class="col-2">
					:
				</div>
			</div>
			<div class="row">
				<div class="col-2"> 
					Keluhan
				</div>
				<div class="col-0">
					:
				</div>	
				<div class="col-9">
					<?=$headtotoe['keluhan'];?>
				</div>		
			</div>
			<div class="row">
				<div class="col-2"> 
					GCS
				</div>
				<div class="col-0">
					:
				</div>	
				<div class="col-9">
					E <?=$headtotoe['GCS_E']?>  V <?=$headtotoe['GCS_V']?>   M <?=$headtotoe['GCS_M']?>  ( CM, Apatis, delirium, somnolen, stupor, coma).*)
				</div>		
			</div>
			<div class="row">
				<div class="col-2"> 
					TB / BB
				</div>
				<div class="col-0">
					:
				</div>
				<div class="col-9">
					<?=$objek[0]->tb?> cm / <?=$objek[0]->bb?> kg
				</div>	
			</div>
			<div class="row">
				<div class="col-2"> 
					Tekanan Darah		
				</div>
				<div class="col-0">
					:
				</div>
				<div class="col-9">
					<?=$objek[0]->td1?> / <?=$objek[0]->td2?> mmHg
				</div>
			</div>
			<div class="row">
				<div class="col-2"> 	
					Nadi					
				</div>
				<div class="col-0">
					:
				</div>
				<div class="col-9">
					<?=$objek[0]->N?> rpm.
				</div>
			</div>
			<div class="row">
				<div class="col-2"> 
					Head to Toe		
				</div>
				<div class="col-0">
					:
				</div>
			</div>
			<div class="row">
				<div class="col-1 offset-1"> 
					Kepala		
				</div>
				<div class="col-0">
					:
				</div>
				<div class="col-9">
				
				Anemis <?=($kepala['anemis_kiri'] == '1') ? '+' : '-'?> / <?=($kepala['anemis_kanan'] == '1') ? '+' : '-'?> Ikterik <?=($kepala['ikterik_kiri'] == '1') ? '+' : '-'?> / <?=($kepala['ikterik_kanan'] == '1') ? '+' : '-'?> Cianosis <?=($kepala['cianosis_kiri'] == '1') ? '+' : '-'?> / <?=($kepala['cianosis_kanan'] == '1') ? '+' : '-'?> Deformitas <?=($kepala['deformitas_kiri'] == '1') ? '+' : '-'?> / <?=($kepala['deformitas_kiri'] == '1') ? '+' : '-'?> Refleksi cahaya <?=($kepala['refchy_kiri'] == '1') ? '+' : '-'?> / <?=($kepala['refchy_kanan'] == '1') ? '+' : '-'?> <?=($kepala['refchyopsi'] == '1') ? 'Isokor' : 'Anisokor'?>.*)
				</div>
				<div class="col-5 offset-2">
				Keterangan tambahan :  <?=$kepala['ket_tambahan']?>
				</div>
			</div>
			<div class="row">
				<div class="col-1 offset-1"> 
					Thorak		
				</div>
					:
				<div class="col-1">
				Paru
				</div>
				:
				<div class="col-3">
				<?=($thorak['metris'] == '1') ? 'Simetris' : 'Asimetris'?>.*)
				</div>
			</div>
			<div class="row">
				&nbsp;
				<div class="col-1 offset-2">
				Jantung
				</div>
				:
				<div class="col-4">
				Ictus cordis <?=($thorak['jantung_icor'] == '1') ? 'Tampak' : 'Tak Tampak'?>.*)
				</div>
			</div>
			<div class="row-2">
				<div class="col-5 offset-3">
				S1-S2 <?=($thorak['s1_s2'] == '1') ? 'Reguler' : 'Irreguler'?>.*), Suara tambahan <?=$thorak['s_tambahan']?>
				</div>
			</div>
			<div class="row">
				<div class="col-5 offset-2">
				Keterangan tambahan :  <?=$thorak['ket_tambahan']?>
				</div>
			</div>
			<div class="row">
				<div class="col-1 offset-1"> 
					Abdomen		
				</div>
					:
				<div class="col-4">
				BU <?php if($abdomen['BU'] == '0'){ 
						echo "Normal"; 
					} elseif ($abdomen['BU'] == '1') {
						echo "Meningkat";
					} elseif ($abdomen['BU'] == '2') {
						echo "Menurun"; 
					} elseif ($abdomen['BU'] == '3') { 
						echo "Negatif";
					}
					?>.*
				</div>
			</div>
			<div class="row">
				&nbsp;
				<div class="col-1 offset-2">
				Nyeri Tekan
				</div>
				<div class="col-1">
				<table border="1">
				  <tr width="90px">
				    <td ><?=($abdomen['ny1'] == '1') ?  '✓': ' ' ?></td>
				    <td ><?=($abdomen['ny2'] == '2') ?  '✓': '  '?></td>
				    <td><?=($abdomen['ny3'] == '3') ?  '✓': '  '?></td>
				  </tr>
				  <tr>
				    <td><?=($abdomen['ny4'] == '4') ?  '✓': ' ' ?></td>
				    <td><?=($abdomen['ny5'] == '5') ?  '✓': ' ' ?></td>
				    <td><?=($abdomen['ny6'] == '6') ?  '✓': ' ' ?></td>
				  </tr>
				   <tr>
				    <td><?=($abdomen['ny7'] == '7') ?  '✓': ' ' ?></td>
				    <td><?=($abdomen['ny8'] == '8') ?  '✓': ' ' ?></td>
				    <td><?=($abdomen['ny9'] == '9') ?  '✓': ' ' ?></td>
				  </tr>
				</table>
				</div>


				<div class="col-4">
				Hepatomegali(<?=$abdomen['hpmgl']?>), Spleenomegali(<?=$abdomen['spmgl']?>)
				</div>
			</div>
			<div class="row">
				<div class="col-5 offset-2">
				Keterangan tambahan : <?=$abdomen['ket_tambahan']?>
				</div>
			</div>
			<div class="row">
				<div class="col-1 offset-1"> 
					Ekstermitas		
				</div>
				<div class="col-2">
				: Akral Hangat
				</div>
				
				<table border="1">
				  <tr>
				    <td><?=($ekstermitas['ah1'] == '1') ?  '✓': ' ' ?></td>
				    <td><?=($ekstermitas['ah2'] == '2') ?  '✓': ' ' ?></td>
				  </tr>
				  <tr>
				    <td><?=($ekstermitas['ah3'] == '3') ?  '✓': ' ' ?></td>
				    <td><?=($ekstermitas['ah4'] == '4') ?  '✓': ' ' ?></td>
				  </tr>
				</table>
				;

				<div class="col-1">
				CRT
				</div>
				<table border="1">
				  <tr>
				    <td><?=($ekstermitas['crt1'] == '1') ?  '✓': ' ' ?></td>
				    <td><?=($ekstermitas['crt2'] == '2') ?  '✓': ' ' ?></td>
				  </tr>
				  <tr>
				    <td><?=($ekstermitas['crt3'] == '3') ?  '✓': ' ' ?></td>
				    <td><?=($ekstermitas['crt4'] == '4') ?  '✓': ' ' ?></td>
				  </tr>
				</table>
				2 detik;

				<div class="col-1">
				Edema
				</div>
				<table border="1">
				  <tr>
				    <td><?=($ekstermitas['edm1'] == '1') ?  '✓': ' ' ?></td>
				    <td><?=($ekstermitas['edm2'] == '2') ?  '✓': ' ' ?></td>
				  </tr>
				  <tr>
				    <td><?=($ekstermitas['edm3'] == '3') ?  '✓': ' ' ?></td>
				    <td><?=($ekstermitas['edm4'] == '4') ?  '✓': ' ' ?></td>
				  </tr>
				</table>
				<div class="col-3">
				<?=($ekstermitas['pitting'] ? 'Non-Pitting' : 'Pitting')?>.*
				</div>
			</div>
			<div class="row">
				<div class="col-1 offset-1"> 
					Lain-lain		
				</div>
					:
				<div class="col-4">
				<?=$headtotoe['lain_lain']?>
				</div>
			</div>
			<div class="row">
				<div class="col-2"> 
					Diagnosa		
				</div>
				<div class="col-0">
					:
				</div>
				<div class="col-7">
				<!-- <?=$diagnosa?> -->
				</div>
			</div>
			<div class="row">
				<div class="col-2"> 
					Terapi		
				</div>
				<div class="col-0">
					:
				</div>
				<div class="col-7">
				R/ <?=$terapi['terapi1']?>
				</div>
			</div>
			<div class="row">
				&nbsp;
				<div class="col-7 offset-2">
				R/ <?=$terapi['terapi2']?>
				</div>
			</div>
			<div class="row">
				&nbsp;
				<div class="col-7 offset-2">
				R/ <?=$terapi['terapi3']?>
				</div>
			</div>

			<div class="row mt-2">
				Demikian atas perhatiannya, diucapkan banyak terima kasih.
			</div>
			<div class="row">
				Wassalamu'allaikum Wr. Wb.
			</div>
			
			<div class="row">
				<div class="col mt-4">
				<div class="row"  style="margin-top: 100px">
						NB : .*) Coret yang tidak perlu.
					</div>
				</div>
				<div class="col-4">
					<div class="row">
						Malang, <?=tgl_indo(date("Y-m-d"))?>
					</div>
					<div class="row" style="margin-bottom: 100px">
						Pemeriksa,
					</div>
					<div class="row mt-5">
						<?=$nama_user?>
					</div>
					<div class="row">
						SIP : <?=$sip?>
					</div>
				</div>	
			</div>
		</div>
	  </div>	
	</div>
</div>