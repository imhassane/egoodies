<h2>Liste des commandes</h2>
<hr class="mb-2" />

	<form method="post" action="<?= base_url() . "index.php/orders/suivi" ?>" class="card card-body p-2">
		<?php
			if(isset($message)) {
				?>
				<p class="p-2 alert alert-danger"><?= $message ?></p>
				<?php
			}
		?>
		<div class="row">
			<div class="form-group col-6">
				<label>Code d'identification</label>
				<input type="text" name="ord_id" class="form-control" />
			</div>
			<div class="form-group col-6">
				<label for="code">Code de la commande</label>
				<input type="text" name="ord_code" class="form-control" />
			</div>
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-primary">
				Chercher une commande
			</button>
		</div>
	</form>

<div class="list-group">

	<?php
		foreach ($orders as $order) {
		?>
		<div class="card card-body p-2 mt-1 mb-1">
			<div class="row">
				<div class="col-8 pl-4 ml-2">
					<p>
						<strong>Identifiant: </strong><?= $order->ord_identification ?>
						<strong>Code: </strong><?= $order->ord_code ?>
					</p>
					<small>commande passée le <?= nice_date($order->ord_created_at, "d/m/Y") ?></small>
				</div>
				<div class="col-3">
					<a href="details/<?=$order->ord_identification?>/<?=$order->ord_code ?>/" class="btn btn-info">
						Suivre cette commande
					</a>
				</div>
			</div>
		</div>
		<?php
		}
	?>

</div>
