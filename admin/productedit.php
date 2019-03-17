<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Proizvod.php'; ?>
<?php include '../classes/Kategorija.php'; ?>
<?php include '../classes/Marka.php'; ?>
<?php
	if(!isset($_GET['proid']) || $_GET['proid'] == NULL){
		echo "<script>window.location = 'productlist.php'; </script>";
	}else{
		$id = preg_replace('/[^-a-zA-Z0-9_]/','', $_GET['proid']);
	}
	$pr = new Proizvod();
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
		$azuPro = $pr->azurirajProizvod($_POST, $_FILES, $id);
	}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Izmeni Proizvod</h2>
        <div class="block">  
		<?php
			if(isset($azuPro)){
				echo $azuPro;
			}
		?>
		<?php
			$dobaviPro = $pr->dobaviProPoId($id);
			if($dobaviPro){
				while($vrednost = $dobaviPro->fetch_assoc()){
		?>
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Ime</label>
                    </td>
                    <td>
                        <input type="text" name="proizvodIme" value="<?php echo $vrednost['proizvodIme']; ?>" class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Kategorija</label>
                    </td>
                    <td>
				          <select id="select" name="katId" >
                            <option>Izaberi Kategoriju</option>
							<?php
								$kat = new Kategorija();
								$dobaviKat = $kat->dobaviKategorije();
								if($dobaviKat){
									while($rezultat = $dobaviKat->fetch_assoc()){
								
							?>
                            <option 
								<?php 
									if($vrednost['katId'] == $rezultat['katId']){ ?>
										selected = "selected"
								<?php	} 	?>
							value="<?php echo $rezultat['katId']; ?>"><?php echo $rezultat['katIme']; ?></option>
							<?php 	
									}
								}
							?>
                        </select>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Marka</label>
                    </td>
                    <td>
                        <select id="select" name="markaId">
                            <option>Izaberi Marku</option>
                           <?php
								$ma = new Marka();
								$dobaviMarku = $ma->dobaviSveMarke();
								if($dobaviMarku){
									while($rezultat = $dobaviMarku->fetch_assoc()){
								
							?>
                            <option 
								<?php
									if($vrednost['markaId'] == $rezultat['markaId']){ ?>
										selected = "selected"
								<?php	} ?>
							value="<?php echo $rezultat['markaId']; ?>"><?php echo $rezultat['markaIme']; ?></option>
							<?php 	
									}
								}
							?>
                        </select>
                    </td>
                </tr>
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Opis</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name="opis"><?php echo $vrednost['opis']; ?></textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Cena</label>
                    </td>
                    <td>
                        <input type="text" name="cena" value="<?php echo $vrednost['cena']; ?>" class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Unesi Sliku</label>
                    </td>
                    <td>
						<img src="<?php echo $vrednost['slika'];?>" height="80px" width="120px"/>
						<br/>
                        <input type="file" name="slika"/>
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Akcija</label>
                    </td>
                    <td>
                        <input type="text" name="akcija" value="<?php echo $vrednost['akcija']; ?>" class="medium" />
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Tip Proizvoda</label>
                    </td>
                    <td>
                        <select id="select" name="tip">
                            <option>Izaberi Tip</option>
                            <?php 
								if($vrednost['tip'] == 0){ ?>
									<option selected = "selected" value="0">Istaknut</option>
									<option value="1">Opsti</option>
							<?php }else { ?>
									<option value="0">Istaknut</option>
									<option  selected = "selected" value="1">Opsti</option>
							<?php } ?>
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Azuriraj" />
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
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>
