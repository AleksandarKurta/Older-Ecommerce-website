<?php include 'inc/header.php'; ?>
<?php
	$logovanje = Session::get("kuplog");
	if($logovanje == false){
		header("Location:login.php");
	}
?>
<?php
	$kupId = Session::get("kupId");
	if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])){
		$azuriraj = $ku->azurirajDetaljeKupca($_POST, $kupId);
	}
?>
<style>
.tblone{width: 550px; margin:0 auto; border:2px solid #ddd;}
.tblone tr td{text-align:justify;}
.tblone input[type="text"]{width: 400px;padding: 5px; font-size: 15px;}
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
		<form action="" method="POST">
			<table class="tblone">
		<?php
			if(isset($azuriraj)){
				echo "<tr><td colspan='2'>" . $azuriraj . "</td></tr>";
			}
		?>
			<tr>
				<td colspan="3"><h2>Azuriranje Vaseg Profila</h2></td>
			</tr>
			<tr>
				<td width="20%">Ime</td>
				<td><input type="text" name="ime" value="<?php echo $rez['ime']; ?>"></td>
		    </tr>
			<tr>
				<td>Grad</td>
				<td><input type="text" name="grad" value="<?php echo $rez['grad']; ?>"></td>
		    </tr>
			<tr>
				<td>E-mail</td>
				<td><input type="text" name="email" value="<?php echo $rez['email']; ?>"></td>
		    </tr>
			<tr>
				<td>Adresa</td>
				<td><input type="text" name="adresa" value="<?php echo $rez['adresa']; ?>"></td>
		    </tr>
			<tr>
				<td>Telefon</td>
				<td><input type="text" name="telefon" value="<?php echo $rez['telefon']; ?>"></td>
		    </tr>
		
			<td><input type="submit" name="submit" value="Sacuvaj"></td>
			</table>

		</form>
		<?php
				}
			}
		?>
		</div>
 		</div>
 	</div>
<?php include 'inc/footer.php'; ?>