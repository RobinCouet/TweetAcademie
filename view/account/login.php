<?php require('view/header.php'); ?>
<div class="container col-md-offset-4 col-md-3">
	<form class="form-signin" method="post">
		<h2 class="form-signin-heading">Connectez vous :</h2>
		<label for="login">Email ou login</label>
		<input id="login" class="form-control" placeholder="Email ou login" type="text" name="login">
		<label for="inputPassword">Password</label>
		<input id="inputPassword" class="form-control" placeholder="Password" required="" type="password" name="pwd">
		<button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
	</form>
	<?php 
	if (isset($this->success))
		echo $this->success;?>
</div>
<?php require('view/footer.php'); ?>