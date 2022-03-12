<?php
session_start();
include('../include/db.php');
if (!(isset($_SESSION['UID']))) {
	header("Location:../");
}
$row = mysqli_fetch_array(mysqli_query($con, "SELECT count(*) FROM persons"));
$personsCount = $row[0];
?>
<html>

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">

	<!-- Material Theme -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="stylesheet.css">

	<title>Address Book</title>
</head>

<body>
	<!-- Navbar -->
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<i class="material-icons" style="font-size:36px">event_note</i>
		<a class="navbar-brand" href="">Address Book</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item">
					<a class="nav-link" data-toggle="modal" data-target="#addModal" href="">Add new entry</a>
				</li>
			</ul>
			<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
				<li class="nav-item">
					<a class="nav-link" href="../login/logout.php">Logout</a>
				</li>
			</ul>
		</div>
	</nav>
	<!-- Container with table -->
	<div class="container-fluid" style="width:80%">
		<table class="table table-striped table-bordered" style="width:100%" id="tabtable">
			<thead>
				<tr>
					<th>Name</th>
					<th>Mobile</th>
					<th>Email</th>
					<th>Street</th>
					<th>City</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$res = mysqli_query($con, "SELECT * FROM persons");
				while ($row = mysqli_fetch_array($res)) {
					echo '<tr id="' . $row['ID'] . '">
						<td>' . $row['Name'] . '</td>
						<td>' . $row['Mobile'] . '</td>
						<td>' . $row['Email'] . '</td>
						<td style="word-wrap:break-word;">' . $row['Street'] . '</td>
						<td>' . $row['City'] . '</td>
						<td style="text-align:center">
							<button id="' . $row['ID'] . '" name="delete" class="tabbutton-dele" style="font-size:24px"><i class="material-icons">clear</i></button>
							<button data-id="' . $row['ID'] . '" name="edit" class="tabbutton-edit" data-toggle="modal" data-target="#editmodal" style="font-size:24px"><i class="material-icons">create</i></button>
						</td>		
					  </tr>';
				}
				?>
			</tbody>
			<tfoot>
				<tr>
					<th>Name</th>
					<th>Mobile</th>
					<th>Email</th>
					<th>Street</th>
					<th>City</th>
					<th>Action</th>
				</tr>
			</tfoot>
		</table>
	</div>
	<!-- Edit Person Modal -->
	<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="editModalTitle">Edit Entry</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
				</div>

				<form method="POST" id="editPersonForm">
					<p class="text-center" id="updateRes"></p>
					<div class="modal-body">
						<input type="hidden" name="update_id" id="update_id">
						<div class="form-group">
							<label>Firstname</label>
							<input type="text" name="updatefname" id="updatefname" class="form-control" placeholder="Enter Firstname">
						</div>
						<div class="form-group">
							<label>Lastname</label>
							<input type="text" name="updatelname" id="updatelname" class="form-control" placeholder="Enter Lastname">
						</div>
						<div class="form-group">
							<label>Mobile</label>
							<input type="tel" required pattern="[0-9]{10}" name="updatemobile" id="updatemobile" class="form-control" placeholder="Enter Phonen umber">
						</div>
						<div class="form-group">
							<label>Email</label>
							<input type="email" required name="updatemail" id="updatemail" class="form-control" placeholder="Enter email address">
						</div>
						<div class="form-group">
							<label>Street</label>
							<input type="text" name="updatestreet" id="updatestreet" class="form-control" placeholder="Enter Streetname">
						</div>
						<div class="form-group">
							<label>City</label>
							<input type="text" name="updatecity" id="updatecity" class="form-control" placeholder="Enter City">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" name="updatedata" class="btn btn-primary">Update Entry</button>
					</div>
				</form>

			</div>
		</div>
	</div>
	<!-- Add Person Modal -->
	<div class="modal fade" id="addmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Add new Entry</h5>
				</div>

				<form method="POST" id="addPersonForm">
					<p class="text-center" id="res"></p>
					<div class="modal-body">
						<div class="form-group">
							<label>Firstname</label>
							<input type="text" name="fname" id="fname" class="form-control" placeholder="Enter Firstname">
						</div>
						<div class="form-group">
							<label>Lastname</label>
							<input type="text" name="lname" id="lname" class="form-control" placeholder="Enter Lastname">
						</div>
						<div class="form-group">
							<label>Mobile</label>
							<input type="tel" required pattern="[0-9]{10}" name="mobile" id="mobile" class="form-control" placeholder="Enter Phone number">
						</div>
						<div class="form-group">
							<label>Email</label>
							<input type="email" name="email" id="email" class="form-control" placeholder="Enter email address">
						</div>
						<div class="form-group">
							<label>Street</label>
							<input type="text" name="street" id="street" class="form-control" placeholder="Enter Streetname">
						</div>
						<div class="form-group">
							<label>City</label>
							<input type="text" name="city" id="city" class="form-control" placeholder="Enter City">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" name="insertdata" class="btn btn-primary">Save Data</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- JS imports -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

	<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
	<!-- DataTable options -->
	<script>
		$(document).ready(function() {
			$('#tabtable').DataTable({
				"dom": '<"top"i>rt<"bottom"flp><"clear">',
				"order": [
					[0, "asc"]
				],
				"pagingType": "simple"
			});
		});
	</script>
	<!-- JQuery functions -->
	<script>
		$(document).ready(function() {
			// reset btn
			$('.btn-primary').click(function() {
				$('#res').text('');
				$('#updateRes').text('');
			});
			// add
			$('#addPersonForm').submit(function() {
				var formData = new FormData($(this)[0]);
				$.ajax({
					url: 'tasks/add.php',
					type: 'POST',
					data: formData,
					async: true,
					success: function(data) {
						//$('#res').html(data);
						location.reload(true); // page reload
					},
					cache: false,
					contentType: false,
					processData: false
				});
				$(this)[0].reset();
				return false;
			});
			// delete a person
			$('.tabbutton-dele').click(function(event) {
				var id = event.target.id;
				if ($.isNumeric(id)) {
					if (confirm("Are you sure to delete this person?")) {
						$.ajax({
							url: 'tasks/delete.php',
							type: 'POST',
							data: 'id=' + id,
							async: false,
							success: function(data) {
								var objID = '#' + id;
								$(objID).hide(500);
							},
						});
					}
				}
				return false;
			});
			// edit a person - fetch
			$(".tabbutton-edit").click(function() {
				var id = parseInt($(this).attr('data-id'));
				$('#editmodal').modal('show');
				if (id != 0) {
					var dataString = 'id=' + id;
					$.ajax({
						url: 'tasks/fetch.php',
						type: 'POST',
						dataType: 'json',
						data: dataString,
						async: false,
						success: function(data) {
							var name = data[1].split(' ');
							var mobile = data[2];
							var mail = data[3];
							var street = data[4];
							var city = data[5];
							$('#updatefname').val(name[0]);
							$('#updatelname').val(name[1]);
							$('#updatemobile').val(mobile);
							$('#updatemail').val(mail);
							$('#updatestreet').val(street);
							$('#updatecity').val(city);
						},
					})
				}
				return false;
			});
			// edit a person - update
			$('#editPersonForm').submit(function() {
				var formData = new FormData($(this)[0]);
				$.ajax({
					url: 'tasks/update.php',
					type: 'POST',
					data: formData,
					async: true,
					success: function(data) {
						//$('#updateRes').html(data);
						location.reload(true); // page reload
					},
					cache: false,
					contentType: false,
					processData: false
				});
				$(this)[0].reset();
				return false;
			});
		});
	</script>
</body>

</html>