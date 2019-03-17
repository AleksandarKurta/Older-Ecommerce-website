<?php 
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
?>
<?php

class Marka{
	
	private $db;
	private $fm;
	
	public function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}
	
	public function unosMarke($markaIme){
		$markaIme = $this->fm->validation($markaIme);
		$markaIme = mysqli_real_escape_string($this->db->link,$markaIme);
		if(empty($markaIme)){
			$poruka = "<span class='greska'>Marka ne sme biti prazna!</span>";
			return $poruka;
		}else{
			$query = "INSERT INTO tbl_marka(markaIme) VALUES('$markaIme')";
			$markaunos = $this->db->unos($query);
			if($markaunos){
				$poruka = "<span class='uspesno'>Marka uspesno uneta</span>";
				return $poruka;
			}else{
				$poruka = "<span class='greska'>Marka neuspesno uneta</span>";
				return $poruka;
			}
		}
	}
	
	public function dobaviSveMarke(){
		$query = "SELECT * FROM tbl_marka ORDER BY markaId DESC";
		$rezultat = $this->db->selekt($query);
		return $rezultat;
	}
	
		public function dobaviMarkuPoId($id){
		$query    = "SELECT * FROM tbl_marka WHERE markaId = '$id'";
		$rezultat = $this->db->selekt($query);
		return $rezultat;
	}
	
	public function markaIzmena($markaIme,$id){
		$markaIme = $this->fm->validation($markaIme);
		$markaIme = mysqli_real_escape_string($this->db->link,$markaIme);
		$id    	  = mysqli_real_escape_string($this->db->link, $id);
		if(empty($markaIme)){
			$poruka = "<span class='greska'>Marka ne sme biti prazna!</span>";
			return $poruka;
		}else{
			$query = "UPDATE tbl_marka SET
			markaIme = '$markaIme' WHERE markaId = '$id'";
			$izmena = $this->db->izmena($query);
			if($izmena){
				$poruka = "<span class='uspesno'>Marka uspesno izmenjena</span>";
				return $poruka;
			}else{
				$poruka = "<span class='greska'>Marka neuspesno izmenjena</span>";
				return $poruka;
			}
		}
	}
	
	public function obrisiMarkuPoId($id){
		$query = "DELETE FROM tbl_marka WHERE markaId = '$id'";
		$obrMarku = $this->db->obrisi($query);
		if($obrMarku){
			$poruka = "<span class='uspesno'>Marka uspesno obrisana</span>";
			return $poruka;
		}else{
			$poruka = "<span class='greska'>Marka neuspesno obrisana</span>";
			return $poruka;
		}
	}
	
}
?>