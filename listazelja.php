<?php include 'inc/header.php'; ?>
<?php
	$login = Session::get("kuplog");
	if($login == false){
		header("Location:index.php");
	}
?>
<?php
	if(isset($_GET['obrlistuz'])){
		$proizvodId = $_GET['obrlistuz'];
		$obrisiListu = $pr->obrisiListuZelja($kupId, $proizvodId);
	}
?>
<style>
table.tblone img{
	height:70px;
	width:80px;
}
</style>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Lista Zelja</h2>
						<table class="tblone">
							<tr>
								<th>SL</th>
								<th>Ime Proizvoda</th>
								<th>Cena</th>
								<th>Slika</th>
								<th>Radnja</th>
							</tr>
					<?php
						$proveriListuZ = $pr->proveriPodatkeListe($kupId);
						if($proveriListuZ){
							$i = 0;
							while($rez = $proveriListuZ->fetch_assoc()){
								$i++;
					?>
						<tr>
								<td><?php echo $i ?></td>
								<td><?php echo $rez['proizvodIme'] ?></td> 
								<td><?php echo $rez['cena'] ?></td>
								<td><img src="admin/<?php echo $rez['slika'] ?>" alt=""/></td>
								<td>
								<a href="details.php?proid=<?php echo $rez['proizvodId']; ?>">Kupi Sad<a/> ||
								<a href="?obrlistuz=<?php echo $rez['proizvodId']; ?>">Ukloni<a/>
								</td>
								
						</tr>
					<?php 
							}
						}
					?>
						</table>
					
					  
					</div>
					<div class="shopping">
						<div class="shopleft" style="width:100%; text-align:center;">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php include 'inc/footer.php'; ?>