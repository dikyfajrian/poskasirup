<?php
/*
 * PROSES TAMPIL  
 */
class view
{
	protected $db;
	function __construct($db)
	{
		$this->db = $db;
	}

	function user()
	{
		$sql = "select * from login where f_delete='0'";
		$row = $this->db->prepare($sql);
		$row->execute();
		$hasil = $row->fetch();
		return $hasil;
	}

	function toko()
	{
		$sql = "select * from toko where id_toko='1' and f_delete='0'";
		$row = $this->db->prepare($sql);
		$row->execute();
		$hasil = $row->fetch();
		return $hasil;
	}

	function kategori()
	{
		$sql = "select * from kategori where f_delete='0'";
		$row = $this->db->prepare($sql);
		$row->execute();
		$hasil = $row->fetchAll();
		return $hasil;
	}

	function satuan()
	{
		$sql = "select * from satuan where f_delete='0'";
		$row = $this->db->prepare($sql);
		$row->execute();
		$hasil = $row->fetchAll();
		return $hasil;
	}

	function supplier()
	{
		$sql = "select * from supplier where f_delete='0'";
		$row = $this->db->prepare($sql);
		$row->execute();
		$hasil = $row->fetchAll();
		return $hasil;
	}

	function puser()
	{
		$sql = "select * from login where f_delete='0'";
		$row = $this->db->prepare($sql);
		$row->execute();
		$hasil = $row->fetchAll();
		return $hasil;
	}


	function barang()
	{
		$sql = "
		select barang.*, kategori.id_kategori, kategori.nama_kategori, satuan.nama as satuan, (IFNULL(in_.qty,0)- IFNULL(out_.qty,0)) as stok
		from barang 
		left join kategori on barang.id_kategori = kategori.id_kategori
		left join satuan on barang.satuan_barang=satuan.id
		left join (

			select a.type, a.id_barang, SUM(a.qty) as qty
			from order_in as a
			where a.f_status='paid' and a.f_delete='0'
			group by a.id_barang

		) as in_ on barang.id_barang=in_.id_barang
		left join (

			select a.type, a.id_barang, SUM(a.qty) as qty
			from order_out as a
			where a.f_status='paid' and a.f_delete='0'
			group by a.id_barang

		) as out_ on barang.id_barang=out_.id_barang
		where barang.f_delete='0'
		ORDER BY id DESC
		";
		$row = $this->db->prepare($sql);
		$row->execute();
		$hasil = $row->fetchAll();
		return $hasil;
	}

	function barang_stok()
	{
		$sql = "select barang.*, kategori.id_kategori, kategori.nama_kategori
						from barang inner join kategori on barang.id_kategori = kategori.id_kategori 
						where stok <= 3 and barang.f_delete='0'
						ORDER BY id DESC";
		$row = $this->db->prepare($sql);
		$row->execute();
		$hasil = $row->fetchAll();
		return $hasil;
	}

	function barang_edit($id)
	{
		$sql = "select barang.*, kategori.nama_kategori, satuan.nama as nama_satuan
						from barang
						left join kategori on barang.id_kategori = kategori.id_kategori
						left join satuan on barang.satuan_barang=satuan.id
						where id_barang=? and barang.f_delete=?";
		$row = $this->db->prepare($sql);
		$row->execute(array($id, '0'));
		$hasil = $row->fetch();
		return $hasil;
	}

	function barang_cari($cari)
	{
		$sql = "select barang.*, kategori.id_kategori, kategori.nama_kategori
						from barang inner join kategori on barang.id_kategori = kategori.id_kategori
						where id_barang like '%$cari%' or nama_barang like '%$cari%' or merk like '%$cari%' and barang.f_delete='0'";
		$row = $this->db->prepare($sql);
		$row->execute();
		$hasil = $row->fetchAll();
		return $hasil;
	}

	function barang_id()
	{
		$sql = 'SELECT * FROM barang where f_delete="0" ORDER BY id DESC';
		$row = $this->db->prepare($sql);
		$row->execute();
		$hasil = $row->fetch();

		$urut = substr($hasil['id_barang'], 2, 3);
		$tambah = (int) $urut + 1;
		if (strlen($tambah) == 1) {
			$format = 'BR00' . $tambah . '';
		} else if (strlen($tambah) == 2) {
			$format = 'BR0' . $tambah . '';
		} else {
			$ex = explode('BR', $hasil['id_barang']);
			$no = (int) $ex[1] + 1;
			$format = 'BR' . $no . '';
		}
		return $format;
	}

	function gudang($param = null)
	{
		$type = "type='pembelian'";
		if ($param == "keluar") {
			$type = "type<>'pembelian'";
		}

		$sql = "select a.*, b.merk as merk_barang, b.nama_barang, c.nama as nama_supplier
				from gudang as a
				left join barang as b on a.id_barang=b.id_barang
				left join supplier as c on a.id_supplier=c.id_supplier
				WHERE " . $type . " and gudang.f_delete='0'
				order by a.tgl_input ASC";
		$row = $this->db->prepare($sql);
		$row->execute();
		$hasil = $row->fetchAll();
		return $hasil;
	}

	function supplier_id()
	{
		$sql = 'SELECT * FROM supplier where f_delete="0" ORDER BY id DESC';
		$row = $this->db->prepare($sql);
		$row->execute();
		$hasil = $row->fetch();

		$urut = substr($hasil['id_supplier'], 2, 3);
		$tambah = (int) $urut + 1;
		if (strlen($tambah) == 1) {
			$format = 'SP00' . $tambah . '';
		} else if (strlen($tambah) == 2) {
			$format = 'SP0' . $tambah . '';
		} else {
			$ex = explode('SP', $hasil['id_supplier']);
			$no = (int) $ex[1] + 1;
			$format = 'SP' . $no . '';
		}
		return $format;
	}

	function supplier_edit($id)
	{
		$sql = "select * from supplier where id_supplier=? and f_delete=?";
		$row = $this->db->prepare($sql);
		$row->execute(array($id, '0'));
		$hasil = $row->fetch();
		return $hasil;
	}

	function puser_edit($id)
	{
		$sql = "select login.*, b.nama as nama_level from login left join level as b on login.level=b.id where id_login=? and f_delete=?";
		$row = $this->db->prepare($sql);
		$row->execute(array($id, '0'));
		$hasil = $row->fetch();
		return $hasil;
	}

	function user_edit($id)
	{
		$sql = "select * from `login` where id_login='" . $id . "' and f_delete='0'";
		$row = $this->db->prepare($sql);
		$row->execute();
		$hasil = $row->fetch();
		return $hasil;
	}

	function kategori_edit($id)
	{
		$sql = "select * from kategori where id_kategori=? and f_delete=?";
		$row = $this->db->prepare($sql);
		$row->execute(array($id, '0'));
		$hasil = $row->fetch();
		return $hasil;
	}

	function kategori_row()
	{
		$sql = "select * from kategori where f_delete='0'";
		$row = $this->db->prepare($sql);
		$row->execute();
		$hasil = $row->rowCount();
		return $hasil;
	}

	function satuan_edit($id)
	{
		$sql = "select * from satuan where id=? and f_delete=?";
		$row = $this->db->prepare($sql);
		$row->execute(array($id, '0'));
		$hasil = $row->fetch();
		return $hasil;
	}

	function satuan_row()
	{
		$sql = "select * from satuan where f_delete='0'";
		$row = $this->db->prepare($sql);
		$row->execute();
		$hasil = $row->rowCount();
		return $hasil;
	}

	function barang_row()
	{
		$sql = "select * from barang where f_delete='0'";
		$row = $this->db->prepare($sql);
		$row->execute();
		$hasil = $row->rowCount();
		return $hasil;
	}

	function barang_stok_row()
	{
		// $sql = "SELECT SUM(stok) as jml FROM barang";
		// $row = $this->db->prepare($sql);
		// $row->execute();
		// $hasil = $row->fetch();
		return 0;
	}

	function barang_beli_row()
	{
		$sql = "SELECT SUM(harga_beli) as beli FROM barang where f_delete='0'";
		$row = $this->db->prepare($sql);
		$row->execute();
		$hasil = $row->fetch();
		return $hasil;
	}

	// function jual_row()
	// {
	// 	$sql = "SELECT SUM(jumlah) as stok FROM nota where f_delete='0'";
	// 	$row = $this->db->prepare($sql);
	// 	$row->execute();
	// 	$hasil = $row->fetch();
	// 	return $hasil;
	// }

	function jual()
	{
		$sql = "SELECT nota.* , barang.id_barang, barang.nama_barang, barang.harga_beli, member.id_member,
						member.nm_member from nota 
					   left join barang on barang.id_barang=nota.id_barang 
					   left join member on member.id_member=nota.id_member 
					   where nota.periode = ?
					   ORDER BY id_nota DESC";
		$row = $this->db->prepare($sql);
		$row->execute(array(date('m-Y')));
		$hasil = $row->fetchAll();
		return $hasil;
	}

	function periode_jual($periode)
	{
		$sql = "SELECT nota.* , barang.id_barang, barang.nama_barang, barang.harga_beli, member.id_member,
						member.nm_member from nota 
					   left join barang on barang.id_barang=nota.id_barang 
					   left join member on member.id_member=nota.id_member WHERE nota.periode = ? 
					   ORDER BY id_nota ASC";
		$row = $this->db->prepare($sql);
		$row->execute(array($periode));
		$hasil = $row->fetchAll();
		return $hasil;
	}

	function hari_jual($hari)
	{
		$ex = explode('-', $hari);
		$monthNum = $ex[1];
		$monthName = date('F', mktime(0, 0, 0, $monthNum, 10));
		if ($ex[2] > 9) {
			$tgl = $ex[2];
		} else {
			$tgl1 = explode('0', $ex[2]);
			$tgl = $tgl1[1];
		}
		$cek = $tgl . ' ' . $monthName . ' ' . $ex[0];
		$param = "%{$cek}%";
		$sql = "SELECT nota.* , barang.id_barang, barang.nama_barang,  barang.harga_beli, member.id_member,
						member.nm_member from nota 
					   left join barang on barang.id_barang=nota.id_barang 
					   left join member on member.id_member=nota.id_member WHERE nota.tanggal_input LIKE ? 
					   ORDER BY id_nota ASC";
		$row = $this->db->prepare($sql);
		$row->execute(array($param));
		$hasil = $row->fetchAll();
		return $hasil;
	}

	function next_invoice_no($date)
	{
		$sql = "
			SELECT a.no_order
			FROM order_out as a
			where DATE_FORMAT(a.tanggal_order, '%Y') = " . DATE("Y", strtotime($date)) . " and a.type='penjualan'
			ORDER BY id DESC LIMIT 1";
		$row = $this->db->prepare($sql);
		$row->execute();
		$hasil = $row->fetchAll();

		$result = "0001-INV-" . DATE("d-m-y", strtotime($date));

		if (count($hasil) > 0) {
			$exp = explode("-", $hasil[0]['no_order']);
			$exp[0] = sprintf("%04d", $exp[0] + 1);
			$result = $exp[0] . "-INV-" . DATE("d-m-y", strtotime($date));
		}

		return $result;
	}

	function penjualan()
	{
		$sql = "SELECT penjualan.* , barang.id_barang, barang.nama_barang, member.id_member,
						member.nm_member from penjualan 
					   left join barang on barang.id_barang=penjualan.id_barang 
					   left join member on member.id_member=penjualan.id_member
					   ORDER BY id_penjualan";
		$row = $this->db->prepare($sql);
		$row->execute();
		$hasil = $row->fetchAll();
		return $hasil;
	}

	function next_no_order_pembelian($date)
	{
		$sql = "
			SELECT a.no_order
			FROM order_in as a
			where DATE_FORMAT(a.tanggal_order, '%Y') = " . DATE("Y", strtotime($date)) . " and a.type='pembelian'
			ORDER BY id DESC LIMIT 1";
		$row = $this->db->prepare($sql);
		$row->execute();
		$hasil = $row->fetchAll();

		$result = "0001-PEM-" . DATE("d-m-y", strtotime($date));

		if (count($hasil) > 0) {
			$exp = explode("-", $hasil[0]['no_order']);
			$exp[0] = sprintf("%04d", $exp[0] + 1);
			$result = $exp[0] . "-PEM-" . DATE("d-m-y", strtotime($date));
		}

		return $result;
	}

	function next_no_order_keluar($date)
	{
		$sql = "
			SELECT a.no_order
			FROM order_out as a
			where DATE_FORMAT(a.tanggal_order, '%Y') = " . DATE("Y", strtotime($date)) . " and a.type<>'penjualan'
			ORDER BY id DESC LIMIT 1";
		$row = $this->db->prepare($sql);
		$row->execute();
		$hasil = $row->fetchAll();

		$result = "0001-OUT-" . DATE("d-m-y", strtotime($date));

		if (count($hasil) > 0) {
			$exp = explode("-", $hasil[0]['no_order']);
			$exp[0] = sprintf("%04d", $exp[0] + 1);
			$result = $exp[0] . "-OUT-" . DATE("d-m-y", strtotime($date));
		}

		return $result;
	}

	function laporan_penjualan($from, $to)
	{
		$sql = "
			SELECT a.*, SUM(a.harga_beli*a.qty) as harga_beli_inv, SUM(a.harga_jual*a.qty) as harga_jual_inv, SUM(a.qty) as qty_inv, (SUM(a.discount_qty*a.qty)+SUM(a.discount_order)) as discount_inv, SUM(a.harga_total) as harga_total_inv
			FROM order_out as a
			where a.type='penjualan' and tanggal_order>='" . DATE("Y-m-d", strtotime($from)) . "' and tanggal_order<='" . DATE("Y-m-d", strtotime($to)) . "' and a.f_delete=0
			group by a.no_order
		";
		$row = $this->db->prepare($sql);
		$row->execute();
		$hasil = $row->fetchAll();
		// echo "<pre>";print_r($hasil);exit();
		return $hasil;
	}

	function laporan_penjualan_all()
	{
		$sql = "
			SELECT a.*, SUM(a.harga_beli*a.qty) as harga_beli_inv, SUM(a.harga_jual*a.qty) as harga_jual_inv, SUM(a.qty) as qty_inv, (SUM(a.discount_qty*a.qty)+SUM(a.discount_order)) as discount_inv, SUM(a.harga_total) as harga_total_inv FROM order_out as a group by a.no_order
		";
		$row = $this->db->prepare($sql);
		$row->execute();
		$hasil = $row->fetchAll();
		// echo "<pre>";print_r($hasil);exit();
		return $hasil;
	}

	function laporan_penjualan_detail($no_order)
	{
		$sql = "
			SELECT a.*, b.nama_barang, b.merk, b.nama_satuan, (a.qty*(a.harga_jual-a.discount_qty)) as sub_total
			FROM order_out as a
			left join (
				select a.*, b.nama as nama_satuan from barang as a left join satuan as b on a.satuan_barang=b.id
			) as b on a.id_barang=b.id_barang
			where a.no_order='" . $no_order . "' and a.f_delete=0
			order by a.id
		";
		$row = $this->db->prepare($sql);
		$row->execute();
		$hasil = $row->fetchAll();
		// echo "<pre>";print_r($hasil);exit();
		return $hasil;
	}

	function laporan_transaksi_masuk($from, $to)
	{
		$sql = "
			SELECT a.*, SUM(a.harga_beli*a.qty) as harga_beli_inv, SUM(a.harga_jual*a.qty) as harga_jual_inv, SUM(a.qty) as qty_inv, (SUM(a.discount_qty*a.qty)+SUM(a.discount_order)) as discount_inv, SUM(a.harga_total) as harga_total_inv, b.nama as nama_supplier, IF(a.f_status='paid','Lunas','Pending') as status
			FROM order_in as a 
			left join supplier as b on a.pengirim=b.id_supplier
			where tanggal_order>='" . DATE("Y-m-d", strtotime($from)) . "' and tanggal_order<='" . DATE("Y-m-d", strtotime($to)) . "' and a.f_delete=0
			group by a.no_order
		";
		$row = $this->db->prepare($sql);
		$row->execute();
		$hasil = $row->fetchAll();
		// echo "<pre>";print_r($hasil);exit();
		return $hasil;
	}

	function view_all_laporan_transaksi_masuk()
	{
		$sql = "
			SELECT a.*, SUM(a.harga_beli*a.qty) as harga_beli_inv, SUM(a.harga_jual*a.qty) as harga_jual_inv, SUM(a.qty) as qty_inv, (SUM(a.discount_qty*a.qty)+SUM(a.discount_order)) as discount_inv, SUM(a.harga_total) as harga_total_inv, b.nama as nama_supplier, IF(a.f_status='paid','Lunas','Pending') as status
			FROM order_in as a left join supplier as b on a.pengirim=b.id_supplier group by a.no_order
		";
		$row = $this->db->prepare($sql);
		$row->execute();
		$hasil = $row->fetchAll();
		// echo "<pre>";print_r($hasil);exit();
		return $hasil;
	}

	function laporan_transaksi_masuk_detail($no_order)
	{
		$sql = "
			SELECT a.*, b.nama_barang, b.merk, b.nama_satuan, (a.qty*(a.harga_beli-a.discount_qty)) as sub_total
			FROM order_in as a
			left join (
				select a.*, b.nama as nama_satuan from barang as a left join satuan as b on a.satuan_barang=b.id
			) as b on a.id_barang=b.id_barang
			where a.no_order='" . $no_order . "' and a.f_delete=0
			order by a.id
		";
		$row = $this->db->prepare($sql);
		$row->execute();
		$hasil = $row->fetchAll();
		// echo "<pre>";print_r($hasil);exit();
		return $hasil;
	}

	function laporan_transaksi_keluar($from, $to)
	{
		$sql = "
			SELECT a.*, SUM(a.harga_beli*a.qty) as harga_beli_inv, SUM(a.harga_jual*a.qty) as harga_jual_inv, SUM(a.qty) as qty_inv, (SUM(a.discount_qty*a.qty)+SUM(a.discount_order)) as discount_inv, SUM(a.harga_total) as harga_total_inv, b.nama as nama_supplier
			FROM order_out as a 
			left join supplier as b on a.penerima=b.id_supplier
			where a.type<>'penjualan' and tanggal_order>='" . DATE("Y-m-d", strtotime($from)) . "' and tanggal_order<='" . DATE("Y-m-d", strtotime($to)) . "' and a.f_delete=0
			group by a.no_order
		";
		$row = $this->db->prepare($sql);
		$row->execute();
		$hasil = $row->fetchAll();
		// echo "<pre>";print_r($hasil);exit();
		return $hasil;
	}

	function view_all_laporan_transaksi_keluar()
	{
		$sql = "
			SELECT a.*, SUM(a.harga_beli*a.qty) as harga_beli_inv, SUM(a.harga_jual*a.qty) as harga_jual_inv, SUM(a.qty) as qty_inv, (SUM(a.discount_qty*a.qty)+SUM(a.discount_order)) as discount_inv, SUM(a.harga_total) as harga_total_inv, b.nama as nama_supplier
			FROM order_out as a left join supplier as b on a.penerima=b.id_supplier group by a.no_order
		";
		$row = $this->db->prepare($sql);
		$row->execute();
		$hasil = $row->fetchAll();
		// echo "<pre>";print_r($hasil);exit();
		return $hasil;
	}

	function laporan_transaksi_keluar_detail($no_order)
	{
		$sql = "
			SELECT a.*, b.nama_barang, b.merk, b.nama_satuan, (a.qty*(a.harga_beli-a.discount_qty)) as sub_total
			FROM order_out as a
			left join (
				select a.*, b.nama as nama_satuan from barang as a left join satuan as b on a.satuan_barang=b.id
			) as b on a.id_barang=b.id_barang
			where a.no_order='" . $no_order . "' and a.f_delete=0
			order by a.id
		";
		$row = $this->db->prepare($sql);
		$row->execute();
		$hasil = $row->fetchAll();
		// echo "<pre>";print_r($hasil);exit();
		return $hasil;
	}

	function modal()//semua table order_in 
	{
		$sql = "
			select SUM(a.harga_total) as modal 
			from order_in as a
			where a.f_status='paid' and a.f_delete='0'
		";
		$row = $this->db->prepare($sql);
		$row->execute();
		$hasil = $row->fetchAll();

		return $hasil;
	}

	function penjualan_total()//ngitung penjualan aja
	{
		$sql = "
			select SUM(a.harga_total) as penjualan 
			from order_out as a
			where a.f_delete='0' and type='penjualan'
		";
		$row = $this->db->prepare($sql);
		$row->execute();
		$hasil = $row->fetchAll();
		return $hasil;
	}

	function pengeluaran()//order out yang rusak, hilang, retur
	{
		$sql = "
			select SUM(a.harga_total) as pengeluaran 
			from order_out as a
			where a.f_delete='0' and type<>'penjualan'
		";
		$row = $this->db->prepare($sql);
		$row->execute();
		$hasil = $row->fetchAll();
		return $hasil;
	}

	function untung()//order out harga total penjualan - barang rusak - harga beli barang
	{
		$sql = "
			select SUM(a.untung) as untung
			from (
				select SUM(a.harga_total) as untung 
				from order_out as a
				where a.type='penjualan' and a.f_delete='0'
			
				UNION
			
				select (SUM(a.harga_beli*a.qty)*-1) as untung 
				from order_out as a
				where a.type='penjualan' and a.f_delete='0'
			
				UNION
			
				select (SUM(a.harga_total)*-1) as untung 
				from order_out as a
				where a.type<>'penjualan' and a.f_delete='0'
			) as a
		";
		$row = $this->db->prepare($sql);
		$row->execute();
		$hasil = $row->fetchAll();
		return $hasil;
	}

	function top_seller()//order out harga total penjualan - barang rusak - harga beli barang
	{
		$sql = "
			select a.* 
			from (
				select a.id_barang, b.nama_barang, SUM(a.qty) as total
				from order_out as a
				left join barang as b on a.id_barang=b.id_barang
				where a.type='penjualan' and a.f_delete='0'
				group by id_barang
			) as a
			order by a.total DESC
			limit 2
		";
		$row = $this->db->prepare($sql);
		$row->execute();
		$hasil = $row->fetchAll();

		$result['label'] = [];
		$result['value'] = [];
		foreach ($hasil as $isi) {
			$result['label'][] = $isi['nama_barang'];
			$result['value'][] = $isi['total'];
		}
// print_r(json_encode($result));exit();
		return json_encode($result);
	}

}