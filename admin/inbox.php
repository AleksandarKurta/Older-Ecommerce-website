<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../classes/Korpa.php');
	$krp = new Korpa();
	$fm  = new Format();
?>
<?php
	if(isset($_GET['shiftid'])){
		$id = $_GET['shiftid'];
		$vreme  = $_GET['vreme'];
		$cena   = $_GET['cena'];
		$prebaci = $krp->prebacivanjeProizvoda($id,$vreme,$cena);
	}
	
	if(isset($_GET['obrpro'])){
		$id = $_GET['obrpro'];
		$vreme  = $_GET['vreme'];
		$cena   = $_GET['cena'];
		$obrisi = $krp->obrisiPrebacivanjeProizvoda($id,$vreme,$cena);
	}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
				<?php
					if(isset($prebaci)){
						echo $prebaci;
					}
				?>
				<?php
					if(isset($obrisi)){
						echo $obrisi;
					}
				?>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>ID</th>
							<th>Vreme Narudzbe</th>
							<th>Proizvod</th>
							<th>Kolicina</th>
							<th>Cena</th>
							<th>ID Kupca</th>
							<th>Adresa</th>
							<th>Radnja</th>
						</tr>
					</thead>
					<tbody>
				<?php
				$dobaviNarudzbu = $krp->dobaviSveNarudzbe();
					if($dobaviNarudzbu){
						while($rez = $dobaviNarudzbu->fetch_assoc()){
				?>
						<tr class="odd gradeX">
							<td><?php echo $rez['id'] ?></td>
							<td><?php echo $fm->formatDate($rez['datum']); ?></td>
							<td><?php echo $rez['proizvodIme'] ?></td>
							<td><?php echo $rez['kolicina'] ?></td>
							<td><?php echo $rez['cena'] ?></td>
							<td><?php echo $rez['kupId'] ?></td>
							<td><a href="kupac.php?kupaId=<?php echo $rez['kupId']; ?>">Vidi Detalje</a></td>
							<?php 
							if($rez['status'] == "0"){ ?>
							<td><a href="?shiftid=<?php echo $rez['kupId'] ?>&cena=<?php echo $rez['cena'] ?>&vreme=<?php echo $rez['datum'] ?> ">Prebaci</a></a></td>
							<?php	}elseif($rez['status'] == '1'){ ?>
									<td>Na Cekanju</td>
							<?php }else{ ?>
									<td><a href="?obrpro=<?php echo $rez['kupId']; ?>&cena=<?php echo $rez['cena']; ?>&vreme=<?php echo $rez['datum']; ?>">Ukloni</a></a></td>
							<?php } ?>
						</tr>
				<?php
						}
					}
				?>
						</tr>
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
