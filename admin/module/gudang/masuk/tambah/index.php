 <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
	  <style>
			label {
				font-weight: bold;
				color: black;
				font-size: 16px;
				margin-top: 6px;
			}
		</style>
		<?php 
			$id = $_SESSION['admin']['id_login'];
			$hasil = $lihat -> user_edit($id);
		?>
		<section id="main-content">
          <section class="wrapper">
              <div class="row">
                  	<div class="col-lg-12 main-chart">
						<h3>Tambah Transaksi Masuk</h3>
						<br>
						<?php if(isset($_GET['success'])){?>
						<div class="alert alert-success">
							<p>Edit Data Berhasil !</p>
						</div>
						<?php }?>
						<?php if(isset($_GET['remove'])){?>
						<div class="alert alert-danger">
							<p>Hapus Data Berhasil !</p>
						</div>
						<?php }?>
						
						<div class="row">

							<div class="col-sm-4">
								<div class="panel panel-success">
									<div class="panel-body row"  style="margin-bottom: 14px;">
										<label class="col-sm-3" for="tanggal_order" >Date</label>
										<div class="col-sm-9">
											<input type="date" class="form-control" id="tanggal_order" name="tanggal_order" placeholder="" value="<?=DATE("Y-m-d");?>" disabled style="width: 100%;">
										</div>
										<hr>
										<label class="col-sm-3" for="" >Petugas</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" name="cari" placeholder="" value="<?=$hasil['nama_profile']?>" disabled style="width: 100%;">
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="panel panel-success">
									<div class="panel-body row" style="margin-bottom: 14px;">
										<label class="col-sm-3" for="barang" >Barang</label>
										<div class="col-sm-7">
											<input type="hidden" class="form-control" id="id_barang" name="id_barang" value="">
											<input type="text" readonly class="form-control" id="nama_barang" name="nama_barang" placeholder="Search Barang" value="" data-toggle="modal" data-target="#myModal" autocomplete="off" style="width: 100%; background-color: white">
										</div>
										<hr style="border-color:white">
										<label class="col-sm-3" for="qty" >Qty</label>
										<div class="col-sm-7">
											<input type="number" class="form-control" id="qty" name="qty" placeholder="" value="<?=$hasil['nama_profile']?>" style="width: 100%;">
										</div>
										<div class="col-sm-2">
											<button class="btn btn-success btn-block" onclick="push_cart()"><i class="fa fa-shopping-cart"></i></button>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="panel panel-success">
									<div class="panel-body row">
										<?php $get_no_inv = $lihat->next_no_order_pembelian(DATE("Y-m-d")); ?>
										<input type="hidden" id="no_order" value="<?=$get_no_inv?>">
										<div class="col-sm-12"><b><u>NO. ORDER : <?=$get_no_inv?></u></b></div>
										<div class="col-sm-12">
											<h1 style="float:right"><b>Rp. </b>&nbsp;&nbsp; <b id="grand_total_inv"><?=number_format(0,2,',','.')?></b></h1>
										</div>
									</div>
								</div>
							</div>

							<div class="col-sm-12">
								<div class="panel panel-success">
									<div class="panel-heading">
										<h4><i class="fa fa-shopping-cart"></i> Hasil Barang Masuk</h4>
									</div>
									<div class="panel-body">
										<table class="table table-bordered">
											<thead>
												<tr style="background:#DFF0D8;color:#333">
													<th class="text-center">No.</th>
													<th class="text-center">ID Barang</th>
													<th class="text-center">Nama Barang</th>
													<th class="text-center">Merk</th>
													<th class="text-center">Qty</th>
													<th class="text-center">Satuan</th>
													<th class="text-center">Harga</th>
													<th class="text-center">Discount</th>
													<th class="text-center">Harga Total</th>
													<th class="text-center" width="15%">Aksi</th>
												</tr>
											</thead>
											<tbody id="push_cart">
												<tr>
													<td>1</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td>
												</tr>
											</tbody>
										</table>
										<div class="row">
											<div class="col-lg-12">
												<select name="type_transaksi" class="form-control" id="type_transaksi" style="width: 20%;float:right; margin-top:20px; margin-left:20px">
													<option value="pembelian">Pembelian</option>
													<option value="pembelian">Retur</option>
													<option value="bonus">Bonus</option>
												</select>
												<label for="type_transaksi" style="float:right;margin-top:25px; margin-left:20px">Type Transaksi</label>
											</div>
											<div class="col-lg-12">
												<select name="pengirim" class="form-control" id="pengirim" style="width: 20%;float:right; margin-top:20px; margin-left:20px">
													<option value="0000">Umum</option>
													<?php 
														$hasil = $lihat->supplier();
														$no = 1;
														foreach ($hasil as $isi) { ?>
															<option value="<?=$isi['id_supplier']?>"><?=$isi['nama']?></option>
														<?php }
													?>
												</select>
												<label for="pengirim" style="float:right;margin-top:25px; margin-left:20px">Pengirim</label>
											</div>
										</div>
									
									</div>
									<div class="panel-footer" style="text-align:right">
										<a href="javascript:void(0)" class="btn btn-success" onclick="save_invoice()"><i class="fa fa-money" aria-hidden="true"></i> Save</a>
									</div>
								</div>
							</div>

						</div>
						
				  	</div>
              	</div>

				<div id="myModal" class="modal fade" role="dialog">
					<div class="modal-dialog">
						<!-- Modal content-->
						<div class="modal-content modal-lg" style=" border-radius:0px;">
							<div class="modal-header" style="background:#285c64;color:#fff;">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title"><i class="fa fa-plus"></i> Search Barang</h4>
							</div>
							<div class="modal-body">
								<table class="table table-bordered" id="example1">
									<thead>
										<tr style="background:#DFF0D8;color:#333;">
											<th>No.</th>
											<th>ID Barang</th>
											<th>Kategori</th>
											<th>Nama Barang</th>
											<th>Merk</th>
											<th>Stok</th>
											<th>Harga Beli</th>
											<th>Satuan</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$hasil = $lihat->barang();

										$no = 1;
										foreach ($hasil as $isi) {
											$param_array = $isi['id_barang'].",".$isi['nama_barang'].",".$isi['merk'].",".$isi['satuan'].",".$isi['harga_jual'].",".$isi['harga_beli'].",".$isi['stok'];
											?>
											<tr>
												<td><?php echo $no; ?></td>
												<td>
													<?php echo $isi['id_barang']; ?>
												</td>
												<td><?php echo $isi['nama_kategori']; ?></td>
												<td>
													<?php echo $isi['nama_barang']; ?>
												</td>
												<td><?php echo $isi['merk']; ?></td>
												<td><?php echo $isi['stok']; ?></td>
												<td>Rp.<?php echo number_format($isi['harga_beli']); ?>,-</td>
												<td>
													<?php echo $isi['satuan']; ?>
												</td>
												<td>
													<button class="btn btn-primary btn-xs" onclick="select_barang_push('<?=$param_array?>')">Pilih</button>
												</td>
											</tr>
											<?php
											$no++;
										}
										?>
									</tbody>
								</table>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>

				<div id="ModalEdit" class="modal fade" role="dialog">
					<div class="modal-dialog">
						<!-- Modal content-->
						<div class="modal-content modal-lg" style=" border-radius:0px;">
							<div class="modal-header" style="background:#285c64;color:#fff;">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title"><i class="fa fa-edit"></i> Edit Transaksi Barang</h4>
							</div>
							<div class="modal-body">
								<input type="hidden" class="form-control" id="key_edit">
								<tr>
									<td>Qty</td><td><input type="number" class="form-control" id="qty_edit"></br></td>
								</tr>
								<tr>
									<td>Discount <i style="color: red;"> * diberikan per Qty</i></td><td><input type="number" class="form-control" id="discount_edit"></td>
								</tr>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-success" data-dismiss="modal" onclick="update_transaksi()">Save</button>
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>

          </section>
      </section>
	

<script>

$('input.CurrencyInput').on('blur', function() {
  const value = this.value.replace(/,/g, '');
  this.value = parseFloat(value).toLocaleString('en-US', {
    style: 'decimal',
    maximumFractionDigits: 2,
    minimumFractionDigits: 2
  });
});

let currency_format= new Intl.NumberFormat('id-ID', {
	style: 'currency',
	currency: 'IDR',
});

var cart_session = [];
var select_barang;

function select_barang_push(array){
	select_barang = "";
	select_barang = array.split(",");

	$("#id_barang").val(select_barang[0]);
	$("#nama_barang").val(select_barang[1]);

	$("#myModal").modal("hide");
}

function load_table_transaksi(){
	var body_table = "";
	var no = 1;
	var sub_total = 0;
	cart_session.forEach(function(val, key){
		var harga_total = (val[5]-val[8])*val[7];
		sub_total += harga_total;

		body_table += `
		<tr>
			<td>`+no+`</td><td>`+val[0]+`</td><td>`+val[1]+`</td><td>`+val[2]+`</td><td>`+val[7]+`</td><td>`+val[3]+`</td><td class='text-right'>`+currency_format.format(val[5]).replace("Rp","Rp.")+`</td><td class='text-right'>`+currency_format.format(val[8]).replace("Rp","Rp.")+`</td><td class='text-right'>`+currency_format.format(harga_total).replace("Rp","Rp.")+`</td><td class="text-center"><button class="btn btn-warning btn-xs" onclick="modalEdit('`+key+`')">Edit</button>&nbsp;<button class="btn btn-danger btn-xs" onclick="modalDelete('`+key+`')">Delete</button></td>
		</tr>
		`;
		no++;
	});

	body_table += `
	<tr>
		<td colspan="7" rowspan="3"></td>
		<td><b>Sub Total</b></td>
		<td class='text-right'><b>`+currency_format.format(sub_total).replace("Rp","Rp.")+`</b></td>
		<td class="text-center"><b>Catatan</b></td>
	</tr>
	<tr>
		<td><b>Discount</b></td>
		<td><input type="hidden" id="discount_order"><input type="text" class="form-control" id="discount_view" onkeyup="grand_total('`+sub_total+`',this)" style="width: 100%;text-align: right;"></td>
		<td rowspan="2"><textarea class="form-control" id="catatan" rows="4" cols="50"></textarea></td>
	</tr>
	<tr>
		<td><b>Grand Total</b></td>
		<td class='text-right' style="border-right: solid 1px gainsboro;"><b id="form_grand_total">`+currency_format.format(sub_total).replace("Rp","Rp.")+`</b></td>	
	</tr>`;

	$("#push_cart").html(body_table);
	$("#grand_total_inv").html(currency_format.format(sub_total).replace("Rp",""));

}

function push_cart(){
	var qty = $("#qty").val();
	if(qty=="" && $("#nama_barang").val() == ""){
		alert("Mohon isi terlebih dahulu form barang dan qty!");
	}else{
		select_barang.push(qty);
		select_barang.push('0');//discount
		cart_session.push(select_barang);
		
		load_table_transaksi();

		// reset form cart
		$("#id_barang").val("");
		$("#nama_barang").val("");
		$("#qty").val("");
		// ================
	}

}

function modalEdit(key){
	console.log(cart_session);

	$("#ModalEdit").modal("show");

	$("#key_edit").val(key);
	$("#qty_edit").val(cart_session[key][7]);
	$("#discount_edit").val(cart_session[key][8]);
}

function update_transaksi(){

	cart_session.forEach(function(val, key){
		if(key==$("#key_edit").val()){
			val[7] = $("#qty_edit").val();
			val[8] = $("#discount_edit").val();
		}
	});

	load_table_transaksi();
}

function modalDelete(param_key){
	var array_cleansing = [];
	if (confirm("Apakah yakin ingin menghapus ?") == true) {
		cart_session.forEach(function(val, key){
			if(key!=param_key){
				array_cleansing.push(val);
			}
		});
	
		cart_session = [];
		cart_session = array_cleansing;

		load_table_transaksi();
	}
}

function grand_total(total,param){
	var input_value = param.value;
	input_value = numberToCurrency(input_value);
	$("#discount_view").val(input_value);


	value = param.value.replace(/,/gi,"");
	$("#discount_order").val(value);
	$("#form_grand_total").html(currency_format.format((total-value)).replace("Rp","Rp."));
	$("#grand_total_inv").html(currency_format.format((total-value)).replace("Rp",""));
}

function save_invoice(){
	var no_order = $("#no_order").val();
	var tanggal_order = $("#tanggal_order").val();
	var catatan = $("#catatan").val();
	var discount_order = $("#discount_order").val();
	var type_transaksi = $("#type_transaksi").val();
	var pengirim = $("#pengirim").val();
	
	
	var list_barang = JSON.stringify(cart_session);

	$.ajax({
		type: "POST",
		url: "fungsi/tambah/tambah.php?transaksi_masuk=yes",
		data:{
			no_order : no_order,
			tanggal_order : tanggal_order,
			catatan : catatan,
			discount_order : discount_order,
			type_transaksi : type_transaksi,
			pengirim : pengirim,
			list_barang : list_barang
		},
		success: function(result){
			var r = JSON.parse(result);
			alert(r.message);
			if(r.success){
				window.location= window.location.href+"&success=tambah-data";
			}
		}
	});
}

var numberToCurrency = function (input_val, fixed = false, blur = false) {
    // don't validate empty input
    if(!input_val) {
        return "";
    }
    
    if(blur) {
        if (input_val === "" || input_val == 0) { return 0; }
    }

    if(input_val.length == 1) {
        return parseInt(input_val);
    }

    input_val = ''+input_val;
    
    let negative = '';
    if(input_val.substr(0, 1) == '-'){
        negative = '-';
    }
    // check for decimal
    if (input_val.indexOf(".") >= 0) {
        // get position of first decimal
        // this prevents multiple decimals from
        // being entered
        var decimal_pos = input_val.indexOf(".");

        // split number by decimal point
        var left_side = input_val.substring(0, decimal_pos);
        var right_side = input_val.substring(decimal_pos);

        // add commas to left side of number
        left_side = left_side.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");

        if(fixed && right_side.length > 3) {
            right_side = parseFloat(0+right_side).toFixed(2);
            right_side =  right_side.substr(1, right_side.length);
        }

        // validate right side
        right_side = right_side.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");

        // Limit decimal to only 2 digits
        if(right_side.length > 2) {
            right_side = right_side.substring(0, 2);
        }
    
        if(blur && parseInt(right_side) == 0) {
            right_side = '';
        }

        // join number by .
        // input_val = left_side + "." + right_side;

        if(blur && right_side.length < 1) {
            input_val = left_side;
        } else {
            input_val = left_side + "." + right_side;
        }
    } else {
        // no decimal entered
        // add commas to number
        // remove all non-digits
        input_val = input_val.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    if(input_val.length > 1 && input_val.substr(0, 1) == '0' && input_val.substr(0, 2) != '0.' ) {
        input_val = input_val.substr(1, input_val.length);
    } else if(input_val.substr(0, 2) == '0,') {
        input_val = input_val.substr(2, input_val.length);
    }
    
    return negative+input_val;
};

//To select country name
</script>