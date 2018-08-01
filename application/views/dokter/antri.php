<style type="text/css">
    .tombol-proses{
        height: 24px;
        padding-top: 1px;
    }
</style>



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
                    <th scope="col"><button type="submit" class="btn btn-success btn-sm btn-block tombol-proses">Proses</button></th>
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
