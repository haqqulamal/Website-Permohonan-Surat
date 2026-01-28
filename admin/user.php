<?php
include "koneksi.php";
include "auth_middleware.php";
check_login();
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<?php include "../title.php"; ?>
	<!-- Icon -->
	<link rel="shortcut icon" type="image/icon" href="../logopulpis1.png">
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.5 -->
	<link rel="stylesheet" href="../aset/bootstrap/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="../aset/fa/css/font-awesome.css">
	<!-- DataTables -->
	<link rel="stylesheet" href="../aset/plugins/datatables/dataTables.bootstrap.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="../aset/dist/css/AdminLTE.min.css">
	<!-- AdminLTE Skins. Choose a skin from the css/skins
		 folder instead of downloading all of them to reduce the load. -->
	<link rel="stylesheet" href="../aset/dist/css/skins/_all-skins.min.css">
</head>

<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
		<?php
		include 'content_header.php';
		?>
		<!-- Left side column. contains the logo and sidebar -->
		<?php
		include "menu.php";
		?>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<h1>
					User
				</h1>
				<ol class="breadcrumb">
					<li><i class="fa fa-user-circle-o"></i> User</li>
				</ol>
			</section>

			<!-- Main content -->
			<section class="content">
				<div class="row">
					<div class="col-xs-12">
						<div class="box">
							<div class="box-header">

							</div><!-- /.box-header -->
							<div class="box-body">
								<a href="#"><button class="btn btn-success" type="button" data-target="#ModalAddDosen"
										data-toggle="modal"><i class="fa fa-plus"></i> Tambah User</button></a>


								<br></br>
								<table id="data" class="table table-bordered table-striped table-scalable">

									<thead>
										<tr>
											<th>Username</th>
											<th>Password</th>
											<th>Nama Lengkap</th>
											<th>Role</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$queryuser = mysqli_query($konek, "SELECT * FROM user");
										if ($queryuser == false) {
											die("Terjadi Kesalahan : " . mysqli_error($konek));
										}
										while ($user = mysqli_fetch_array($queryuser)) {

											echo "
								<tr>
									<td>$user[username]</td>
									<td>*****</td>
									<td>$user[nama_lengkap]</td>
									<td>$user[role]</td>
									<td>
								";
											if ($user["id_user"] == $_SESSION["id_user"]) {
												echo "
										<a href='#'>Disable</a>";
											} else {
												echo "
										<a href='#' onClick='confirm_delete(\"user_delete.php?id_user=$user[id_user]\")'>Delete</a>";
											}
											echo
												"
									</td>
								</tr>";
										}
										?>
									</tbody>

								</table>
							</div><!-- /.box-body -->
						</div><!-- /.box -->
					</div><!-- /.col -->
				</div><!-- /.row -->
			</section><!-- /.content -->

			<!-- Modal Popup Dosen -->
			<div id="ModalAddDosen" class="modal fade" tabindex="-1" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
									aria-hidden="true">&times;</span></button>
							<h4 class="modal-title">Tambah User </h4>
							<br />
							<h6 class="modal-title">Username Dan Password </h6>
						</div>
						<div class="modal-body">
							<form action="user_add.php" name="modal_popup" enctype="multipart/form-data" method="post">
								<div class="form-group">
									<label>Role</label>
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-user"></i>
										</div>
										<select name="role" class="form-control">
											<option>Pilih Role</option>
											<option value="admin">Admin</option>
											<option value="penduduk">Penduduk</option>
											<option value="jagabaya">Jagabaya</option>
											<option value="ulu-ulu">Ulu-ulu</option>
											<option value="lurah">Lurah</option>
										</select>
									</div>
								</div>

								<div class="form-group">
									<label>nama_lengkap</label>
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-user"></i>
										</div>
										<input type='text' class='form-control' name='nama_lengkap' required
											oninvalid="this.setCustomValidity('Data tidak boleh kosong')"
											oninput="setCustomValidity('')">
									</div>
								</div>

								<div class="form-group">
									<label>email</label>
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-user"></i>
										</div>
										<input type='email' class='form-control' name='email' required
											oninvalid="this.setCustomValidity('Data tidak boleh kosong')"
											oninput="setCustomValidity('')">
									</div>
								</div>

								<div class="form-group">
									<label>Username</label>
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-user"></i>
										</div>
										<input type='text' class='form-control' placeholder="username" name='username'
											required oninvalid="this.setCustomValidity('Data tidak boleh kosong')"
											oninput="setCustomValidity('')">
									</div>
								</div>

								<div class="form-group">
									<label>Password</label>
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-user"></i>
										</div>
										<input type='text' class='form-control' placeholder="Password" name='password'
											required oninvalid="this.setCustomValidity('Data tidak boleh kosong')"
											oninput="setCustomValidity('')">
									</div>
								</div>

								<div class="modal-footer">
									<button class="btn btn-success" type="submit">
										Create User
									</button>
									<button type="reset" class="btn btn-danger" data-dismiss="modal" aria-hidden="true">
										Cancel
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>

			<!-- Modal Popup Dosen -->


			<!-- Modal Popup untuk delete-->
			<div class="modal fade" id="modal_delete">
				<div class="modal-dialog">
					<div class="modal-content" style="margin-top:100px;">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title" style="text-align:center;">Are you sure to delete this information ?
							</h4>
						</div>
						<div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
							<a href="#" class="btn btn-danger" id="delete_link">Delete</a>
							<button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
						</div>
					</div>
				</div>
			</div>

			<!-- /.content-wrapper -->


		</div>
		<?php
		include "content_footer.php";
		?>
	</div><!-- ./wrapper -->
	<!-- Library Scripts -->
	<?php
	include "bundle_script.php";
	?>
</body>

</html>