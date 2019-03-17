<?php include 'inc/header.php'; ?>
<?php
	if(!isset($_GET['search']) || $_GET['search'] == NULL){
		header("Location:404.php");
	}else{
		$search = $_GET['search'];
	}
?>
 <div class="main">
    <div class="content">
		<?php
			$query = "SELECT * FROM tbl_proizvod WHERE proizvodIme LIKE '%$search%' OR opis LIKE '%$search%'";
			$pro = $db->selekt($query);
			if($pro){
				while($result = $pro->fetch_assoc()){		
		?>		
			<div class="grid_1_of_4 images_1_of_4">
					  <a href="details.php?proid=<?php echo $result['proizvodId']; ?>"><img src="admin/<?php echo $result['slika']; ?>" alt="" /></a>
					 <h2><?php echo $result['proizvodIme']; ?></h2>
					 <p><?php echo $fm->textShorten($result['opis'],60); ?></p>
					 <p><span class="price">$<?php echo $result['cena']; ?></span></p>
				     <div class="button"><span><a href="details.php?proid=<?php echo $result['proizvodId']; ?>" class="details">Details</a></span></div>
				</div>
        <?php } }else{ ?>
					<p>Nema Rezultata Pretrage</p>
				<?php } ?>
      <div class="clear"></div>
    </div>
 </div>
 <?php include 'inc/footer.php'; ?>