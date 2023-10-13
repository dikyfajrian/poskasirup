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
                    <td><?=$no?></td>
                    <td><?=$isi['id_barang']?></td>
                    <td><?=$isi['nama_barang']?></td>
                    <td><?=$isi['merk']?></td>
                    <td><?=$isi['qty']?></td>
                    <td><?=$isi['nama_satuan']?></td>
                    <td class='text-right'><?="Rp. " .number_format($isi['harga_jual'],2,',','.')?></td>
                    <td class='text-right'><?="Rp. " .number_format($isi['discount_qty'],2,',','.')?></td>
                    <td class='text-right'><?="Rp. " .number_format($isi['sub_total'],2,',','.')?></td>
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
                    <td>
                        <b>Sub Total</b>
                    </td>
                    <td class='text-right'>
                        <b><?="Rp. " .number_format(round($sub_total_footer),2,',','.')?></b>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Discount</b>
                    </td>
                    <td class='text-right'>
                        <b><?="Rp. " .number_format(round($discount_footer),2,',','.')?></b>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Grand Total</b>
                    </td>
                    <td class='text-right'>
                        <b><?="Rp. " .number_format(round($grand_total_footer),2,',','.')?></b>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <script>
		window.print();
	</script>
</body>
</html>