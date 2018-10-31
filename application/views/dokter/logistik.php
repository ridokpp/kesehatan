<script type="text/javascript">



    $(document).ready(function() {
    $('#example').DataTable( {
        columnDefs: [
            {
                orderable: false,
                targets: [4]
            }
        ],
        });
    });
</script>

<div class="text-center mt-3"><h5><strong>Daftar Logistik Obat</strong></h5></div>

<div class="container mt-3">
    <button class="btn btn-primary mt-3 mb-5" data-toggle="modal" data-target="#exampleModal1" ><span class="glyphicon glyphicon-envelope">Tambah Obat</span></button>
    <!-- Modal Tambah Obat -->
    <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
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
                        <div class="col">Kadaluarsa</div>
                        <div class="col-1">:</div>
                        <div class="col">
                            <input class="form-control" type="date" name=""  >
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Tambahkan</button>
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

                        <!-- Modal Edit Obat-->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
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