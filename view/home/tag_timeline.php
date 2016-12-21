<?php require(ROOT . '/view/header.php'); ?>
<div class="container">
	<div class="col-lg-12">
		<div class="row trend">
			<div class="col-xs-12">
				<h2>Tendances</h2>
				<?php foreach ($trend as $value) {
					$value = preg_replace("~#([a-zA-Z0-9]+)~",
						"<a href='/".DIRNAME."/home/tag/$1'>#$1</a> ", $value);
					echo $value . "<br>";
				}?>
			</div>
		</div>
		<div class="row">
			<h1>Ma timeline :</h1>
			<form method="post">
				<textarea class="form-control profile-tweet" name="content"></textarea>
				<button type="submit" name="add_tweet" class="btn btn-primary vert-offset-top-1 vert-offset-bottom-1 pull-right">Tweeter</button>
			</form>
			<span>Suggestions : </span><span class="suggestion"></span>
		</div>
		<div class="row">
			<div class="col-xs-3">
				<h2>Les comptes</h2>
				<?php
				for ($i = 0; $i < count($account_tag); $i++) {
					echo '<a href="/'.DIRNAME.'/profile/user/'.
					$account_tag[$i]['login'].'">@' . $account_tag[$i]['login']
					. '</a><br>';
				}
				?>
			</div>
			<div class="col-xs-8 col-xs-offset-1">
				<h2>Les tweets</h2>
				<?php
				for ($i = 0; $i < count($tab_follower); $i++) {
					$tab_follower[$i]['content'] = 
					htmlspecialchars($tab_follower[$i]['content']);
					$tab_follower[$i]['content'] = 
					preg_replace("~#([a-zA-Z0-9]+)~",
						"<a href='/".DIRNAME."/home/tag/$1'>#$1</a> ",
						$tab_follower[$i]['content']);
					$tab_follower[$i]['content'] =
					preg_replace("#@([a-zA-Z0-9_-]+)#",
						"<a href='/".DIRNAME."/profile/user/$1'>@$1</a> ",
						$tab_follower[$i]['content']);
					echo '<div class="panel panel-info vert-offset-top-2">
					<div class="panel-heading">
						<a href="/'.DIRNAME.'/profile/user/'.
						$tab_follower[$i]['login'].
						'" class="panel-title">@'.$tab_follower[$i]['login'].
						'</a>
					</div>
					<div class="panel-body">
						<div class="col-xs-2">';
							if (file_exists(ROOT . "/misc/" .
								$tab_follower[$i]['login'] . "_profile.jpg")) {
								echo '<img class="img-responsive"
							src="/'.DIRNAME.'/misc/'. $tab_follower[$i]['login']
							.'_profile.jpg" alt="profile_pic">';
							}
							else {
								echo '<img class="img-responsive"
								src="/'.DIRNAME.'/misc/default_profile.png"
								alt="profile_pic">';
							}
							echo '</div>
							<div class="col-xs-9 col-xs-offset-1">
								<p>'.$tab_follower[$i]['content'].'</p>
							</div>
						</div>
						<div class="panel-footer">
							<a href="/' . DIRNAME . '/profile/tweet_like/' .
							$tab_follower[$i]["id_tweet"] . '"><span
							class="glyphicon glyphicon-heart col-xs-offset-4">
							</span></a>
							<span class="col-xs-offset-1">' .
							$tab_follower[$i]["nb_tweet"] . '</span>
							<a href="#"><span
							class="glyphicon glyphicon-retweet col-xs-offset-1">
							</span></a>
							<span class="col-xs-offset-1">0</span>

						</div>
					</div>';
				}
				?>
			</div>
		</div>
	</div>
</div>
<?php require(ROOT . '/view/footer.php'); ?>