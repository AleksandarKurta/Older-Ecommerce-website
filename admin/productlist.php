<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Proizvod.php'; ?>
<?php include_once '../helpers/Format.php'; ?>
<?php
	$pr = new Proizvod();
	$fm = new Format();
?>
<?php
	if(isset($_GET['izbrpro'])){
		$id = $_GET['izbrpro'];
		$id = preg_replace('/[^-a-zA-Z0-9_]/','', $_GET['izbrpro']);
		$izbrPro = $pr->izbrProPoId($id);
	}
		if(isset($_GET['actoff'])){
			$offid = $_GET['actoff'];
			$ukloniAkc = $pr->ukloniAkciju($offid);
		}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
        <div class="block">
		<?php
			if(isset($izbrPro)){
				echo $izbrPro;
			}
			if(isset($ukloniAkc)){
				echo $ukloniAkc;
			}
		?>
		<form action="" method="GET">	
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>SL</th>
					<th>Ime Proizvoda</th>
					<th>Kategorija</th>
					<th>Marka</th>
					<th>Opis</th>
					<th>Cena</th>
					<th>Slika</th>
					<th>Tip</th>
					<th>Akcija</th>
					<th>Radnja</th>
				</tr>
			</thead>
			<tbody>
			<?php
				$dobaviPr = $pr->dobaviSveProizvode();
				if($dobaviPr){
					$i = 0;
					while($rezultat = $dobaviPr->fetch_assoc()){
						$i++;
			?>
				<tr class="odd gradeX">
					<td><?php echo $i;?></td>
					<td><?php echo $rezultat['proizvodIme'];?></td>
					<td><?php echo $rezultat['katId'];?></td>
					<td><?php echo $rezultat['markaId'];?></td>
					<td><?php echo $fm->textShorten($rezultat['opis'], 50);?></td>
					<td><?php echo $rezultat['cena'];?>$</td>
					<td><img src="<?php echo $rezultat['slika'];?>" height="40px" width="60px"></td>
					<td>
						<?php 
							if($rezultat['tip'] == 0){
								echo "Istaknut";
							}else{
								echo "Opsti";
							}
						?>
					</td>
					<td><?php echo $rezultat['akcija'];?>

					<?php	if($rezultat['akcija'] != NULL){ ?>
						$ <a onclick="return confirm('Da li ste sigurni da zelite da Uklonite Akciju?')"
					href="?actoff=<?php echo $rezultat['proizvodId'] ?>">Ukloni</a>
					<?php }else{ 
						echo "Nije Na Akciji";
					}
					?></td>
					<td><a href="productedit.php?proid=<?php echo $rezultat['proizvodId'] ?>">Izmeni</a> || <a onclick="return confirm('Da li ste sigurni da zelite da Obrisete?')"
					href="?izbrpro=<?php echo $rezultat['proizvodId'] ?>">Obrisi</a></td>
				</tr>
			<?php
					}
				}
			?>
			</tbody>
		</table>
		</form>
       </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
