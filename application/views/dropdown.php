<!DOCTYPE html>
<html>

<head>
	<title>CodeIgniter: Dependent dropdown list by using single table value</title>
	<!-- load bootstrap css -->
	<link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<!-- load jquery library -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<!-- load bootstrap js -->
	<script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
	<div class="container">
		<div class="form-group">
			<label for="name">Nama Barang</label>
			<select class="form-control" id="item_name" name="item_name">
				<option value="0">Pilih Barang</option>
				<?php if (isset($data)) : ?>
					<?php foreach ($data as $key => $value) : ?>
						<option value="<?= $value['item_name'] ?>"><?= $value['item_name'] ?></option>
					<?php endforeach ?>
				<?php endif ?>
			</select>
		</div>
		<div class="form-group">
			<label for="name">Warna Barang</label>
			<select class="form-control" id="color" name="color">
				<option value="0">Pilih Warna</option>
			</select>
		</div>
		<div class="form-group">
			<input type="button" class="btn btn-primary" value="Submit">
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function() {
			// client select box
			var $item_name = $('select#item_name');
			// project select box
			var $color = $('select#color');
			// task select box

			$item_name.on('change', function() {
				// get selected client name
				var item_name = $(this).find('option:selected').val();
				// post data with CSRF token
				var data = {
					action: 'project',
					client: item_name,
					"<?= $this->security->get_csrf_token_name() ?>": "<?= $this->security->get_csrf_hash() ?>"
				};
				// AjaxPOST to get projects
				$.post('./dropdown', data, function(json) {
					projects_data = '<option value="0">Pilih Warna</option>';
					$.each(json, function(index, obj) {
						projects_data += '<option value="' + obj.color + '">' + obj.color + '</option>';
					});
					// append all projects in project dropdown
					$color.html(projects_data);
				}, 'JSON');
			});
		});
	</script>
</body>

</html>
