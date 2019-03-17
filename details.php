<?php include 'inc/header.php'; ?>
<?php
	if(isset($_GET['proid'])){
		$id = preg_replace('/[^-a-zA-Z0-9_]/','', $_GET['proid']);
	}
	
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
		$kolicina = $_POST['kolicina'];
		$dodajKrp = $krp->dodajUKorpu($kolicina,$id);
	}
?>
<?php
	if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['uporedi'])){
		$proizvodId = $_POST['proizvodId'];
		$unesiPoredjenje = $pr->unesiPodatkeZaPoredjenje($proizvodId ,$kupId);
	}
	
	if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['listaz'])){
		$sacuvajListu = $pr->sacuvajPodatkeListeZelja($id ,$kupId);
	}
?>
<?php
	if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['comment'])){
		$komentar = $_POST['komentar'];
		$kupId = Session::get("kupId");
		$unesiKom = $pr->unesiKomentar($komentar,$id,$kupId);
	}
?>
<style>
.dugme {width:100px; float:left; margin-right:50px;}
</style>
 <div class="main">
    <div class="content">
    	<div class="section group">
				<div class="cont-desc span_1_of_2">	
				<?php
					$jedanPr = $pr->dobaviJedanProizvod($id);
					if($jedanPr){
						while($rezultat = $jedanPr->fetch_assoc()){
				?>
					<div class="grid images_3_of_2">
						<img src="admin/<?php echo $rezultat['slika']; ?>" alt="" />
					</div>
				<div class="desc span_3_of_2">
					<h2><?php echo $rezultat['proizvodIme']; ?></h2>
					<div class="price">
						<p>Cena: <span>$<?php echo $rezultat['cena']; ?></span></p>
						<p>Kategorija: <span><?php echo $rezultat['katIme']; ?></span></p>
						<p>Marka:<span><?php echo $rezultat['markaIme']; ?></span></p>
					</div>
				<div class="add-cart">
					<form action="" method="post">
						<input type="number" class="buyfield" name="kolicina" value="1"/>
						<input type="submit" class="buysubmit" name="submit" value="Kupovina"/>
					</form>				
				</div>
				<span style="color:red; font-size:18px;">
				<?php
					if(isset($dodajKrp)){
						echo $dodajKrp;
					}
				?>
				</span>
				<?php
					if(isset($unesiPoredjenje)){
						echo $unesiPoredjenje;
					}
					if(isset($sacuvajListu)){
						echo $sacuvajListu;
					}
				?>
				<?php
					$login = Session::get("kuplog");
					if($login == true){
				?>
				<div class="add-cart">
					<div class="dugme">
					<form action="" method="post">
						<input type="hidden" class="buyfield" name="proizvodId" value="<?php echo $rezultat['proizvodId']; ?>"/>
						<input type="submit" class="buysubmit" name="uporedi" value="Dodaj na Poredjenje"/>
					</form>
					</div>
					<div class="dugme">
					<form action="" method="post">
						<input type="submit" class="buysubmit" name="listaz" value="Sacuvaj na Listu"/>
					</form>	
					</div>
				</div>
				<?php } ?>
			</div>
			<div class="product-desc">
			<h2>Opis Proizvoda</h2>
			<?php echo $rezultat['opis']; ?>
	    </div>
<?php
	if(isset($unesiKom)){
		echo $unesiKom;
	}
?>
<?php if(Session::get("kuplog") == TRUE){  ?>
		<form action="" method="POST">
			<table>
				<tr>
					<td>Ostavi Komentar</td>
					<td>
						<textarea name="komentar"></textarea>
					</td>
					<td>
						<input type="submit" name="comment" value="Posalji"/>
					</td>
				</tr>
			</table>
		</form>
		
<?php }else{ ?>
		<a href="login.php">Morate biti Ulogovani da biste ostavili kometar</a>
<?php }?>
		<?php
						}
					}
		?>
	</div>
				<div class="rightsidebar span_3_of_1">
					<h2>KATEGORIJE</h2>
					<ul>
				<?php
					$dobaviKat = $kat->dobaviKategorije();
					if($dobaviKat){
						while($rezultat = $dobaviKat->fetch_assoc()){
				?>
				      <li><a href="productbycat.php?katId=<?php echo $rezultat['katId']; ?>"><?php echo $rezultat['katIme']; ?></a></li>
				<?php
						}
					}
				?>
    				</ul>
    	
 				</div>

<?php $dobaviKom = $pr->dobaviKomentare($id);
	if($dobaviKom){
		while($rescom = $dobaviKom->fetch_assoc()){ ?>
			<p><?php echo $rescom['ime']; ?></p>
			<p><?php echo $rescom['komentar']; ?></p>
			<p><?php echo $rescom['vreme']; ?></p>
	<?php } } ?>

 		</div>
 	</div>
<?php include 'inc/footer.php'; ?>

