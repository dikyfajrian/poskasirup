<!--sidebar end-->

<!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
<!--main content start-->
<section id="main-content">
    <section class="wrapper">

        <div class="row">
            <div class="col-lg-12 main-chart">
                <h3>Data Supplier</h3>
                <br />
                <?php if (isset($_GET['success'])) { ?>
                    <div class="alert alert-success">
                        <p>Tambah Data Berhasil !</p>
                    </div>
                <?php } ?>
                <?php if (isset($_GET['success-edit'])) { ?>
                    <div class="alert alert-success">
                        <p>Update Data Berhasil !</p>
                    </div>
                <?php } ?>
                <?php if (isset($_GET['remove'])) { ?>
                    <div class="alert alert-danger">
                        <p>Hapus Data Berhasil !</p>
                    </div>
                <?php } ?>
                <?php
                if (!empty($_GET['uid'])) {
                    $sql = "SELECT * FROM supplier WHERE id = ?";
                    $row = $config->prepare($sql);
                    $row->execute(array($_GET['uid']));
                    $edit = $row->fetch();
                    ?>

                    <?php } else { ?>

                    <button type="button" class="btn btn-primary btn-md pull-right" data-toggle="modal"
                        data-target="#myModal">
                        <i class="fa fa-plus"></i> Insert Data Supplier</button>
                    <a href="index.php?page=supplier" style="margin-right :0.5pc;" class="btn btn-success btn-md pull-right">
                        <i class="fa fa-refresh"></i> Refresh Data</a>
                    <div class="clearfix"></div>

                    <?php } ?>
                <br />
                <table class="table table-bordered" id="example1">
                    <thead>
                        <tr style="background:#DFF0D8;color:#333;">
                            <th>No.</th>
                            <th>ID Supplier</th>
                            <th>Supplier</th>
                            <th>Alamat</th>
                            <th>Telpon</th>
                            <th>Keterangan</th>
                            <th>Tanggal Input</th>
                            <th>Tanggal Update</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $hasil = $lihat->supplier();
                        $no = 1;
                        foreach ($hasil as $isi) {
                            ?>
                            <tr>
                                <td>
                                    <?php echo $no; ?>
                                </td>
                                <td><?php echo $isi['id_supplier']; ?>
                                </td>
                                <td>
                                    <?php echo $isi['nama']; ?>
                                </td>
                                <td>
                                    <?php echo $isi['alamat']; ?>
                                </td>
                                <td>
                                    <?php echo $isi['telepon']; ?>
                                </td>
                                <td>
                                    <?php echo $isi['keterangan']; ?>
                                </td>
                                <td>
                                    <?php echo $isi['tgl_input']; ?>
                                </td>
                                <td>
                                    <?php echo $isi['tgl_update']; ?>
                                </td>
                                <td>
                                    <a href="index.php?page=supplier/edit&supplier=<?php echo $isi['id_supplier']; ?>"><button
											class="btn btn-warning">Edit</button></a>
                                    <a href="fungsi/hapus/hapus.php?supplier=hapus&id=<?php echo $isi['id_supplier']; ?>"
                                        onclick="javascript:return confirm('Hapus Data supplier ?');"><button
                                            class="btn btn-danger">Hapus</button></a>
                                </td>
                            </tr>
                            <?php $no++;
                        } ?>
                    </tbody>
                </table>
                <div class="clearfix" style="padding-top:16%;"></div>
                <div id="myModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content" style=" border-radius:0px;">
                        <div class="modal-header" style="background:#285c64;color:#fff;">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title"><i class="fa fa-plus"></i> Tambah Supplier</h4>
                        </div>										
                        <form action="fungsi/tambah/tambah.php?supplier=tambah" method="POST">
                            <div class="modal-body">
                                <table class="table table-striped bordered">
                                    <?php
                                        $format = $lihat -> supplier_id();
                                    ?>
                                    <tr>
                                        <td>ID Supplier</td>
                                        <td><input type="text" readonly="readonly" required value="<?php echo $format;?>" class="form-control"  name="id_supplier"></td>
                                    </tr>
                                    <tr>
                                        <td>Nama Supplier</td>
                                        <td><input type="text" placeholder="Nama Supplier" required class="form-control" name="nama"></td>
                                    </tr>
                                    <tr>
                                        <td>Alamat Supplier</td>
                                        <td><input type="text" placeholder="Alamat Supplier" required class="form-control"  name="alamat"></td>
                                    </tr>
                                    <tr>
                                        <td>No. Telepon</td>
                                        <td><input type="text" placeholder="Nomor Telpon" required class="form-control" name="telepon"></td>
                                    </tr>
                                    <tr>
                                        <td>Keterangan</td>
                                        <td><input type="text" placeholder="Keterangan" required class="form-control" name="keterangan"></td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Input</td>
                                        <td><input type="text" required readonly="readonly" class="form-control" value="<?php echo  date("j F Y, G:i");?>" name="tgl_input"></td>
                                    </tr>											
                                    <!-- <tr>
                                        <td>Tanggal Output</td>
                                        <td><input type="text" required readonly="readonly" class="form-control" value="<?php echo  date("j F Y, G:i");?>" name="tgl_output"></td>
                                    </tr> -->
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Insert Data</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>