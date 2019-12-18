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
			<h4 class="mb-3">Liste des profils</h4>
			<hr />
			<p><small><?= count($profils); ?> profils trouvés</small></p>

			<div>
				<table class="table table-striped table-sm">
					<thead>
						<th>Avatar</th>
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
							<td><img src="https://avatars.dicebear.com/v2/human/<?=$profil->prf_prenom;?>.svg" height="50" width="50" alt="A" /></td>
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
