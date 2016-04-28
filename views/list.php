<?php
require 'parts/header.php';
?>

<table class="ui celled table">
	<thead>
		<tr>
			<th>Numéro de commande</th>
			<th>Nom</th>
			<th>date</th>
			<th>Nombre de photos</th>
			<th>Détails</th>
			<th>Archiver</th>
		</tr>		
	</thead>
	<?php
	$order = new Flyette\Models\Order();
	$baskets = $order->all();
	foreach ( $baskets as $b):
		?>
	<tr>
		<td><a href="?id=<?= $b->id ?>"><?= $b->id?></a></td>
		<td><?= $b->nom?></td>
		<td><?= Flyette\Models\Order::frenchDate($b->created_at)?></td>
		<td><?= count($b->basket['data'])?></td>
		<td><?php $v = $b->basket['data']; foreach ($v as $p) {echo '<image height="40" src="'.$p['url'].'"/>';}?></td>
		<td>
			<form action="index.php/archive" method="post">
				<p><input type="hidden" name="id" value="<?=$b->id?>"></p>
				<p><input type="submit" value="Fait"></p>
			</form>
		</td>
	<?php endforeach ?>
</tr>
<tbody></tbody>
</table>

<?php require 'parts/footer.php';?>