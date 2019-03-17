<?php include 'inc/header.php'; ?>
<?php include 'inc/slider.php'; ?>	
 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Istaknuti Proizvodi</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
			<?php
				$istPro = $pr->istaknutiProizvod();
				if($istPro){
					while($rezultat = $istPro->fetch_assoc()){
			?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?proid=<?php echo $rezultat['proizvodId']; ?>"><img src="admin/<?php echo $rezultat['slika']; ?>" alt="" /></a>
					 <h2><?php echo $rezultat['proizvodIme']; ?></h2>
					 <p><?php echo $fm->textShorten($rezultat['opis'],60); ?></p>
					 <p><span class="price"><?php echo $rezultat['cena']; ?> €</span></p>
				     <div class="button"><span><a href="details.php?proid=<?php echo $rezultat['proizvodId']; ?>" class="details">Details</a></span></div>
				</div>
			<?php
					}
				}
			?>
			</div>
		<div class="content_bottom">
    		<div class="heading">
    		<h3>Novi Proizvodi</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">
			<?php 
				$djp = $pr->dobaviNoviProizvod();
				if($djp){
					while($rezultat = $djp->fetch_assoc()){			
			?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?proid=<?php echo $rezultat['proizvodId']; ?>"><img src="admin/<?php echo $rezultat['slika']; ?>" alt="" /></a>
					 <h2><?php echo $rezultat['proizvodIme']; ?></h2>
					 <p><span class="price"><?php echo $rezultat['cena']; ?> €</span></p>
				      <div class="button"><span><a href="details.php?proid=<?php echo $rezultat['proizvodId']; ?>" class="details">Details</a></span></div>
				</div>
			<?php
					}
				}
			?>
				    
			</div>
			
		<div class="content_bottom">
    		<div class="heading">
    		<h3>Proizvodi Na Akciji</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">
			<?php 
				$proAkcija = $pr->dobaviProNaAkciji();
				if($proAkcija){
					while($rezultat = $proAkcija->fetch_assoc()){			
			?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?proid=<?php echo $rezultat['proizvodId']; ?>"><img src="admin/<?php echo $rezultat['slika']; ?>" alt="" /></a>
					 <h2><?php echo $rezultat['proizvodIme']; ?></h2>
					 <p><span class="price">Stara Cena: <?php echo $rezultat['cena']; ?> €</span></p>
					 <h4><span class="price">Akcija: <?php echo $rezultat['akcija']; ?> €</span></h4>
				      <div class="button"><span><a href="details.php?proid=<?php echo $rezultat['proizvodId']; ?>" class="details">Details</a></span></div>
				</div>
			<?php
					}
				}
			?>
				    
			</div>
	</div>
    </div>
 </div>
</div>
<?php include 'inc/footer.php'; ?>
