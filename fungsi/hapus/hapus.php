<?php
session_start();
if (!empty($_SESSION['admin'])) {
	require '../../config.php';
	if (!empty($_GET['kategori'])) {
		$id = $_GET['id'];
		$data[] = $id;
		$sql = 'UPDATE kategori SET f_delete="1" WHERE id_kategori=?';
		$row = $config->prepare($sql);
		$row->execute($data);
		echo '<script>window.location="../../index.php?page=kategori&&remove=hapus-data"</script>';
	}
	if (!empty($_GET['satuan'])) {
		$id = $_GET['id'];
		$data[] = $id;
		$sql = 'UPDATE satuan SET f_delete="1" WHERE id=?';
		$row = $config->prepare($sql);
		$row->execute($data);
		echo '<script>window.location="../../index.php?page=satuan&&remove=hapus-data"</script>';
	}
	if (!empty($_GET['barang'])) {
		$id = $_GET['id'];
		$data[] = $id;
		$sql = 'UPDATE barang SET f_delete="1"  WHERE id_barang=?';
		$row = $config->prepare($sql);
		$row->execute($data);
		echo '<script>window.location="../../index.php?page=barang&&remove=hapus-data"</script>';
	}
	if (!empty($_GET['supplier'])) {
		$id = $_GET['id'];
		$data[] = $id;
		$sql = 'UPDATE supplier SET f_delete="1" WHERE id_supplier=?';
		$row = $config->prepare($sql);
		$row->execute($data);
		echo '<script>window.location="../../index.php?page=supplier&&remove=hapus-data"</script>';
	}
	if (!empty($_GET['puser'])) {
		$id = $_GET['id'];
		$data[] = $id;
		$sql = 'UPDATE login SET f_delete="1" WHERE id_login=?';
		$row = $config->prepare($sql);
		$row->execute($data);
		echo '<script>window.location="../../index.php?page=pengaturan&&remove=hapus-data"</script>';
	}
	if (!empty($_GET['jual'])) {

		$dataI[] = $_GET['brg'];
		$sqlI = 'select*from barang where id_barang=?';
		$rowI = $config->prepare($sqlI);
		$rowI->execute($dataI);
		$hasil = $rowI->fetch();

		/*$jml = $_GET['jml'] + $hasil['stok'];
		
		$dataU[] = $jml;
		$dataU[] = $_GET['brg'];
		$sqlU = 'UPDATE barang SET stok =? where id_barang=?';
		$rowU = $config -> prepare($sqlU);
		$rowU -> execute($dataU);*/

		$id = $_GET['id'];
		$data[] = $id;
		$sql = 'UPDATE penjualan SET f_delete="1" WHERE id_penjualan=?';
		$row = $config->prepare($sql);
		$row->execute($data);
		echo '<script>window.location="../../index.php?page=jual"</script>';
	}
	if (!empty($_GET['penjualan'])) {

		$sql = 'UPDATE penjualan SET f_delete="1"';
		$row = $config->prepare($sql);
		$row->execute();
		echo '<script>window.location="../../index.php?page=jual"</script>';
	}
	if (!empty($_GET['laporan'])) {

		$sql = 'UPDATE nota SET f_delete="1"';
		$row = $config->prepare($sql);
		$row->execute();
		echo '<script>window.location="../../index.php?page=laporan&remove=hapus"</script>';
	}
}