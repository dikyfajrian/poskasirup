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
        <table width="100%" border="1" cellpadding="3" cellspacing="4" style="border-collapse:collapse" class="report" id="tble">
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
                                    <td class="tprice" style="display:none;"><?php echo $isi['harga_total_inv']; ?></td>
									<td>Rp. <?php echo number_format(($isi['harga_jual_inv'] - $isi['harga_beli_inv'])); ?></td>
                                    <td class="xprice" style="display:none"><?php echo ($isi['harga_jual_inv'] - $isi['harga_beli_inv']); ?></td>
									<td><?php echo $isi['catatan']; ?></td>
								</tr>
								<?php
								$no++;
							}
						?>
                        <tr>
                            <td colspan="5">Total</td>
                            <td id="totalprice" style="display: none;"></td>
                            <td id="xtotalprice" style="display: none;"></td>
                            <td id="resultprice"></td>
                            <td id="xresultprice"></td>
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
                                    <td class="tprice" style="display:none;"><?php echo $isi['harga_total_inv']; ?></td>
									<td>Rp. <?php echo number_format(($isi['harga_jual_inv'] - $isi['harga_beli_inv'])); ?></td>
                                    <td class="xprice" style="display:none"><?php echo ($isi['harga_jual_inv'] - $isi['harga_beli_inv']); ?></td>
									<td><?php echo $isi['catatan']; ?></td>
								</tr>
							<?php $no++; } ?>
                            <tr>
                                <td colspan="5">Total</td>
                                <td id="totalprice" style="display: none;"></td>
                                <td id="xtotalprice" style="display: none;"></td>
                                <td id="resultprice"></td>
                                <td id="xresultprice"></td>
                                <td></td>
                            </tr>
						<?php } ?>
					</tbody>
        </table>
    </div>
    
    <script>
		window.print();
	</script>
    <script>
        let sum = 0;
        const prices = [...document.querySelectorAll('#tble .tprice')]
        .map(td => isNaN(td.textContent) ? 0 : +td.textContent); // an array of numbers
        if (prices.length) sum = prices.reduce((a, b) => a + b);   // reduced to a sum

        var result = document.getElementById('totalprice').innerHTML += sum;            
        var	reverse = result.toString().split('').reverse().join(''),
        ribuan 	= reverse.match(/\d{1,3}/g);
        ribuan	= ribuan.join(',').split('').reverse().join('');

        // Cetak hasil	
        document.getElementById('resultprice').innerHTML = 'Rp. ' + ribuan;
    </script>
    <script>
        let xsum = 0;
        const pricesx = [...document.querySelectorAll('#tble .xprice')]
        .map(td => isNaN(td.textContent) ? 0 : +td.textContent); // an array of numbers
        if (pricesx.length) xsum = pricesx.reduce((a, b) => a + b);   // reduced to a xsum
        var resultx = document.getElementById('xtotalprice').innerHTML += xsum;           
        var	reversex = resultx.toString().split('').reverse().join(''),
        ribuanx 	= reversex.match(/\d{1,3}/g);
        ribuanx 	= ribuanx.join(',').split('').reverse().join('');

        // Cetak hasil	
        document.getElementById('xresultprice').innerHTML = 'Rp. ' + ribuanx;
    </script>
</body>
</html>