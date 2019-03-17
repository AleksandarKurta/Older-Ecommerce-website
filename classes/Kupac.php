<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
?>
<?php

class Kupac{
	
	private $db;
	private $fm;
	
	public function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}
	
	public function registracijaKupca($data){
		$ime     = mysqli_real_escape_string($this->db->link,$data['ime']);
		$adresa  = mysqli_real_escape_string($this->db->link,$data['adresa']);
		$grad 	 = mysqli_real_escape_string($this->db->link,$data['grad']);
		$telefon = mysqli_real_escape_string($this->db->link,$data['telefon']);
		$email 	 = mysqli_real_escape_string($this->db->link,$data['email']);
		$lozinka = mysqli_real_escape_string($this->db->link,md5($data['lozinka']));
		
		if($ime == "" || $adresa == "" || $grad == "" || $telefon == "" || $email == "" || $lozinka == "" ){
			$poruka = "<span class='greska'>Poslja Ne Smeju Biti prazna!</span>";
			return $poruka;
		}
		$mailquery = "SELECT * FROM tbl_kupac WHERE email = '$email' LIMIT 1";
		$mailchk = $this->db->selekt($mailquery);
		if($mailchk != false){
			$poruka = "<span class='greska'>E-Mail Vec Postoji !</span>";
			return $poruka;
		}else{ 
			$query = "INSERT INTO tbl_kupac(ime, adresa, grad, telefon, email, lozinka) VALUES('$ime', '$adresa', '$grad', '$telefon', '$email', '$lozinka')";
			
			$insert_row = $this->db->unos($query);
			if($insert_row){
				$poruka = "<span class='uspesno'>Unos Podataka o Kupcu Uspesno Unet!</span>";
				return $poruka;
			}else{
				$poruka = "<span class='greska'>Unos Podataka o Kupcu Neuspesan!</span>";
				return $poruka;
			}	
		}
	}
	
	public function logovanjeKupca($data){
		$email 	 = mysqli_real_escape_string($this->db->link,$data['email']);
		$lozinka = mysqli_real_escape_string($this->db->link,md5($data['lozinka']));
		
		if(empty($email) || empty($lozinka)){
			$poruka = "<span class='greska'>Polja ne smeju biti prazna !</span>";
			return $poruka;
		}
		
		$query = "SELECT * FROM tbl_kupac WHERE email = '$email' AND lozinka = '$lozinka'";
		$rezultat = $this->db->selekt($query);
		if($rezultat != false){
			$vrednost = $rezultat->fetch_assoc();
			Session::set("kuplog", true);
			Session::set("kupId", $vrednost['id']);
			Session::set("kupIme", $vrednost['ime']);
			header("Location:cart.php");
		}else{
			$poruka = "<span class='greska'>E-Mail ili Lozinka se ne poklapaju!</span>";
			return $poruka;
		}
	}
	
	public function dobaviPodatkeKupca($id){
		$query = "SELECT * FROM tbl_kupac WHERE id = '$id'";
		$rezultat = $this->db->selekt($query);
		return $rezultat;
	}
	
	public function azurirajDetaljeKupca($data, $kupId){
		$ime        = mysqli_real_escape_string($this->db->link,$data['ime']);
		$adresa     = mysqli_real_escape_string($this->db->link,$data['adresa']);
		$grad        = mysqli_real_escape_string($this->db->link,$data['grad']);
		$telefon       = mysqli_real_escape_string($this->db->link,$data['telefon']);
		$email       = mysqli_real_escape_string($this->db->link,$data['email']);
		
			if($ime == "" || $adresa == "" || $grad == "" ||  $telefon == "" || $email == "" ){
			$msg = "<span class='error'>Polja ne smeju biti prazna !</span>";
			return $msg;
		}else{
			$query  = "UPDATE tbl_kupac
			SET
			ime    = '$ime',
			adresa = '$adresa',
			grad    = '$grad',
			telefon   = '$telefon',
			email 	= '$email'
			WHERE id = '$kupId'";
			$updated_row = $this->db->izmena($query);
			if($updated_row){
				$poruka = "<span class='uspesno'>Profil Uspesno Izmenjen.</span>";
				return $poruka;
			}else{
				$poruka = "<span class='greska'>Profil Neuspesno Izmenjen.</span>";
				return $poruka;
			}
		}	
	}
	
}
?>