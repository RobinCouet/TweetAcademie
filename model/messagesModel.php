<?php
class messages_private extends database {

	public function __construct () {
		parent::__construct();
	}

	public function get_tchat() {
		$req = $this->bdd->prepare("SELECT id_user FROM users WHERE login = :login");
		$req->execute(array('login'=>$_SESSION['login']));
		$data = $req->fetch(PDO::FETCH_ASSOC);

		$req3 = $this->bdd->prepare("SELECT id_user FROM users WHERE login = :login");
		$req3->execute(array('login'=>$_GET['user']));
		$data2 = $req3->fetch(PDO::FETCH_ASSOC);
		$req2 = $this->bdd->prepare("
			SELECT private_messages.content, private_messages.date,
			private_messages.id_user_send AS login
			FROM private_messages
			WHERE id_user_send = :user AND id_user_receive = :dest
			OR id_user_receive = :user AND id_user_send = :dest
			ORDER BY private_messages.date DESC");
		$req2->execute(array(
			'user'=> $data['id_user'],
			'dest'=> $data2['id_user']
		));
		$result = $req2->fetchAll(PDO::FETCH_ASSOC);
		for ($i = 0; $i < count($result); $i++) {
			foreach ($result[$i] as $key => $value) {
				if ($key === "login") {
					$req = $this->bdd->prepare("SELECT login FROM users WHERE id_user = :id");
					$req->execute(array('id' => $result[$i][$key]));
					$data = $req->fetch(PDO::FETCH_ASSOC);
					$result[$i][$key] = $data["login"];
				}
			}
		}
		return $result;
	}

	public function to_send() {
		$req = $this->bdd->prepare("SELECT id_user FROM users WHERE
			login = :login");
		$req->execute(array('login'=>$_SESSION['login']));
		$id_user = $req->fetch(PDO::FETCH_ASSOC);

		$req2 = $this->bdd->prepare("SELECT id_user FROM users WHERE
			login = :login");
		$req2->execute(array('login'=>$_GET['user']));
		$id_dest = $req2->fetch(PDO::FETCH_ASSOC);

		$req_final = $this->bdd->prepare("INSERT INTO private_messages
			(content, id_user_send, id_user_receive) VALUES
			(:content, :id_user, :id_dest)");

		$req_final->execute(array(
			'id_user'=>$id_user['id_user'],
			'id_dest'=>$id_dest['id_user'],
			'content'=>$_GET['content']
		));
	}

	public function to_view() {
		$req = $this->bdd->prepare("SELECT login FROM users");
		$req->execute();
		$rep = $req->fetchAll(PDO::FETCH_ASSOC);
		return $rep;
	}
}
?>