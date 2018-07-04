<form action="<?=base_url()?>Petugas_handler/register" method="POST" class="mt-5">
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="form-group">
					<label for="" class="control-label">Nama Lengkap</label>
					<input type="text" class="form-control" id="" name="nama_lengkap" placeholder="Nama Lengkap" required="">
				</div>	

				<div class="form-group"> 
					<label for="" class="control-label">NIK</label>
					<input type="number" class="form-control" id="" name="nik" placeholder="NIK" required="">
				</div>

				<div class="form-row">
					<div class="col">
						<label class="control-label">Tempat Lahir</label>
				      <input type="text" class="form-control" id="" name="tempat_lahir" placeholder="Tempat Lahir" required="">
				   </div>
				   <div class="col">
				   	<label class="control-label">Tanggal Lahir</label>
				      <input type="date" class="form-control" name="tanggal_lahir" required="">
				      <br>
				   </div>
				</div>

				<div class="form-group">
					<label for="" class="control-label">Alamat</label>
					<select class="form-control" id="" name="kota" required="">
						<option value="" disabled="" selected="">Kota / Kabupaten</option>
						<option value="Kota Malang">Kota Malang</option>
						<option value="Kabupaten Malang">Kabupaten Malang</option>
						<option value="Lain-lain">Lain-lain</option>
					</select>
					<br>
					<select class="form-control" name="kecamatan" id="" required="">
						<option value="" disabled="" selected="">Kecamatan</option>
						<option value="Kedungkandang">Kedungkandang</option>
						<option value="Lowokwaru">Lowokwaru</option>
						<option value="Klojen">Klojen</option>
						<option value="Sukun">Sukun</option>
						<option value="Blimbing">Blimbing</option>
						<option value="Lain-lain">Lain-lain</option>
					</select>
					<br>
					<select class="form-control" id="" name="kelurahan" required="">
						<option value="" disabled="" selected="">Kelurahan</option>
						<option value="001 Arjowinangun">001 Arjowinangun</option>
						<option value="002 Bumiayu">002 Bumiayu</option>
						<option value="003 Buring">003 Buring</option>
						<option value="004 Cemoro Kandang">004 Cemoro Kandang</option>
						<option value="005 Kedung Kandang">005 Kedung Kandang</option>
						<option value="006 Kota Lama">006 Kota Lama</option>
						<option value="007 Lesanpuro">007 Lesanpuro</option>
						<option value="008 Madyopuro">008 Madyopuro</option>
						<option value="009 Mergosono">009 Mergosono</option>
						<option value="010 Sawojajar">010 Sawojajar</option>
						<option value="011 Tlogowaru">011 Tlogowaru</option>
						<option value="012 Wonokoyo">012 Wonokoyo</option>
						<option value="013 Lain-Lain">013 Lain-Lain</option>
					</select>
					<br>
					<input type="text" class="form-control" id="" name="jalan" placeholder="Jalan" required="">
				</div>	

										
				<div class="form-group"> 
					<label for="state_id" class="control-label">Jenis Kelamin</label>
					<select class="form-control" id="state_id" name="jenis_kelamin" required="">
						<option value="01">Laki - Laki</option>
						<option value="02">Perempuan</option>
					</select>					
				</div>
				
				<div class="form-group"> 
					<label for="" class="control-label">Pembayaran</label>
					<select class="form-control" id="" name="pembayaran" required="">
						<option value="Umum">Umum</option>
						<option value="BPJS">BPJS</option>
						<option value="RF">Royale Family</option>
					</select>
				</div>

				<div class="form-group">
					<label for="" class="control-label">Pekerjaan</label>
					<input type="text" class="form-control" id="" name="pekerjaan" placeholder="Pekerjaan" required="">
				</div>		
				
				<div class="form-group">
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>  
			</div>   
		</div>
	</div>
</form>