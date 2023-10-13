<section id="main-content">
	<section class="wrapper">

		<div class="row">
			<div class="col-lg-12 main-chart">
				<h3>Laporan Penjualan Details</h3>
				<h5><?=@$_GET['no_invoice']?></h5>
				<br />
				
				
			</div>
			
			<div class="col-lg-12">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h4><i class="fa fa-shopping-cart"></i> Hasil Keranjang <span style="float: right;"><a href="print_detail_penjualan.php?page=laporan/detail&no_invoice=<?php echo $_GET['no_invoice'] ?>" class="btn btn-default" target="_blank"><i class="fa fa-print"></i>
							Print</a></span></h4>
					</div>
					<div class="panel-body">
						<table class="table table-bordered">
							<thead>
								<tr style="background:#DFF0D8;color:#333">
									<th class="text-center">No.</th>
									<th class="text-center">ID Barang</th>
									<th class="text-center">Nama Barang</th>
									<th class="text-center">Merk</th>
									<th class="text-center">Qty</th>
									<th class="text-center">Satuan</th>
									<th class="text-center">Harga</th>
									<th class="text-center">Discount</th>
									<th class="text-center">Harga Total</th>
								</tr>
							</thead>
							<tbody id="push_cart">
							<?php
							if(isset($_GET['no_invoice'])){
								$hasil = $lihat->laporan_penjualan_detail($_GET['no_invoice']);
								$no = 1;

								$sub_total_footer = 0;
								$discount_footer = 0;
								$grand_total_footer = 0;
								
								foreach ($hasil as $isi) { ?>
									<tr>
										<td><?=$no?></td><td><?=$isi['id_barang']?></td><td><?=$isi['nama_barang']?></td><td><?=$isi['merk']?></td><td><?=$isi['qty']?></td><td><?=$isi['nama_satuan']?></td><td class='text-right'><?="Rp. " .number_format($isi['harga_jual'],2,',','.')?></td><td class='text-right'><?="Rp. " .number_format($isi['discount_qty'],2,',','.')?></td><td class='text-right'><?="Rp. " .number_format($isi['sub_total'],2,',','.')?></td>
									</tr>
								<?php 
								
								$no++; 
								$sub_total_footer += $isi['sub_total'];
								$discount_footer += $isi['discount_order'];
								$grand_total_footer += $isi['sub_total']-$isi['discount_order'];
								}
							}
							?>
								<tr>
									<td colspan="7" rowspan="3"></td>
									<td><b>Sub Total</b></td>
									<td class='text-right'><b><?="Rp. " .number_format(round($sub_total_footer),2,',','.')?></b></td>
								</tr>
								<tr>
									<td><b>Discount</b></td>
									<td class='text-right'><b><?="Rp. " .number_format(round($discount_footer),2,',','.')?></b></td>
								</tr>
								<tr>
									<td><b>Grand Total</b></td>
									<td class='text-right'><b><?="Rp. " .number_format(round($grand_total_footer),2,',','.')?></b></td>	
								</tr>
							</tbody>
						</table>
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

		window.location= link_search[0]+"?page=laporan&from="+from+"&to="+to;
	}
</script>