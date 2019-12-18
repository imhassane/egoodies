<h3>Informations</h3>
<hr class="mb-3" />

<div>
	<form method="post">
		<div class="row">
			<div class="form-group col-6">
				<label>Votre nom</label>
				<input type="text" name="last_name" class="form-control" value="<?= set_value('last_name'); ?>" />
				<?= form_error('last_name',"<p class='text-danger'>", "</p>"); ?>
			</div>
			<div class="form-group col-6">
				<label>Votre prénom</label>
				<input type="text" name="first_name" class="form-control" value="<?= set_value('first_name'); ?>" />
				<?= form_error('first_name', "<p class='text-danger'>", "</p>"); ?>
			</div>
		</div>
		<div class="form-group">
			<label>Votre adresse email</label>
			<input type="email" name="email" class="form-control" value="<?= set_value('email'); ?>" />
			<?= form_error('email', "<p class='text-danger'>", "</p>"); ?>
		</div>
		<div class="form-group">
			<label>Choisissez un point de retrait</label>
			<select name="wit_id" class="form-control">
				<option value="">--- Selectionner un point de retrait ---</option>
				<?php
				foreach ($withs as $wit) {
					?>
					<option value="<?= $wit->wit_id; ?>"><?= $wit->wit_name; ?></option>
					<?php
				}
				?>
			</select>
			<?= form_error('wit_id', "<p class='text-danger'>", "</p>"); ?>
		</div>
		<div class="form-group float-right">
			<a class="btn btn-danger" href="<?= base_url() . 'index.php/panier' ;?>">Retour au panier</a>
			<input type="submit" value="Etape suivante" class="btn btn-info" />
		</div>
	</form>
</div>
