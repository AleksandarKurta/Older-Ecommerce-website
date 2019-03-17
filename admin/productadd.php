<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Proizvod.php'; ?>
<?php include '../classes/Kategorija.php'; ?>
<?php include '../classes/Marka.php'; ?>
<?php
	$pr = new Proizvod();
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
		$unesiProizvod = $pr->unosProizvoda($_POST, $_FILES);
	}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Product</h2>
        <div class="block">  
		<?php
			if(isset($unesiProizvod)){
				echo $unesiProizvod;
			}
		?>
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Ime</label>
                    </td>
                    <td>
                        <input type="text" name="proizvodIme" placeholder="Unesi Ime Proizvoda..." class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Kategorija</label>
                    </td>
                    <td>
				          <select id="select" name="katId">
                            <option>Izaberi Kategoriju</option>
							<?php
								$kat = new Kategorija();
								$dobaviKat = $kat->dobaviKategorije();
								if($dobaviKat){
									while($rezultat = $dobaviKat->fetch_assoc()){
								
							?>
                            <option value="<?php echo $rezultat['katId']; ?>"><?php echo $rezultat['katIme']; ?></option>
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
                            <option value="<?php echo $rezultat['markaId']; ?>"><?php echo $rezultat['markaIme']; ?></option>
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
                        <textarea class="tinymce" name="opis"></textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Cena</label>
                    </td>
                    <td>
                        <input type="text" name="cena" placeholder="Unesi Cenu..." class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Unesi Sliku</label>
                    </td>
                    <td>
                        <input type="file" name="slika"/>
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Akcija</label>
                    </td>
                    <td>
                        <input type="text" name="akcija" placeholder="Unesi Cenu Za Akciju..." class="medium" /> 
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Tip Proizvoda</label>
                    </td>
                    <td>
                        <select id="select" name="tip">
                            <option>Izaberi Tip</option>
                            <option value="0">Istaknut</option>
                            <option value="1">Opsti</option>
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Save" />
                    </td>
                </tr>
            </table>
            </form>
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


