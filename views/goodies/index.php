<h3>Liste des goodies</h3>
<hr class="mb-4" />

<?= validation_errors(); ?>

<div class="row">
	<div class="col-3">
		<h5>Tous les types</h5>
		<ul class="list-group">
			<?php
			foreach ($types as $type) {
				?>
				<li class="list-group-item">
					<a href="<?= base_url() . "index.php/goodies?type=" . $type->typ_id ;?>">
						<?= $type->typ_name; ?>
						<span class="badge badge-primary"><?= $type->totalGoody; ?></span>
					</a>
				</li>
				<?php
			}
			?>
		</ul>
	</div>
	<div class="col-9 row">
		<?php
			foreach ($goodies as $goody) {
				?>
				<div class="col-3">
					<div>
						<img src="<?= $goody->goo_image; ?>" alt="<?= $goody->goo_name; ?>" style="width: 100%;" />
					</div>
					<div class="mt-2">
						<form method="post" action="<?= base_url() . 'index.php/goodies/index';?>">
							<div class="form-group">
								<input type="hidden" name="goo_id" 			value="<?= $goody->goo_id ;?>" />
								<input type="hidden" name="goo_name" 		value="<?= $goody->goo_name ;?>" />
								<input type="hidden" name="goo_image" 		value="<?= $goody->goo_image ;?>" />
								<input type="hidden" name="goo_description" value="<?= $goody->goo_description ;?>" />
								<input type="hidden" name="goo_price" 		value="<?= $goody->goo_price ;?>" />
								<input type="hidden" name="goo_quantity"	value="<?= $goody->goo_quantity; ?>" />
							<input class="form-control form-control-sm" type="number" name="qty" value="0" min="0" max="<?= $goody->goo_quantity; ?>" />
							</div>
							<input style="width:100%" class="btn btn-info btn-small" type="submit" value="Ajouter au panier" />
						</form>
					</div>
				</div>
				<?php
			}
		?>
	</div>
</div>
