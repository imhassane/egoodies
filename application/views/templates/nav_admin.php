<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	<div class="container">
		<a class="navbar-brand" href="<?= base_url(); ?>">NBA Goodies</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item active">
					<a class="nav-link" href="<?= base_url() . "index.php" ?>">Home
						<span class="sr-only">(current)</span>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">About</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Services</a>
				</li>
				<li>
					<a class="nav-link" href="<?= base_url() . "index.php/orders/liste" ?>">Voir les commandes</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= base_url() . "index.php/originals/"?>">Galerie</a>
				</li>
				<li class="dropdown">
					<a class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="#">Espace personnel</a>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="<?= base_url() . "index.php/member/profil" ?>">Mon profil</a>
						<a class="dropdown-item" href="<?= base_url() . "index.php/member/deconnexion" ?>">Déconnexion</a>
					</div>
				</li>
			</ul>
		</div>
	</div>
</nav>