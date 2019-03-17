<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Kategorija.php'; ?>
<?php
	$kat = new Kategorija();
	if(isset($_GET['obrkat'])){
		$id = preg_replace('/[^-a-zA-Z0-9_]/','', $_GET['obrkat']);
		$obrisiKat = $kat->obrisiKategorijuPoId($id);
	}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
                <div class="block">  
					<?php 
						if(isset($obrisiKat)){
							echo $obrisiKat;
						}
					?>				
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$dobaviKat = $kat->dobaviKategorije();
							if($dobaviKat){
								$i = 0;
								while($rez = $dobaviKat->fetch_assoc()){
								$i++;
					?>
						<tr class="odd gradeX">
							<td><?php echo $i ; ?></td>
							<td><?php echo $rez['katIme']; ?></td>
							<td><a href="catedit.php?katid=<?php  echo $rez['katId']; ?>">Edit</a> || <a onclick="return confirm('Are you sure to Delete!')" href="?obrkat=<?php echo $rez['katId']; ?>">Delete</a></td>
						</tr>
					<?php
								}
							}
					?>
					</tbody>
				</table>
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

