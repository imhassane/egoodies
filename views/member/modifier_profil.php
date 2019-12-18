<h3>Modification du profil</h3>
<hr class="mb-3" />
<?php if(isset($user) && $user == false) { ?>
<p class="alert alert-info">Votre profil a été bien modifié</p>
<?php } else { ?>
<div class="mt-4 mb-4">
	<form method="post" action="">
		<div class="row p-3">
			<div class="col-6">
				<label for="first_name">Entrez votre prénom</label>
				<input class="form-control" type="text" name="first_name" value="<?= $user->prf_prenom; ?>" />
				<?= form_error('first_name'); ?>
			</div>
			<div class="col-6">
				<label for="first_name">Entrez votre nom</label>
				<input class="form-control" type="text" name="last_name" value="<?= $user->prf_nom; ?>" />
				<?= form_error('last_name'); ?>
			</div>
		</div>
		<div class="p-3">
			<label for="first_name">Entrez votre adresse email</label>
			<input class="form-control" type="email" name="email" value="<?= $user->prf_email; ?>" />
			<?= form_error('email'); ?>
		</div>
		<div class="m-3">
			<input type="submit" value="Mettre à jour le profil" class="btn btn-primary" />
			<?= "<a class='btn btn-danger' href='". base_url(). "index.php/member/profil" ."'>Annuler</a>"; ?>
		</div>
	</form>
</div>

<?php }
