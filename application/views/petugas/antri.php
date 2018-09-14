<style type="text/css">
    .tombol-proses{
        height: 24px;
        padding-top: 1px;
    }
</style>

<h3 class="text-center mt-3">Antrian Pasien</h3>
<div class="row">
    <div class="<?=($proses_antrian != array())? 'col-8':'col'?>">
        <h5 class="text-center mt-3">Pasien Antri</h5>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Jam Datang</th>
                    <th scope="col">Pembayaran</th>
                    <th scope="col">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($antrian != array() ) {
                    $i =0;
                    foreach ($antrian as $key => $value) {
                ?>
                <tr>
                    <th><?=$value->nomor_antrian?></th>
                    <td><?=$value->nama?></td>
                    <td><?=substr($value->jam_datang, 11)?></td>
                    <td><?=$value->pembayaran?></td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a href="<?=base_url()?>Petugas_handler/antrian/proses/<?=$value->nomor_pasien?>?>" class="btn btn-success btn-sm tombol-proses">Proses</a>
                            <a href="<?=base_url()?>Petugas_handler/antrian/hapus/<?=$value->nomor_pasien?>?>" class="btn btn-danger btn-sm tombol-proses">Hapus</a>
                        </div>
                    </td>
                </tr>

                <?php
                    $i++;
                    }
                }else{ ?>
                <tr>
                    <th>-</th>
                    <th>-</th>
                    <th>-</th>
                    <th>-</th>
                    <th>-</th>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    <?php 
    if ($proses_antrian != array()) {
    ?>
    <div class="col-4">
        <h5 class="text-center mt-3">Pasien Dalam Proses</h5>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Pembayaran</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $i =1;
                foreach ($proses_antrian as $key => $value) { 
                ?>
                <tr>
                    <th><?=$i?></th>
                    <td><?=$value->nama?></td>
                    <td><?=$value->pembayaran?></td>
                    <td>
                        <a href="<?=base_url()?>Petugas_handler/antrian/hapus/<?=$value->nomor_pasien?>" class="btn btn-danger btn-sm tombol-proses">Hapus</a>
                    </td>
                </tr>
                <?php $i++;} ?>
            </tbody>
        </table>
    </div>  
    <?php
    }
    ?>
</div>
