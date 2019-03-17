<?php include 'inc/header.php'; ?>
<?php
	$logovanje = Session::get("kuplog");
	if($logovanje == false){
		header("Location:login.php");
	}
?>
<style>
.uspesno{width:500px;min-height:200px;text-align:center;border:1px solid #ddd; margin:0 auto; padding:20px;}
.uspesno h2{border-bottom:1px solid #ddd; margin-bottom:20px; padding-bottom:10px;}
.uspesno p{line-height:25px;font-size:18px;line-height:25px;}
</style>
 <div class="main">
    <div class="content">
    	<div class="section group">
			<div class="uspesno">
				<h2>Uspesno</h2>
			<?php
				$kupId = Session::get("kupId");
				$svota = $krp->svotaZaPlacanje($kupId);
				if($svota){
					$sum = 0;
					while($rez = $svota->fetch_assoc()){
						$cena = $rez['cena'];
						$sum   = $sum + $cena;
					}
				}
			?>
				<p style="color:red">Ukupna Svota Za Naplatu(Ukljucujuci PDV) : €
				<?php
					$vat = $sum * 0.1;
					$total = $sum + $vat;
					echo $total;
				?>
				</p>
				<p>Hvala na kupovini. Narudzba priljena uspesno .Kontaktiracemo vas sto pre oko detalja posiljke. Ovde su detalji vase narudzbe...<a href="orderdetails.php">Posetite ovde...</a></p>
			</div>
			
 		</div>
 	</div>
	</div>
<?php include 'inc/footer.php'; ?>