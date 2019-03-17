<?php include 'inc/header.php'; ?>
<?php
	$logovanje = Session::get("kuplog");
	if($logovanje == false){
		header("Location:login.php");
	}
?>
<?php
		if(isset($_GET['kupaId'])){
		$id = $_GET['kupaId'];
		$vreme  = $_GET['vreme'];
		$cena   = $_GET['cena'];
		$potvrdi = $krp->proizvodPrebacivanjePotvrdi($id,$vreme,$cena);
	}
?>
 <div class="main">
    <div class="content">
		<div class="section group">
			 <div class="order">
				<h2>Detalji vase Narudzbine</h2>
				<table class="tblone">
					<tr>
						<th>Br</th>
						<th>Ime Proizvoda</th>
						<th>Slika</th>
						<th>Kolicina</th>
						<th>Cena</th>
						<th>Datum</th>
						<th>Status</th>
						<th>Radnja</th>
					</tr>
				<?php
					$kupId = Session::get("kupId");
					$prikazi = $krp->dobaviNaruceniProizvod($kupId);
					if($prikazi){
						$i = 0;
						while($rez = $prikazi->fetch_assoc()){
				?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $rez['proizvodIme']; ?></td>
						<td><img src="admin/<?php echo $rez['slika']; ?>" alt=""/></td>
						<td><?php echo $rez['kolicina']; ?></td>
					
						<td><?php echo $rez['cena']; ?>€</td>
						<td><?php echo $fm->formatDate($rez['datum']); ?></td>
						<td>
						<?php
							if($rez['status'] == "0"){
								echo "Na cekanju";
							}elseif($rez['status'] == "1"){
								echo "Na Cekanju";
							}else{
								echo "U Redu";
							}
						?>
						</td>
						<?php
							if($rez['status'] == '1'){ ?>
							<td><a href="?kupaId=<?php echo $kupId; ?>&cena=<?php echo $rez['cena']; ?>&vreme=<?php echo $rez['datum'] ?> ">Potvrdi</a></td>
							<?php }elseif($rez['status'] == '2'){ ?>
							<td>U Redu</td>
						<?php }elseif($rez['status'] == '0'){ ?>
								<td>N/A</td>	
						<?php } ?>
						?>
					</tr>
				<?php
						}
					}
				?>
				</table>
			 </div>
		 </div>
       <div class="clear"></div>
    </div>
 </div>
 <?php include 'inc/footer.php'; ?>