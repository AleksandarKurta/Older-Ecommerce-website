<?php include 'inc/header.php'; ?>
<?php
	$login = Session::get("kuplog");
	if($login == false){
		header("Location:index.php");
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
			    	<h2>Poredi</h2>
						<table class="tblone">
							<tr>
								<th>SL</th>
								<th>Ime Proizvoda</th>
								<th>Cena</th>
								<th>Slika</th>
								<th>Radnja</th>
							</tr>
					<?php
						$kupId = Session::get("kupId");
						$dobaviPod = $pr->dobaviPodatkePoredjenja($kupId);
						if($dobaviPod){
							$i = 0;
							while($rez = $dobaviPod->fetch_assoc()){
								$i++;
					?>
						<tr>
								<td><?php echo $i ?></td>
								<td><?php echo $rez['proizvodIme'] ?></td> 
								<td><?php echo $rez['cena'] ?></td>
								<td><img src="admin/<?php echo $rez['slika'] ?>" alt=""/></td>
								<td><a href="details.php?proid=<?php echo $rez['proizvodId']; ?>">Pregled</a></td>
								
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