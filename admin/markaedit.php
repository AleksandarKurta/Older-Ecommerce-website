<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Marka.php'; ?>
<?php
	if(!isset($_GET['markaid']) || $_GET['markaid'] == NULL){
		echo "<script>window.location = 'markalista.php'; </script>";
	}else{
		$id = preg_replace('/[^-a-zA-Z0-9_]/','', $_GET['markaid']);
	}
	
	$ma = new Marka();
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$markaIme   = $_POST['markaIme'];
		$izmeniMarku = $ma->markaIzmena($markaIme,$id);
	}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Izmeni Marku</h2>
               <div class="block copyblock"> 
			    <?php
					if(isset($izmeniMarku)){
						echo $izmeniMarku;
					}
			    ?>
				<?php
					$dobaviMarku = $ma->dobaviMarkuPoId($id);
					if($dobaviMarku){
						while($rezultat = $dobaviMarku->fetch_assoc()){
				?>
                 <form action="" method="POST">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="markaIme" value="<?php echo $rezultat['markaIme'] ?>" class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
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