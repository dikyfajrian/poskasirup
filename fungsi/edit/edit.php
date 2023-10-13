<?php
session_start();
if (!empty($_SESSION['admin'])) {
	require '../../config.php';
	if (!empty($_GET['pengaturan'])) {
		$nama = htmlentities($_POST['namatoko']);
		$alamat = htmlentities($_POST['alamat']);
		$kontak = htmlentities($_POST['kontak']);
		$pemilik = htmlentities($_POST['pemilik']);
		$id = '1';

		$data[] = $nama;
		$data[] = $alamat;
		$data[] = $kontak;
		$data[] = $pemilik;
		$data[] = $id;
		$sql = 'UPDATE toko SET nama_toko=?, alamat_toko=?, tlp=?, nama_pemilik=? WHERE id_toko = ?';
		$row = $config->prepare($sql);
		$row->execute($data);
		echo '<script>window.location="../../index.php?page=pengaturan&success=edit-data"</script>';
	}

	if (!empty($_GET['kategori'])) {
		$nama = htmlentities($_POST['kategori']);
		$id = htmlentities($_POST['id']);
		$data[] = $nama;
		$data[] = $id;
		$sql = 'UPDATE kategori SET  nama_kategori=? WHERE id_kategori=?';
		$row = $config->prepare($sql);
		$row->execute($data);
		echo '<script>window.location="../../index.php?page=kategori&success-edit=edit-data"</script>';
	}

	if (!empty($_GET['satuan'])) {
		$nama = htmlentities($_POST['satuan']);
		$id = htmlentities($_POST['id']);
		$data[] = $nama;
		$data[] = $id;
		$sql = 'UPDATE satuan SET  nama=? WHERE id=?';
		$row = $config->prepare($sql);
		$row->execute($data);
		echo '<script>window.location="../../index.php?page=satuan&success-edit=edit-data"</script>';
	}

	if (!empty($_GET['stok'])) {
		$restok = htmlentities($_POST['restok']);
		$id = htmlentities($_POST['id']);
		$dataS[] = $id;
		$sqlS = 'select*from barang WHERE id_barang=?';
		$rowS = $config->prepare($sqlS);
		$rowS->execute($dataS);
		$hasil = $rowS->fetch();

		$stok = $restok + $hasil['stok'];

		$data[] = $stok;
		$data[] = $id;
		$sql = 'UPDATE barang SET stok=? WHERE id_barang=?';
		$row = $config->prepare($sql);
		$row->execute($data);
		echo '<script>window.location="../../index.php?page=barang&success-stok=stok-data"</script>';
	}

	if (!empty($_GET['barang'])) {
		$id = htmlentities($_POST['id']);
		$kategori = htmlentities($_POST['kategori']);
		$nama = htmlentities($_POST['nama']);
		$merk = htmlentities($_POST['merk']);
		$beli = htmlentities($_POST['beli']);
		$jual = htmlentities($_POST['jual']);
		$satuan = htmlentities($_POST['satuan']);
		$tgl = htmlentities($_POST['tgl']);

		$data[] = $kategori;
		$data[] = $nama;
		$data[] = $merk;
		$data[] = $beli;
		$data[] = $jual;
		$data[] = $satuan;
		$data[] = $tgl;
		$data[] = $id;
		$sql = 'UPDATE barang SET id_kategori=?, nama_barang=?, merk=?, 
				harga_beli=?, harga_jual=?, satuan_barang=?, tgl_update=?  WHERE id_barang=?';
		$row = $config->prepare($sql);
		$row->execute($data);

		echo '<script>window.location="../../index.php?page=barang/edit&barang=' . $id . '&success=edit-data"</script>';
	}

	if (!empty($_GET['supplier'])) {
		$id = htmlentities($_POST['id_supplier']);
		$nama = htmlentities($_POST['nama']);
		$alamat = htmlentities($_POST['alamat']);
		$telepon = htmlentities($_POST['telepon']);
		$keterangan = htmlentities($_POST['keterangan']);
		$tgl_update = htmlentities($_POST['tgl_update']);

		$data[] = $nama;
		$data[] = $alamat;
		$data[] = $telepon;
		$data[] = $keterangan;
		$data[] = $tgl_update;
		$data[] = $id;

		$sql = 'UPDATE supplier SET nama=?, alamat=?, 
				telepon=?, keterangan=?, tgl_update=?  WHERE id_supplier=?';
		$row = $config->prepare($sql);
		$row->execute($data);
		echo '<script>window.location="../../index.php?page=supplier/edit&supplier=' . $id . '&success=edit-data"</script>';
	}

	if (!empty($_GET['gambar'])) {
		$id = htmlentities($_POST['id']);
		set_time_limit(0);
		$allowedImageType = array("image/gif", "image/JPG", "image/jpeg", "image/pjpeg", "image/png", "image/x-png");

		if ($_FILES['foto']["error"] > 0) {
			$update['error'] = "Error in File";
		} elseif (!in_array($_FILES['foto']["type"], $allowedImageType)) {
			// echo "You can only upload JPG, PNG and GIF file";
			// echo "<font face='Verdana' size='2' ><BR><BR><BR>
			// 		<a href='../../index.php?page=user'>Back to upform</a><BR>";
			echo '<script>alert("You can only upload JPG, PNG and GIF file");window.location="../../index.php?page=user"</script>';
		} elseif (round($_FILES['foto']["size"] / 1024) > 4096) {
			// echo "WARNING !!! Besar Gambar Tidak Boleh Lebih Dari 4 MB";
			// echo "<font face='Verdana' size='2' ><BR><BR><BR>
			// 		<a href='../../index.php?page=user'>Back to upform</a><BR>";
			echo '<script>alert("WARNING !!! Besar Gambar Tidak Boleh Lebih Dari 4 MB");window.location="../../index.php?page=user"</script>';
		} else {
			$dir = '../../assets/img/user/';
			$tmp_name = $_FILES['foto']['tmp_name'];
			$name = time() . basename($_FILES['foto']['name']);
			if (move_uploaded_file($tmp_name, $dir . $name)) {
				//post foto lama
				$foto2 = $_POST['foto2'];
				//remove foto di direktori
				@unlink('../../assets/img/user/' . $foto2 . '');
				//input foto
				$id = $_POST['id'];
				$data[] = $name;
				$data[] = $id;
				$sql = 'UPDATE `login` SET gambar=?  WHERE login.id_login=?';
				$row = $config->prepare($sql);
				$row->execute($data);
				echo '<script>window.location="../../index.php?page=pengaturan&success=edit-data"</script>';
			} else {
				echo '<script>alert("Masukan Gambar !");window.location="../../index.php?page=pengaturan"</script>';
			}
		}
	}

	if (!empty($_GET['pusergambar'])) {
		$id = htmlentities($_POST['id']);
		set_time_limit(0);
		$allowedImageType = array("image/gif", "image/JPG", "image/jpeg", "image/pjpeg", "image/png", "image/x-png");

		if ($_FILES['foto']["error"] > 0) {
			$update['error'] = "Error in File";
		} elseif (!in_array($_FILES['foto']["type"], $allowedImageType)) {
			// echo "You can only upload JPG, PNG and GIF file";
			// echo "<font face='Verdana' size='2' ><BR><BR><BR>
			// 		<a href='../../index.php?page=user'>Back to upform</a><BR>";
			echo '<script>alert("You can only upload JPG, PNG and GIF file");window.location="../../index.php?page=user"</script>';
		} elseif (round($_FILES['foto']["size"] / 1024) > 4096) {
			// echo "WARNING !!! Besar Gambar Tidak Boleh Lebih Dari 4 MB";
			// echo "<font face='Verdana' size='2' ><BR><BR><BR>
			// 		<a href='../../index.php?page=user'>Back to upform</a><BR>";
			echo '<script>alert("WARNING !!! Besar Gambar Tidak Boleh Lebih Dari 4 MB");window.location="../../index.php?page=user"</script>';
		} else {
			$dir = '../../assets/img/user/';
			$tmp_name = $_FILES['foto']['tmp_name'];
			$name = time() . basename($_FILES['foto']['name']);
			if (move_uploaded_file($tmp_name, $dir . $name)) {
				//post foto lama
				$foto2 = $_POST['foto2'];
				//remove foto di direktori
				@unlink('../../assets/img/user/' . $foto2 . '');
				//input foto
				$id = $_POST['id'];
				$data[] = $name;
				$data[] = $id;
				$sql = 'UPDATE `login` SET gambar=?  WHERE login.id_login=?';
				$row = $config->prepare($sql);
				$row->execute($data);
				echo '<script>window.location="../../index.php?page=user&success=edit-data"</script>';
			} else {
				echo '<script>alert("Masukan Gambar !");window.location="../../index.php?page=user"</script>';
			}
		}
	}

	if (!empty($_GET['user'])) {
		$id = htmlentities($_POST['id']);
		$nama = htmlentities($_POST['nama']);
		$alamat = htmlentities($_POST['alamat']);
		$no_hp = htmlentities($_POST['no_hp']);
		$email = htmlentities($_POST['email']);

		$data[] = $nama;
		$data[] = $alamat;
		$data[] = $no_hp;
		$data[] = $email;
		$data[] = $id;
		$sql = 'UPDATE `login` SET nama_profile=?,alamat=?,no_hp=?,email=? WHERE id_login=?';
		$row = $config->prepare($sql);
		$row->execute($data);
		echo '<script>window.location="../../index.php?page=user&success=edit-data"</script>';
	}
	if (!empty($_GET['pass'])) {
		$id = htmlentities($_POST['id']);
		$user = htmlentities($_POST['user']);
		$pass = htmlentities($_POST['pass']);

		$data[] = $user;
		$data[] = $pass;
		$data[] = $id;
		$sql = 'UPDATE `login` SET user=?,pass=? WHERE id_login=?';
		$row = $config->prepare($sql);
		$row->execute($data);
		echo '<script>window.location="../../index.php?page=user&success=edit-data"</script>';
	}


	if (!empty($_GET['puser'])) {
		$id = htmlentities($_POST['id']);
		$nama = htmlentities($_POST['nama']);
		$alamat = htmlentities($_POST['alamat']);
		$no_hp = htmlentities($_POST['no_hp']);
		$email = htmlentities($_POST['email']);

		$data[] = $nama;
		$data[] = $alamat;
		$data[] = $no_hp;
		$data[] = $email;
		$data[] = $id;
		$sql = 'UPDATE `login` SET nama_profile=?,alamat=?,no_hp=?,email=? WHERE id_login=?';
		$row = $config->prepare($sql);
		$row->execute($data);
		echo '<script>window.location="../../index.php?page=pengaturan&success=edit-data"</script>';
	}
	if (!empty($_GET['puserpass'])) {
		$id = htmlentities($_POST['id']);
		$user = htmlentities($_POST['user']);
		$pass = htmlentities($_POST['pass']);

		$data[] = $user;
		$data[] = $pass;
		$data[] = $id;
		$sql = 'UPDATE `login` SET user=?,pass=? WHERE id_login=?';
		$row = $config->prepare($sql);
		$row->execute($data);
		echo '<script>window.location="../../index.php?page=pengaturan&success=edit-data"</script>';
	}

	if (!empty($_GET['jual'])) {
		$id = htmlentities($_POST['id']);
		$id_barang = htmlentities($_POST['id_barang']);
		$jumlah = htmlentities($_POST['jumlah']);

		$sql_tampil = "select *from barang where barang.id_barang=?";
		$row_tampil = $config->prepare($sql_tampil);
		$row_tampil->execute(array($id_barang));
		$hasil = $row_tampil->fetch();

		if ($hasil['stok'] > $jumlah) {
			$jual = $hasil['harga_jual'];
			$total = $jual * $jumlah;
			$data1[] = $jumlah;
			$data1[] = $total;
			$data1[] = $id;
			$sql1 = 'UPDATE penjualan SET jumlah=?,total=? WHERE id_penjualan=?';
			$row1 = $config->prepare($sql1);
			$row1->execute($data1);
			echo '<script>window.location="../../index.php?page=jual#keranjang"</script>';
		} else {
			echo '<script>alert("Keranjang Melebihi Stok Barang Anda !");
					window.location="../../index.php?page=jual#keranjang"</script>';
		}

	}

	if (!empty($_GET['status_transaksi_in'])) {
		$data[] = htmlentities($_POST['status']);
		$data[] = htmlentities($_POST['no_order']);

		$sql = 'UPDATE order_in SET f_status=? WHERE no_order=?';
		$row = $config->prepare($sql);
		$row->execute($data);

		$result['success'] = true;
		$result['message'] = "Update berhasil!";

		echo json_encode($result);
	}

	if (!empty($_GET['cari_barang'])) {
		$cari = trim(strip_tags($_POST['keyword']));
		if ($cari == '') {

		} else {
			$sql = "select barang.*, kategori.id_kategori, kategori.nama_kategori
					from barang inner join kategori on barang.id_kategori = kategori.id_kategori
					where barang.id_barang like '%$cari%' or barang.nama_barang like '%$cari%' or barang.merk like '%$cari%'";
			$row = $config->prepare($sql);
			$row->execute();
			$hasil1 = $row->fetchAll();
			?>
			<table class="table table-stripped" width="100%" id="example2">
				<tr>
					<th>ID Barang</th>
					<th>Nama Barang</th>
					<th>Merk</th>
					<th>Harga Jual</th>
					<th>Aksi</th>
				</tr>
				<?php foreach ($hasil1 as $hasil) { ?>
					<tr>
						<td><?php echo $hasil['id_barang']; ?></td>
						<td>
							<?php echo $hasil['nama_barang']; ?>
						</td>
						<td><?php echo $hasil['merk']; ?></td>
						<td>
							<?php echo $hasil['harga_jual']; ?>
						</td>
						<td>
							<a href="fungsi/tambah/tambah.php?jual=jual&id=<?php echo $hasil['id_barang']; ?>&id_kasir=<?php echo $_SESSION['admin']['id_member']; ?>"
								class="btn btn-success">
								<i class="fa fa-shopping-cart"></i></a>
						</td>
					</tr>
				<?php } ?>
			</table>
		<?php
		}
	}

	if (!empty($_GET['top_seller'])) {

		$sql = '
			select a.* from (
				select b.nama_barang, SUM(a.qty) as total_qty 
				from order_out as a
				left join barang as b on a.id_barang=b.id_barang
				where a.f_status="paid" and a.f_delete="0"
				group by a.id_barang
			) as a
			order by a.total_qty DESC
			limit 10
		';
		$row = $config->prepare($sql);
		$row->execute();

		$hasil = $row->fetchAll();
		
		$result['nama_barang'] = [];
		$result['qty_barang'] = [];
		$result['color_barang'] = [];

		$list_color = ["red","yellow","green","blue","crimson","gold","LimeGreen","LightSeaGreen"];
		$i = 0;
		foreach ($hasil as $isi) {
			$result['nama_barang'][] = $isi['nama_barang'];
			$result['qty_barang'][] = $isi['total_qty'];
			$result['color_barang'][] = $list_color[$i];

			$i++;
			if($i>8){$i=0;}//warna mulai dari awal
		}

		if(COUNT($hasil)>0){
			$result['success'] = true;
		}else{
			$result['success'] = false;
		}

		echo json_encode($result);
	}

	if (!empty($_GET['pencapaian'])) {

		$sql = '
			select a.*, IFNULL(b.total_qty,0) as total_qty_out
			from (
				select a.id_barang, b.nama_barang, SUM(a.qty) as total_qty 
				from order_in as a
				left join barang as b on a.id_barang=b.id_barang
				where a.f_status="paid" and a.f_delete="0"
				group by a.id_barang
			) as a
			left join (
				select a.id_barang, b.nama_barang, SUM(a.qty) as total_qty 
				from order_out as a
				left join barang as b on a.id_barang=b.id_barang
				where a.type="penjualan" and a.f_status="paid" and a.f_delete="0"
				group by a.id_barang
			)as b
			on a.id_barang=b.id_barang
			order by total_qty_out DESC
		';
		$row = $config->prepare($sql);
		$row->execute();

		$hasil = $row->fetchAll();
		
		$result['nama_barang'] = [];
		$result['qty_barang'] = [];

		foreach ($hasil as $isi) {
			$result['nama_barang'][] = $isi['nama_barang'];
			$result['qty_barang_in'][] = $isi['total_qty'];
			$result['qty_barang_out'][] = $isi['total_qty_out'];
		}

		if(COUNT($hasil)>0){
			$result['success'] = true;
		}else{
			$result['success'] = false;
		}

		echo json_encode($result);
	}
}