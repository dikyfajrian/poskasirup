<!--sidebar end-->

<!-- **********************************************************************************************************************************************************
	  MAIN CONTENT
	  *********************************************************************************************************************************************************** -->
<!--main content start-->
<?php
$id = $_GET['barang'];
$hasil = $lihat->barang_edit($id);

?>
<section id="main-content">
	<section class="wrapper">

		<div class="row">
			<div class="col-lg-12 main-chart">
				<a href="index.php?page=barang"><button class="btn btn-primary"><i class="fa fa-angle-left"></i> Balik
					</button></a>
				<h3>Details Barang</h3>
				<?php if (isset($_GET['success'])) { ?>
					<div class="alert alert-success">
						<p>Edit Data Berhasil !</p>
					</div>
					<?php } ?>
				<?php if (isset($_GET['remove'])) { ?>
					<div class="alert alert-danger">
						<p>Hapus Data Berhasil !</p>
					</div>
					<?php } ?>
				<table class="table table-striped">
					<form action="fungsi/edit/edit.php?barang=edit" method="POST">
						<tr>
							<td>ID Barang</td>
							<td><input type="text" readonly="readonly" class="form-control"
									value="<?php echo $hasil['id_barang']; ?>" name="id"></td>
						</tr>
						<tr>
							<td>Kategori</td>
							<td>
								<select name="kategori" class="form-control">
									<option value="#">Pilih Kategori</option>
									<?php $kat = $lihat->kategori();
									foreach ($kat as $isi) { ?>
										<?php if($isi['id_kategori']==$hasil['id_kategori']){ ?>
											<option selected value="<?php echo $isi['id_kategori']; ?>">
												<?php echo $isi['nama_kategori']; ?>
											</option>
										<?php }else{ ?>
											<option value="<?php echo $isi['id_kategori']; ?>">
												<?php echo $isi['nama_kategori']; ?>
											</option>
										<?php }
									} ?>
								</select>
							</td>
						</tr>
						<tr>
							<td>Nama Barang</td>
							<td><input type="text" class="form-control" value="<?php echo $hasil['nama_barang']; ?>"
									name="nama"></td>
						</tr>
						<tr>
							<td>Merk Barang</td>
							<td><input type="text" class="form-control" value="<?php echo $hasil['merk']; ?>"
									name="merk"></td>
						</tr>
						<tr>
							<td>Harga Beli</td>
							<td><input type="number" class="form-control" value="<?php echo $hasil['harga_beli']; ?>"
									name="beli"></td>
						</tr>
						<tr>
							<td>Harga Jual</td>
							<td><input type="number" class="form-control" value="<?php echo $hasil['harga_jual']; ?>"
									name="jual"></td>
						</tr>
						<tr>
							<td>Satuan Barang</td>
							<td>
								<select name="satuan" class="form-control">
									<option value="#">Pilih Satuan</option>
									<?php $sat = $lihat->satuan();
									foreach ($sat as $isi) { ?>
										<?php if($isi['id']==$hasil['satuan_barang']){ ?>
											<option selected value="<?php echo $isi['id']; ?>">
												<?php echo $isi['nama']; ?>
											</option>
										<?php }else{ ?>
											<option value="<?php echo $isi['id']; ?>">
												<?php echo $isi['nama']; ?>
											</option>
										<?php } ?>
									<?php } ?>
								</select>
							</td>
						</tr>
						<tr>
							<td>Tanggal Update</td>
							<td><input type="text" readonly="readonly" class="form-control"
									value="<?php echo date("j F Y, G:i"); ?>" name="tgl"></td>
						</tr>
						<tr>
							<td></td>
							<td><button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> Update Data</button></td>
						</tr>
					</form>
				</table>
				<div class="clearfix" style="padding-top:16%;"></div>
			</div>
		</div>
	</section>
</section>