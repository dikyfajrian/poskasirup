<?php
session_start();
if (!empty($_SESSION['admin'])) {
	require '../../config.php';
	if (!empty($_GET['kategori'])) {
		$nama = $_POST['kategori'];
		$tgl = date("j F Y, G:i");
		$data[] = $nama;
		$data[] = $tgl;
		$sql = 'INSERT INTO kategori (nama_kategori,tgl_input) VALUES(?,?)';
		$row = $config->prepare($sql);
		$row->execute($data);
		echo '<script>window.location="../../index.php?page=kategori&&success=tambah-data"</script>';
	}
	if (!empty($_GET['satuan'])) {
		$nama = $_POST['satuan'];
		$tgl = date("j F Y, G:i");
		$data[] = $nama;
		$data[] = $tgl;
		$sql = 'INSERT INTO satuan (nama,tgl_input) VALUES(?,?)';
		$row = $config->prepare($sql);
		$row->execute($data);
		echo '<script>window.location="../../index.php?page=satuan&&success=tambah-data"</script>';
	}
	if (!empty($_GET['barang'])) { //tambah ke table barang dan 
		$id = $_POST['id'];
		$kategori = $_POST['kategori'];
		$nama = $_POST['nama'];
		$merk = $_POST['merk'];
		$beli = $_POST['beli'];
		$jual = $_POST['jual'];
		$satuan = $_POST['satuan'];
		$tgl = $_POST['tgl'];

		$data[] = $id;
		$data[] = $kategori;
		$data[] = $nama;
		$data[] = $merk;
		$data[] = $beli;
		$data[] = $jual;
		$data[] = $satuan;
		$data[] = $tgl;

		$sql = 'INSERT INTO barang (id_barang,id_kategori,nama_barang,merk,harga_beli,harga_jual,satuan_barang,tgl_input) 
			    VALUES (?,?,?,?,?,?,?,?)';
		$row = $config->prepare($sql);
		$row->execute($data);

		echo '<script>window.location="../../index.php?page=barang&success=tambah-data"</script>';
	}
	if (!empty($_GET['supplier'])) {
		$id = $_POST['id_supplier'];
		$nama = $_POST['nama'];
		$alamat = $_POST['alamat'];
		$telepon = $_POST['telepon'];
		$keterangan = $_POST['keterangan'];
		$tgl_input = $_POST['tgl_input'];


		$data[] = $id;
		$data[] = $nama;
		$data[] = $alamat;
		$data[] = $telepon;
		$data[] = $keterangan;
		$data[] = $tgl_input;

		$sql = 'INSERT INTO supplier (id_supplier,nama,alamat,telepon,keterangan,tgl_input) 
			    VALUES (?,?,?,?,?,?) ';
		$row = $config->prepare($sql);
		$row->execute($data);
		echo '<script>window.location="../../index.php?page=supplier&success=tambah-data"</script>';
	}

	if (!empty($_GET['puser'])) {
		// $id = $_POST['id_login'];
		$nama = $_POST['nama_profile'];
		$user = $_POST['user'];
		$pass = $_POST['pass'];
		$level = $_POST['level'];
		$gambar = $_POST['gambar'];
		$no_hp = $_POST['no_hp'];
		$email = $_POST['email'];
		$alamat = $_POST['alamat'];
		// $f_delete = $_POST['f_delete'];


		// $data[] = $id;
		$data[] = $nama;
		$data[] = $user;
		$data[] = $pass;
		$data[] = $level;
		$data[] = $gambar;
		$data[] = $no_hp;
		$data[] = $email;
		$data[] = $alamat;
		// $data[] = $f_delete;

		$sql = 'INSERT INTO login (nama_profile,user,pass,level,gambar,no_hp,email,alamat) 
			    VALUES (?,?,?,?,?,?,?,?) ';
		$row = $config->prepare($sql);
		$row->execute($data);
		echo '<script>window.location="../../index.php?page=pengaturan&success=tambah-data"</script>';
	}
	if (!empty($_GET['jual'])) {
		$id = $_GET['id'];

		// get tabel barang id_barang 
		$sql = 'SELECT * FROM barang WHERE id_barang = ?';
		$row = $config->prepare($sql);
		$row->execute(array($id));
		$hsl = $row->fetch();

		if ($hsl['stok'] > 0) {
			$kasir = $_GET['id_kasir'];
			$jumlah = 1;
			$total = $hsl['harga_jual'];
			$tgl = date("j F Y, G:i");

			$data1[] = $id;
			$data1[] = $kasir;
			$data1[] = $jumlah;
			$data1[] = $total;
			$data1[] = $tgl;

			$sql1 = 'INSERT INTO penjualan (id_barang,id_member,jumlah,total,tanggal_input) VALUES (?,?,?,?,?)';
			$row1 = $config->prepare($sql1);
			$row1->execute($data1);

			echo '<script>window.location="../../index.php?page=jual&success=tambah-data"</script>';

		} else {
			echo '<script>alert("Stok Barang Anda Telah Habis !");
					window.location="../../index.php?page=jual#keranjang"</script>';
		}
	}
	if (!empty($_GET['penjualan'])) {
		// echo "<pre>";print_r($_POST);exit();

		$detail = json_decode($_POST['list_barang']);

		$discount_order_average = isset($_POST['discount_order'])&&$_POST['discount_order']>0? ($_POST['discount_order']/ count($detail)):0;

		$array = [];
		foreach ($detail as $k => $v) {
			$data_input = [];
			$data_input[] = htmlentities($_POST['no_order']); //no_order
			$data_input[] = htmlentities($_POST['tanggal_order']); //tanggal_order
			$data_input[] = "penjualan"; //type
			$data_input[] = htmlentities($v[0]); //id barang
			$data_input[] = htmlentities($v[5]); //harga beli
			$data_input[] = htmlentities($v[4]); //harga jual
			$data_input[] = htmlentities($v[7]); //qty
			$data_input[] = htmlentities($v[8]); //discount qty
			$data_input[] = $discount_order_average; //discount order
			$data_input[] = ((($v[4] - $v[8]) * $v[7]) - $discount_order_average); //harga total
			$data_input[] = "0000"; //penerima
			$data_input[] = htmlentities($_POST['catatan']); //catatan
			$data_input[] = DATE("Y-m-d h:i:s"); //tanggal_input

			$sql1 = 'INSERT INTO order_out (no_order, tanggal_order, `type`, id_barang, harga_beli, harga_jual, qty, discount_qty, discount_order, harga_total, penerima, catatan, tanggal_input
			) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)';
			$row1 = $config->prepare($sql1);
			$row1->execute($data_input);
		}

		$result['success'] = true;
		$result['message'] = "Update Success!";

		echo json_encode($result);
		'<script>window.location="../../index.php?page=jual&success=tambah-data"</script>';
	}
	if (!empty($_GET['transaksi_masuk'])) {
		// echo "<pre>";print_r($_POST);exit();

		$detail = json_decode($_POST['list_barang']);
		
		$discount_order_average = isset($_POST['discount_order'])&&$_POST['discount_order']>0? ($_POST['discount_order']/ count($detail)):0;

		$array = [];
		foreach ($detail as $k => $v) {
			$data_input = [];
			$data_input[] = htmlentities($_POST['no_order']); //no_order
			$data_input[] = htmlentities($_POST['tanggal_order']); //tanggal_order
			$data_input[] = htmlentities($_POST['type_transaksi']); //type
			$data_input[] = htmlentities($v[0]); //id barang
			$data_input[] = htmlentities($v[5]); //harga beli
			$data_input[] = htmlentities($v[4]); //harga jual
			$data_input[] = htmlentities($v[7]); //qty
			$data_input[] = htmlentities($v[8]); //discount qty
			$data_input[] = $discount_order_average; //discount order
			$data_input[] = ((($v[5] - $v[8]) * $v[7]) - $discount_order_average); //harga total
			$data_input[] = htmlentities($_POST['pengirim']);
			; //pengirim
			$data_input[] = htmlentities($_POST['catatan']); //catatan
			$data_input[] = DATE("Y-m-d h:i:s"); //tanggal_input

			$sql1 = 'INSERT INTO order_in (no_order, tanggal_order, `type`, id_barang, harga_beli, harga_jual, qty, discount_qty, discount_order, harga_total, pengirim, catatan, tanggal_input
			) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)';
			$row1 = $config->prepare($sql1);
			$row1->execute($data_input);
		}

		$result['success'] = true;
		$result['message'] = "Update Success!";

		echo json_encode($result);
		'<script>window.location="../../index.php?page=jual&success=tambah-data"</script>';
	}
	if (!empty($_GET['transaksi_keluar'])) {
		// echo "<pre>";print_r($_POST);exit();

		$detail = json_decode($_POST['list_barang']);

		$discount_order_average = isset($_POST['discount_order'])&&$_POST['discount_order']>0? ($_POST['discount_order']/ count($detail)):0;

		$array = [];
		foreach ($detail as $k => $v) {
			$data_input = [];
			$data_input[] = htmlentities($_POST['no_order']); //no_order
			$data_input[] = htmlentities($_POST['tanggal_order']); //tanggal_order
			$data_input[] = htmlentities($_POST['type_transaksi']); //type
			$data_input[] = htmlentities($v[0]); //id barang
			$data_input[] = htmlentities($v[5]); //harga beli
			$data_input[] = htmlentities($v[4]); //harga jual
			$data_input[] = htmlentities($v[7]); //qty
			$data_input[] = htmlentities($v[8]); //discount qty
			$data_input[] = $discount_order_average; //discount order
			$data_input[] = ((($v[5] - $v[8]) * $v[7]) - $discount_order_average); //harga total
			$data_input[] = htmlentities($_POST['penerima']);
			; //pengirim
			$data_input[] = htmlentities($_POST['catatan']); //catatan
			$data_input[] = DATE("Y-m-d h:i:s"); //tanggal_input

			$sql1 = 'INSERT INTO order_out (no_order, tanggal_order, `type`, id_barang, harga_beli, harga_jual, qty, discount_qty, discount_order, harga_total, penerima, catatan, tanggal_input
			) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)';
			$row1 = $config->prepare($sql1);
			$row1->execute($data_input);
		}

		$result['success'] = true;
		$result['message'] = "Update Success!";

		echo json_encode($result);
		'<script>window.location="../../index.php?page=jual&success=tambah-data"</script>';
	}
}