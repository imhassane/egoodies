<div class="row">
	<div class="col-4">
		<h4>Informations personnelles</h4>
		<div>
			<img
				width="100"
				src="https://avatars.dicebear.com/v2/human/<?=$profil->prf_prenom;?>.svg"
			/>
		</div>
		<p>
			<span><?= $profil->prf_nom; ?></span>
			<span><?= $profil->prf_prenom; ?></span>
		</p>
		<p>
			<strong>Type du profil: </strong>
			<span>
				<?= $profil->cpt_status == 'A' ? 'Administrateur' : 'Vendeur'; ?>
			</span>
		</p>
		<div>
			<div class="list-group">
				<a href="<?= base_url() . "index.php/member/modifiermotdepasse" ;?>" class="list-group-item">Modifier mon mot de passe</a>
				<a href="<?= base_url() . "index.php/member/modifierprofil"; ?>" class="list-group-item">Modifier le profil</a>
			</div>
		</div>
	</div>
</div>
