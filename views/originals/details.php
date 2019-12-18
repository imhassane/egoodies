<?php

	if(isset($message)) {
		?>
		<p class="alert alert-danger"><?= $message; ?></p>
		<?php
	} else {
		?>
		<div class="container row">
			<div class="col-4">
				<img src="<?= $original->ori_image; ?>" alt="<?= $original->ori_name; ?>" style="width: 100%" />
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
					<p class="font-weight-lighter text-info col-12">Aucun goody associé</p>
					<?php
				}else {
					foreach ($goodies as $goody) {
						?>
						<div class="col-2">
							<img src="<?= $goody->goo_image; ?>" alt="<?= $goody->goo_name; ?>" style="width: 100%"/>
							<p class="font-weight-lighter"><?= $goody->goo_name; ?></p>
							<p class="font-weight-lighter font-italic"><?= $goody->goo_price; ?> € - <?= $goody->goo_quantity; ?> en stock</p>
							<div class="mt-2">
								<form method="post" action="<?= base_url() . 'index.php/originals/details/' . $original->ori_id;?>">
									<div class="form-group">
										<input type="hidden" name="goo_id" 			value="<?= $goody->goo_id ;?>" />
										<input type="hidden" name="goo_name" 		value="<?= $goody->goo_name ;?>" />
										<input type="hidden" name="goo_image" 		value="<?= $goody->goo_image ;?>" />
										<input type="hidden" name="goo_description" value="<?= $goody->goo_description ;?>" />
										<input type="hidden" name="goo_price" 		value="<?= $goody->goo_price ;?>" />
										<input type="hidden" name="goo_quantity"	value="<?= $goody->goo_quantity; ?>" />
										<input class="form-control form-control-sm" type="number" name="qty" value="<?= set_value('qty'); ?>" min="0" />
									</div>
									<p class="font-weight-lighter text-danger"><?= isset($qty_exceeded) && (int) $this->input->post('goo_id') == (int) $goody->goo_id ? $qty_exceeded : ''; ?></p>
									<input style="width:100%" class="btn btn-info btn-small" type="submit" value="Ajouter au panier" />
								</form>
							</div>
						</div>
						<?php
					}
				}
			?>
			</div>
		</div>
		<?php
	}

