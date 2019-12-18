<h3>Espace administrateur</h3>
<hr class="mb-3" />

<div class="row">

	<div class="col-3">
		<div class="list-group">
			<a class="list-group-item" href="<?= base_url() . "index.php/member/profil" ; ?>">Afficher votre profil</a>
			<a class="list-group-item" href="<?= base_url() . "index.php/member/inscription" ;?>">Créer un profil</a>
			<a class="list-group-item" href="<?= base_url() . "index.php/member/profils" ;?>">Liste des profils</a>
		</div>
	</div>

	<div class="col-9 mb-3">
		<div>
			<h4 class="mb-3">Liste des commandes</h4>
			<hr />

			<div>
				<table class="table table-striped table-sm">
					<thead>
						<th>Code commande</th>
						<th>Date de la commande</th>
						<th>Point de retrait</th>
						<th>Etat</th>
						<th>Action</th>
					</thead>
					<tbody>
						<?php
							foreach ($orders as $order) {
								?>
								<tr>
									<td><?= $order->ord_code; ?></td>
									<td><?= $order->ord_created_at; ?></td>
									<td><?= $order->wit_name; ?></td>
									<td>
										<?= $order->ord_status == 'R' ? "<span><i style='color: red'>retirée</i></span>" : 'disponible'; ?>
									</td>
									<td><a class="btn btn-outline-primary" href="<?= base_url() . 'index.php/orders/details/' . $order->ord_identification . '/' . $order->ord_code; ?>">details</a> </td>
								</tr>
								<?php
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
		<div>
			<h4 class="mb-3">Points de retraits</h4>
			<hr />
			<div class="row">
			<?php
				foreach ($withs as $with) {
					?>
					<div class="col-3 card card-body m-1">
						<strong><?= $with->wit_name; ?></strong>
						<p><i><?= $with->wit_adress; ?></i></p>
					</div>
					<?php
				}
			?>
			</div>
		</div>
	</div>

</div>
