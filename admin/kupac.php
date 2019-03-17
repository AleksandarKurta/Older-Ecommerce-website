<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../classes/Kupac.php');
?>
<?php
	if(!isset($_GET['kupaId']) || $_GET['kupaId'] == NULL){
		echo "<script>window.location = 'inbox.php'; </script>";
	}else{
		$id = preg_replace('/[^-a-zA-Z0-9_]/','', $_GET['kupaId']);
	}
	
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		echo "<script>window.location = 'inbox.php'; </script>";
	}
?>
        <div class="grid_10">
            <div class="box round first grid">
				<h2>Detalji Kupca</h2>
				<div class="block copyblock"> 
            <?php
			$ku = new Kupac();
			$podatci = $ku->dobaviPodatkeKupca($id);
			if($podatci){
				while($rez = $podatci->fetch_assoc()){
		?>
			<form action="" method="post">
                    <table class="form">					
                        <tr>
							<td>Ime</td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $rez['ime']; ?>" class="medium" />
                            </td>
                        </tr>
						
					    <tr>
							<td>Adresa</td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $rez['adresa']; ?>" class="medium" />
                            </td>
                        </tr>
						
						<tr>
							<td>Grad</td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $rez['grad']; ?>" class="medium" />
                            </td>
                        </tr>
	
						<tr>
							<td>Telefon</td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $rez['telefon']; ?>" class="medium" />
                            </td>
                        </tr>
						
						<tr>
							<td>Email</td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $rez['email']; ?>" class="medium" />
                            </td>
                        </tr>
						
						
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="OK" />
                            </td>
                        </tr>
                    </table>
                    </form>
		<?php
				}
			}
		?>
				</div>
            </div>
        </div>
<?php include 'inc/footer.php';?>