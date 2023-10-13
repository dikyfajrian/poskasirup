<?php
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
<style>
    @media print {

html, body {
    width: 210mm;
    height: 297mm;  
    background:#fff;
}
.page-layout {
    border: initial;
    border-radius: initial;
    width: initial;
    min-height: initial;
    box-shadow: initial;
    background: initial;
    page-break-after: always;           
}       
table.report { page-break-after:auto }
table.report tr    { page-break-inside:avoid; page-break-after:auto }
table.report td    { page-break-inside:avoid; page-break-after:auto }
table.report thead { display:table-header-group; margin-top:50px; }
table.report tfoot { display:table-footer-group }

.header {
    display:block; 
    position:fixed; 
    top: 0px;   
    font-weight:bold;
    font-size:14px;
    text-align:right;
    right:0px;
}
.footer {
    z-index: 1;
    position: fixed;
    left: 0;
    bottom: 0;
    text-align: left;
    left: 0;
    width:100%;
    display:block;
}       
}
</style>
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
        <table width="100%" border="1" cellpadding="3" cellspacing="4" style="border-collapse:collapse" class="report">
            <thead>
                <tr bgcolor="yellow">
                <th>No.</th>
                <th>Tanggal Barang Keluar</th>
                <th>No. Order</th>
                <th style="width: 80px;">Harga</th>
                <th>Alasan</th>
                <th style="width: 80px;">Total</th>
                <th>Pengirim</th>
                <th>Catatan</th>
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
								</tr>
								<?php
								$no++;
						}
						?>
						<?php } ?>
					</tbody>
        </table>
    </div>
    <script>
		window.print();
	</script>
</body>
</html>