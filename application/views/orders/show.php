<h2 class="mt-3 mb-3">Détails de la commande</h2>

<?php

	if(isset($message)) {
		?>
		<p class="alert alert-danger p-3"><?= $message ?></p>
		<?php
	} else {
		?>
		<div class="card card-body">
			<div class="row">
				<span class="mb-2 col-4"><strong>Nom:</strong> <?= $order->ord_last_name ?></span>
				<span class="mb-2 col-4"><strong>Prenom:</strong> <?= $order->ord_first_name ?></span>
				<span class="mb-2 col-4"><strong>Adresse email:</strong> <?= $order->ord_email ?></span>
				<span class="mb-2 col-6"><strong>Code de la commande:</strong> <?= $order->ord_code ?></span>
				<span class="mb-2 col-6"><strong>Identifiant de la commande:</strong> <?= $order->ord_identification ?></span>
				<span class="mb-2 col-4"><strong>Point de relais:</strong> <?= $order->wit_name; ?></span>
				<span class="mb-2 col-4"><strong>Date:</strong> passée le <?= nice_date($order->ord_created_at, "d/m/Y") ?></span>
				<span class="mb-2 col-12"><strong>Adresse du point:</strong> <?= $order->wit_adress; ?></span>
			</div>
		</div>

		<div class="mt-4 mb-4">
			<h4>Goodies de la commande</h4>
			<p class="pb-4"><?= count($goodies) > 1 ? count($goodies) . " goodies" : count($goodies) . " goody" ?> dans cette commande</p>

			<table class="table table-striped table-sm table-bordered table-danger">
				<caption>Contenu de la commande</caption>
				<thead>
					<th>Nom</th>
					<th>Description</th>
					<th>Image</th>
					<th>Actions</th>
				</thead>
				<tbody>
				<?php
					foreach ($goodies as $goody) {
						?>
						<tr>
							<td><?= $goody->goo_name; ?></td>
							<td><?= $goody->goo_description; ?></td>
							<td><img src="<?= $goody->goo_image ?>" width="50" height="50" alt="<?= $goody->goo_name; ?>" </td>
							<td><a class="btn btn-outline-primary" href="/">Voir</a></td>
						</tr>
						<?php
					}
				?>
				</tbody>
			</table>
		</div>

		<div class="mt-3 mb-3">
			<a class="btn btn-danger" href="/">Supprimer</a>
		</div>
		<?php
	}
