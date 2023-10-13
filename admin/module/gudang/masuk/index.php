<section id="main-content">
	<section class="wrapper">

		<div class="row">
			<div class="col-lg-12 main-chart">
				<h3>Transaksi Masuk</h3>
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
							<a href="excel_in.php?page=gudang/masuk&from=<?php echo $_GET['from']; ?>&to=<?php echo $_GET['to'] ;?>" class="btn btn-success"><i class="fa fa-download"></i>
							Export Excel</a>
							<a href="print_in.php?page=gudang/masuk&from=<?php echo $_GET['from']; ?>&to=<?php echo $_GET['to'] ;?>" class="btn btn-default"><i class="fa fa-print"></i>
							Print</a>
							<?php }else{ ?>
							<a href="excel_in.php?page=gudang/masuk" class="btn btn-success"><i class="fa fa-download"></i>
							Export Excel</a>
							<a href="print_in.php?page=gudang/masuk" class="btn btn-default"><i class="fa fa-print"></i>
							Print</a>
							<?php } ?>
						</td>
						</tr>
					</table>
				</form>
			</div>
			<div class="col-lg-12 main-chart">
				<a href="index.php?page=gudang/masuk/tambah" class="btn btn-primary" onclick="filter_laporan()"><i class="fa fa-plus"></i> Tambah</a>
			</div>
			<div class="col-lg-12 main-chart">
	
				<table class="table table-bordered" id="example1">
					<thead>
						<tr style="background:#DFF0D8;color:#333;">
							<th>No.</th>
							<th>Tanggal Barang Masuk</th>
							<th>No. Order</th>
							<th>Harga</th>
							<th>Discount</th>
							<th>Total</th>
							<th>Pengirim</th>
							<th>Status</th>
							<th>Catatan</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if(isset($_GET['from'])&&isset($_GET['to'])){
							$hasil = $lihat->laporan_transaksi_masuk($_GET['from'], $_GET['to']);
							$no = 1;
							foreach ($hasil as $isi) {
								$status = '<span class="btn btn-danger btn-xs" onclick="pembayaran(`'.$isi['no_order'].'`,`'.$isi['harga_total_inv'].'`,`'.$isi['status'].'`)">'.$isi['status'].'</span>';
								if($isi['status']=="Lunas"){$status = '<span class="btn btn-success btn-xs" onclick="pembayaran(`'.$isi['no_order'].'`,`'.$isi['harga_total_inv'].'`,`'.$isi['status'].'`)">'.$isi['status'].'</span>';}
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
									<td>Rp. <?php echo number_format($isi['discount_inv']); ?></td>

									<td>Rp. <?php echo number_format($isi['harga_total_inv']); ?></td>
									<td><?php echo $isi['nama_supplier']; ?></td>
									<td style="text-align:center"><?php echo $status; ?></td>
									<td><?php echo $isi['catatan']; ?></td>
									<td>
										<a href="index.php?page=gudang/masuk/details&no_invoice=<?php echo $isi['no_order']; ?>">
										<button class="btn btn-primary btn-xs">Details</button></a>
									</td>
								</tr>
								<?php
								$no++;
							}
						?>
						<?php } else { ?>
							<?php
							$hasil = $lihat->view_all_laporan_transaksi_masuk();
							$no = 1;
							foreach ($hasil as $isi) {
								$status = '<span class="btn btn-danger btn-xs" onclick="pembayaran(`'.$isi['no_order'].'`,`'.$isi['harga_total_inv'].'`,`'.$isi['status'].'`)">'.$isi['status'].'</span>';
								if($isi['status']=="Lunas"){$status = '<span class="btn btn-success btn-xs" onclick="pembayaran(`'.$isi['no_order'].'`,`'.$isi['harga_total_inv'].'`,`'.$isi['status'].'`)">'.$isi['status'].'</span>';}
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
									<td>Rp. <?php echo number_format($isi['discount_inv']); ?></td>

									<td>Rp. <?php echo number_format($isi['harga_total_inv']); ?></td>
									<td><?php echo $isi['nama_supplier']; ?></td>
									<td style="text-align:center"><?php echo $status; ?></td>
									<td><?php echo $isi['catatan']; ?></td>
									<td>
										<a href="index.php?page=gudang/masuk/details&no_invoice=<?php echo $isi['no_order']; ?>">
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

		<div id="Modal_pembayaran" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content modal-lg" style=" border-radius:0px;">
					<div class="modal-header" style="background:#285c64;color:#fff;">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title"><i class="fa fa-edit"></i> Pembayaran Invoice </h4>
					</div>
					<div class="modal-body">
						<input type="hidden" class="form-control" id="key_edit">
						<tr>
							<td>No. Order</td><td><input type="text" class="form-control" id="no_order" disabled></br></td>
						</tr>
						<tr>
							<td>Total</td><td><input type="number" class="form-control" id="total_inv" disabled></br></td>
						</tr>
						<tr>
							<td>Bayar</td><td><input type="number" class="form-control" id="bayar_inv"></td>
						</tr>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-success" onclick="update_pembayaran()">Save</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>

	</section>
</section>

<script>
	function filter_laporan(){
		var from = $("#from").val();
		var to = $("#to").val();
		var link_search = String(window.location).split("?");

		window.location= link_search[0]+"?page=gudang/masuk&from="+from+"&to="+to;
	}

	function pembayaran(no_order, total, status_inv){
		
		// alert(no_order+" || "+total+" || "+status_inv);
		$("#Modal_pembayaran").modal("show");
		$("#no_order").val(no_order);
		$("#total_inv").val(total);
		$("#bayar_inv").val(status_inv);
	}

	function update_pembayaran(){
		var no_order = $("#no_order").val();
		var total_inv = $("#total_inv").val();
		var bayar_inv = $("#bayar_inv").val();

		if((total_inv*1)==(bayar_inv*1)){
			$.ajax({
				type: "POST",
				url: "fungsi/edit/edit.php?status_transaksi_in=yes",
				data:{
					no_order : no_order,
					status : "paid"
				},
				success: function(result){
					var r = JSON.parse(result);
					alert(r.message);
					if(r.success){
						window.location= window.location.href;
					}
				}
			});
		}else{
			alert("Pembayaran Invoice harus sesuai dengan tagihan!");
		}

	}

</script>