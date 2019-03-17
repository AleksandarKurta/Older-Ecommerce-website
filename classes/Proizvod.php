<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
?>
<?php

class Proizvod{
	
	public $db;
	public $fm;
	
	public function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}
	
	public function unosProizvoda($data, $file){
		$proizvodIme = mysqli_real_escape_string($this->db->link,$data['proizvodIme']);
		$katId = mysqli_real_escape_string($this->db->link,$data['katId']);
		$markaId = mysqli_real_escape_string($this->db->link,$data['markaId']);
		$opis 	     = mysqli_real_escape_string($this->db->link,$data['opis']);
		$cena 	     = mysqli_real_escape_string($this->db->link,$data['cena']);
		$akcija        = mysqli_real_escape_string($this->db->link,$data['akcija']);
		$tip        = mysqli_real_escape_string($this->db->link,$data['tip']);
		
		$permited  = array('jpg', 'jpeg', 'png', 'gif');
		$file_name = $file['slika']['name'];
		$file_size = $file['slika']['size'];
		$file_temp = $file['slika']['tmp_name'];
	
		$div = explode('.', $file_name);
		$file_ext = strtolower(end($div));
		$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
		$uploaded_image = "uploads/".$unique_image;
		
		if($proizvodIme == "" || $katId == "" || $markaId == ""  || $opis == "" || $cena == "" || $file_name== "" || $tip == "" ){
			$poruka = "<span class='error'>Polja ne smeju biti prazna !</span>";
			return $poruka;
		
		}elseif ($file_size >1048567) {
		echo "<span class='error'>Image Size should be less then 1MB!
		</span>";
		} elseif (in_array($file_ext, $permited) === false) {
		echo "<span class='error'>You can upload only:-"
		.implode(', ', $permited)."</span>";
		
		}else{
			move_uploaded_file($file_temp, $uploaded_image);
			$query = "INSERT INTO tbl_proizvod(proizvodIme, katId, markaId, opis, cena, slika, akcija, tip) VALUES ('$proizvodIme','$katId','$markaId','$opis','$cena','$uploaded_image','$akcija','$tip')";
			$insert_row = $this->db->unos($query);
			if($insert_row){
				$poruka = "<span class='uspesno'>Proizvod Uspesno Unet.</span>";
				return $poruka;
			}else{
				$poruka = "<span class='greska'>Proizvod Neuspesno Unet.</span>";
				return $poruka;
			}	
		}
	}
	
	public function dobaviSveProizvode(){
		$query = "SELECT p.*, k.katIme,m.markaIme
				  FROM tbl_proizvod as p, tbl_kategorija as k, tbl_marka as m
				  WHERE p.katId = k.katId AND p.markaId = m.markaId
				  ORDER BY p.proizvodId DESC";
		/*
		$query = "SELECT tbl_proizvod.*,tbl_kategorija.katIme,
		tbl_marka.markaIme
		FROM tbl_proizvod
		INNER JOIN tbl_kategorija
		ON tbl_proizvod.katId = tbl_kategorija.katId
		INNER JOIN tbl_marka
		ON tbl_proizvod.markaId = tbl_marka.markaId
		ORDER BY tbl_proizvod.proizvodId DESC";
		*/
		$rezultat = $this->db->selekt($query);
		return $rezultat;
	}
	
	public function dobaviProPoId($id){
		$query = "SELECT * FROM tbl_proizvod WHERE proizvodId = '$id'";
		$rezultat = $this->db->selekt($query);
		return $rezultat;
	}
	
	public function azurirajProizvod($data, $file, $id){
		$proizvodIme = mysqli_real_escape_string($this->db->link,$data['proizvodIme']);
		$katId = mysqli_real_escape_string($this->db->link,$data['katId']);
		$markaId = mysqli_real_escape_string($this->db->link,$data['markaId']);
		$opis 	     = mysqli_real_escape_string($this->db->link,$data['opis']);
		$cena 	     = mysqli_real_escape_string($this->db->link,$data['cena']);
		$akcija        = mysqli_real_escape_string($this->db->link,$data['akcija']);
		$tip        = mysqli_real_escape_string($this->db->link,$data['tip']);
		
		$permited  = array('jpg', 'jpeg', 'png', 'gif');
		$file_name = $file['slika']['name'];
		$file_size = $file['slika']['size'];
		$file_temp = $file['slika']['tmp_name'];
	
		$div = explode('.', $file_name);
		$file_ext = strtolower(end($div));
		$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
		$uploaded_image = "uploads/".$unique_image;
		
		if($proizvodIme == "" || $katId == "" || $markaId == ""  || $opis == "" || $cena == "" ||  $tip == "" ){
			$poruka = "<span class='error'>Polja ne smeju biti prazna !</span>";
			return $poruka;
		}else{
			if(!empty($file_name)){
		
		if ($file_size >1048567) {
		echo "<span class='error'>Image Size should be less then 1MB!
		</span>";
		} elseif (in_array($file_ext, $permited) === false) {
		echo "<span class='error'>You can upload only:-"
		.implode(', ', $permited)."</span>";
		
		}else{
			move_uploaded_file($file_temp, $uploaded_image);
			$query = "UPDATE tbl_proizvod
					SET
					proizvodIme = '$proizvodIme',
					katId 		= '$katId',
					markaId 	= '$markaId',
					opis	    = '$opis',
					cena        = '$cena',
					slika 		= '$slika',
					akcija 		= '$akcija',
					tip 		= '$tip'
					WHERE proizvodId = '$id'";
				
			$updated_row = $this->db->izmena($query);
			if($updated_row){
				$msg = "<span class='succes'>Product Updated Successfully.</span>";
				return $msg;
			}else{
				$msg = "<span class='error'>Product Not Updated.</span>";
				return $msg;
			}	
		}
	}else{
			$query = "UPDATE tbl_proizvod
					SET
					proizvodIme = '$proizvodIme',
					katId 		= '$katId',
					markaId 	= '$markaId',
					opis	    = '$opis',
					cena        = '$cena',
					akcija 		= '$akcija',
					tip 		= '$tip'
					WHERE proizvodId = '$id'";
				
			$updated_row = $this->db->izmena($query);
			if($updated_row){
				$poruka = "<span class='uspesno'>Proizvod Uspesno Izmenjen.</span>";
				return $poruka;
			}else{
				$poruka = "<span class='uspesno'>Proizvod Neuspesno Izmenjen.</span>";
				return $poruka;
			}
		}
	  }
	}
	
	public  function izbrProPoId($id){
		$query = "SELECT * FROM tbl_proizvod WHERE proizvodId = '$id'";
		$getData = $this->db->selekt($query);
		if($getData){
			while($delImg = $getData->fetch_assoc()){
				$dellink = $delImg['slika'];
				unlink($dellink);
			}
		}
		
		$delquery = "DELETE FROM tbl_proizvod WHERE proizvodId = '$id'";
		$deldata = $this->db->obrisi($delquery);
		if($deldata){
			$poruka = "<span class='uspesno'>Proizvod Uspesno Obrisan.</span>";
			return $poruka;
		}else{
			$poruka = "<span class='uspesno'>Proizvod Neuspesno Obrisan.</span>";
			return $poruka;
		}
	}
	
	public function istaknutiProizvod(){
		$query = "SELECT * FROM tbl_proizvod WHERE tip ='0' ORDER BY proizvodId DESC LIMIT 5";
		$rezultat = $this->db->selekt($query);
		return $rezultat;
	}
	
	public function dobaviNoviProizvod(){
		$query = "SELECT * FROM tbl_proizvod ORDER BY proizvodId DESC LIMIT 5";
		$rezultat = $this->db->selekt($query);
		return $rezultat;
	}
	
	public function dobaviJedanProizvod($id){
		$query = "SELECT p.*, k.katIme,m.markaIme
				  FROM tbl_proizvod as p, tbl_kategorija as k, tbl_marka as m
				  WHERE p.katId = k.katId AND p.markaId = m.markaId AND p.proizvodId = '$id'";
		$rezultat = $this->db->selekt($query);
		return $rezultat;
	}
	
	public function najnovijeOdIphone(){
		$query = "SELECT * FROM tbl_proizvod WHERE markaId = '6' ORDER BY proizvodIme DESC LIMIT 1";
		$rezultat = $this->db->selekt($query);
		return $rezultat;
	}
	
	public function najnovijeOdAcera(){
		$query = "SELECT * FROM tbl_proizvod WHERE markaId = '12' ORDER BY proizvodIme DESC LIMIT 1";
		$rezultat = $this->db->selekt($query);
		return $rezultat;
	}
	
	public function najnovijeOdGorenje(){
		$query = "SELECT * FROM tbl_proizvod WHERE markaId = '15' ORDER BY proizvodIme DESC LIMIT 1";
		$rezultat = $this->db->selekt($query);
		return $rezultat;
	}
	
	public function najnovijeOdMonitor(){
		$query = "SELECT * FROM tbl_proizvod WHERE markaId = '16' ORDER BY proizvodIme DESC LIMIT 1";
		$rezultat = $this->db->selekt($query);
		return $rezultat;
	}
	
	public function proizvodPoKategoriji($id){
		$query = "SELECT * FROM tbl_proizvod WHERE katId = '$id'";
		$rezultat = $this->db->selekt($query);
		return $rezultat;
	}
	
	public function  unesiPodatkeZaPoredjenje($cmprid ,$kupId){
		$kupId = mysqli_real_escape_string($this->db->link,$kupId);
		$proizvodId = mysqli_real_escape_string($this->db->link,$cmprid);
		$cquery = "SELECT * FROM tbl_uporedi WHERE kupId = '$kupId' AND proizvodId = '$proizvodId'";
		$provera = $this->db->selekt($cquery);
		if($provera){
			$msg = "<span class='greska'>Vec Dodato.</span>";
			return $msg;
		}
		$query = "SELECT * FROM tbl_proizvod WHERE proizvodId = '$proizvodId'";
		$rezultat = $this->db->selekt($query)->fetch_assoc();
		if($rezultat){
				$proizvodId = $rezultat['proizvodId'];
				$proizvodIme = $rezultat['proizvodIme'];
				$cena = $rezultat['cena'];
				$slika = $rezultat['slika'];
				
			$query = "INSERT INTO tbl_uporedi(kupId, proizvodId, proizvodIme, cena, slika ) VALUES ('$kupId', '$proizvodId', '$proizvodIme','$cena', '$slika')";
			$insert_row = $this->db->unos($query);
			
			if($insert_row){
				$poruka = "<span class='uspesno'>Uspesno Dodato na Poredjenje</span>";
				return $poruka;
			}else{
				$poruka = "<span class='uspesno'>Neuspesno Dodato na Poredjenje</span>";
				return $poruka;
			}
		}
	}
	
	public function dobaviPodatkePoredjenja($kupId){
		$query = "SELECT * FROM tbl_uporedi WHERE kupId = '$kupId' ORDER BY id DESC";
		$rezultat = $this->db->selekt($query);
		return $rezultat;
	}
	
	public function obrisiPodatkePoredjenja($kupId){
		$query = "DELETE FROM tbl_uporedi WHERE kupId = '$kupId'";
		$deldata = $this->db->obrisi($query);
	}
	
	public function sacuvajPodatkeListeZelja($id ,$kupId){
		$cquery = "SELECT * FROM tbl_listaz WHERE kupId = '$kupId' AND proizvodId = '$id'";
		$provera = $this->db->selekt($cquery);
		if($provera){
			$msg = "<span class='greska'>Vec Dodato.</span>";
			return $msg;
		}
		$query = "SELECT * FROM tbl_proizvod WHERE proizvodId = '$id'";
		$getPro = $this->db->selekt($query);
		if($getPro){
			while($rezultat = $getPro->fetch_assoc()){
				$proizvodId = $rezultat['proizvodId'];
				$proizvodIme = $rezultat['proizvodIme'];
				$cena = $rezultat['cena'];
				$slika = $rezultat['slika'];
				
			$query = "INSERT INTO tbl_listaz(kupId, proizvodId, proizvodIme, cena, slika ) VALUES ('$kupId', '$proizvodId', '$proizvodIme','$cena', '$slika')";
			$insert_row = $this->db->unos($query);
			
			if($insert_row){
				$poruka = "<span class='uspesno'>Uspesno Dodato na listu</span>";
				return $poruka;
			}else{
				$poruka = "<span class='uspesno'>Neuspesno Dodato na Listu</span>";
				return $poruka;
			}
		}
	  }
	}
	
	public function proveriPodatkeListe($kupId){
		$query = "SELECT * FROM tbl_listaz WHERE kupId = '$kupId' ORDER BY id DESC";
		$rezultat = $this->db->selekt($query);
		return $rezultat;
	}
	
	public function obrisiListuZelja($kupId, $proizvodId){
		$query = "DELETE FROM tbl_listaz WHERE kupId = '$kupId' AND proizvodId = '$proizvodId'";
		$deldata = $this->db->obrisi($query);
	}
	
	public function unesiKomentar($komentar,$id,$kupId){
		$komentar = mysqli_real_escape_string($this->db->link,$komentar);
		$id = mysqli_real_escape_string($this->db->link,$id);
		$kupId = mysqli_real_escape_string($this->db->link,$kupId);
		
		if($komentar == "" || $id == "" || $kupId == ""){
			$poruka = "<span class='error'>Polja ne smeju biti prazna !</span>";
			return $poruka;
		}else{
			$query = "INSERT INTO tbl_komentar(komentar, proizvodId, kupId) VALUES ('$komentar', '$id', '$kupId')";
		$insert_row = $this->db->unos($query);
		}
	}
	
	public function dobaviKomentare($id){
		$query = "SELECT tbl_komentar.komentar , tbl_komentar.vreme , tbl_kupac.ime
		FROM tbl_komentar LEFT JOIN tbl_kupac
		ON tbl_komentar.kupId = tbl_kupac.id
		WHERE proizvodId = '$id'";
		$rezultat = $this->db->selekt($query);
		return $rezultat;
	}
	
	public function dobaviProNaAkciji(){
		$query = "SELECT * FROM tbl_proizvod WHERE akcija != '0' ORDER BY proizvodId DESC LIMIT 5";
		$rezultat = $this->db->selekt($query);
		return $rezultat;
	}
	
	public function ukloniAkciju($offid){
		$query = "UPDATE tbl_proizvod SET
				akcija = NULL
				WHERE proizvodId = '$offid'";
		$updated_row = $this->db->izmena($query);
		if($updated_row){
			$poruka = "<span class='uspesno'>Proizvod Uspesno Skinut Sa Akcije</span>";
			return $poruka;
		}else{
			$poruka = "<span class='uspesno'>Skidanje Akcije Neuspesno</span>";
			return $poruka;
		}
	}
}
?>