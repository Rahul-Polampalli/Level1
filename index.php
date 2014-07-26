<!DOCTYPE html>
<html>
	<head>
		<title>Aliens Registration</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/aliens.js"></script>
	</head>
	<body>
		<?php
			require_once('/classes/Database.class.php');
			
			$db = new Database();
			$result = $db -> fetchAll();
		?>
		<div class="rowC col-xs-12">
			<h3>Aliens Registration</h3>
		</div>
		<div class="rowC col-xs-12" style="background-color:#f5f5f5;border:1px solid black;padding-top:10px;">
			<div class="alert alert-danger error" style="display:none;"></div>
			<form role="form" class="form-horizontal">
				<div class="form-group">
					<label class="control-label col-xs-2">Code Name:</label>
					<div class="col-xs-4">
						<input type="text" class="form-control" id="name"/>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-2">Blood Color:</label>
					<div class="col-xs-4">
						<input type="text" class="form-control" id="blood"/>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-2">Antennas:</label>
					<div class="col-xs-4">
						<input type="text" class="form-control" id="antennas"/>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-2">Legs:</label>
					<div class="col-xs-4">
						<input type="text" class="form-control" id="legs"/>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-2">Home Planet:</label>
					<div class="col-xs-4">
						<input type="text" class="form-control" id="planet"/>
					</div>
				</div>
			</form>
			<div class="form-group col-xs-4">
				<button class="btn btn-md btn-primary pull-right" id="addBtn">Register</button>
			</div>
		</div>
		<div class="rowC col-xs-12" style="padding-top:10px;padding-bottom:10px;"><br>
			<button class="btn btn-xs btn-primary word pull-right">Word</button>
			<button class="btn btn-xs btn-primary pdf pull-right" style="margin-right:3px;">Pdf</button>
		</div>
		<div class="rowC col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-condensed table-bordered dataTable">
					<thead>
						<tr>
							<th>Code Name</th>
							<th>Blood</th>
							<th>Antennas</th>
							<th>Legs</th>
							<th>Home Planet</th>
						</tr>
					</thead>
					<tbody>
						<?php
							foreach($result as $row){
								echo '<tr id='.$row['id'].'>
										<td>'.$row['codename'].'</td>
										<td>'.$row['bloodcolor'].'</td>
										<td>'.$row['antennas'].'</td>
										<td>'.$row['legs'].'</td>
										<td>'.$row['homeplanet'].'</td>
									</tr>';			
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</body>
</html>