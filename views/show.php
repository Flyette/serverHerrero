<?php 
require 'parts/header.php';


$order = new Flyette\Models\Order();
$o = $order->get($_GET['id']);
?>

<!-- menu vertical -->
<div class="ui inverted segment">
	<div class="ui inverted secondary pointing menu">
		<a class="item" href="../commandes">
			Commandes en cours
		</a>
		<a class="item" href="archives">
			Commandes archivées
		</a>
	</div>
</div>

<h2>Commande en cours</h2>
<table class="ui celled table">
	<tr>
		<thead>
			<th>Nom</th>
			<th>Identifiant</th>
			<th>Nb de photos</th>
			<th>Date de la commande</th>
			<th>Statut</th>
		</thead>
	</tr>
	<tr>
		<td><?=$o->nom?></td>
		<td><?=$o->id?></td>
		<td><?= count($o->basket['data'])?></td>
		<td><?= Flyette\Models\Order::frenchDate($o->created_at)?></td>
		<td>
			<form action="archive" method="post">
				<p><input type="hidden" name="id" value="<?=$o->id?>"></p>
				<p><input class="ui button green" type="submit" value="Fait"></p>
			</form>
		</td>
	</tr>
</table>	

<div class="ui vertical floated right">
	<div class="header">Liste des photos</div>
	<div class="list_photo"><?php foreach ($o->basket['data'] as $p) {echo $p['url']; echo '<br>';}?></div>
</div>

<div>Vue des photos : <br><?php foreach ($o->basket['data'] as $p) {echo '<image height="80" src="'.$p['url'].'"/>';}?></div>
<?php require 'parts/footer.php' ?>