<?php
require 'parts/header.php';
?>
<?php $order = new Flyette\Models\Order();
$baskets = $order->archived();?>
<div class="ui inverted segment">
	<div class="ui inverted secondary pointing menu">
		<a class="item" href="../commandes">
			Commandes en cours
		</a>
		<a class="active item" href="archives">
			Commandes archivées
		</a>
		<a class="item right nb_c">
			<?= count($baskets)?> Commande(s) en cours
		</a>
	</div>
</div>
<h2>Commandes archivées</h2>
<table class="ui celled table">
	<thead>
		<tr>
			<th>Numéro de commande<a href="?tri=id&direction=ASC"><i class="angle up icon"></i></a><a href="?tri=id&direction=DESC"><i class="angle down icon"></i></a></th>
			<th>Nom</th>
			<th>date</th>
			<th>Nombre de photos</th>
			<th>Détails</th>
			<th>Ouvrir</th>
			<th>Désarchiver</th>
		</tr>		
	</thead>
	<?php
	foreach ( $baskets as $b):
		?>
	<tr>
		<td><a href="?id=<?= $b->id ?>"><?= $b->id?></a></td>
		<td><a href="?id=<?= $b->id ?>"><?= $b->nom?></a></td>
		<td><a href="?id=<?= $b->id ?>"><?= Flyette\Models\Order::frenchDate($b->created_at)?></a></td>
		<td><a href="?id=<?= $b->id ?>"><?= count($b->basket['data'])?></a></td>
		<td><a href="?id=<?= $b->id ?>"><?php $v = $b->basket['data']; foreach ($v as $p) {echo '<image height="40" src="'.$p['url'].'"/>';}?></a></td>
		<td><form  class="ui form" action="" method="get">
					<p><input type="hidden" name="id" value="<?=$b->id?>"></p>
					<p><input class="ui button" type="submit" value="Voir"></p>
				</form></td>
		<td>
			<form action="desarchive" method="post">
				<p><input type="hidden" name="id" value="<?=$b->id?>"></p>
				<p><input class="ui button blue" type="submit" value="<-"></p>
			</form>
		</td>
	<?php endforeach ?>
</tr>
<tbody></tbody>
</table>
<form action="deleteAll" method="post">
			<p><input type="hidden" name="id" value="<?=$o->id?>"></p>
			<p><input class="ui button red" type="submit" value="Tout Effacer"></p>
		</form>

<?php require 'parts/footer.php';?>