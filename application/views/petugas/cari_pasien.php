<script type="text/javascript">
$(document).ready(function() {
	$('select').select2();
	$("#nama_or_nomor").select2({
		ajax: {
			url: '<?=base_url()?>Petugas_handler/cari_nama/',
			dataType: 'json',
			delay: 250,
			data: function (term, page) {
				return {
					term: term, // search term
					page: 10
				};
			},
			processResults: function (data, page) {
				console.log(data);
				return {
					results: data
				};
			},
			cache: true
		},
		escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
		minimumInputLength: 1,
	});
});
</script>
<h3 class="text-center mt-3">Cari Nomor Pasien</h3>
<div class="container mt-5">
	<form action="<?=base_url().'Petugas_handler/redirector'?>" method="GET">
		<?=$this->session->flashdata("alert");?>
		<div class="row">
			<div class="col">
			 	<div class="form-group row">
				    <div class="input-group-prepend col-8 offset-2">
				      	<select class="js-data-example-ajax form-control" name="nama_or_nomor" id="nama_or_nomor">
				      		<option value="" selected="selected">Cari berdasarkan nama pasien atau nomor pasien</option>
				      	</select>
				    </div>
				</div>
			</div>   
		</div>
		<div class="row">
			<div class="col-8 offset-2">
			    <div class="form-group">
					<button type="submit" class="btn btn-primary btn-block">Submit</button>
				</div>
			</div>
		</div>
	</form>	
</div>