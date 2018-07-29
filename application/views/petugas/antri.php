<style type="text/css">
    .tombol-proses{
        height: 24px;
        padding-top: 1px;
    }
</style>

<h3 class="text-center mt-3">Antrian Pasien</h3>
<div class="row">
    <div class="<?=($proses_antrian != array())? 'col-8':'col'?>">
        <h5 class="text-center mt-3">Daftar Pasien Terdaftar</h5>
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
                        <form method="POST" action="<?= base_url()?>Petugas_handler/proses_antrian">
                            <input type="hidden" name="nomor_antrian" value="<?=$value->nomor_antrian?>">
                            <input type="hidden" name="nomor_pasien" value="<?=$value->nomor_pasien?>">
                            <button type="submit" class="btn btn-success btn-sm btn-block tombol-proses">Proses</button>
                        </form>
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
                </tr>
                <?php $i++;} ?>
            </tbody>
        </table>
    </div>  
    <?php
    }
    ?>
</div>
