<style type="text/css">
    .tombol-proses{
        height: 24px;
        padding-top: 1px;
    }
</style>
    <div class="container">
            <?=$this->session->flashdata("alert");?>
        <div class="row">
            <div class="col">
                <h5 class="text-center mt-3">Pasien Dalam Antrian</h5>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Pembayaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i =1;  
                        if ($antrian != array()) {
                            foreach ($antrian as $key => $value) { 
                            ?>
                            <tr>
                                <td><?=$i?></td>
                                <td><?=$value->nama?></td>
                                <td><?=$value->pembayaran?></td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="<?=base_url()?>Dokter_handler/antrian/proses/<?=$value->nomor_pasien?>" class="btn btn-success btn-sm tombol-proses">Proses</a>
                                        <a href="<?=base_url()?>Dokter_handler/antrian/hapus/<?=$value->nomor_pasien?>" class="btn btn-danger btn-sm tombol-proses">Hapus</a>
                                    </div>
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
            <div class="col">
                <h5 class="text-center mt-3">Pasien Dalam Proses</h5>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Pembayaran</th>
                            <th>Aksi</th>
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
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="<?= base_url()?>Dokter/log/<?=$value->nomor_pasien?>" class="btn btn-success btn-sm btn-block tombol-proses">Proses</a>
                                        <a href="<?=base_url()?>Dokter_handler/antrian/hapus/<?=$value->nomor_pasien?>" class="btn btn-danger btn-sm tombol-proses">Hapus</a>
                                    </div>
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
        
    </div>