<?php include '../classes/Adminlogin.php'; ?>
<?php
	$al = new Adminlogin();
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$adminKorisnik = $_POST['adminKorisnik'];
		$adminLozinka = md5($_POST['adminLozinka']);
		
		$loginChk = $al->adminLogin($adminKorisnik,$adminLozinka);
	}
?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Admin Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
		<form action="login.php" method="post">
			<h1>Admin Login</h1>
			<span style="color:red;font-size:18px;">
				<?php 
					if(isset($loginChk)){
						echo $loginChk;
					}
				?>
			</span>
			<div>
				<input type="text" placeholder="Username"  name="adminKorisnik"/>
			</div>
			<div>
				<input type="password" placeholder="Password"  name="adminLozinka"/>
			</div>
			<div>
				<input type="submit" value="Log in" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="#">Training with live project</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>
