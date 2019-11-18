<h3>Créer un nouveau compte</h3>
<hr class="mb-3" />

<?= isset($message) ? "<p class='alert alert-info'>Le profil a bien été créé</p>": ""; ?>

<form method="post" action="">
	<div class="row">
		<div class="col-6 form-group p-3">
			<label for="first_name">Entrez un prénom</label>
			<input class="form-control" type="text" name="first_name" value="<?= set_value('first_name'); ?>" placeholder="John" />
			<?= form_error('first_name') ?>
		</div>
		<div class="col-6 form-group p-3">
			<label for="last_name">Entrez un nom</label>
			<input class="form-control" type="text" name="last_name" value="<?= set_value('last_name'); ?>" placeholder="Doe" />
			<?= form_error('last_name') ?>
		</div>
	</div>
	<div class="form-group">
		<label for="email">Entrez un nom d'utilisateur</label>
		<input class="form-control" type="text"  name="username" value="<?= set_value('username'); ?>" placeholder="imhassane" />
		<?= form_error('username') ?>
	</div>
	<div class="form-group">
		<label for="email">Entrez une adresse email</label>
		<input class="form-control" type="email"  name="email" value="<?= set_value('email'); ?>" placeholder="john.doe@gmail.com" />
		<?= form_error('email') ?>
	</div>
	<div class="row">
		<div class="form-group col-6 p-3">
			<label for="password">Entrez un mot de passe</label>
			<input class="form-control" type="password" name="password" value="<?= set_value('password'); ?>" placeholder="********" />
			<?= form_error('password') ?>
		</div>
		<div class="form-group col-6 p-3">
			<label for="password">Repetez le mot de passe</label>
			<input class="form-control" type="password" name="repeat" placeholder="********" />
			<?= form_error('repeat') ?>
		</div>
	</div>
	<div class="form-group">
		<label for="type">Type du compte à créer</label>
		<select name="type" class="form-control">
			<option value="V">Vendeur</option>
			<option value="A">Administrateur</option>
		</select>
		<?= form_error('type') ?>
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-primary">Créer mon compte</button>
	</div>
</form>
