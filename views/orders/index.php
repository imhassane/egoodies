<h4>Suivi de commandes</h4>
<hr class="mb-2" />

<p class="font-weight-lighter text-info mt-3 mb-3">
	Pour chercher votre commande, veuillez vous munir de son code d'identification (8 caractères) et de son code (20 caractères). <br />
	Vous avez un mois pour retirer votre commande, ce délai passé votre commande sera annulée.
</p>

	<form method="post" action="<?= base_url() . "index.php/orders/suivi" ?>" class="card card-body p-2">
		<?php
			if(isset($message)) {
				?>
				<p class="p-2 font-weight-lighter text-danger"><?= $message ?></p>
				<?php
			}
		?>
		<div class="row">
			<div class="form-group col-6">
				<label>Code d'identification</label>
				<input type="text" name="ord_id" class="form-control" value="<?= set_value('ord_id'); ?>" />
				<?= form_error('ord_id'); ?>
			</div>
			<div class="form-group col-6">
				<label for="code">Code de la commande</label>
				<input type="text" name="ord_code" class="form-control" value="<?= set_value('ord_code'); ?>" />
				<?= form_error('ord_code'); ?>
			</div>
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-info">
				Chercher une commande
			</button>
		</div>
	</form>
<?php
	if(isset($orders)) {
?>
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

<?php } ?>
