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
						<th>Nom</th>
						<th>Prenom</th>
						<th>Email</th>
						<th>Statut</th>
						<th>Nom d'utilisateur</th>
					</thead>
					<tbody>
					<?php
					foreach ($profils as $profil) {
						?>
						<tr>
							<td><?= $profil->prf_nom; ?></td>
							<td><?= $profil->prf_prenom; ?></td>
							<td><?= $profil->prf_email; ?></td>
							<td>
								<?= $profil->cpt_status == 'A' ? "<span><i style='color: green'>Administrateur</i></span>" : 'Vendeur'; ?>
							</td>
							<td><?= $profil->cpt_username; ?></td>
						</tr>
						<?php
					}
					?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

</div>
