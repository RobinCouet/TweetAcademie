<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="description" content="tweet">
	<title>Tweet Academie</title>
	<link rel="stylesheet" type="text/css" href="/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="/css/style.css">
	<link rel="stylesheet" type="text/css" href="/css/user_style.css">
</head>
<body>

	<?php
	if (!isset($_SESSION['login'])) {
		echo '
		<nav class="navbar navbar-default navbar-fixed-top">
			<img class="pull-right hidden-xs hidden-sm" src="/misc/bird.png" alt="bird">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed"
					data-toggle="collapse" data-target="#navbar"
					aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="/home">
					Tweet Academie</a>
				</div>
				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
						<li><a href="/account/login">Connexion</a>
						</li>
						<li>
							<a href="/account/sign_in">Inscription</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>';
	}
	else {
		echo '<nav class="navbar navbar-default navbar-fixed-top">
		<img class="hidden-xs hidden-sm" src="/misc/bird.png"
		alt="bird">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed"
				data-toggle="collapse" data-target="#navbar"
				aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="/">Tweet Academie</a>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li><a href="/">Acceuil</a></li>
				<li><a href=/messages/view/>Messages</a></li>
				<li>
					<a href="/profile/user/"' .
					$_SESSION["login"] . '">Mon Compte</a>
				</li>
				<li>
					<li>
						<a href="/account/modif/">Paramètres</a>
					</li>
					<li>
						<a href="/account/logout">Déconnexion</a>
					</li>
				</ul>
				<form class="navbar-form navbar-right" role="search"
				method="POST" action="/home/tag">
				<div class="form-group">
					<input name="tag" type="text" class="form-control"
					placeholder="Recherche">
				</div>
			</form>
		</div>
	</div>
</nav>';
}

?>

