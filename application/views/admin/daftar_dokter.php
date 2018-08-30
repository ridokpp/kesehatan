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
						<th>No.</th>
						<th>Foto</th>
						<th>
						</th>							
						<th>Keterangan</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>1.</td>
						<td>Foto</td>
						<td>Biodata</td>
						<td>
							<button type="button" class="btn btn-danger">Reset</button>
							<button type="button" class="btn btn-primary">Detail</button>
						</td>
					</tr>
					<tr>
						<td>2.</td>
						<td>Foto</td>
						<td>Biodata</td>
						<td>
							<button type="button" class="btn btn-danger">Reset</button>
							<button type="button" class="btn btn-primary">Detail</button>
						</td>
					</tr>
					<tr>
						<td>5.</td>
						<td>Foto</td>
						<td>Biodata</td>
						<td>
							<button type="button" class="btn btn-danger">Reset</button>
							<button type="button" class="btn btn-primary">Detail</button>
						</td>
					</tr>
					<tr>
						<td>4.</td>
						<td>Foto</td>
						<td>Biodata</td>
						<td>
							<button type="button" class="btn btn-danger">Reset</button>
							<button type="button" class="btn btn-primary">Detail</button>
						</td>
					</tr>
				</tbody>
				<tfoot>
		            <tr>
		                <th>No.</th>
		                <th>Foto</th>
		                <th>Biodata</th>
		                <th>Keterangan</th>
		            </tr>
		        </tfoot>
			</table>
		</div>
	</div>
</div>