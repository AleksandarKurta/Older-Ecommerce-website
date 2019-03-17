<?php 
	include 'lib/Session.php';
	Session::init();
	include 'lib/Database.php';
	include 'helpers/Format.php';
	
	spl_autoload_register(function($class){
		include_once "classes/".$class.".php";
	});
	
	$db  = new Database();
	$fm  = new Format();
	$pr  = new Proizvod();
	$kat = new Kategorija();
	$krp = new Korpa();
	$ku  = new Kupac();
?>
<!DOCTYPE HTML>
<head>
<title>Store Website</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/menu.css" rel="stylesheet" type="text/css" media="all"/>
<script src="js/jquerymain.js"></script>
<script src="js/script.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script> 
<script type="text/javascript" src="js/nav.js"></script>
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script> 
<script type="text/javascript" src="js/nav-hover.js"></script>
<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
<script type="text/javascript">
  $(document).ready(function($){
    $('#dc_mega-menu-orange').dcMegaMenu({rowItems:'4',speed:'fast',effect:'fade'});
  });
</script>
</head>
<body>
  <div class="wrap">
		<div class="header_top">
			<div class="logo">
				<a href="index.php"><img src="images/logo.png" alt="" /></a>
			</div>
			  <div class="header_top_right">
			    <div class="search_box">
				    <form action="search.php" method="GET">
				    	<input type="text" name="search" value="Pretraga Proizvoda" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Pretraga Proizvoda';}"><input type="submit" name="submit" value="TRAZI">
				    </form>
			    </div>
			    <div class="shopping_cart">
					<div class="cart">
						<a href="cart.php?id=live" title="View my shopping cart" rel="nofollow">
								<span class="cart_title">Korpa</span>
								<span class="no_product">
								<?php
									$provera = $krp->proveraKorpe();
									if($provera){
										$sum = Session::get("sum");
										$kol = Session::get("kol");
										echo "€. " .$sum. " | Kol: " . $kol;
									}else{
										echo "(Prazna)";
									}
								?>
								</span>
							</a>
						</div>
			      </div>
	<?php
		if(isset($_GET['cid'])){
			$kupId = Session::get("kupId");
			$obrPod = $krp->obrisiKorpuKupca();
			$obrPor = $pr->obrisiPodatkePoredjenja($kupId);
			Session::destroy();
		}
	?>
		   <div class="login">
	<?php
		$logovanje = Session::get("kuplog");
		if($logovanje == false){ ?>
			<a href="login.php">Moj Nalog</a>
	<?php }else{ ?>
			<a href="?cid=<?php Session::get('kupId') ?>">Izlogujte se</a>
	<?php	
		}
	?>   
		   </div>
		 <div class="clear"></div>
	 </div>
	 <div class="clear"></div>
 </div>
<div class="menu">
	<ul id="dc_mega-menu-orange" class="dc_mm-orange">
	  <li><a href="index.php">Pocetna</a></li>
	  <li><a href="products.php">Proizvodi</a> </li>
	  <li><a href="topbrands.php">Brendovi</a></li>
	<?php
		$provera = $krp->proveraKorpe();
		if($provera){ ?>
			<li><a href="cart.php">Korpa</a></li>
			<li><a href="payment.php">Placanje</a></li>
	<?php } ?>
	<?php
		$kupId = Session::get("kupId");
		$provera = $krp->proveraNarudzbe($kupId);
		if($provera){ ?>
			<li><a href="orderdetails.php">Narudzba</a></li>
	<?php } ?>
	 
	<?php
		$logovanje = Session::get("kuplog");
		if($logovanje == true){ ?>
			<li><a href="profile.php">Profil</a> </li>
	<?php	} ?>
	<?php
		$dobaviPod = $pr->dobaviPodatkePoredjenja($kupId);
		if($dobaviPod){ ?>
	  <li><a href="compare.php">Poredi</a> </li>
	<?php	} ?>
	<?php
		$proveriListuZ = $pr->proveriPodatkeListe($kupId);
		if($proveriListuZ){ ?>
	  <li><a href="listazelja.php">Lista Zelja</a> </li>
		<?php	} ?>
	  <li><a href="contact.php">Kontakt</a> </li>
	  <div class="clear"></div>
	</ul>
</div>