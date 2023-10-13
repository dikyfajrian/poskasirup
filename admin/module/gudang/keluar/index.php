<section id="main-content">
	<section class="wrapper">

		<div class="row">
			<div class="col-lg-12 main-chart">
				<h3>Transaksi Keluar</h3>
				<br />
				
				<form method="GET" action="index.php?">
					<table class="table table-striped">
						<tr>
							<th>
								Dari
							</th>
							<th>
								Sampai
							</th>
							<th>
								Aksi
							</th>
						</tr>
						<tr>
						<td>
							<input type="date" id="from" name="from" value="<?= isset($_GET['from'])? $_GET['from']:DATE('Y-01-01');?>" class="form-control">
						</td>
						<td>
							<input type="date" id="to" name="to" value="<?=isset($_GET['to'])? $_GET['to']:DATE('Y-m-d');?>" class="form-control">
						</td>
						<td>
							<a href="javascript:void(0)" class="btn btn-primary" onclick="filter_laporan()">
								<i class="fa fa-search"></i> Cari
							</a>							
							<?php if (!empty($_GET['from']) || !empty($_GET['top'])) { ?>
							<a href="excel_out.php?page=gudang/keluar&from=<?php echo $_GET['from']; ?>&to=<?php echo $_GET['to'] ;?>" class="btn btn-success"><i class="fa fa-download"></i>
							Export Excel</a>
							<a href="print_out.php?page=gudang/keluar&from=<?php echo $_GET['from']; ?>&to=<?php echo $_GET['to'] ;?>" class="btn btn-default"><i class="fa fa-print"></i>
							Print</a>
							<?php }else{ ?>
							<a href="excel_out.php?page=gudang/keluar" class="btn btn-success"><i class="fa fa-download"></i>
							Export Excel</a>
							<a href="print_out.php?page=gudang/keluar" class="btn btn-default"><i class="fa fa-print"></i>
							Print</a>
							<?php } ?>
						</td>
						</tr>
					</table>
				</form>
			</div>
			<div class="col-lg-12 main-chart">
				<a href="index.php?page=gudang/keluar/tambah" class="btn btn-primary" onclick="filter_laporan()"><i class="fa fa-plus"></i> Tambah</a>
			</div>
			<div class="col-lg-12 main-chart">
	
				<table class="table table-bordered" id="example1">
					<thead>
						<tr style="background:#DFF0D8;color:#333;">
							<th>No.</th>
							<th>Tanggal Barang Keluar</th>
							<th>No. Order</th>
							<th>Harga</th>
							<th>Alasan</th>
							<th>Total</th>
							<th>Pengirim</th>
							<th>Catatan</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if(isset($_GET['from'])&&isset($_GET['to'])){
							$hasil = $lihat->laporan_transaksi_keluar($_GET['from'], $_GET['to']);
							$no = 1;
							foreach ($hasil as $isi) {
								?>
								<tr>
									<td><?php echo $no; ?></td>
									<td>
										<?php echo $isi['tanggal_order']; ?>
									</td>
									<td><?php echo $isi['no_order']; ?></td>
									<td>
										Rp. <?php echo number_format($isi['harga_beli_inv']); ?>
									</td>
									<td><?php echo $isi['type']; ?></td>
									<td>Rp. <?php echo number_format($isi['harga_total_inv']); ?></td>
									<td><?php echo $isi['nama_supplier']; ?></td>
									<td><?php echo $isi['catatan']; ?></td>
									<td>
										<a href="index.php?page=gudang/keluar/details&no_invoice=<?php echo $isi['no_order']; ?>">
										<button class="btn btn-primary btn-xs">Details</button></a>
									</td>
								</tr>
								<?php
								$no++;
							}
						?>
						<?php } else { ?>
							<?php
							$hasil = $lihat->view_all_laporan_transaksi_keluar();
							$no = 1;
							foreach ($hasil as $isi) {
								?>
								<tr>
									<td><?php echo $no; ?></td>
									<td>
										<?php echo $isi['tanggal_order']; ?>
									</td>
									<td><?php echo $isi['no_order']; ?></td>
									<td>
										Rp. <?php echo number_format($isi['harga_beli_inv']); ?>
									</td>
									<td><?php echo $isi['type']; ?></td>
									<td>Rp. <?php echo number_format($isi['harga_total_inv']); ?></td>
									<td><?php echo $isi['nama_supplier']; ?></td>
									<td><?php echo $isi['catatan']; ?></td>
									<td>
										<a href="index.php?page=gudang/keluar/details&no_invoice=<?php echo $isi['no_order']; ?>">
										<button class="btn btn-primary btn-xs">Details</button></a>
									</td>
								</tr>
								<?php
								$no++;
						}
						?>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</section>
</section>

<script>
	function filter_laporan(){
		var from = $("#from").val();
		var to = $("#to").val();
		var link_search = String(window.location).split("?");

		window.location= link_search[0]+"?page=gudang/keluar&from="+from+"&to="+to;
	}
</script>