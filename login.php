<?php
@ob_start();
session_start();
if (isset($_POST['proses'])) {
	require 'config.php';

	$user = strip_tags($_POST['user']);
	$pass = strip_tags($_POST['pass']);

	$sql = 'select a.*, b.nama as nama_level
				from login as a
				left join level as b on a.level=b.id
				where user =? and pass = ?';
	$row = $config->prepare($sql);
	$row->execute(array($user, $pass));
	$jum = $row->rowCount();
	if ($jum > 0) {
		$hasil = $row->fetch();
		$_SESSION['admin'] = $hasil;
		echo '<script>alert("Login Sukses");window.location="index.php"</script>';
	} else {
		echo '<script>alert("Login Gagal");history.go(-1);</script>';
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="Dashboard">
	<meta name="keyword">

	<title>Login To Admin</title>

	<!-- Bootstrap core CSS -->
	<!-- <link href="assets/css/bootstrap.css" rel="stylesheet"> -->
	<!--external css-->
	<!-- <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" /> -->

	<!-- Custom styles for this template -->
	<link href="assets/css/login.css" rel="stylesheet">
	<!-- <link href="assets/css/style-responsive.css" rel="stylesheet">  -->

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>

<!-- <body style="background:#ffffff;color:#fff;"> -->

<!-- **********************************************************************************************************************************************************
	  MAIN CONTENT
	  *********************************************************************************************************************************************************** -->

<!-- <div id="login-page" style="padding-top:3pc;">
		<div class="container">
			<form class="form-login" method="POST">
				<h2 class="form-login-heading">SRC ICO</h2>
				<div class="login-wrap">
					<input type="text" class="form-control" name="user" placeholder="User ID" autofocus>
					<br>
					<input type="password" class="form-control" name="pass" placeholder="Password">
					<br>
					<button class="btn btn-primary btn-block" name="proses" type="submit">
						SIGN IN</button>
				</div>
			</form>
	
		</div>
	</div> -->

<!-- <div class="body"></div>
<div class="grad"></div>
<div class="header">
	<div>SRC<span> ICO</span></div>
</div>
<br>

<form class="form-login" method="POST">
	<div class="login">
		<input type="text" placeholder="username" name="user"><br> -->
		<!-- <input type="password" placeholder="password" name="pass"><br> -->
		<!-- <input type="button" name="proses" type="submit" value="Login"> -->
		<!-- <br>
		<button class="btn btn-primary btn-block" name="proses" type="submit">
			Login</button>
	</div>
</form> -->

<div class="login-page">
  <div class="form">
    <form class="login-form" method="POST">
      <input type="text" name="user" placeholder="username"/>
      <input type="password" name="pass" placeholder="password"/>
      		<button class="btn btn-primary btn-block" name="proses" type="submit">
			Login</button>
    </form>
  </div>
</div>
<!-- js placed at the end of the document so the pages load faster -->
<script src="assets/js/jquery.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
</body>

</html>