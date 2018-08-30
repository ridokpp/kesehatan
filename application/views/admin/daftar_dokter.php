<script type="text/javascript">
	$(document).ready(function() {
    $('#example').DataTable({
    	columnDefs: [ 
            { 
            	orderable: false, 
            	targets: [1,3] 
            },
            {
            	width: "20px",
            	targets: [0]
            },
            {
            	width: "200px",
            	targets: [1]
            },
            {
            	width: "600px",
            	targets: [2]
            }
        ]
    });
} );
</script>

<style type="text/css">
	.linone {
		display: none;
	}
	.no-bullets {
    list-style-type: none;
	}
</style>

<h3 class="text-center mt-4">Daftar Dokter</h3>

<div class="container">
	<div class=" row mt-5">	
		<div class="col">
			<table id="example" class="display">
				<thead>
					<tr>
						<th><div class="text-center">No.</div></th>
						<th><div class="text-center">Foto</div></th>
						<th><div class="text-center">Biodata</div></th>							
						<th><div class="text-center">Keterangan</div></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>	
							<div class="text-center">1.</div>
						</td>
						<td>
							<div class="text-center">
							 	<img src="<?php echo base_url()?>assets/images/users_photo/juragan2.jpg" class="rounded">
							</div>
						</td>
						<td>
							<div class="row">
								<div class="col-2">Nama</div>
								<div class="col-0">:</div>
								<div class="col-9">Mochammad Fadhli Zhil Iqram</div>
							</div>
							<div class="row">
								<div class="col-2">SIP</div>
								<div class="col-0">:</div>
								<div class="col-9">112131314124</div>
							</div>
							<div class="row">
								<div class="col-2">Alamat</div>
								<div class="col-0">:</div>
								<div class="col-9">Jl. Tata Surya 1 No 21</div>
							</div>
							<div class="row">
								<div class="col-2">No. Tlpn</div>
								<div class="col-0">:</div>
								<div class="col-9">08123456789</div>
							</div>
						</td>
						<td>
							<button type="button" class="btn btn-danger">Reset</button>
							<button type="button" class="btn btn-primary">Detail</button>
						</td>
					</tr>
					<tr>
						<td>	
							<div class="text-center">1.</div>
						</td>
						<td>
							<div class="text-center">
							 	<img src="<?php echo base_url()?>assets/images/users_photo/juragan2.jpg" class="rounded">
							</div>
						</td>
						<td>
							<div class="row">
								<div class="col-2">Nama</div>
								<div class="col-0">:</div>
								<div class="col-9">Mochammad Fadhli Zhil Iqram</div>
							</div>
							<div class="row">
								<div class="col-2">SIP</div>
								<div class="col-0">:</div>
								<div class="col-9">112131314124</div>
							</div>
							<div class="row">
								<div class="col-2">Alamat</div>
								<div class="col-0">:</div>
								<div class="col-9">Jl. Tata Surya 1 No 21</div>
							</div>
							<div class="row">
								<div class="col-2">No. Tlpn</div>
								<div class="col-0">:</div>
								<div class="col-9">08123456789</div>
							</div>
						</td>
						<td>
							<button type="button" class="btn btn-danger">Reset</button>
							<button type="button" class="btn btn-primary">Detail</button>
						</td>
					</tr>
					<tr>
						<td>	
							<div class="text-center">1.</div>
						</td>
						<td>
							<div class="text-center">
							 	<img src="<?php echo base_url()?>assets/images/users_photo/juragan2.jpg" class="rounded">
							</div>
						</td>
						<td>
							<div class="row">
								<div class="col-2">Nama</div>
								<div class="col-0">:</div>
								<div class="col-9">Mochammad Fadhli Zhil Iqram</div>
							</div>
							<div class="row">
								<div class="col-2">SIP</div>
								<div class="col-0">:</div>
								<div class="col-9">112131314124</div>
							</div>
							<div class="row">
								<div class="col-2">Alamat</div>
								<div class="col-0">:</div>
								<div class="col-9">Jl. Tata Surya 1 No 21</div>
							</div>
							<div class="row">
								<div class="col-2">No. Tlpn</div>
								<div class="col-0">:</div>
								<div class="col-9">08123456789</div>
							</div>
						</td>
						<td>
							<button type="button" class="btn btn-danger">Reset</button>
							<button type="button" class="btn btn-primary">Detail</button>
						</td>
					</tr>
					<tr>
						<td>	
							<div class="text-center">1.</div>
						</td>
						<td>
							<div class="text-center">
							 	<img src="<?php echo base_url()?>assets/images/users_photo/juragan2.jpg" class="rounded">
							</div>
						</td>
						<td>
							<div class="row">
								<div class="col-2">Nama</div>
								<div class="col-0">:</div>
								<div class="col-9">Mochammad Fadhli Zhil Iqram</div>
							</div>
							<div class="row">
								<div class="col-2">SIP</div>
								<div class="col-0">:</div>
								<div class="col-9">112131314124</div>
							</div>
							<div class="row">
								<div class="col-2">Alamat</div>
								<div class="col-0">:</div>
								<div class="col-9">Jl. Tata Surya 1 No 21</div>
							</div>
							<div class="row">
								<div class="col-2">No. Tlpn</div>
								<div class="col-0">:</div>
								<div class="col-9">08123456789</div>
							</div>
						</td>
						<td>
							<button type="button" class="btn btn-danger">Reset</button>
							<button type="button" class="btn btn-primary">Detail</button>
						</td>
					</tr>
					<tr>
						<td>	
							<div class="text-center">2.</div>
						</td>
						<td>
							<div class="text-center">
							 	<img src="<?php echo base_url()?>assets/images/users_photo/juragan2.jpg" class="rounded">
							</div>
						</td>
						<td>
							<div class="row">
								<div class="col-2">Nama</div>
								<div class="col-0">:</div>
								<div class="col-9">Ridho Pratama Putra</div>
							</div>
							<div class="row">
								<div class="col-2">SIP</div>
								<div class="col-0">:</div>
								<div class="col-9">112131314124</div>
							</div>
							<div class="row">
								<div class="col-2">Alamat</div>
								<div class="col-0">:</div>
								<div class="col-9">Jl. Tata Surya 1 No 21</div>
							</div>
							<div class="row">
								<div class="col-2">No. Tlpn</div>
								<div class="col-0">:</div>
								<div class="col-9">08123456789</div>
							</div>
						</td>
						<td>
							<button type="button" class="btn btn-danger">Reset</button>
							<button type="button" class="btn btn-primary">Detail</button>
						</td>
					</tr>
					<tr>
						<td>	
							<div class="text-center">2.</div>
						</td>
						<td>
							<div class="text-center">
							 	<img src="<?php echo base_url()?>assets/images/users_photo/juragan2.jpg" class="rounded">
							</div>
						</td>
						<td>
							<div class="row">
								<div class="col-2">Nama</div>
								<div class="col-0">:</div>
								<div class="col-9">Ridho Pratama Putra</div>
							</div>
							<div class="row">
								<div class="col-2">SIP</div>
								<div class="col-0">:</div>
								<div class="col-9">112131314124</div>
							</div>
							<div class="row">
								<div class="col-2">Alamat</div>
								<div class="col-0">:</div>
								<div class="col-9">Jl. Tata Surya 1 No 21</div>
							</div>
							<div class="row">
								<div class="col-2">No. Tlpn</div>
								<div class="col-0">:</div>
								<div class="col-9">08123456789</div>
							</div>
						</td>
						<td>
							<button type="button" class="btn btn-danger">Reset</button>
							<button type="button" class="btn btn-primary">Detail</button>
						</td>
					</tr>
					<tr>
						<td>	
							<div class="text-center">2.</div>
						</td>
						<td>
							<div class="text-center">
							 	<img src="<?php echo base_url()?>assets/images/users_photo/juragan2.jpg" class="rounded">
							</div>
						</td>
						<td>
							<div class="row">
								<div class="col-2">Nama</div>
								<div class="col-0">:</div>
								<div class="col-9">Ridho Pratama Putra</div>
							</div>
							<div class="row">
								<div class="col-2">SIP</div>
								<div class="col-0">:</div>
								<div class="col-9">112131314124</div>
							</div>
							<div class="row">
								<div class="col-2">Alamat</div>
								<div class="col-0">:</div>
								<div class="col-9">Jl. Tata Surya 1 No 21</div>
							</div>
							<div class="row">
								<div class="col-2">No. Tlpn</div>
								<div class="col-0">:</div>
								<div class="col-9">08123456789</div>
							</div>
						</td>
						<td>
							<button type="button" class="btn btn-danger">Reset</button>
							<button type="button" class="btn btn-primary">Detail</button>
						</td>
					</tr>
					<tr>
						<td>	
							<div class="text-center">2.</div>
						</td>
						<td>
							<div class="text-center">
							 	<img src="<?php echo base_url()?>assets/images/users_photo/juragan2.jpg" class="rounded">
							</div>
						</td>
						<td>
							<div class="row">
								<div class="col-2">Nama</div>
								<div class="col-0">:</div>
								<div class="col-9">Ridho Pratama Putra</div>
							</div>
							<div class="row">
								<div class="col-2">SIP</div>
								<div class="col-0">:</div>
								<div class="col-9">112131314124</div>
							</div>
							<div class="row">
								<div class="col-2">Alamat</div>
								<div class="col-0">:</div>
								<div class="col-9">Jl. Tata Surya 1 No 21</div>
							</div>
							<div class="row">
								<div class="col-2">No. Tlpn</div>
								<div class="col-0">:</div>
								<div class="col-9">08123456789</div>
							</div>
						</td>
						<td>
							<button type="button" class="btn btn-danger">Reset</button>
							<button type="button" class="btn btn-primary">Detail</button>
						</td>
					</tr>
					<tr>
						<td>	
							<div class="text-center">2.</div>
						</td>
						<td>
							<div class="text-center">
							 	<img src="<?php echo base_url()?>assets/images/users_photo/juragan2.jpg" class="rounded">
							</div>
						</td>
						<td>
							<div class="row">
								<div class="col-2">Nama</div>
								<div class="col-0">:</div>
								<div class="col-9">Ridho Pratama Putra</div>
							</div>
							<div class="row">
								<div class="col-2">SIP</div>
								<div class="col-0">:</div>
								<div class="col-9">112131314124</div>
							</div>
							<div class="row">
								<div class="col-2">Alamat</div>
								<div class="col-0">:</div>
								<div class="col-9">Jl. Tata Surya 1 No 21</div>
							</div>
							<div class="row">
								<div class="col-2">No. Tlpn</div>
								<div class="col-0">:</div>
								<div class="col-9">08123456789</div>
							</div>
						</td>
						<td>
							<button type="button" class="btn btn-danger">Reset</button>
							<button type="button" class="btn btn-primary">Detail</button>
						</td>
					</tr>
					<tr>
						<td>	
							<div class="text-center">2.</div>
						</td>
						<td>
							<div class="text-center">
							 	<img src="<?php echo base_url()?>assets/images/users_photo/juragan2.jpg" class="rounded">
							</div>
						</td>
						<td>
							<div class="row">
								<div class="col-2">Nama</div>
								<div class="col-0">:</div>
								<div class="col-9">Ridho Pratama Putra</div>
							</div>
							<div class="row">
								<div class="col-2">SIP</div>
								<div class="col-0">:</div>
								<div class="col-9">112131314124</div>
							</div>
							<div class="row">
								<div class="col-2">Alamat</div>
								<div class="col-0">:</div>
								<div class="col-9">Jl. Tata Surya 1 No 21</div>
							</div>
							<div class="row">
								<div class="col-2">No. Tlpn</div>
								<div class="col-0">:</div>
								<div class="col-9">08123456789</div>
							</div>
						</td>
						<td>
							<button type="button" class="btn btn-danger">Reset</button>
							<button type="button" class="btn btn-primary">Detail</button>
						</td>
					</tr>
					<tr>
						<td>	
							<div class="text-center">2.</div>
						</td>
						<td>
							<div class="text-center">
							 	<img src="<?php echo base_url()?>assets/images/users_photo/juragan2.jpg" class="rounded">
							</div>
						</td>
						<td>
							<div class="row">
								<div class="col-2">Nama</div>
								<div class="col-0">:</div>
								<div class="col-9">Ridho Pratama Putra</div>
							</div>
							<div class="row">
								<div class="col-2">SIP</div>
								<div class="col-0">:</div>
								<div class="col-9">112131314124</div>
							</div>
							<div class="row">
								<div class="col-2">Alamat</div>
								<div class="col-0">:</div>
								<div class="col-9">Jl. Tata Surya 1 No 21</div>
							</div>
							<div class="row">
								<div class="col-2">No. Tlpn</div>
								<div class="col-0">:</div>
								<div class="col-9">08123456789</div>
							</div>
						</td>
						<td>
							<button type="button" class="btn btn-danger">Reset</button>
							<button type="button" class="btn btn-primary">Detail</button>
						</td>
					</tr>
				</tbody>
				<tfoot>
		            <tr>
		                <th></th>
		                <th></th>
		                <th></th>
		                <th></th>
		            </tr>
		        </tfoot>
			</table>
		</div>
	</div>
</div>