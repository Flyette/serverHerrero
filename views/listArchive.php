<?php
require 'parts/header.php';
?>
<?php $order = new Flyette\Models\Order();
$baskets = $order->archived();?>
<div class="ui inverted segment">
  <div class="ui inverted secondary pointing menu">
    <a class="item" href="../index.php">
      Commandes
    </a>
    <a class="active item" href="../index.php/listArchive">
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
			<th>Numéro de commande</th>
			<th>Nom</th>
			<th>date</th>
			<th>Nombre de photos</th>
			<th>Détails</th>
			<th>Désarchiver</th>
		</tr>		
	</thead>
	<?php
	foreach ( $baskets as $b):
	?>
	<tr>
		<td><a href="?id=<?= $b->id ?>"><?= $b->id?></a></td>
		<td><?= $b->nom?></td>
		<td><?= Flyette\Models\Order::frenchDate($b->created_at)?></td>
		<td><?= count($b->basket['data'])?></td>
		<td><?php $v = $b->basket['data']; foreach ($v as $p) {echo '<image height="40" src="'.$p['url'].'"/>';}?></td>
		<td>
			<form action="../index.php/desarchive" method="post">
				<p><input type="hidden" name="id" value="<?=$b->id?>"></p>
				<p><input class="ui button blue" type="submit" value="<-"></p>
			</form>
		</td>
	<?php endforeach ?>
</tr>
<tbody></tbody>
</table>

<?php require 'parts/footer.php';?>