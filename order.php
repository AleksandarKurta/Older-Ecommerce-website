<?php include 'inc/header.php'; ?>
<?php
	$logovanje = Session::get("kuplog");
	if($logovanje == false){
		header("Location:login.php");
	}
?>
 <div class="main">
    <div class="content">
		<div class="section group">
			 <div class="order">
				<h2>Narucivanje</h2>
			 </div>
		 </div>
       <div class="clear"></div>
    </div>
 </div>
 <?php include 'inc/footer.php'; ?>