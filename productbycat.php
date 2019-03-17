<?php include 'inc/header.php'; ?>
<?php
	if(!isset($_GET['katId']) || $_GET['katId'] == NULL){
		echo "<script>window.location = '404.php'; </script>";
	}else{
		$id = preg_replace('/[^-a-zA-Z0-9_]/','', $_GET['katId']);
	}
?>
 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Poslednje iz Kategorije</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
			<?php
				$propokat = $pr->proizvodPoKategoriji($id);
				if($propokat){
					while($rezultat = $propokat->fetch_assoc()){
			?>
				<div class="grid_1_of_4 images_1_of_4">
					  <a href="details.php?proid=<?php echo $rezultat['proizvodId']; ?>"><img src="admin/<?php echo $rezultat['slika']; ?>" alt="" /></a>
					 <h2><?php echo $rezultat['proizvodIme']; ?></h2>
					 <p><?php echo $fm->textShorten($rezultat['opis'],60); ?></p>
					 <p><span class="price">$<?php echo $rezultat['cena']; ?></span></p>
				     <div class="button"><span><a href="details.php?proid=<?php echo $rezultat['proizvodId']; ?>" class="details">Details</a></span></div>
				</div>
			<?php
					}
				}else{
					echo "<p>Proizvodi iz ove Kategorije nisu trenutno dostupni !</p>";
				}	
			?>
			</div>

	
	
    </div>
 </div>
<?php include 'inc/footer.php'; ?>