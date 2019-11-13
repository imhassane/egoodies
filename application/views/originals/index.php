<h2>Galerie</h2>
<?= isset($category) ? "<span>Catégorie choisie: $category->cat_name</span>": "" ?>
<hr class="mb-4" />

<div class="card card-body p-4">
	<h4>Liste des catégories</h4>
	<p class="mt-2 mb-2">En sélectionnant une catégorie, seuls les articles de cette catégorie seront affichés</p>

	<div class="mt-2 mb-2">
		<form method="get" action="<?= base_url() . "index.php/originals" ?>"">
			<select name="categorie" class="form-control">
				<option value="all">Toutes les catégories</option>
				<?php
				foreach ($categories as $category) {
					?>
					<option value="<?= $category->cat_id ?>"><?= $category->cat_name; ?></option>
					<?php
				}
				?>
			</select>
			<button type="submit" class="m-3 btn btn-primary">Trier les catégories</button>
		</form>
	</div>

</div>
<?php
	if(isset($message)) {
		?>
		<p class="alert alert-danger"><?= $message; ?></p>
		<?php
	} else {
		?>
		<div class="mt-4 mb-4">

			<div class="row">
				<?php
				foreach ($originals as $original) {
					?>
					<div class="col-2 mb-2">
						<a href="<?= base_url() . 'index.php/originals/details/' . $original->ori_id ?>">
							<img src="<?= $original->ori_image ?>" height="100" alt="<?= $original->ori_name ?>"/>
						</a>
					</div>
					<?php
				}
				?>
			</div>

		</div>

		<?php
	}
