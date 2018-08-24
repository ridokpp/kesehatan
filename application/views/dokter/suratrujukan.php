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
				Mohon konsul dan penatalaksanaan lebih lanjut pada penderita;
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
					..............................................................................................
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
					E ...  V ...  M ... ( CM, Apatis, delirium, somnolen, stupor, coma).*)
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
				Anemis .... / .... Ikterik .... / .... Cianosis .... / .... Deformitas .... / .... Refkejs cahaya .... / .... isokor/anisokor.*)
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
				Simetris/Asimetris.*)
				</div>
			</div>
			<div class="row">
				&nbsp;
				<div class="col-1 offset-2">
				Jantung
				</div>
				:
				<div class="col-4">
				Ictus cordis Tak Tampak / Tampak.*)
				</div>
			</div>
			<div class="row-2">
				<div class="col-5 offset-3">
				S1-S2 Reguler/Irreguler.*), Suara tambahan ...................
				</div>
			</div>
			<div class="row">
				<div class="col-5 offset-1">
				Keterangan tambahan : .............................
				</div>
			</div>
			<div class="row">
				<div class="col-1 offset-1"> 
					Abdomen		
				</div>
					:
				<div class="col-4">
				BU Normal/Meningkat/Menurun/Negatif.*)
				</div>
			</div>
			<div class="row">
				&nbsp;
				<div class="col-1 offset-2">
				Nyeri Tekan
				</div>
				<div class="col-1">
				<table border="1">
				  <tr>
				    <td>&nbsp;</td>
				    <td>&nbsp;</td>
				    <td>&nbsp;</td>
				  </tr>
				  <tr>
				    <td>&nbsp;</td>
				    <td>&nbsp;</td>
				    <td>&nbsp;</td>
				  </tr>
				</table>
				</div>


				<div class="col-4">
				Hepatomegali(.........), Spleenomegali(.........)
				</div>
			</div>
			<div class="row">
				<div class="col-5 offset-1">
				Keterangan tambahan : .............................
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
				    <td>&nbsp;</td>
				    <td>&nbsp;</td>
				  </tr>
				  <tr>
				    <td>&nbsp;</td>
				    <td>&nbsp;</td>
				  </tr>
				</table>
				;

				<div class="col-1">
				CRT
				</div>
				<table border="1">
				  <tr>
				    <td>&nbsp;</td>
				    <td>&nbsp;</td>
				  </tr>
				  <tr>
				    <td>&nbsp;</td>
				    <td>&nbsp;</td>
				  </tr>
				</table>
				2 detik;

				<div class="col-1">
				Edema
				</div>
				<table border="1">
				  <tr>
				    <td>&nbsp;</td>
				    <td>&nbsp;</td>
				  </tr>
				  <tr>
				    <td>&nbsp;</td>
				    <td>&nbsp;</td>
				  </tr>
				</table>
				<div class="col-3">
				non-pitting/pitting.*)
				</div>
			</div>
			<div class="row">
				<div class="col-1 offset-1"> 
					Lain-lain		
				</div>
					:
				<div class="col-4">
				...................................................
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
				...................................................
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
				R/...................................................
				</div>
			</div>
			<div class="row">
				&nbsp;
				<div class="col-7 offset-2">
				R/...................................................
				</div>
			</div>
			<div class="row">
				&nbsp;
				<div class="col-7 offset-2">
				R/...................................................
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