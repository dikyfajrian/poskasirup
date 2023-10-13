 <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">

              <div class="row">
                  <div class="col-lg-12 main-chart">
						<h3>Data Stok</h3>
						<br/>
						<br/>
						<table class="table table-bordered" id="example1">
							<thead>
								<tr style="background:#DFF0D8;color:#333;">
									<th>No.</th>
									<!-- <th>ID Barang</th> -->
									<th>Kategori</th>
									<th>Nama Barang</th>
									<th>Merk</th>
									<th>Stok</th>
									<th>Harga Jual</th>
									<th>Satuan</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$hasil = $lihat->barang();

								$no = 1;
								foreach ($hasil as $isi) {
									$param_array = $isi['id_barang'].",".$isi['nama_barang'].",".$isi['merk'].",".$isi['satuan'].",".$isi['harga_jual'].",".$isi['harga_beli'].",".$isi['stok'];
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
										<td>Rp.<?php echo number_format($isi['harga_jual']); ?>,-</td>
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
						<!-- <div class="clearfix" style="padding-top:16%;"></div> -->
						<center><canvas id="myChart_1" style="width:100%;max-width:650px;max-height:900px"></canvas></center>
							
						
				  </div>
              </div>
          </section>
      </section>
	<script>
			$.ajax({
		type: "POST",
		url: "fungsi/edit/edit.php?pencapaian=yes",
		success: function(result){
			var r = JSON.parse(result);
			// alert(JSON.stringify(r.nama_barang));
			if(r.success){
				var xValues_1 = r.nama_barang;

				new Chart("myChart_1", {
					type: "line",
					data: {
						labels: xValues_1,
						datasets: [{ 
						data: r.qty_barang_in,
						borderColor: "green",
						fill: false
						}, { 
						data: r.qty_barang_out,
						borderColor: "red",
						fill: false
						}]
					},
					options: {
						legend: {display: false},
						title: {
						display: true,
						text: "Barang Masuk (hijau) / Keluar (merah)"
						}
					},

				});
			}
		}
	});
	</script>
