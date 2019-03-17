<?php include 'inc/header.php'; ?>
<?php
	if(isset($_GET['delpro'])){
		$obrId = preg_replace('/[^-a-zA-Z0-9_]/','', $_GET['delpro']);
		$obrisiPro = $krp->obrisiProIzKorpe($obrId);
	}
?>
<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$korpaId 	   = $_POST['korpaId'];
		$kolicina 	   = $_POST['kolicina'];
		$azurirajKorpu = $krp->azurirajKolicinu($korpaId,$kolicina);
		if($kolicina <= 0){
			$obrisiPro = $krp->obrisiProIzKorpe($korpaId);
		}
	}
?>
<?php
	if(!isset($_GET['id'])){
		echo "<meta http-equiv='refresh' content='0;URL=?id=live'/> ";
	}	
?>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Korpa</h2>
					<?php
						if(isset($azurirajKorpu)){
							echo $azurirajKorpu;
						}
						if(isset($obrisiPro)){
							echo $obrisiPro;
						}
					?>
						<table class="tblone">
							<tr>
								<th width="5%">SL</th>
								<th width="30%">Ime Proizvoda</th>
								<th width="10%">Slika</th>
								<th width="15%">Cena</th>
								<th width="15%">Kolicina</th>
								<th width="15%">Ukupna Cena</th>
								<th width="10%">Status</th>
							</tr>
					<?php
						$dobaviPro = $krp->dobaviProIzKorpe();
						if($dobaviPro){
							$i = 0;
							$kol = 0;
							$sum = 0;
							while($rez = $dobaviPro->fetch_assoc()){
								$i++;
					?>
							<tr>
								<td><?php echo $i ?></td>
								<td><?php echo $rez['proizvodIme'] ?></td>
								<td><img src="admin/<?php echo $rez['slika'] ?>" alt=""/></td>
								<td><?php echo $rez['cena'] ?> €</td>
								<td>
					<form action="" method="post">
						<input type="hidden" name="korpaId" value="<?php echo $rez['korpaId']; ?>"/>
						<input type="number" name="kolicina" value="<?php echo $rez['kolicina']; ?>"/>
						<input type="submit" name="submit" value="Azuriraj"/>
					</form>
								</td>
								<td><?php 
								$total = $rez['cena'] * $rez['kolicina'];
								echo $total;
								?> €</td>
								<td><a onclick="return confirm('Da li ste sigurni da zelite da obrisete?');"  href="?delpro=<?php echo $rez['korpaId']; ?>">X</a></td>
						</tr>
					<?php
						$kol = $kol + $rez['kolicina'];
						$sum = $sum + $total;
						Session::set("kol",$kol);
						Session::set("sum",$sum);
					?>
					<?php
							}
						}
					?>
						</table>
					<?php
						$provera = $krp->proveraKorpe();
						if($provera){
					?>
						<table style="float:right;text-align:left;" width="40%">
							<tr>
								<th>Sub Total : </th>
								<td><?php echo $sum ?> €</td>
							</tr>
							<tr>
								<th>PDV : </th>
								<td>10%</td>
							</tr>
							<tr>
								<th>Grand Total :</th>
								<td>
							<?php 
									$vat = $sum * 0.1;
									$gtotal = $sum + $vat;
									echo $gtotal;
				            ?> €</td>
							</tr>
					   </table>
					  <?php
						}else{
							header("Location:index.php");
							//Kolica su prazna molimo pazarite.
						}
					  ?>
					</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						<div class="shopright">
							<a href="payment.php"> <img src="images/check.png" alt="" /></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php include 'inc/footer.php'; ?>