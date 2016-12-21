<?php
class messages {
	private $model;
	public function __construct() {
		if (isset($_SESSION["id_user"])) {
			require(ROOT . "/model/messagesModel.php");
			$this->model = new messages_private();
		}
		else {
			header("Location: /Projet_Web_tweet_academie/account/login"); 
		}
	}

	public function send() {
		$data = $this->model->to_send();
	}

	public function tchat() {
		$result = $this->model->get_tchat();
		
		for ($i = count($result)-1 ; $i >= 0  ; $i--) {
			echo "De <span class='color'>";

			if ($_SESSION['login'] == $result[$i]['login'])
				echo "Vous";
			else
				echo $result[$i]['login'];
			
			echo "</span>" . " le " . $result[$i]['date'] . " : " . "<br><br>"
			. htmlentities($result[$i]['content']) . "<br><br>";
		}
	}

	public function view() {
		$rep = $this->model->to_view();
		require (ROOT . '/view/home/messages.php');
	}
}
?>