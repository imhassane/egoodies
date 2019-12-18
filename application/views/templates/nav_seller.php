<nav class="navbar navbar-expand-lg navbar-dark bg-info">
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
					<a class="nav-link" href="<?= base_url() . "index.php/orders/commandes" ?>">Commandes</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= base_url() . "index.php/originals?cat=1"; ?>">Galerie</a>
				</li>
				<li class="dropdown">
					<a class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="#"><?= $this->session->userdata('cpt_username'); ?></a>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="<?= base_url() . "index.php/member/espacevendeur" ?>">Espace vendeur</a>
						<a class="dropdown-item" href="<?= base_url() . "index.php/member/deconnexion" ?>">Déconnexion</a>
					</div>
				</li>
			</ul>
		</div>
	</div>
</nav>
