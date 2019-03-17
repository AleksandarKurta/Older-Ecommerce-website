<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Kategorija.php'; ?>
<?php
	if(!isset($_GET['katid']) || $_GET['katid'] == NULL){
		echo "<script>window.location = 'catlist.php'; </script>";
	}else{
		$id = preg_replace('/[^-a-zA-Z0-9_]/','', $_GET['katid']);
	}
	
	$kat = new Kategorija();
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$katIme   = $_POST['katIme'];
		$izmeniKat = $kat->kategorijaIzmena($katIme,$id);
	}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Izmeni Kategoriju</h2>
               <div class="block copyblock"> 
			    <?php
					if(isset($izmeniKat)){
						echo $izmeniKat;
					}
			    ?>
				<?php
					$dobaviKat = $kat->dobaviKatPoId($id);
					if($dobaviKat){
						while($rezultat = $dobaviKat->fetch_assoc()){	
				?>
                 <form action="" method="POST">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="katIme" value="<?php echo $rezultat['katIme'] ?>" class="medium" />
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