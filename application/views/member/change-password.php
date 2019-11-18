<h3 class="mt-3">Modifier le mot de passe</h3>
<hr class="mb-3" />
<div class="mt-3 mb-3">
	<?= isset($user->message) ? "<p class='alert alert-danger'>$user->message</p>": "" ;?>
	<?= !isset($user->message) && isset($message) ? "<p class='alert alert-info'>$message</p>" : "" ;?>
	<form method="post" action="">
		<div class="form-group p-2">
			<label for="old">Mot de passe actuel</label>
			<input type="password" class="form-control" placeholder="**********" name="current" value="<?= set_value('current'); ?>" />
			<?= form_error('current'); ?>
		</div>
		<div class="row p-2">
			<div class="form-group col-6">
				<label for="old">Nouveau mot de passe</label>
				<input type="password" class="form-control" placeholder="**********" name="new" value="<?= set_value('new'); ?>" />
				<?= form_error('new'); ?>
			</div>
			<div class="form-group col-6">
				<label for="old">Repetez le mot de passe</label>
				<input type="password" class="form-control" placeholder="**********" name="repeat" />
				<?= form_error('repeat'); ?>
			</div>
		</div>
		<div class="form-group p-2">
			<button type="submit" class="btn btn-primary">Modifier le mot de passe</button>
		</div>
	</form>
</div>

