<?php include 'inc/header.php'; ?>
<?php
	$logovanje = Session::get("kuplog");
	if($logovanje == false){
		header("Location:login.php");
	}
?>
<style>
.tblone{width: 550px; margin:0 auto; border:2px solid #ddd;}
.tblone tr td{text-align:justify;}
</style>
 <div class="main">
    <div class="content">
    	<div class="section group">
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
<?php include 'inc/footer.php'; ?>