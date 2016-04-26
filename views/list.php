<?php
require 'parts/header.php';
?>

<table class="ui celled table">
	<tr>
		<thead>
			<th>Numéro de commande</th>
			<th>Nom</th>
			<th>date</th>
			<th>Nombre de photos</th>
			<th>Détails</th>
			<th>Archiver</th>
		</thead>
	</tr>		
	<?php
	$order = new Flyette\Models\Order();
	$baskets = $order->all();
	foreach ( $baskets as $b):
		$v = $b->basket['data'];
	?>
	<tr>
		<td><a href="?id=<?= $b->id ?>"><?= $b->id?></a></td>
		<td><?= $b->nom?></td>
		<td><?= Flyette\Models\Order::frenchDate($b->created_at)?></td>
		<td><?= count($b->basket['data'])?></td>
		<td><?php foreach ($v as $p) {echo '<image height="40" src="/phpHerrero/'.$p['url'].'"/>';}?></td>
		<td><a href="#" class="ui blue button icon" title="Archiver l'utilisateur">X</a></td>
<?php endforeach ?>
	</tr>
</table>

<?php require 'parts/footer.php';?>