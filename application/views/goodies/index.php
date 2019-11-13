<h3>Liste des goodies</h3>
<hr class="mb-4" />

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
					<img src="<?= $goody->goo_image; ?>" alt="<?= $goody->goo_name; ?>" style="width: 100%;" />
				</div>
				<?php
			}
		?>
	</div>
</div>
