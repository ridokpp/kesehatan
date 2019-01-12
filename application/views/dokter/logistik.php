<div class="text-center mt-3"><h5><strong>Daftar Logistik Obat</strong></h5></div>

<div class="container mt-3">
    <div class="mt-3 mb-3">
        <?=$this->session->flashdata("alert");?>
    </div>

    <button class="btn btn-primary mt-3 mb-5" data-toggle="modal" data-target="#modalTambahObat" ><span class="glyphicon glyphicon-envelope">Tambah Obat</span></button>
    
    <!-- Modal Tambah Obat -->
    <div class="modal fade" id="modalTambahObat" tabindex="-1" role="dialog" aria-labelledby="modalTambahObat" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="<?=base_url()?>Dokter/submitAddLogistik" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Obat</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row mt-3">
                            <div class="col">Nama Obat</div>
                            <div class="col-1">:</div>
                            <div class="col">
                                <input class="form-control" type="text" name="nama" placeholder="Nama Obat" required="">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col">Stok Obat</div>
                            <div class="col-1">:</div>
                            <div class="col">
                                <input class="form-control" type="number" name="stok" placeholder="Stok Obat" min="0" required="">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col">Harga Beli per Box</div>
                            <div class="col-1">:</div>
                            <div class="col">
                                <input class="form-control" type="number" name="harga_beli_per_box" placeholder="contoh : 30000" min="0" id="hargabeliperbox" required="">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col">Satuan per Box</div>
                            <div class="col-1">:</div>
                            <div class="col">
                                <input class="form-control" type="number" name="satuan_per_box" placeholder="contoh : 100" min="0" id="satuanperbox" required="">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col">Harga Beli Satuan</div>
                            <div class="col-1">:</div>
                            <div class="col">
                                <input class="form-control" type="number" name="harga_beli_satuan" placeholder="contoh : 300" min="0" id="hargabelisatuan" required="">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col">Harga Jual Satuan</div>
                            <div class="col-1">:</div>
                            <div class="col">
                                <input class="form-control" type="number" name="harga_jual_satuan" placeholder="contoh : 5000" min="0" required="">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col">Satuan</div>
                            <div class="col-1">:</div>
                            <div class="col">
                                <select class="form-control" name="satuan" required="">
                                    <option selected="" disabled="">Pilih Satuan Stok</option>
                                    <?php foreach ($satuan as $key => $value) { ?>
                                        <option value="<?=$value->id?>"><?=$value->satuan?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col">Kadaluarsa</div>
                            <div class="col-1">:</div>
                            <div class="col">
                                <input class="form-control" type="date" name="kadaluarsa" >
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Tambahkan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Tambah Obat -->


    <!-- Modal Edit Obat-->
    <div class="modal fade" id="modalEditObat" tabindex="-1" role="dialog" aria-labelledby="modalEditObat" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="<?=base_url()?>Dokter/SubmitEditLogistik" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Obat</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" value="" id="idobat">
                        <div class="row mt-3">
                            <div class="col">Nama Obat</div>
                            <div class="col-1">:</div>
                            <div class="col">
                                <input class="form-control" type="text" name="nama" id="namaobat" placeholder="Nama Obat">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col">Stok Obat</div>
                            <div class="col-1">:</div>
                            <div class="col">
                                <input class="form-control" type="number" name="stok" id="stokobat" placeholder="Stok Obat" min="0">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col">Harga Beli</div>
                            <div class="col-1">:</div>
                            <div class="col">
                                <input class="form-control" type="number" name="stok" id="hargabeliobat" placeholder="harga beli Obat" min="0">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col">Harga Jual</div>
                            <div class="col-1">:</div>
                            <div class="col">
                                <input class="form-control" type="number" name="stok" id="hargajualobat" placeholder="Harga jual Obat" min="0">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col">Satuan</div>
                            <div class="col-1">:</div>
                            <div class="col">
                                <select class="form-control" name="satuan" id="satuanobat">
                                    <option selected="" disabled="">Pilih Satuan Stok</option>
                                    <option value="Botol">Botol</option>
                                    <option value="Lembar">Lembar</option>
                                    <option value="Botol">Botol</option>
                                    <option value="Capsul">Capsul</option>
                                    <option value="Syrup 60ml">Syrup 60ml</option>
                                    <option value="Tablet">Tablet</option>
                                    <option value="KSR">KSR</option>
                                    <option value="Sachet">Sachet</option>
                                    <option value="Ampul 1ml">Ampul 1ml</option>
                                    <option value="Ampul 2ml">Ampul 2ml</option>
                                    <option value="Vial 15ml">Vial 15ml</option>
                                    <option value="Vial 15ml">Vial 15ml</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col">Kadaluarsa</div>
                            <div class="col-1">:</div>
                            <div class="col">
                                <input class="form-control" type="date" name="kadaluarsa" id="kadaluarsaobat">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Ubah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Edit Obat-->


    <!-- Modal hapus obat-->
    <div class="modal fade" id="modalHapusObat" tabindex="-1" role="dialog" aria-labelledby="modalHapusObat" aria-hidden="true">
      <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hapus Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="<?=base_url()?>Dokter/SubmitDeleteLogistik">
                    <div class="modal-body">
                        <p>Anda yakin untuk menghapus data tersebut?</p>
                        <input type="text" name="id" value="" id="hapusidobat">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Ya</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal hapus obat-->


     <button class="btn btn-primary mt-3 mb-5" data-toggle="modal" data-target="#modalTambahSatuan" ><span class="glyphicon glyphicon-envelope">Tambah satuan Obat</span></button>
    
    <!-- Modal satuan Obat -->
    <div class="modal fade" id="modalTambahSatuan" tabindex="-1" role="dialog" aria-labelledby="modalTambahSatuan" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="<?=base_url()?>Dokter/submitAddSatuan" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Satuan Obat</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row mt-3">
                            <div class="col">Nama Satuan</div>
                            <div class="col-1">:</div>
                            <div class="col">
                                <input class="form-control" type="text" name="satuan" placeholder="Nama Satuan">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Tambahkan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal satuan Obat -->


    <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th class="text-center" style="width: 5%">No.</th>
                <th>Nama Obat</th>
                <th>Jumlah Obat</th>
                <th>Kadaluarsa</th>
                <th class="text-center" style="width: 10%">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <?php
               $i = 1;
                foreach($logistik as $key => $value) {
             ?>
            <tr>
                <td class="text-center"><?=$i?></td>
                <td><?=$value->nama?></td>
                <td><?=$value->stok?> <?=$value->satuan?></td>
                <td><?=tgl_indo($value->kadaluarsa)?></td>
                <td>
                    <div class="text-center">
                        <button 
                            type="button" 
                            data-toggle="modal" 
                            data-target="#modalEditObat" 
                            data-idobat="<?=$value->id?>" 
                            data-namaobat="<?=$value->nama?>" 
                            data-stokobat="<?=$value->stok?>" 
                            data-satuanobat="<?=$value->satuan?>" 
                            data-kadaluarsaobat="<?=$value->kadaluarsa?>" 
                            data-hargajualobat="<?=$value->harga_jual_satuan?>" 
                            data-hargabeliobat="<?=$value->harga_beli_satuan?>"
                        >
                            <img src="<?php echo base_url()?>assets/icon/edit2.png">
                        </button>

                        <button type="button" data-toggle="modal" data-target="#modalHapusObat" data-idobat="<?=$value->id?>">
                            <img src="<?php echo base_url()?>assets/icon/delete.png">
                        </button>
                    </div>
                </td>
            </tr>
            <?php $i++; } ?>
        </tbody>
        <tfoot>
            <tr>
                <th class="text-center">No.</th>
                <th>Nama Obat</th>
                <th>Jumlah Obat</th>
                <th>Kadaluarsa</th>
                <th class="text-center">Keterangan</th>
            </tr>
        </tfoot>
    </table>
</div>

<script type="text/javascript">

    $(document).ready(function() {
        $('#example').DataTable( {
            columnDefs: [
                {
                    orderable: false,
                    targets: [4]
                }
            ]
        });
        $('#modalHapusObat').on('shown.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            $('#hapusidobat').val(button.data('idobat')); // Extract info from data-* attributes
        });
        $('#modalEditObat').on('shown.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal

            // Extract info from data-* attributes
            $('#idobat').val(button.data('idobat')); 
            $('#namaobat').val(button.data('namaobat')); 
            $('#stokobat').val(button.data('stokobat')); 
            $('#satuanobat').val(button.data('satuanobat')); 
            $('#kadaluarsaobat').val(button.data('kadaluarsaobat'));
            $('#hargajualobat').val(button.data('hargajualobat'));
            $('#hargabeliobat').val(button.data('hargabeliobat'));
        })
    });


</script>