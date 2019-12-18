
<div>
	<h5>Liste des commandes</h5>
	<p class="font-weight-lighter text-info">
		<?php
		$count = count($orders);
		switch ($count) {
			case 0: echo "aucune commande passée dans votre point de retrait"; break;
			case 1: echo "Une commande passée dans votre point de retrait"; break;
			default: echo $count . " commandes passées dans votre point de retrait"; break;
		}
		?>
	</p>
	<p class="font-weight-lighter font-italic">* Les commandes en fond rouge ont été rétirées</p>
	<table class="table table-bordered table-sm table-striped">
		<thead>
			<th>Email du client</th>
			<th>Date de retrait max</th>
			<th>Prix</th>
			<th>Code d'identification</th>
			<th>Code</th>
			<th>Actions</th>
		</thead>
		<tbody>
		<?php
		foreach ($orders as $ord) {
			?>
			<tr class="font-weight-lighter <?= $ord->ord_status == 'R' ? 'table-danger' : ''; ?>">
				<td><?= $ord->ord_email ;?></td>
				<td><?= nice_date($ord->ord_max_date, 'd M Y à H:m') ;?></td>
				<td class="font-italic"><?= $ord->ord_price ;?> €</td>
				<td><?= $ord->ord_identification ;?></td>
				<td><?= $ord->ord_code ;?></td>
				<td><a class="text-info" href="<?= base_url() . 'index.php/orders/details/' . $ord->ord_identification . '/' . $ord->ord_code ; ?>">voir la commande</a> </td>
			</tr>
			<?php
		}
		?>
		</tbody>
	</table>
</div>
