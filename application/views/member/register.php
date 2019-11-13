<h3>Créer un nouveau compte</h3>

<form method="post" action="">
	<div class="row">
		<div class="col-6 form-group p-3">
			<label for="first_name">Votre prénom</label>
			<input class="form-control" type="text" name="first_name" placeholder="John" />
		</div>
		<div class="col-6 form-group p-3">
			<label for="last_name">Votre nom</label>
			<input class="form-control" type="text" name="last_name" placeholder="Doe" />
		</div>
	</div>
	<div class="form-group">
		<label for="email">Entrez votre adresse email</label>
		<input class="form-control" type="email"  name="email" placeholder="john.doe@gmail.com" />
	</div>
	<div class="row">
		<div class="form-group col-6 p-3">
			<label for="password">Entrez votre mot de passe</label>
			<input class="form-control" type="password" name="password" placeholder="********" />
		</div>
		<div class="form-group col-6 p-3">
			<label for="password">Entrez votre mot de passe</label>
			<input class="form-control" type="password" name="password" placeholder="********" />
		</div>
	</div>
	<div class="form-group">
		<label for="type">Type du compte à créer</label>
		<p>
			<input type="checkbox" name="type" />
			<span>Je souhaite ouvrir un compte vendeur</span>
		</p>
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-primary">Créer mon compte</button>
	</div>

	<p>J'ai déjà un compte, <a href="<?= base_url() . 'index.php/member' ?>">accéder à mon compte</a></p>
</form>
