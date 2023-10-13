<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Dashboard">
  <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

  <title>Sistem Penjualan Barang Berbasis Web </title>

  <!-- Bootstrap core CSS -->
  <link href="assets/css/bootstrap.css" rel="stylesheet">
  <!--external css-->
  <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="assets/css/zabuto_calendar.css">
  <link rel="stylesheet" type="text/css" href="assets/datatables/dataTables.bootstrap.css" />
  <link rel="stylesheet" type="text/css" href="assets/js/gritter/css/jquery.gritter.css" />
  <link rel="stylesheet" type="text/css" href="assets/lineicons/style.css">

  <!-- Custom styles for this template -->
  <link href="assets/css/style.css" rel="stylesheet">
  <link href="assets/css/style-responsive.css" rel="stylesheet">

  <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="assets/datatables/jquery.dataTables.js"></script>
  <script type="text/javascript" src="assets/datatables/dataTables.bootstrap.js"></script>
  <script type="text/javascript" src="assets/js/jquery-2.2.3.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

  <style>
    .header {
      background: #fff;
      color: #fff;
    }

    #main-content {
      background: #fff;
    }

    #hidden {
      display: none
    }
  </style>
</head>

<body style="background-color: white;">
  <section id="container">
    <header class="header black-bg">
      <div class="sidebar-toggle-box">
        <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
      </div>
      <center>
      <a href="index.php" class="logo"><b>
          <?php echo $toko['nama_toko']; ?>
        </b> <small style="padding-left:5px;font-size:13px;"><?php echo $toko['alamat_toko']; ?></small>
      </a></center>
      <!-- <div class="nav notify-row" id="top_menu">
      </div> -->
    </header>
