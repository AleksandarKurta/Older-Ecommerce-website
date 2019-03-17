<?php include 'inc/header.php'; ?>
<?php
	$logovanje = Session::get("kuplog");
	if($logovanje == true){
		header("Location:order.php");
	}
?>
<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['logovanje'])){
		$kupacLog = $ku->logovanjeKupca($_POST);
	}
?>
 <div class="main">
    <div class="content">
    	 <div class="login_panel">
		 <?php
			if(isset($kupacLog)){
				echo $kupacLog;
			}
		 ?>
        	<h3>Postojeci Kupac</h3>
        	<p>Ispunite formu ispod.</p>
        	<form action="" method="POST" >
                	<input name="email" placeholder="E-Mail" type="text" >
                    <input name="lozinka" placeholder="Lozinka" type="password" >
					<div class="buttons"><div><button class="grey" name="logovanje" >Ulogujte se</button></div></div>
                    </div>
            </form>
    <?php
		if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['registracija'])){
			$kupacReg = $ku->registracijaKupca($_POST);
		}
	?>
    	<div class="register_account">
	<?php
		if(isset($kupacReg)){
			echo $kupacReg;
		}
	?>
    		<h3>Registracija</h3>
    		<form action="" method="POST">
		   			 <table>
		   				<tbody>
						<tr>
						<td>
							<div>
							<input type="text" name="ime" placeholder="Ime" >
							</div>
							
							<div>
							   <input type="text" name="grad" placeholder="Grad">
							</div>
							
						
							<div>
								<input type="text" name="email" placeholder="E-Mail" >
							</div>
		    			 </td>
		    			<td>
						<div>
							<input type="text" name="adresa" placeholder="Adresa">
						</div>
		    		
		           <div>
		          <input type="text" name="telefon" placeholder="Telefon">
		          </div>
				  
				  <div>
					<input name="lozinka" placeholder="Lozinka" type="password" >
				</div>
		    	</td>
		    </tr> 
		    </tbody></table> 
		   <div class="search"><div><button class="grey" name="registracija">Napravite Nalog</button></div></div>
		    <p class="terms">By clicking 'Create Account' you agree to the <a href="#">Terms &amp; Conditions</a>.</p>
		    <div class="clear"></div>
		    </form>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php include 'inc/footer.php'; ?>