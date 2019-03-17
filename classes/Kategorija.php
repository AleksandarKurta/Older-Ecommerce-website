<?php 
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
?>
<?php

class Kategorija{
	private $db;
	private $fm;
	
	public function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}
	
	public function kategorijaUnos($katIme){
		$katIme = $this->fm->validation($katIme);
		$katIme = mysqli_real_escape_string($this->db->link, $katIme);
		if(empty($katIme)){
			$poruka = "<span class='greska'>Kategorija ne sme biti prazna!</span>";
			return $poruka;
		}else{
			$query = "INSERT INTO tbl_kategorija(katIme) VALUES ('$katIme')";
			$katunos = $this->db->unos($query);
			if($katunos){
				$poruka = "<span class='uspesno'>Kategorija uspesno uneta</span>";
				return $poruka;
			}else{
				$poruka = "<span class='greska'>Kategorija neuspesno uneta</span>";
				return $poruka;
			}
		}
	}
	
	public function dobaviKategorije(){
		$query 	  = "SELECT * FROM tbl_kategorija ORDER BY katId DESC";
		$rezultat = $this->db->selekt($query);
		return $rezultat;
	}
	
	public function dobaviKatPoId($id){
		$query    = "SELECT * FROM tbl_kategorija WHERE katId = '$id'";
		$rezultat = $this->db->selekt($query);
		return $rezultat;
	}
	
	public function kategorijaIzmena($katIme,$id){
		$katIme = $this->fm->validation($katIme);
		$katIme = mysqli_real_escape_string($this->db->link, $katIme);
		$id 	= mysqli_real_escape_string($this->db->link, $id);
		if(empty($katIme)){
			$poruka = "<span class='greska'>Kategorija ne sme biti prazna!</span>";
			return $poruka;
		}else{
			$query = "UPDATE tbl_kategorija SET
			katIme = '$katIme' WHERE katId = '$id'";
			$izmena = $this->db->izmena($query);
			if($izmena){
				$poruka = "<span class='uspesno'>Kategorija uspesno izmenjena</span>";
				return $poruka;
			}else{
				$poruka = "<span class='greska'>Kategorija neuspesno izmenjena</span>";
				return $poruka;
			}
		}
	}
	
	public function obrisiKategorijuPoId($id){
		$query = "DELETE FROM tbl_kategorija WHERE katId = '$id'";
		$obrPodatke = $this->db->obrisi($query);
		if($obrPodatke){
			$poruka = "<span class='uspesno'>Kategorija uspesno obrisana</span>";
			return $poruka;
		}else{
			$poruka = "<span class='greska'>Kategorija neuspesno obrisana</span>";
			return $poruka;
		}
	}
}
?>