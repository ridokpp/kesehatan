<?php
?>
<style type="text/css">
table {
  border-collapse: collapse;
  margin: 0 auto;
}
table td {
  border: 1px solid black; 
}
table tr:first-child td {
  border-top: 0;
}
table tr td:first-child {
  border-left: 0;
}
table tr:last-child td {
  border-bottom: 0;
}
table tr td:last-child {
  border-right: 0;
}
</style>
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
						<div class="row col-2 ">
							Perihal
						</div>
						<div class= "offset-1">
						:
						</div>	
						<div class="col-9">
							Rujukan Pasien
						</div>
					</div>
					<div class="row">
						<div class="row col-2 ">
							No. Surat
						</div>
						<div class= "offset-1">
						:
						</div>	
						<div class="col-9">
							<?=($nomor_surat < 10 ) ? "00".$nomor_surat : "0".$nomor_surat ?> / 003 / <?=date('0m / Y')?>
						</div>
					</div>
					<div class="row">
						<div class="row col-2 ">
						Lampiran
						</div>
						<div class= "offset-1">
						:
						</div>	
						<div class="col-9">
							..............................................................
						</div>
					</div>
				</div>
				<div class="col-4">
					<div class="row">
						Kepada YTH.
					</div>
					<div class="row"">
						Dr.	________________________________________
					</div>
					<div class="row">
						di RS ______________________________________
					</div>
					<div class="row">
						Kota ______________________________________
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
					<?=ucwords($pasien[0]->nama)?>
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
					<?=ucwords($pasien[0]->tmp_lahir).", ".tgl_indo($pasien[0]->tgl_lahir)?>
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
					<?=ucwords($pasien[0]->jkelamin)?>
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
					<?=ucwords($pasien[0]->pekerjaan)?>
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
					<?=ucwords($pasien[0]->alamat)?>
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
					<?=ucwords($headtotoe['keluhan'])?>
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
					E <?=$headtotoe['GCS_E']?> &nbsp;&nbsp;  V <?=$headtotoe['GCS_V']?> &nbsp;&nbsp;  M <?=$headtotoe['GCS_M']?> &nbsp;&nbsp; 
					( <?= (in_array("CM", $GCS_opsi)) ? "CM" : "<strike>CM</strike>"?>, <?= (in_array("Apatis", $GCS_opsi)) ? "Apatis" : "<strike>Apatis</strike>"?>, <?= (in_array("Delirium", $GCS_opsi)) ? "Delirium" : "<strike>Delirium</strike>"?>, <?= (in_array("Somnolen", $GCS_opsi)) ? "Somnolen" : "<strike>Somnolen</strike>"?>, <?= (in_array("Stupor", $GCS_opsi)) ? "Stupor" : "<strike>Stupor</strike>"?>, <?= (in_array("Coma", $GCS_opsi)) ? "Coma" : "<strike>Coma</strike>"?>).*)
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
				
				Anemis <?=($kepala['anemis_kiri'] == '1') ? '+' : '-'?> / <?=($kepala['anemis_kanan'] == '1') ? '+' : '-'?> Ikterik <?=($kepala['ikterik_kiri'] == '1') ? '+' : '-'?> / <?=($kepala['ikterik_kanan'] == '1') ? '+' : '-'?> Cianosis <?=($kepala['cianosis_kiri'] == '1') ? '+' : '-'?> / <?=($kepala['cianosis_kanan'] == '1') ? '+' : '-'?> Deformitas <?=($kepala['deformitas_kiri'] == '1') ? '+' : '-'?> / <?=($kepala['deformitas_kiri'] == '1') ? '+' : '-'?> Refleksi cahaya <?=($kepala['refchy_kiri'] == '1') ? '+' : '-'?> / <?=($kepala['refchy_kanan'] == '1') ? '+' : '-'?> <?=($kepala['refchyopsi'] == '1') ? 'Isokor / <strike>Anisokor</strike>' : '<strike>Isokor</strike> / Anisokor'?>.*)
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
					<?=($thorak['metris'] == '1') ? 'Simetris / <strike>Asimetris</strike>' : '<strike>Simetris</strike> / Asimetris'?>.*)
				</div>
			</div>
			<div class="row">
				&nbsp;
				<div class="col-1 offset-2">
					Jantung
				</div>
				:
				<div class="col-4">
					Ictus cordis <?=($thorak['jantung_icor'] == '1') ? 'Tampak / <strike>Tak Tampak</strike>' : '<strike>Tampak</strike> / Tak Tampak'?>.*)
				</div>
			</div>
			<div class="row">
				<div class="col offset-3">
				S1-S2 <?=($thorak['s1_s2'] == '1') ? 'Reguler / <strike>Irreguler</strike>' : '<strike>Reguler</strike> / Irreguler'?>.*), Suara tambahan <?=$thorak['s_tambahan']?>
				</div>
			</div>
			<div class="row">
				<div class="col offset-2">
				Keterangan tambahan :  <?=$thorak['ket_tambahan']?>
				</div>
			</div>
			<div class="row">
				<div class="col-1 offset-1"> 
					Abdomen		
				</div>
					:
				<div class="col-4">
				BU <?php
				if($abdomen['BU'] == 'Normal'){ 
						echo "Normal / "; 
						echo "<strike>Meningkat</strike> / ";
						echo "<strike>Menurun</strike> / ";
						echo "<strike>Negatif</strike>";
					} elseif ($abdomen['BU'] == 'Meningkat') {
						echo "<strike>Normal</strike> / ";
						echo "Meningkat / ";
						echo "<strike>Menurun</strike> / ";
						echo "<strike>Negatif</strike>";
					} elseif ($abdomen['BU'] == 'Menurun') {
						echo "<strike>Normal</strike> / ";
						echo "<strike>Meningkat</strike> / ";
						echo "Menurun / ";
						echo "<strike>Negatif</strike>";
					} elseif ($abdomen['BU'] == 'Negatif') { 
						echo "<strike>Normal</strike> / ";
						echo "<strike>Meningkat</strike> / ";
						echo "<strike>Menurun</strike> / ";
						echo "Negatif";
					}
					?>.*)
				</div>
			</div>
			<div class="row">
				&nbsp;
				<div class="col-1 offset-2">
				Nyeri Tekan
				</div>
				<div class="col-1">
				<table >
				  <tr>
				    <td width="20" height="20"><?=($abdomen['ny1'] == '1') ?  '✓': ' ' ?></td>
				    <td width="20" height="20"><?=($abdomen['ny2'] == '2') ?  '✓': '  '?></td>
				    <td width="20" height="20"><?=($abdomen['ny3'] == '3') ?  '✓': '  '?></td>
				  </tr>
				  <tr>
				    <td width="20" height="20"><?=($abdomen['ny4'] == '4') ?  '✓': ' ' ?></td>
				    <td width="20" height="20"><?=($abdomen['ny5'] == '5') ?  '✓': ' ' ?></td>
				    <td width="20" height="20"><?=($abdomen['ny6'] == '6') ?  '✓': ' ' ?></td>
				  </tr>
				   <tr>
				    <td width="20" height="20"><?=($abdomen['ny7'] == '7') ?  '✓': ' ' ?></td>
				    <td width="20" height="20"><?=($abdomen['ny8'] == '8') ?  '✓': ' ' ?></td>
				    <td width="20" height="20"><?=($abdomen['ny9'] == '9') ?  '✓': ' ' ?></td>
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
				
				<table>
					<tr>
						<td width="20" height="20"><?=($ekstermitas['ah1'] == '1') ?  '✓': ' ' ?></td>
						<td width="20" height="20"><?=($ekstermitas['ah2'] == '2') ?  '✓': ' ' ?></td>
					</tr>
					<tr>
						<td width="20" height="20"><?=($ekstermitas['ah3'] == '3') ?  '✓': ' ' ?></td>
						<td width="20" height="20"><?=($ekstermitas['ah4'] == '4') ?  '✓': ' ' ?></td>
					</tr>
				</table>
				;

				<div class="col-1">
				CRT
				</div>
				<table >
				  <tr>
				    <td width="20" height="20"><?=($ekstermitas['crt1'] == '1') ?  '✓': ' ' ?></td>
				    <td width="20" height="20"><?=($ekstermitas['crt2'] == '2') ?  '✓': ' ' ?></td>
				  </tr>
				  <tr>
				    <td width="20" height="20"><?=($ekstermitas['crt3'] == '3') ?  '✓': ' ' ?></td>
				    <td width="20" height="20"><?=($ekstermitas['crt4'] == '4') ?  '✓': ' ' ?></td>
				  </tr>
				</table>
				2 detik;

				<div class="col-1">
				Edema
				</div>
				<table >
				  <tr>
				    <td width="20" height="20"><?=($ekstermitas['edm1'] == '1') ?  '✓': ' ' ?></td>
				    <td width="20" height="20"><?=($ekstermitas['edm2'] == '2') ?  '✓': ' ' ?></td>
				  </tr>
				  <tr>
				    <td width="20" height="20"><?=($ekstermitas['edm3'] == '3') ?  '✓': ' ' ?></td>
				    <td width="20" height="20"><?=($ekstermitas['edm4'] == '4') ?  '✓': ' ' ?></td>
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
				</div>:
				<div class="col">
							<?php 
							foreach ($diagnosaPrimer as $key => $value ) {
								echo $value." ; ";
							}
							foreach ($diagnosaSekunder as $key => $value) {
								echo $value." ; ";
							}
							foreach ($diagnosaLain as $key => $value) {
								echo $value;
							}
							echo $diagnosaPemeriksaanLab;
							?>
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
						<?=ucwords($nama_user)?>
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