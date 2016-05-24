<?php
require 'parts/header.php';
$order = new Flyette\Models\Order();
$baskets = $order->all();
?>
<div class="ui inverted segment">
	<div class="ui inverted secondary pointing menu">
		<a class="active item" href="../commandes">
			Commandes en cours
		</a>
		<a class="item" href="archives">
			Commandes archivées
		</a>
		<a class="item" href="fichier">
			Fichier photos
		</a>
		<a class="item right nb_c">
			<?= count($baskets)?> Commande(s) en cours
		</a>
	</div>
</div>

<h2><?= count($baskets)?> Commandes en cours</h2>
<table class="ui celled table">
	<thead>
		<tr>
			<th>Numéro de commande</th>
			<th>Nom</th>
			<th>Nombre de photos</th>
			<th>Photos séléctionnées</th>
			<th>Date</th>
			<th>Ouvrir</th>
			<th>Archiver</th>
		</tr>		
	</thead>
	<?php foreach ( $baskets as $b):?>
		<tr>
			<td><a href="?id=<?= $b->id ?>"><?= $b->id?></a></td>
			<td><a href="?id=<?= $b->id ?>"><?= $b->nom?></a></td>
			<td><a href="?id=<?= $b->id ?>"><?= count($b->basket['data'])?></a></td>
			<td><a href="?id=<?= $b->id ?>"><?php foreach ($b->basket['data'] as $p) {
				echo '<image height="30" src="'.$p['url'].'"/>';}?></a></td>
			<td><a href="?id=<?= $b->id ?>"><?= Flyette\Models\Order::frenchDate($b->created_at)?></a></td>
			<td>
				<form  class="ui form" action="" method="get">
					<p><input type="hidden" name="id" value="<?=$b->id?>"></p>
					<p><input class="ui button" type="submit" value="Voir"></p>
				</form>
			</td><td>
			<form  class="ui form" action="archive" method="post">
				<input type="hidden" name="id" value="<?=$b->id?>">
				<p><input class="ui button archive green" type="submit" value="Fait"></p>
			</form>
		</td>
	<?php endforeach ?>
</tr>
<tbody></tbody>
</table>
<?php require 'parts/footer.php';?>