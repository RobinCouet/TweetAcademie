<?php require('view/header.php'); ?>
<div class="container">
	<div class="col-lg-12">
		<div class="row trend">
			<div class="col-xs-12">
				<h2>Tendances</h2>
				<?php foreach ($trend as $value) {
					$value = preg_replace("~#([a-zA-Z0-9]+)~",
						"<a href='/home/tag/$1'>#$1</a> ", $value);
					echo $value . "<br>";
				}?>
			</div>
		</div>
		<div class="row">
			<h1>Ma timeline :</h1>
			<form method="post">
				<textarea class="form-control profile-tweet text_to_tweet" id="text-box" name="content"></textarea>
				<div class="col-xs-12 green" id="nbr">Charactere restant : 140</div>
				<button type="submit" name="add_tweet" class="btn btn-primary vert-offset-top-1 vert-offset-bottom-1 pull-right">Tweeter</button>
			</form>
			<span>Suggestions : </span><span class="suggestion"></span>
		</div>
		<div class="row">
			<div id="timeline">
				<?php
				for ($i = 0; $i < count($tab_follower); $i++) {
					$tab_follower[$i]['content'] = preg_replace("~#([a-zA-Z0-9]+)~",
						"<a href='/home/tag/$1'>#$1</a> ",
						$tab_follower[$i]['content']);
				// $tab_follower[$i]['content'] =
				//preg_replace("#@([a-zA-Z0-9_-]+)#",
				// 	"<a href='/".DIRNAME."/profile/user/$1'>@$1</a> ",
				//$tab_follower[$i]['content']);

					echo '<div class="panel panel-info vert-offset-top-2">'; 
					if (isset($tab_follower[$i]["login_init"])) {
						echo '<div class="panel-heading">
						<a href="/profile/user/'.
						$tab_follower[$i]['login_init'].
						'" class="panel-title">@'.$tab_follower[$i]['login_init'].'</a><span class="white"> à été retweeté par </span><a href="/profile/user/'.
						$tab_follower[$i]['login'].'" class="panel-title">@'.$tab_follower[$i]['login'].'</a>
					</div>
					';
				}
				else {
					echo '<div class="panel-heading">
					<a href="/profile/user/'.
					$tab_follower[$i]['login'].
					'" class="panel-title">@'.$tab_follower[$i]['login'].'</a>
					</div>';
			}
			echo '<div class="panel-body">
			<div class="col-xs-2">';
				if (file_exists("/misc/" . $tab_follower[$i]['login']
					. "_profile.jpg")) {
					echo '<img class="img-responsive"
				src="/misc/'. $tab_follower[$i]['login']
				.'_profile.jpg" alt="profile_pic">';
			}
			else {
				echo '<img class="img-responsive" src="/misc/default_profile.png" alt="profile_pic">';
			}
			echo '</div>
			<div class="col-xs-9 col-xs-offset-1">
				<p>'.$tab_follower[$i]['content'].'</p>
			</div>
		</div>
		<div class="panel-footer">
			<a href="/profile/tweet_like/' .
			$tab_follower[$i]["id_tweet"] . '"><span
			class="glyphicon glyphicon-heart col-xs-offset-4">
		</span></a>
		<span class="col-xs-offset-1">' .
			$tab_follower[$i]["nb_tweet"] . '</span>
			<a href="/profile/retweet/' .
			$tab_follower[$i]["id_tweet"] . '"><span class="glyphicon glyphicon-retweet col-xs-offset-1">
		</span></a>
		<span class="col-xs-offset-1">' . $tab_follower[$i]["nb_rt"] . '</span>

	</div>
</div>';
}
?>
</div>
</div>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<?php echo '<script src="/js/reload_auto.js"></script>'?>
<?php echo '<script src="/js/autocomplete.js"></script>'?>
<?php echo '<script src="/js/script.js"></script>'?>
<script>
	jQuery(function($) {
		$('#timeline').reload_timeline();
	})
</script>
</body>
</html>