<?php
session_start();
if($_SESSION){
          	header("Location: user.php");
            }
	      if(isset($_POST['login'])){
					include("config/koneksi.php");

					$username = htmlspecialchars($username);
					$username = addslashes($username);

					$username	= $_POST['username'];
					$password	= md5($_POST['password']);
					$level		= $_POST['level'];
					
					$query = mysql_query("SELECT * FROM users WHERE username='$username' AND password='$password'");
					if(mysql_num_rows($query) == 0){
						echo '<div class="alert alert-danger">Upss...!!! Login gagal.</div>';
					}else{
						$row = mysql_fetch_assoc($query);
						
						if($row['level'] == 1 && $level == 1){
							$_SESSION['username']=$username;
							$_SESSION['level']='admin';
							header("Location: admin.php");
						}else if($row['level'] == 2 && $level == 2){
							$_SESSION['username']=$username;
							$_SESSION['level']='dosen';
							header("Location: user.php");
						}else if($row['level'] == 3 && $level == 3){
							$_SESSION['username']=$username;
							$_SESSION['level']='mahasiswa';
							header("Location: user.php");
						}else{
							echo '<div class="alert alert-danger">Upss...!!! Login gagal.</div>';
						}
		    	}
		  	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login System</title>

	<!-- Bootstrap -->
	<link href="assets/css/bootstrap.min.css" rel="stylesheet">
	<style>
		body {
			background-color:#eee;
		}
		.row {
			margin:100px auto;
			width:300px;
			text-align:center;
		}
		.login {
			background-color:#fff;
			padding:20px;
			margin-top:20px;
		}
	</style>
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body> <!--Batas Mulai Tubuh Beranda-->
	
	<div class="container">
		<div class="row">
			<h2>C-Panel</h2>
			<div class="login">
				
				<form role="form" action="" method="post">
					<div class="form-group">
						<input type="text" name="username" class="form-control" placeholder="Username" required autofocus />
					</div>
					<div class="form-group">
						<input type="password" name="password" class="form-control" placeholder="Password" required autofocus />
					</div>
					<div class="form-group">
						<select name="level" class="form-control" required>
							<option value="">Pilih Level User</option>
							<option value="1">Administrator</option>
							<option value="2">Dosen</option>
							<option value="3">Mahasiswa</option>
						</select>
					</div>
					<div class="form-group">
						<input type="submit" name="login" class="btn btn-primary btn-block" value="Log me in" />
					</div>
				</form>
			</div>
			<br />
			Copyright &copy; 2016 <a href="http://syedara.com" target="_blank">wwww.syedara.com</a>
		</div>
	</div>
	<script src="assets/js/bootstrap.min.js"></script>
</body> <!--Batas Akhir Tubuh Beranda-->
</html>
