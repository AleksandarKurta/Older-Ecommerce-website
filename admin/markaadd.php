<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Marka.php'; ?>
<?php
	$ma = new Marka();
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$markaIme   = $_POST['markaIme'];
		$unesiMarku = $ma->unosMarke($markaIme);
	}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Dodaj Novu Marku</h2>
               <div class="block copyblock"> 
			    <?php
					if(isset($unesiMarku)){
						echo $unesiMarku;
					}
			    ?>
                 <form action="" method="POST">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="markaIme" placeholder="Enter Category Name..." class="medium" />
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