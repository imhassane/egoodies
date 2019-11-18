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
				<li>
					<a class="nav-link" href="<?= base_url() . "index.php/orders/liste" ?>">Suivi de commandes</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= base_url() . "index.php/originals/"?>">Galerie</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= base_url() . "index.php/goodies/" ;?>">Goodies</a>
				</li>
				<li>
					<a class="nav-link" href="<?= base_url() . "index.php/member" ?>">Espace membre</a>
				</li>
			</ul>
		</div>
	</div>
</nav>
