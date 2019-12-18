<h3>Liste des actualités</h3>
<p class="font-weight-lighter mb-4"><?= count($news); ?> articles publiés</p>

<div>
	<?php

		foreach ($news as $new) {
			?>
			<div class="row mb-2 p-2">
				<div class="col-2">
					<img src="<?= $new->ori_image; ?>" width="100" />
				</div>
				<div class="col-10">
					<h4><?= $new->new_title; ?></h4>
					<hr />
					<p class="font-weight-lighter">
						<strong>Publiée le: </strong> <span><?= nice_date($new->new_created_at, 'd/m/Y'); ?></span>
						<strong>&Eacute;crit par: </strong> <span><?= $new->cpt_username; ?></span>
					</p>
					<p>
						<?= substr($new->new_content, 0, 150); ?> ...
					</p>
					<div>
						<a href="" class="text-info">Lire la suite</a>
					</div>
				</div>
			</div>
			<?php
		}

	?>
</div>
