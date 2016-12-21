<?php require_once(ROOT . '/view/header.php'); ?>
<div class="container">
	<div class="member">
		<ul>
			<?php
			for ($i = 0 ; $i < count($rep) ; $i++) {
				if ($rep[$i]['login'] != $_SESSION['login']) {
					echo "<li class='tchatli' id='".$rep[$i]['login']."'>".$rep[$i]['login']."</li>";
				}
			}
			?>
		</ul>
	</div>
	<div class="msg">
		<div id="recu"></div>
		<form class="message_to_send" action="#" method="post">
			<div class="write">
				<textarea name="content" id="area"></textarea><br>				
				<button class="btn-md">Envoyer</button>
			</div>
		</form>
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<?php echo '<script src="/' . DIRNAME .'/js/script.js"></script>'?>
<?php echo '<script src="/' . DIRNAME .'/js/reload_auto.js"></script>'?>
<script>
	jQuery(function($) {
		$('#recu').reload_auto();
	})
</script>
</body>
</html>