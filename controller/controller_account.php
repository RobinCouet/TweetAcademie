<?php
class account {
	private $member;
	private $success;
	private $title;
	public function __construct() {
		include("model/accountModel.php");
		$this->member = new Member();
	}
	public function sign_in() {
		if (!isset($_SESSION["id_user"])) {
			foreach ($_POST as $value) {
				if ($value == "" || $value === NULL) {
					$this->success = "<div class=\"alert alert-danger\">
					Veuillez remplire tout les champs ci dessus</div>";
					
					$verif = 0;
				}
			}
			if (count($_POST) == 0 || isset($verif)) {
				include("view/account/sign_in.php");
				return false;
			}
			$pwd[0] = $_POST['password'];
			$pwd[1] = $_POST['vpassword'];
			$name[0] = $_POST["nom"];
			$name[1] = $_POST["prenom"];
			$name[2] = $_POST["email"];
			$name[3] = $_POST["login"];
			$name[4] = $_POST["sexe"];
			$name[5] = $_POST["phone"];
			$this->success = $this->member->CreateMember($name, $pwd, 
			$_POST["adresse"], $_POST["date"]);
			if ($this->success === NULL) {
				$this->success = "<div class=\"alert alert-info\">
				Veuillez remplire tout les champs ci dessus</div>";
			}
			elseif ($this->success === true) {
				$this->success = "<div class=\"alert alert-success\">
				Vous vous êtes enregistré avec succès!</div>";
			}
			elseif ($this->success === false) {
				$this->success = "<div class=\"alert alert-danger\">
				Il y a eu un problème lors de l'inscription, veuillez réessayer!
				</div>";
			}
			include("/view/account/sign_in.php");
		}
	}
	public function home() {
		include("/view/account/sign_in.php");
	}
	public function setSuccess($str) {
		$this->success = $str;
	}
	public function getSuccess() {
		return $this->success;
	}
	
	public function login() {
		if (isset($_SESSION["id_user"])) {
			header("location: /Projet_Web_tweet_academie/");
		}

		foreach ($_POST as $value) {
			if ($value == "") {
				$this->success = "<div class=\"alert alert-danger\">
				Veuillez remplire tout les champs ci dessus</div>";
				
				$verif = 0;
			}
		}
		
		if (count($_POST) == 0 || isset($verif)) {
			include("view/account/login.php");
			return false;
		}
		$bool = $this->member->connection($_POST["login"], 
		$_POST["pwd"]);
		if ($bool == true)
		header("location: /Projet_Web_tweet_academie/");
		else {
			$this->success = "<div class=\"alert alert-danger\">
			Il y a eu un probleme lors de la connexion, veuillez réessayer</div>";
			include("view/account/login.php");
		}
	}
	public function logout() {
		if (isset(($_SESSION["id_user"]))){
			session_destroy();
			header("location: /Projet_Web_tweet_academie/");
		}
	}
	public function modif() {
		if (isset($_SESSION["id_user"])) {
			if (isset($_POST["submit"])) 
			$this->member->change_data();
			elseif (isset($_POST["theme"]))
			$this->member->change_profil();
			elseif (isset($_POST["profil_submit"]))
			$this->member->change_avatar();
			elseif (isset($_POST["cover_submit"]))
			$this->member->change_cover();
			elseif (isset($_POST["delete"])) {
				$this->member->delete();
				header("location: /Projet_Web_tweet_academie/account/sign_in");
			}
			include("view/account/account_modif.php");
		}
		else {
			header("location: /Projet_Web_tweet_academie/account/login");
		}
	}
}