<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Marka.php'; ?>
<?php
	$ma = new Marka();
	if(isset($_GET['obrmarku'])){
		$id = preg_replace('/[^-a-zA-Z0-9_]/','', $_GET['obrmarku']);
		$obrisiMarku = $ma->obrisiMarkuPoId($id);
	}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
                <div class="block">  
					<?php 
						if(isset($obrisiMarku)){
							echo $obrisiMarku;
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
						$ma = new Marka();
						$dobaviMarke = $ma->dobaviSveMarke();
							if($dobaviMarke){
								$i = 0;
								while($rez = $dobaviMarke->fetch_assoc()){
								$i++;
					?>
						<tr class="odd gradeX">
							<td><?php echo $i ; ?></td>
							<td><?php echo $rez['markaIme']; ?></td>
							<td><a href="markaedit.php?markaid=<?php  echo $rez['markaId']; ?>">Edit</a> || <a onclick="return confirm('Are you sure to Delete!')" href="?obrmarku=<?php echo $rez['markaId']; ?>">Delete</a></td>
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