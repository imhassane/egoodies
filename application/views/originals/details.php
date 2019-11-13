<?php

	if(isset($message)) {
		?>
		<p class="alert alert-danger"><?= $message; ?></p>
		<?php
	} else {
		?>
		<div class="container row">
			<div class="col-4">
				<img src="<?= $original->ori_image; ?>" alt="<? $original->ori_name; ?>" style="width: 100%" />
			</div>
			<div class="col-8">
				<h3><?= $original->ori_name; ?></h3>
				<p><strong>Description</strong></p>
				<p><?= $original->ori_description; ?></p>
			</div>
		</div>
		<div class="mt-3 mb-3">
			<h3>Goodies associés (<?= count($goodies); ?>)</h3>
			<div class="row">
			<?php
				if(count($goodies) == 0) {
					?>
					<p class="alert alert-primary col-12">Aucun goody associé</p>
					<?php
				}else {
					foreach ($goodies as $goody) {
						?>
						<div class="col-2">
							<img src="<?= $goody->goo_image; ?>" alt="<?= $goody->goo_name; ?>" style="width: 100%"/>
						</div>
						<?php
					}
				}
			?>
			</div>
		</div>
		<?php
	}

