<?php
	if($method == "update") {

		?>
		<div class="p-3">
			<p class="font-weight-lighter text-info">
				La commande a été marquée comme retirée
			</p>
		</div>
		<?php

	} else {
		?>
		<div class="p-3">
			<p class="font-weight-lighter text-info">
				La commande a été définitivement supprimée de la base de données
			</p>
		</div>
		<?php
	}
?>
