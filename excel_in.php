<?php 
   
    header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
    header("Content-Disposition: attachment; filename=data-laporan-penjualan-barang-masuk-".date('Y-m-d').".xls");  //File name extension was wrong
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: private",false); 

    require 'config.php';
    include $view;
    $lihat = new view($config);

    $bulan_tes =array(
        '01'=>"Januari",
        '02'=>"Februari",
        '03'=>"Maret",
        '04'=>"April",
        '05'=>"Mei",
        '06'=>"Juni",
        '07'=>"Juli",
        '08'=>"Agustus",
        '09'=>"September",
        '10'=>"Oktober",
        '11'=>"November",
        '12'=>"Desember"
    );
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
	<!-- view barang -->	
    <!-- view barang -->	
    <div class="modal-view">
        <h3 style="text-align:center;"> 
                <?php if(!empty($_GET['cari'])){ ?>
                    Data Laporan Penjualan <?= $bulan_tes[$_GET['bln']];?> <?= $_GET['thn'];?>
                <?php }elseif(!empty($_GET['hari'])){?>
                    Data Laporan Penjualan <?= $_GET['tgl'];?>
                <?php }else{?>
                    Data Laporan Penjualan <?= $bulan_tes[date('m')];?> <?= date('Y');?>
                <?php }?>
        </h3>
        <table border="1" width="100%" cellpadding="3" cellspacing="4">
            <thead>
                <tr bgcolor="yellow">
                <th>No.</th>
                <th>Tanggal Barang Masuk</th>
                <th>No. Order</th>
                <th>Harga</th>
                <th>Discount</th>
                <th>Total</th>
                <th>Pengirim</th>
                <th>Status</th>
                <th>Catatan</th>
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
								</tr>
								<?php
								$no++;
						}
						?>
						<?php } ?>
					</tbody>
        </table>
    </div>
</body>
</html>