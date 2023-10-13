<?php
$hasil_profil = $lihat->puser_edit($_SESSION['admin']['id_login']);
// echo "</br></br><pre>";print_r($hasil_profil);exit();
?>
<aside>
    <div id="sidebar" class="nav-collapse">
        <h2>
            <?= $hasil_profil['nama_level']; ?>
        </h2>
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
            <p class="centered" style="margin-top: -50px;"><a><img src="assets/img/user/<?php echo $hasil_profil['gambar']; ?>" class="img-box"
                        width="100" height="100"></a></p>
            <h5 class="centered">
                <?php echo $hasil_profil['nama_profile']; ?>
            </h5>

            </br>

            <?php
            if ($hasil_profil['level'] == '1') { ?>
                <li>
                    <a href="index.php">
                        <i class="fa fa-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?page=supplier">
                        <i class="fa fa-cubes"></i>
                        <span>Supplier</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa Example of inbox fa-inbox"></i>
                        <span>Product <span style="padding-left:2px;"> <i class="fa fa-angle-down"></i></span></span>
                    </a>
                    <ul class="sub">
                        <li><a href="index.php?page=barang">Barang</a></li>
                        <li><a href="index.php?page=kategori">Kategori</a></li>
                        <li><a href="index.php?page=satuan">Satuan</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-shopping-cart"></i>
                        <span>Transaksi <span style="padding-left:2px;"> <i class="fa fa-angle-down"></i></span></span>
                    </a>
                    <ul class="sub">
                        <li><a href="index.php?page=jual">Transaksi Jual</a></li>
                        <li><a href="index.php?page=laporan">Laporan Penjualan</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-archive"></i>
                        <span>Gudang <span style="padding-left:2px;"> <i class="fa fa-angle-down"></i></span></span>
                    </a>
                    <ul class="sub">
                        <li><a href="index.php?page=gudang/masuk">Barang Masuk</a></li>
                        <li><a href="index.php?page=gudang/keluar">Barang Keluar</a></li>
                        <li><a href="index.php?page=stok">Stok Barang</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-cog"></i>
                        <span>Setting <span style="padding-left:2px;"> <i class="fa fa-angle-down"></i></span></span>
                    </a>
                    <ul class="sub">
                        <li><a href="index.php?page=pengaturan">Pengaturan User</a></li>
                        <li><a href="index.php?page=user">User</a></li>

                    </ul>
                </li>
                <li>
                    <a class="logout" onclick="javascript: return confirm('Mau Logout ?');" href="logout.php">
                        <i class="fa fa-sign-out"></i>
                        <span>Logout</span>
                    </a>
                </li>
            <?php } ?>
            <?php
            if ($hasil_profil['level'] == '2') { ?>
                <li class="mt">
                    <a href="index.php">
                        <i class="fa fa-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?page=supplier">
                        <i class="fa fa-cubes"></i>
                        <span>Supplier</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa Example of inbox fa-inbox"></i>
                        <span>Product <span style="padding-left:2px;"> <i class="fa fa-angle-down"></i></span></span>
                    </a>
                    <ul class="sub">
                        <li><a href="index.php?page=barang">Barang</a></li>
                        <li><a href="index.php?page=kategori">Kategori</a></li>
                        <li><a href="index.php?page=satuan">Satuan</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-shopping-cart"></i>
                        <span>Transaksi <span style="padding-left:2px;"> <i class="fa fa-angle-down"></i></span></span>
                    </a>
                    <ul class="sub">
                        <li><a href="index.php?page=jual">Transaksi Jual</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-archive"></i>
                        <span>Gudang <span style="padding-left:2px;"> <i class="fa fa-angle-down"></i></span></span>
                    </a>
                    <ul class="sub">
                        <li><a href="index.php?page=gudang/masuk">Barang Masuk</a></li>
                        <li><a href="index.php?page=gudang/keluar">Barang Keluar</a></li>
                        <li><a href="index.php?page=stok">Stok Barang</a></li>
                    </ul>
                </li>
                <li>
                    <a class="logout" onclick="javascript: return confirm('Mau Logout ?');" href="logout.php">
                        <i class="fa fa-sign-out"></i>
                        <span>Logout</span>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </div>
</aside>
<!--sidebar end-->