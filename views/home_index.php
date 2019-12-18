<div class="mt-3">
	<h2>Dernières actualités</h2>
	<hr class="mb-2" />
	<div class="">
		<?php
		foreach ($news->result() as $new) {
			?>
			<div class="card card-body m-2 p-2">
				<h3><?= $new->new_title; ?></h3>
				<p class=""><?= $new->new_content; ?></p>
				<p>
					<a href="" class="btn btn-primary">Lire</a>
				</p>
			</div>
			<?php
		}
		?>
	</div>
	<p>
		<a href="/">Voir toutes les actualités</a>
	</p>
</div>
