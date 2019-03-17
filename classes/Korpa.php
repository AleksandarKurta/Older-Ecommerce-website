<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
?>
<?php

class Korpa{
	
	private $db;
	private $fm;
	
	public function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}
	
	public function dodajUKorpu($kolicina,$id){
		$kolicina = $this->fm->validation($kolicina);
		$kolicina = mysqli_real_escape_string($this->db->link,$kolicina);
		$proizvodId = mysqli_real_escape_string($this->db->link,$id);
		$sId = session_id();
		$query = "SELECT * FROM tbl_proizvod WHERE proizvodId = '$proizvodId'";
		$rezultat = $this->db->selekt($query)->fetch_assoc();
		
		$proizvodIme = $rezultat['proizvodIme'];
		$cena 		 = $rezultat['cena'];
		$slika 		 = $rezultat['slika'];
		
		$query = "SELECT * FROM tbl_korpa WHERE proizvodId = '$proizvodId' AND sId = '$sId'";
		$dobaviPro = $this->db->selekt($query);
		if($dobaviPro){
			$poruka = "Proizvod je vec dodat.";
			return $poruka;
		}else{
			$query = "INSERT INTO tbl_korpa(sId, proizvodId, proizvodIme, cena, kolicina, slika) VALUES('$sId', '$proizvodId', '$proizvodIme', '$cena', '$kolicina', '$slika')";
			
			$unos = $this->db->unos($query);
			if($unos){
				header("Location:cart.php");
			}else{
				header("Location:404.php");
			}	
		}
	}
	
	public function dobaviProIzKorpe(){
		$sId = session_id();
		$query = "SELECT * FROM tbl_korpa WHERE sId = '$sId'";
		$rezultat = $this->db->selekt($query);
		return $rezultat;
	}
	
	public function azurirajKolicinu($korpaId,$kolicina){
		$korpaId  = mysqli_real_escape_string($this->db->link,$korpaId);
		$kolicina = mysqli_real_escape_string($this->db->link,$kolicina);
		$query = "UPDATE tbl_korpa SET kolicina = '$kolicina' WHERE korpaId = '$korpaId'";
		$update_row = $this->db->izmena($query);
		if($update_row){
			header("Location:cart.php");
		}else{
			$poruka = "<span class='greska'>Kolicina Nije Azurirana.</span>";
			return $poruka;
		}
		
	}
	
	public function obrisiProIzKorpe($obrId){
		$obrId = mysqli_real_escape_string($this->db->link,$obrId);
		$query = "DELETE FROM tbl_korpa WHERE korpaId = '$obrId'";
		$delete_row = $this->db->obrisi($query);
		if($delete_row){
			echo "<script>window.location = 'cart.php';</script>";
		}else{
			$poruka = "<span class='greska'>Proizvod Nije Obrisan.</span>";
			return $poruka;
		}	
	}
	
	public function proveraKorpe(){
		$sId = session_id();
		$query = "SELECT * FROM tbl_korpa WHERE sId = '$sId'";
		$rezultat = $this->db->selekt($query);
		return $rezultat;
	}
	
		public function obrisiKorpuKupca(){
		$sId = session_id();
		$query = "DELETE FROM tbl_korpa WHERE sId = '$sId'";
		$this->db->obrisi($query);
	}
	
	public function naruciProizvod($kupId){
		$sId = Session_id();
		$query = "SELECT * FROM tbl_korpa WHERE sId = '$sId'";
		$dobaviPro = $this->db->selekt($query);
		if($dobaviPro){
			while($rez = $dobaviPro->fetch_assoc()){
				$proizvodId = $rez['proizvodId'];
				$proizvodIme = $rez['proizvodIme'];
				$kolicina = $rez['kolicina'] ;
				$cena = $rez['cena'] * $kolicina;
				$slika = $rez['slika'];
				
			$query = "INSERT INTO tbl_narudzba(kupId, proizvodId, proizvodIme, kolicina, cena, slika ) VALUES ('$kupId', '$proizvodId', '$proizvodIme', '$kolicina', '$cena', '$slika')";
			$insert_row = $this->db->unos($query);
			}
		}
	}
	
	public function svotaZaPlacanje($kupId){
		$query = "SELECT cena FROM tbl_narudzba WHERE kupId = '$kupId' AND datum = now()";
		$rezultat = $this->db->selekt($query);
		return $rezultat;
	}
	
	public function dobaviNaruceniProizvod($kupId){
		$query = "SELECT * FROM tbl_narudzba WHERE kupId = '$kupId' ORDER BY datum DESC";
		$rezultat = $this->db->selekt($query);
		return $rezultat;
	}
	
	public function proveraNarudzbe($kupId){
		$query = "SELECT * FROM tbl_narudzba WHERE kupId = '$kupId'";
		$rezultat = $this->db->selekt($query);
		return $rezultat;
	}
	
	public function dobaviSveNarudzbe(){
		$query = "SELECT * FROM tbl_narudzba ORDER BY datum DESC";
		$rezultat = $this->db->selekt($query);
		return $rezultat;
	}
	
	public function prebacivanjeProizvoda($id,$datum,$cena){
		$id = mysqli_real_escape_string($this->db->link,$id);
		$datum = mysqli_real_escape_string($this->db->link,$datum);
		$cena = mysqli_real_escape_string($this->db->link,$cena);
		$query = "UPDATE tbl_narudzba SET
	    status = '1' WHERE kupId = '$id' AND datum = '$datum' AND cena = '$cena'";
		$update_row = $this->db->izmena($query);
		if($update_row){
			$poruka = "<span class='uspesno'>Izmena Uspesna</span>";
			return $poruka;
		}else{
			$poruka = "<span class='greska'>Izmena Neuspesna.</span>";
			return $poruka;
		}
	}
	
	public function obrisiPrebacivanjeProizvoda($id,$vreme,$cena){
		$id = mysqli_real_escape_string($this->db->link,$id);
		$datum = mysqli_real_escape_string($this->db->link,$vreme);
		$cena = mysqli_real_escape_string($this->db->link,$cena);
		$query = "DELETE FROM tbl_narudzba
	    WHERE kupId = '$id' AND datum = '$datum' AND cena = '$cena'";
		$delete_row = $this->db->obrisi($query);
		if($delete_row){
			$poruka = "<span class='uspesno'>Usepsno Obrisano</span>";
			return $poruka;
		}else{
			$poruka = "<span class='greska'>Neuspesno Obrisano.</span>";
			return $poruka;
		}
	}
	
	public function proizvodPrebacivanjePotvrdi($id,$vreme,$cena){
		$id    = mysqli_real_escape_string($this->db->link, $id);
		$datum  = mysqli_real_escape_string($this->db->link, $vreme);
		$cena = mysqli_real_escape_string($this->db->link, $cena);
		$query = "UPDATE tbl_narudzba SET
			status = '2'
			WHERE kupId = '$id' AND datum = '$datum' AND cena = '$cena'";
		$updated_row = $this->db->izmena($query);
		if($updated_row){
			$poruka = "<span class='uspesno'>Izmena Uspesna.</span>";
			return $poruka;
		}else{
			$poruka = "<span class='greska'>Izmena Neuspesna.</span>";
			return $poruka;
		}
	}
}
?>