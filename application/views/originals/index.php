<h2>Galerie</h2>
<?= isset($category) ? "<span>Catégorie choisie: $category->cat_name</span>": "" ?>
<hr class="mb-4" />

<div class="row mt-3 mb-3">
	<div class="col-3">
		<div class="list-group">
			<?php
			foreach ($categories as $cat) {
				?>
				<a class="list-group-item" href="<?= base_url() . 'index.php/originals?cat=' . $cat->cat_id . ''; ?>"><?= $cat->cat_name; ?></a>
				<?php
			}
			?>
		</div>
	</div>
	<div class="col-9">
		<p class="font-weight-lighter">
			<?php
				switch (count($originals)) {
					case 0: echo "aucun original trouvé pour cette catégorie"; break;
					case 1: echo "un original trouvé pour la catégorie <i>$category->cat_name</i>"; break;
					default: echo count($originals) . " originaux trouvés pour la catégorie <i>$category->cat_name</i>";
				}
			?>
		</p>
		<div class="row">
		<?php
		foreach ($originals as $ori) {
			?>
			<div class="col-3 mr-1 mb-2">
				<img src="<?= $ori->ori_image; ?>" height="120" width="100%" />
				<p><a href="<?= base_url() . 'index.php/originals/details/' . $ori->ori_id ;?>" class="text-info"><?= $ori->ori_name; ?></a> </p>
			</div>
			<?php
		}
		?>
		</div>
	</div>
</div>
