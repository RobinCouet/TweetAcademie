<?php
class Member extends database {
	public function __construct () {
		parent::__construct();
	}
	
	public function CreateMember($name, $pwd, $addr, $date) {
		if ($pwd[0] == $pwd[1]) {
			$req = $this->bdd->prepare("
			INSERT INTO profiles (color_hexa, name) VALUES 
			(:color_hexa, :name)");
			$req->execute(array(
				'color_hexa' => "E5F2F7",
				'name' => $name[3]
			));
			$id_profile = $this->bdd->lastInsertId("id_profile");
			$req = $this->bdd->prepare("
			INSERT INTO user_infos (name, firstname, sex, birthdate, place,
			phone_number) VALUES (:name, :firstname, :sex, :birthdate,
			:place, :phone_number)");
			$req->execute(array(
				'name' => $name[0],
				'firstname' => $name[1],
				'sex' => $name[4],
				'birthdate' => $date,
				'place' => $addr,
				'phone_number' => $name[5]
			));
			$id_info = $this->bdd->lastInsertId("id_user");
			$req = $this->bdd->prepare("
			INSERT INTO users (login, mail, password, admin, id_profile, 
			id_infos) VALUES (:login, :mail, :password, :admin, 
			:id_profile, :id_info)");
			$req->execute(array(
				'login' => $name[3],
				'mail' => $name[2],
				'password' => hash("ripemd160", $pwd[0] . 
				"si tu aimes la wac tape dans tes mains"),
				'admin' => 0,
				'id_profile' => $id_profile,
				'id_info' => $id_info
			));
			return true;
		}
	}
	
	public function connection($login, $pwd) {
		$req = $this->bdd->prepare("
		SELECT users.*, profiles.* FROM users INNER JOIN 
		profiles ON profiles.id_profile = users.id_profile WHERE login = 
		:login AND password = :pwd");
		$req->execute(array(
			'login' => $login,
			'pwd' => hash("ripemd160", $pwd . 
			"si tu aimes la wac tape dans tes mains")
		));
		$data = $req->fetch(PDO::FETCH_ASSOC);
		$_SESSION["id_user"] = $data["id_user"];
		$_SESSION["login"] = $data["login"];
		$_SESSION["mail"] = $data["mail"];
		$_SESSION["admin"] = $data["admin"];
		$_SESSION["hexa"] = $data["color_hexa"];
		$req = $this->bdd->prepare("
		SELECT * FROM user_infos WHERE 
		user_infos.id_user = :id_user");
		$req->execute(array(
			'id_user' => $data["id_infos"]
		));
		$data = $req->fetch(PDO::FETCH_ASSOC);
		$_SESSION["id_info"] = $data["id_user"];
		$_SESSION["name"] = $data["name"];
		$_SESSION["firstname"] = $data["firstname"];
		$_SESSION["sexe"] = $data["sex"];
		$_SESSION["place"] = $data["place"];
		$_SESSION["birthdate"] = $data["birthdate"];
		$_SESSION["phone_number"] = $data["phone_number"];
		if ($data != false) {
			return true;
		}
		else
		return false;
	}
	
	public function change_data() {
		$req = $this->bdd->prepare("UPDATE user_infos SET name = :name, 
		firstname = :firstname, sex = :sex, birthdate = :birthdate, 
		place = :place, phone_number = :phone_number WHERE id_user = 
		:id_user");
		$req->execute(array(
			'id_user' => $_SESSION["id_user"],
			'name' => $_POST["nom"],
			'firstname' => $_POST["prenom"],
			'sex' => $_POST["sexe"],
			'birthdate' => $_POST["birthdate"],
			'place' => $_POST["place"],
			'phone_number' => $_POST["phone_number"]
		));
		if ($_POST["password"] != "" && $_POST["password"] == 
		$_POST["vpassword"]) {
			$req = $this->bdd->prepare("UPDATE users SET password = 
			:password WHERE id_user = :id_user");
			$req->execute(array(
				'id_user' => $_SESSION["id_user"],
				'password' => hash("ripemd160", $_POST["password"] . 
				"si tu aimes la wac tape dans tes mains")
			));
		}
		$req = $this->bdd->prepare("UPDATE users SET login = 
		:login WHERE id_user = :id_user");
		$req->execute(array(
			'id_user' => $_SESSION["id_user"],
			'login' => $_POST["pseudo"]
		));
		rename("misc/" . $_SESSION["login"] . "_profile.jpg", "misc/" . 
		$_POST["pseudo"] . "_profile.jpg");
		rename("misc/" . $_SESSION["login"] . "_cover.jpg", "misc/" . 
		$_POST["pseudo"] . "_cover.jpg");
		$_SESSION["login"] = $_POST["pseudo"];
	}
	
	public function change_profil() {
		if (!preg_match("/^#[0-9A-F]{6}$/i", $_POST['hexa']))
		$_POST['hexa'] = "#005ea7";
		$req = $this->bdd->prepare("UPDATE profiles SET description = :description,
		color_hexa = :color_hexa WHERE id_profile = 
		:id_profile");
		$req->execute(array(
			'description' => $_POST["desc"],
			'color_hexa' => substr($_POST["hexa"], 1),
			'id_profile' => $_SESSION["id_user"]
		));
		$_SESSION["hexa"] = substr($_POST["hexa"], 1);
	}
	public function delete() {
		$req = $this->bdd->prepare("DELETE FROM users WHERE id_user = 
		:id_profile");
		$req->execute(array(
			'id_profile' => $_SESSION["id_user"]
		));
		$req = $this->bdd->prepare("DELETE FROM profiles WHERE id_profile = 
		:id_profile");
		$req->execute(array(
			'id_profile' => $_SESSION["id_user"]
		));
		$req = $this->bdd->prepare("DELETE FROM user_infos WHERE id_user = 
		:id_profile");
		$req->execute(array(
			'id_profile' => $_SESSION["id_user"]
		));
		file_put_contents("css/user_style.css", "");
		session_destroy();
	}
	
	public function change_avatar() {
		if (isset($_FILES["profil"]["tmp_name"]) &&
		$_FILES["profil"]["tmp_name"] != "") {
			$img = file_get_contents($_FILES["profil"]["tmp_name"]);
			if (mime_content_type($_FILES["profil"]["tmp_name"]) == 'image/png' ||
			mime_content_type($_FILES["profil"]["tmp_name"]) == 'image/jpeg' ||
			mime_content_type($_FILES["profil"]["tmp_name"]) == 'image/jpg' ||
			mime_content_type($_FILES["profil"]["tmp_name"]) == 'image/bmp')
			file_put_contents("misc/" . $_SESSION["login"] . "_profile.jpg", $img);
		}
	}
	public function change_cover() {
		if (isset($_FILES["cover"]["tmp_name"]) &&
		$_FILES["cover"]["tmp_name"] != "") {
			$img = file_get_contents($_FILES["cover"]["tmp_name"]);
			if (mime_content_type($_FILES["cover"]["tmp_name"]) == 'image/png' ||
			mime_content_type($_FILES["cover"]["tmp_name"]) == 'image/jpeg' ||
			mime_content_type($_FILES["cover"]["tmp_name"]) == 'image/jpg' ||
			mime_content_type($_FILES["cover"]["tmp_name"]) == 'image/bmp')
			file_put_contents("misc/" . $_SESSION["login"] . "_cover.jpg", $img);
		}
	}
}