<div>

	<h2>Accès à l'espace d'administration</h2>

	<?php
		if(isset($message)) {
			?>
			<p class="alert alert-danger"><?= $message; ?></p>
			<?php
		}
		?>

	<form method="post" action="<?= base_url() . "index.php/member/connexion" ?>">
		<div class="form-group m-2">
			<label for="pseudo">Nom d'utilisateur</label>
			<input class="form-control" type="text" name="pseudo" placeholder="ex: john.doe" />
		</div>

		<div class="form-group m-2">
			<label for="pseudo">Mot de passe</label>
			<input class="form-control" type="password" name="password" placeholder="*******" />
		</div>


		<div class="m-2">
			<button type="submit" class="btn btn-primary">
				Connexion
			</button>
		</div>

		<p class="p-3">Je veux créer un compte</p>
	</form>

</div>
