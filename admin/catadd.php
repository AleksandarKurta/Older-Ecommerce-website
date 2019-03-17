<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Kategorija.php'; ?>
<?php
	$kat = new Kategorija();
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$katIme   = $_POST['katIme'];
		$unesiKat = $kat->kategorijaUnos($katIme);
	}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add New Category</h2>
               <div class="block copyblock"> 
			    <?php
					if(isset($unesiKat)){
						echo $unesiKat;
					}
			    ?>
                 <form action="catadd.php" method="POST">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="katIme" placeholder="Enter Category Name..." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>