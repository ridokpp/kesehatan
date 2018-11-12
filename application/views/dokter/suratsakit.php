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
			<hr class="mt-0 mb-0">
			<div>
				<p class="text-center mb-0 mt-3 font-weight-bold">SURAT KETERANGAN SAKIT</p>
				<hr class="mt-0 mb-0" width="20%">
			</div>
			<div>
				<p class="text-center mb-4 font-weight-bold">No. <?=($nomor_surat < 10 ) ? "00".$nomor_surat : "0".$nomor_surat ?> / 002 / <?=date('0m / Y')?></p>
			</div>
			<div class="row mb-4">
				Yang bertanda tangan dibawah ini <?=ucwords($nama_user)?>, menerangkan dengan sebenarnya bahwa;
			</div>
			<div class="row">
				<div class="col-2"> 
					Nama
				</div>
				<div class="col">
					: <?=ucwords($pasien[0]->nama )?>
				</div>		
			</div>
			<div class="row">
				<div class="col-2"> 
					Tempat / Tgl Lahir
				</div>
				<div class="col">
					: <?=ucwords($pasien[0]->tempat_lahir.", ".tgl_indo($pasien[0]->tanggal_lahir))?>
				</div>
			</div>
			<div class="row">
				<div class="col-2"> 
					Jenis Kelamin		
				</div>
				<div class="col">
					: <?=ucwords($pasien[0]->jenis_kelamin )?>
				</div>
			</div>
			<div class="row">
				<div class="col-2"> 	
					Pekerjaan					
				</div>
				<div class="col">
					: <?=ucwords($pasien[0]->pekerjaan )?>
				</div>
			</div>
			<div class="row mb-4">
				<div class="col-2"> 
					Alamat		
				</div>
				<div class="col">
					: <?=ucwords($pasien[0]->alamat )?>
				</div>
			</div>
			<div class="row mb-4">
				Diberikan <?=($alasan == 1) ? "Istirahat Sakit" : "Perlakuan Khusus" ?> selama <?=$selama?> ( <?=int_to_words($selama)?> ) <?=$selama_satuan?> , terhitung mulai Tanggal <?=tgl_indo($tanggal_awal)?> s/d Tanggal <?=tgl_indo($tanggal_akhir)?>. Demikian surat keteragan ini dibuat untuk digunakan sebagaimana mestinya.
			</div>
			<div class="row">
				<div class="col mt-4">
					<div class="row"  style="margin-top: 100px">
						NB : .*) Coret yang tidak perlu.
					</div>
					<div class="row">
						**Surat ini tidak sah jika tidak terdapat cap stampel.
					</div>
					<div class="row">
						Istirahat sakit diberikan maksimal selama 3 (tiga) hari.
					</div>
				</div>
				<div class="col-4">
					<div class="row">
						Malang, <?=tgl_indo($tanggal_awal)?>
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