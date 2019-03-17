	<div class="header_bottom">
		<div class="header_bottom_left">
			<div class="section group">
			<?php
				$dobaviIphone = $pr->najnovijeOdIphone();
				if($dobaviIphone){
					while($rezultat = $dobaviIphone->fetch_assoc()){
			?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?proid=<?php echo $rezultat['proizvodId']; ?>"> <img src="admin/<?php echo $rezultat['slika']; ?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2><?php echo  $fm->textShorten($rezultat['proizvodIme'],10); ?></h2>
						<p><?php echo  $fm->textShorten($rezultat['opis'],40); ?></p>
						<div class="button"><span><a href="details.php?proid=<?php echo $rezultat['proizvodId']; ?>">Add to cart</a></span></div>
				   </div>
			   </div>	
			<?php
					}
				}
			?>
			<?php
				$dobaviAcer = $pr->najnovijeOdAcera();
				if($dobaviAcer){
					while($rezultat = $dobaviAcer->fetch_assoc()){
			?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?proid=<?php echo $rezultat['proizvodId']; ?>"> <img src="admin/<?php echo $rezultat['slika']; ?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2><?php echo  $fm->textShorten($rezultat['proizvodIme'],10); ?></h2>
						<p><?php echo  $fm->textShorten($rezultat['opis'],40); ?></p>
						<div class="button"><span><a href="details.php?proid=<?php echo $rezultat['proizvodId']; ?>">Add to cart</a></span></div>
				   </div>
			   </div>	
			<?php
					}
				}
			?>
			</div>
			<div class="section group">
			<?php
				$dobaviGorenje = $pr->najnovijeOdGorenje();
				if($dobaviGorenje){
					while($rezultat = $dobaviGorenje->fetch_assoc()){
			?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?proid=<?php echo $rezultat['proizvodId']; ?>"> <img src="admin/<?php echo $rezultat['slika']; ?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2><?php echo  $fm->textShorten($rezultat['proizvodIme'],10); ?></h2>
						<p><?php echo  $fm->textShorten($rezultat['opis'],40); ?></p>
						<div class="button"><span><a href="details.php?proid=<?php echo $rezultat['proizvodId']; ?>">Add to cart</a></span></div>
				   </div>
			   </div>	
			<?php
					}
				}
			?>
			<?php
				$dobaviMonitor = $pr->najnovijeOdMonitor();
				if($dobaviMonitor){
					while($rezultat = $dobaviMonitor->fetch_assoc()){
			?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?proid=<?php echo $rezultat['proizvodId']; ?>"> <img src="admin/<?php echo $rezultat['slika']; ?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2><?php echo  $fm->textShorten($rezultat['proizvodIme'],10); ?></h2>
						<p><?php echo  $fm->textShorten($rezultat['opis'],40); ?></p>
						<div class="button"><span><a href="details.php?proid=<?php echo $rezultat['proizvodId']; ?>">Add to cart</a></span></div>
				   </div>
			   </div>	
			<?php
					}
				}
			?>
			</div>
		  <div class="clear"></div>
		</div>
			 <div class="header_bottom_right_images">
		   <!-- FlexSlider -->
             
			<section class="slider">
				  <div class="flexslider">
					<ul class="slides">
						<li><img src="images/1.jpg" alt=""/></li>
						<li><img src="images/2.jpg" alt=""/></li>
						<li><img src="images/3.jpg" alt=""/></li>
						<li><img src="images/4.jpg" alt=""/></li>
				    </ul>
				  </div>
	      </section>
<!-- FlexSlider -->
	    </div>
	  <div class="clear"></div>
  </div>