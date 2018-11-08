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
    });
</script>

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
                                <input class="form-control" type="text" name="nama" placeholder="Nama Obat">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col">Stok Obat</div>
                            <div class="col-1">:</div>
                            <div class="col">
                                <input class="form-control" type="number" name="stok" placeholder="Stok Obat" min="0">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col">Satuan</div>
                            <div class="col-1">:</div>
                            <div class="col">
                                <select class="form-control" name="satuan">
                                    <option selected="" disabled="">Pilih Satuan Stok</option>
                                    <option value="Botol">Botol</option>
                                    <option value="Lembar">Lembar</option>
                                    <option value="Kapsul">Kapsul</option>
                                    <option value="Kaleng">Kaleng</option>
                                    <option value="Gelas">Gelas</option>
                                    <option value="Buah">Buah</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col">Kadaluarsa</div>
                            <div class="col-1">:</div>
                            <div class="col">
                                <input class="form-control" type="date" name="kadaluarsa"  >
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
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Edit Obat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mt-3">
                        <div class="col">Nama Obat</div>
                        <div class="col-1">:</div>
                        <div class="col">
                            <input class="form-control" type="text" name="" placeholder="Nama Obat">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col">Stok Obat</div>
                        <div class="col-1">:</div>
                        <div class="col">
                            <input class="form-control" type="number" name="" placeholder="Nama Obat">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col">Satuan</div>
                        <div class="col-1">:</div>
                        <div class="col">
                            <select class="form-control">
                                <option selected="" disabled="">Pilih Satuan Stok</option>
                                <option value="Botol">Botol</option>
                                <option value="Lembar">Lembar</option>
                                <option value="Botol">Botol</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col">Kadaluarsa</div>
                        <div class="col-1">:</div>
                        <div class="col">
                            <input class="form-control" type="date" name=""  >
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Ubah</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Edit Obat-->


    <!-- Modal hapus obat-->
    <div class="modal" id="exampleModal2" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Hapus Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Anda yakin untuk menghapus data tersebut?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger">Ya</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
          </div>
        </div>
      </div>
    </div>





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
                <td class="text-center"></td>
                <td><?=$value->nama?></td>
                <td><?=$value->stok?></td>
                <td><?=tgl_indo($value->kadaluarsa)?></td>
                <td>
                    <div class="text-center">
                        <button type="button" data-toggle="modal" data-target="#exampleModal">
                            <img src="<?php echo base_url()?>assets/icon/edit2.png">
                        </button>

                        <button type="button" data-toggle="modal" data-target="#exampleModal2">
                            <img src="<?php echo base_url()?>assets/icon/delete.png">
                        </button>
                    </div>
                </td>
            </tr>
            <?php } ?>
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