<!--sidebar end-->

<!-- **********************************************************************************************************************************************************
	  MAIN CONTENT
	  *********************************************************************************************************************************************************** -->
<!--main content start-->
<section id="main-content">
	<section class="wrapper">

		<div class="row">
			<div class="col-lg-12 main-chart">
				<h3>Data User</h3>
				<br />
				<?php if (isset($_GET['success'])) { ?>
					<div class="alert alert-success">
						<p>Tambah Data Berhasil !</p>
					</div>
				<?php } ?>
				<?php if (isset($_GET['success-edit'])) { ?>
					<div class="alert alert-success">
						<p>Update Data Berhasil !</p>
					</div>
				<?php } ?>
				<?php if (isset($_GET['remove'])) { ?>
					<div class="alert alert-danger">
						<p>Hapus Data Berhasil !</p>
					</div>
				<?php } ?>
				<?php
				if (!empty($_GET['uid'])) {
					$sql = "SELECT * FROM login WHERE id_login = ?";
					$row = $config->prepare($sql);
					$row->execute(array($_GET['uid']));
					$edit = $row->fetch();
					?>

				<?php } else { ?>

					<button type="button" class="btn btn-primary btn-md pull-right" data-toggle="modal"
						data-target="#myModal">
						<i class="fa fa-plus"></i> Insert Data User</button>
					<a href="index.php?page=pengaturan" style="margin-right :0.5pc;"
						class="btn btn-success btn-md pull-right">
						<i class="fa fa-refresh"></i> Refresh Data</a>
					<div class="clearfix"></div>

				<?php } ?>
				<br />
				<table class="table table-bordered" id="example1">
					<thead>
						<tr style="background:#DFF0D8;color:#333;">
							<th>No.</th>
							<th>Nama Profile</th>
							<th>Username</th>
							<th>Password</th>
							<th>Level</th>
							<th>Gambar</th>
							<th>No. Hp</th>
							<th>Email</th>
							<th>Alamat</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$hasil = $lihat->puser();
						$no = 1;
						foreach ($hasil as $isi) {
							?>
							<tr>
								<td>
									<?php echo $no; ?>
								</td>
								<td>
									<?php echo $isi['nama_profile']; ?>
								</td>
								<td>
									<?php echo $isi['user']; ?>
								</td>
								<td>
									<?php echo $isi['pass']; ?>
								</td>
								<td>
									<?php echo $isi['level']; ?>
								</td>
								<td>
									<?php echo $isi['gambar']; ?>
								</td>
								<td>
									<?php echo $isi['no_hp']; ?>
								</td>
								<td>
									<?php echo $isi['email']; ?>
								</td>
								<td>
									<?php echo $isi['alamat']; ?>
								</td>
								<td>
									<a href="index.php?page=pengaturan/edit&puser=<?php echo $isi['id_login']; ?>"><button
											class="btn btn-warning">Edit</button></a>
									<a href="fungsi/hapus/hapus.php?puser=hapus&id=<?php echo $isi['id_login']; ?>"
										onclick="javascript:return confirm('Hapus Data User ?');"><button
											class="btn btn-danger">Hapus</button></a>
								</td>
							</tr>
							<?php $no++;
						} ?>
					</tbody>
				</table>
				<div class="clearfix" style="padding-top:16%;"></div>
				<div id="myModal" class="modal fade" role="dialog">
					<div class="modal-dialog">
						<!-- Modal content-->
						<div class="modal-content" style=" border-radius:0px;">
							<div class="modal-header" style="background:#285c64;color:#fff;">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title"><i class="fa fa-plus"></i> Tambah Usr</h4>
							</div>
							<form action="fungsi/tambah/tambah.php?puser=tambah" method="POST">
								<div class="modal-body">
									<table class="table table-striped bordered">
										<?php
										$format = $lihat->puser();
										?>
										<!-- <tr>
											<td>ID Supplier</td>
											<td><input type="text" readonly="readonly" required
													value="<?php echo $format; ?>" class="form-control"
													name="id_supplier"></td>
										</tr> -->
										<tr>
											<td>Nama User</td>
											<td><input type="text" placeholder="Nama User" required class="form-control"
													name="nama_profile"></td>
										</tr>
										<tr>
											<td>Username</td>
											<td><input type="text" placeholder="Username" required class="form-control"
													name="user"></td>
										</tr>
										<tr>
											<td>Password</td>
											<td><input type="password" placeholder="Password" required
													class="form-control" name="pass"></td>
										</tr>
										<tr>
											<td>Level</td>
											<td><input type="text" placeholder="Level" required class="form-control"
													name="level"></td>
										</tr>
										<tr>
											<td>Gambar</td>
											<td><input type="text" placeholder="Gambar" required class="form-control"
													name="gambar"></td>
										</tr>
										<tr>
											<td>No. Hp</td>
											<td><input type="text" placeholder="No. Hp" required class="form-control"
													name="no_hp"></td>
										</tr>
										<tr>
											<td>Email</td>
											<td><input type="email" placeholder="Email" required class="form-control"
													name="email"></td>
										</tr>
										<tr>
											<td>Alamat</td>
											<td><input type="text" placeholder="Alamat" required class="form-control"
													name="alamat"></td>
										</tr>
									</table>
								</div>
								<div class="modal-footer">
									<button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Insert
										Data</button>
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
	</section>
</section>