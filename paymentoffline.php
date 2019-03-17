<?php include 'inc/header.php'; ?>
<?php
	$logovanje = Session::get("kuplog");
	if($logovanje == false){
		header("Location:login.php");
	}
?>
<?php
	if(isset($_GET['orderid']) && $_GET['orderid'] == 'order'){
		$kupId = Session::get("kupId");
		$unosNarudzbe = $krp->naruciProizvod($kupId);
		$obrPodatke = $krp->obrisiKorpuKupca();
		header("Location:uspesno.php");
	}
?>
<style>
.division{width:50%; float:left;}
.tblone{width: 590px; margin:0 auto; border:2px solid #ddd;}
.tblone tr td{text-align:justify;}

.tbltwo{float:right; text-align:left; width:60%; border:2px solid #ddd; margin-right:14px; margin-top: 12px;}
.tbltwo tr td{text-align: justify; padding:5px 10px;}
.ordernow{padding-bottom:30px;}
.ordernow a{width:200px;margin:20px auto 0;text-align:center;padding:5px;font-size:30px;display:block;background:#ff0000;color:#fff;border-radius:3px;}
</style>
 <div class="main">
    <div class="content">
    	<div class="section group">
			<div class="division">
			<table class="tblone">
							<tr>
								<th>Br</th>
								<th>Proizvod</th>
								<th>Cena</th>
								<th>Kolicina</th>
								<th>Ukupno</th>
							</tr>
					
			
						</table>
							<table class="tbltwo">
							<tr>
								<td>Sub Total</td>
								<td>:</td>
								<td><?php echo $sum ?>€</td>
							</tr>
							<tr>
								<td>PDV </td>
								<td>:</td>
								<td>10% (<?php echo $vat = $sum * 0.1; ?>€)</td>
							</tr>
							<tr>
								<td>Grand Total</td>
								<td>:</td>
								<td>
								<?php 
									$vat = $sum * 0.1;
									$gtotal = $sum + $vat;
									echo $gtotal;
								?>€</td>
							</tr>
							<tr>
								<td>Kolicina</td>
								<td>:</td>
								<td><?php echo $kol ?></td>
							</tr>
					   </table>
			</div>
			
			<div class="division">
			<?php
			$id = Session::get("kupId");
			$podatci = $ku->dobaviPodatkeKupca($id);
			if($podatci){
				while($rez = $podatci->fetch_assoc()){
		?>
			<table class="tblone">
			<tr>
				<td colspan="3"><h2>Detalji Vaseg Profila</h2></td>
			</tr>
			<tr>
				<td width="20%">Ime</td>
				<td width="5%">:</td>
				<td><?php echo $rez['ime']; ?></td>
		    </tr>
			<tr>
				<td>Grad</td>
				<td>:</td>
				<td><?php echo $rez['grad']; ?></td>
		    </tr>
			<tr>
				<td>E-mail</td>
				<td>:</td>
				<td><?php echo $rez['email']; ?></td>
		    </tr>
			<tr>
				<td>Adresa</td>
				<td>:</td>
				<td><?php echo $rez['adresa']; ?></td>
		    </tr>
			<tr>
				<td>Telefon</td>
				<td>:</td>
				<td><?php echo $rez['telefon']; ?></td>
		    </tr>
			<tr>
				<td></td>
				<td></td>
				<td><a href="editprofile.php">Azuriraj Detalje</a></td>
			</tr>
			</table>
		<?php
				}
			}
		?>
			</div>
 		</div>
 	</div>
	<div class="ordernow"><a href="?orderid=order">Naruci</a></div>
	</div>
	
<?php include 'inc/footer.php'; ?>