<h3>Votre panier</h3>
<hr class="mb-3" />
<div>
	<?php

		if(count($this->session->userdata('cart')) == 0) {
			?>
			<p class="font-weight-lighter text-info">Votre panier est vide pour l'instant</p>
			<?php
		} else {
			if(isset($message)) {
				?>
				<p class="alert alert-info"><?= $message; ?></p>
				<?php
			}
			$cart = $this->session->cart;
			$total_price = 0;

			foreach ($cart as $id => $el) {
				if(isset($el['goo_name'])) {
					$total_price += $el['goo_price'] * $el['goo_qty'];
					?>
					<div class="row p-1">
						<div class="col-2">
							<img width="100" height="100" src="<?= $el['goo_image']; ?>" alt="<?= $el['goo_name']; ?>"/>
						</div>
						<div class="col-6">
							<p><strong><?= $el['goo_name']; ?></strong></p>
							<p><small><?= $el['goo_description']; ?></small></p>
						</div>
						<div class="col-2">
							<p><strong>Prix unitaire</strong>: <i><?= $el['goo_price']; ?> €</i></p>
							<p><strong>Quantité</strong>: <i><?= $el['goo_qty']; ?></i></p>
							<p><strong>Total</strong>: <i><?= $el['goo_price'] * $el['goo_qty']; ?> €</i></p>
							<p><strong>Stock</strong>: <i><?= $el['stock']; ?></i></p>
						</div>
						<div class="col-2">
							<form method="post">
								<input type="hidden" name="method" value="update"/>
								<input type="hidden" name="id" value="<?= $id; ?>"/>
								<input type="number" class="form-control form-control-sm" value="<?= $el['goo_qty']; ?>"
									   name="num_goodies" min="0" max="<?= $el['stock']; ?>"/>
								<?= form_error('num_goodies', "<p class='text-danger'>", "</p>"); ?>
								<input type="submit" value="Modifier" class="btn btn-info mt-1" style="width: 100%"/>
							</form>
						</div>
					</div>
					<hr/>
					<?php
				} else {
					unset($_SESSION['cart'][$id]);
				}
			}
			?>
			<div class="mt-3">
				<p>
					Le total de la commande est de <?= $total_price; ?> €
					<?php $this->session->set_userdata('total_price', $total_price); ?>
				</p>
				<p>
					<a class="btn btn-info float-right" href="<?= base_url() . 'index.php/panier/informations'; ?>">&Eacute;tape suivante - Informations personnelles</a>
				</p>
			</div>
			<?php
		}

	?>
</div>
