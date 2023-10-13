<?php 
   
    header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
    header("Content-Disposition: attachment; filename=data-laporan-penjualan-".date('Y-m-d').".xls");  //File name extension was wrong
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: private",false); 
    error_reporting(0);
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
                <th>Tanggal Laporan Penjualan</th>
                <th>No. Invoice</th>
                <th>Harga</th>
                <th>Discount</th>
                <th>Total</th>
                <th>Keuntungan</th>
                <th>Catatan</th>
                </tr>
            </thead>
            <tbody>
						<?php
						if(isset($_GET['from'])&&isset($_GET['to'])){
							$hasil = $lihat->laporan_penjualan($_GET['from'], $_GET['to']);
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
										Rp. <?php echo number_format($isi['harga_jual_inv']); ?>
									</td>
									<td>Rp. <?php echo number_format($isi['discount_inv']); ?></td>
									<td>Rp. <?php echo number_format($isi['harga_total_inv']); ?></td>
									<td>Rp. <?php echo number_format(($isi['harga_jual_inv'] - $isi['harga_beli_inv'])); ?></td>
									<td><?php echo $isi['catatan']; ?></td>
								</tr>
								<?php
								$no++;
                                $gtotal += $isi['harga_total_inv'];
                                $ctotal += $isi['harga_jual_inv'] - $isi['harga_beli_inv'];
                        }
                        
						?>
                                    <tr>
                                        <td colspan="5">Total</td>
                                        <td>Rp. <?php echo number_format($gtotal); ?></td>
                                        <td>Rp. <?php echo number_format($ctotal); ?></td>
                                        <td></td>
                                    </tr>
						<?php } else {
							$hasil = $lihat->laporan_penjualan_all();
							$no = 1;
							foreach ($hasil as $isi) { ?>
							<tr>
									<td><?php echo $no; ?></td>
									<td>
										<?php echo $isi['tanggal_order']; ?>
									</td>
									<td><?php echo $isi['no_order']; ?></td>
									<td>
										Rp. <?php echo number_format($isi['harga_jual_inv']); ?>
									</td>
									<td>Rp. <?php echo number_format($isi['discount_inv']); ?></td>

									<td>Rp. <?php echo number_format($isi['harga_total_inv']); ?></td>
									<td>Rp. <?php echo number_format(($isi['harga_jual_inv'] - $isi['harga_beli_inv'])); ?></td>
									<td><?php echo $isi['catatan']; ?></td>
								</tr>
							    <?php
                                $no++;
                                $gtotal += $isi['harga_total_inv'];
                                $ctotal += $isi['harga_jual_inv'] - $isi['harga_beli_inv'];
                            } 
                            ?>
                                <tr>
                                    <td colspan="5">Total</td>
                                    <td>Rp. <?php echo number_format($gtotal); ?></td>
                                    <td>Rp. <?php echo number_format($ctotal); ?></td>
                                    <td></td>
                                </tr>
						<?php } ?>
					</tbody>
        </table>
    </div>
</body>
</html>