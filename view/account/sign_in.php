<?php require(ROOT . '/view/header.php'); ?>
<div class="container well">
	<div class="row">
		<div class="col-md-offset-2 col-md-8">
			<h1> Inscription <br/> <small> Merci de renseigner vos informations </small></h1>
		</div>
	</div>
	<form method="post">
		<div class="row">
			<div class="col-md-offset-2 col-md-3">
				<div class="form-group">
					<label for="nom">Nom</label>
					<input type="text" class="form-control" id="nom" placeholder="Nom" name="nom">
				</div>
			</div>
			<div class="col-md-offset-1 col-md-3">
				<div class="form-group">
					<label for="prenom">Prénom</label>
					<input type="text" class="form-control" id="prenom" placeholder="Prénom" name="prenom">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-offset-2 col-md-3">
				<div class="form-group">
					<label class="radio-inline"><input type="radio" name="sexe" value="MALE" checked>Homme</label>
					<label class="radio-inline"><input type="radio" name="sexe" value="FEMALE">Femme</label>
					<label class="radio-inline"><input type="radio" name="sexe" value="OTHER">Autre</label>
				</div>
			</div>
			<div class='col-md-offset-1 col-md-3'>
				<div class="form-group">
				<label for="date">Date de naissance</label>
					<input type='date' class="form-control" name="date" id="date" />
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-offset-2 col-md-3">
				<div class="form-group">
					<label for="adresse">Adresse</label>
					<input type='text' placeholder="Enter adress" class="form-control" name="adresse" id="adresse" />
				</div>
			</div>
			<div class="col-md-offset-1 col-md-3">
				<div class="form-group">
					<label for="phone">Numero de telephone</label>
					<input type='text' placeholder="Enter phone number" class="form-control" name="phone" id="phone" />
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-offset-2 col-md-3">
				<div class="form-group">
					<label for="email">Email address</label>
					<input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
				</div>
			</div>
			<div class="col-md-offset-1 col-md-3">
				<div class="form-group">
					<label for="login">Login</label>
					<input type="text" class="form-control" id="login" placeholder="Enter login" name="login">
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-offset-2 col-md-3">
				<div class="form-group">
					<label for="password">Mot de passe</label>
					<input type="password" class="form-control" id="password" placeholder="Mot de passe" name="password">
				</div>
			</div>
			<div class="col-md-offset-1 col-md-3">
				<div class="form-group">
					<label for="vpassword">Vérification mot de passe</label>
					<input type="password" class="form-control" id="vpassword" placeholder="Vérification mot de passe" name="vpassword">
				</div>
			</div>
		</div>
		<br/>
		<div class="row">
			<div class="col-md-offset-6 col-md-3">
				<button type="submit" class="btn btn-primary">Envoyer mes informations</button>
			</div>
		</div>
		<?php echo $this->success;?>
	</form>
</div>
<?php require(ROOT . '/view/footer.php'); ?>