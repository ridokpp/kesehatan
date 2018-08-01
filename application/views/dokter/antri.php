<style type="text/css">
    .tombol-proses{
        height: 24px;
        padding-top: 1px;
    }
</style>
    <div class="container">
        <h5 class="text-center mt-3">Pasien Dalam Proses</h5>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Pembayaran</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $i =1;	
                if ($proses_antrian != array()) {
	                foreach ($proses_antrian as $key => $value) { 
	                ?>
	                <tr>
	                    <td><?=$i?></td>
	                    <td><?=$value->nama?></td>
	                    <td><?=$value->pembayaran?></td>
	                    <td>
	                    	<a href="<?= base_url()?>Dokter/log/<?=$value->nomor_pasien?>" class="btn btn-success btn-sm btn-block tombol-proses">Proses</a>
	                    </td>
	                </tr>
	                <?php $i++;
	            	}
                }else{?>
                	<tr>
	                    <td>-</td>
	                    <td>-</td>
	                    <td>-</td>
	                </tr>
                <?php
                }
            	?>
            </tbody>
        </table>
    </div>  
</div>
