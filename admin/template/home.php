<!--sidebar end-->
<!-- **********************************************************************************************************************************************************
	  MAIN CONTENT
	  *********************************************************************************************************************************************************** -->
<!--main content start-->
<?php
include('config.php');
?>
<section id="main-content">
	<section class="wrapper">
		<div class="row">
			<div class="col-lg-12">
				<div class="row" style="margin-left:1pc;margin-right:1pc;">
					<h1>DASHBOARD
						<?php echo $hasil_profil['nama_profile']; ?>
					</h1>

					<hr>

					<?php
					$sql = " select * from barang";
					$row = $config->prepare($sql);
					$row->execute();

					?>
					<?php $hasil_barang = $lihat->barang_row(); ?>
					<?php $hasil_kategori = $lihat->kategori_row(); ?>
					<?php $stok = $lihat->barang_stok_row(); ?>

					<?php $modal = $lihat->modal(); ?>
					<?php $penjualan = $lihat->penjualan_total(); ?>
					<?php $pengeluaran = $lihat->pengeluaran(); ?>
					<?php $untung = $lihat->untung(); ?>

					<div class="row">
						<div class="col-md-3">
							<div class="panel panel-primary">
								<div class="panel-heading">
									<h5>Modal</h5>
								</div>
								<div class="panel-body">
									<center>
										<h1>
											<?php echo "Rp. ".number_format($modal[0]['modal']); ?>
										</h1>
									</center>
								</div>
								<div class="panel-footer">
									<h4 style="font-size:15px;font-weight:700;"><a href='index.php?page=barang'>Barang Masuk<i class='fa fa-angle-double-right'></i></a></h4>
								</div>
							</div><!--/grey-panel -->
						</div><!-- /col-md-3-->
						<div class="col-md-3">
							<div class="panel panel-primary">
								<div class="panel-heading">
									<h5>Penjualan</h5>
								</div>
								<div class="panel-body">
									<center>
										<h1>
											<?php echo "Rp. ".number_format($penjualan[0]['penjualan']); ?>
										</h1>
									</center>
								</div>
								<div class="panel-footer">
									<h4 style="font-size:15px;font-weight:700;"><a href='index.php?page=barang'>Barang Keluar <i class='fa fa-angle-double-right'></i></a></h4>
								</div>
							</div><!--/grey-panel -->
						</div><!-- /col-md-3-->
						<div class="col-md-3">
							<div class="panel panel-primary">
								<div class="panel-heading">
									<h5>Pengeluaran</h5>
								</div>
								<div class="panel-body">
									<center>
										<h1>
											<?php echo "Rp. ".number_format($pengeluaran[0]['pengeluaran']); ?>
										</h1>
									</center>
								</div>
								<div class="panel-footer">
									<h4 style="font-size:15px;font-weight:700;"><a href='index.php?page=barang'>Barang Keluar <i class='fa fa-angle-double-right'></i></a></h4>
								</div>
							</div><!--/grey-panel -->
						</div><!-- /col-md-3-->
						<div class="col-md-3">
							<div class="panel panel-primary">
								<div class="panel-heading">
									<h5>Keuntungan</h5>
								</div>
								<div class="panel-body">
									<center>
										<h1>
											<?php echo "Rp. ".number_format($untung[0]['untung']); ?>
										</h1>
									</center>
								</div>
								<div class="panel-footer">
									<h4 style="font-size:15px;font-weight:700;"><a href='index.php?page=barang'>Barang Keluar <i class='fa fa-angle-double-right'></i></a></h4>
								</div>
							</div><!--/grey-panel -->
						</div><!-- /col-md-3-->

						<div class="col-md-5">
							<canvas id="myChart" style="width:100%;max-width:600px"></canvas>
						</div>
<!-- 
						<div class="col-md-6">
							<canvas id="myChart_1" style="width:100%;max-width:600px"></canvas>
						</div> -->

						<div class="col-md-7">
				<table class="table table-bordered" id="example1">
							<thead>
								<tr style="background:#DFF0D8;color:#333;">
									<th>No.</th>
									<!-- <th>ID Barang</th> -->
									<th>Kategori</th>
									<th>Nama Barang</th>
									<th>Merk</th>
									<th>Stok</th>
									<th>Satuan</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$hasil = $lihat->barang();

								$no = 1;
								foreach ($hasil as $isi) {
									$param_array = $isi['id_barang'].",".$isi['nama_barang'].",".$isi['merk'].",".$isi['satuan'].",".$isi['stok'];
									?>
									<tr>
										<td><?php echo $no; ?></td>
										<!-- <td>
											<?php echo $isi['id_barang']; ?>
										</td> -->
										<td><?php echo $isi['nama_kategori']; ?></td>
										<td>
											<?php echo $isi['nama_barang']; ?>
										</td>
										<td><?php echo $isi['merk']; ?></td>
										<td><?php echo $isi['stok']; ?></td>
										<td>
											<?php echo $isi['satuan']; ?>
										</td>
									</tr>
									<?php
									$no++;
								}
								?>
							</tbody>
				</table>
			</div>
<!-- 
						<div class="col-md-6">
							<canvas id="myChart_2" style="width:100%;max-width:600px"></canvas>
						</div>

						<div class="col-md-6">
							<canvas id="myChart_3" style="width:100%;max-width:600px"></canvas>
						</div> -->
<!-- </div> -->
		<!-- <div class="row"> -->


		</div>

					</div>
				</div>
			</div><!-- /col-lg-9 END SECTION MIDDLE -->

			<!-- **********************************************************************************************************************************************************
	  RIGHT SIDEBAR CONTENT
	  *********************************************************************************************************************************************************** -->


		<!-- <div class="clearfix" style="padding-top:18%;"></div> -->

	</section>
</section>

<script>

	$.ajax({
		type: "POST",
		url: "fungsi/edit/edit.php?top_seller=yes",
		success: function(result){
			var r = JSON.parse(result);
			if(r.success){
				var xValues = r.nama_barang;
				var yValues = r.qty_barang;
				var barColors = r.color_barang;

				new Chart("myChart", {
					type: "bar",
					data: {
						labels: xValues,
						datasets: [{
						backgroundColor: barColors,
						data: yValues
						}]
					},
					options: {
						legend: {display: false},
						title: {
						display: true,
						text: "Top Seller"
						}
					}
				});
			}
		}
	});
	

	// ============================================ //




	// ============================================ //
	// var xValues_2 = ["Italy", "France", "Spain", "USA", "Argentina"];
	// var yValues_2 = [55, 49, 44, 24, 15];
	// var barColors_2 = [
	// 	"#b91d47",
	// 	"#00aba9",
	// 	"#2b5797",
	// 	"#e8c3b9",
	// 	"#1e7145"
	// ];

	// new Chart("myChart_2", {
	// 	type: "doughnut",
	// 	data: {
	// 		labels: xValues_2,
	// 		datasets: [{
	// 		backgroundColor: barColors_2,
	// 		data: yValues_2
	// 		}]
	// 	},
	// 	options: {
	// 		title: {
	// 		display: true,
	// 		text: "World Wide Wine Production 2018"
	// 		}
	// 	}
	// });

	// // ============================================ //
	// var xValues_3 = ["Italy", "France", "Spain", "USA", "Argentina"];
	// var yValues_3 = [55, 49, 44, 24, 15];
	// var barColors_3 = [
	// 	"#b91d47",
	// 	"#00aba9",
	// 	"#2b5797",
	// 	"#e8c3b9",
	// 	"#1e7145"
	// ];

	// new Chart("myChart_3", {
	// 	type: "pie",
	// 	data: {
	// 		labels: xValues_3,
	// 		datasets: [{
	// 		backgroundColor: barColors_3,
	// 		data: yValues_3
	// 		}]
	// 	},
	// 	options: {
	// 		title: {
	// 		display: true,
	// 		text: "World Wide Wine Production 2018"
	// 		}
	// 	}
	// });

</script>