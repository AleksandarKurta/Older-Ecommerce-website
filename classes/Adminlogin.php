<?php 
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Session.php');
	Session::checkLogin();
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
?>

<?php
class AdminLogin{
	private $db;
	private $fm;
	
	public function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}
	
	public function adminLogin($adminKorisnik,$adminLozinka){
		$adminKorisnik = $this->fm->validation($adminKorisnik);
		$adminLozinka = $this->fm->validation($adminLozinka);
		
		$adminKorisnik = mysqli_real_escape_string($this->db->link, $adminKorisnik);
		$adminLozinka = mysqli_real_escape_string($this->db->link, $adminLozinka);
		
		if(empty($adminKorisnik) || empty($adminLozinka)){
			$poruka = "Korisnicko Ime i Lozinka moraju biti uneti!";
			return $poruka;
		}else{
			$query = "SELECT * FROM tbl_admin WHERE adminKorisnik = '$adminKorisnik' AND adminLozinka = '$adminLozinka' ";
			$rezultat = $this->db->selekt($query);
			if($rezultat != false){
				$vrednost = $rezultat->fetch_assoc();
				Session::set("adminlogin", true);
				Session::set("adminId", $vrednost['adminId']);
				Session::set("adminKorisnik", $vrednost['adminKorisnik']);
				Session::set("adminIme", $vrednost['adminName']);
				Session::set("loginmsg", "<div class='alert alert-success'><strong>Success ! 	</strong>You are LoggedIn!</div>");
				header("Location:dashbord.php");
			}else{
				$poruka = "Korisnicko Ime ili Lozinka se ne poklapaju!";
				return $poruka;
			}
		}
	}
}

?>