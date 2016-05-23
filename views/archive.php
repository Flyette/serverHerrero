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
<h2>Commande exécutée</h2>

<div class="ui grid">
	<div class="five wide column">
		<h2>Nom : <?=$o->nom?></h2>
		<h3>Identifiant : <?=$o->id?></h3>
		<h3>Date de la commande : <?= Flyette\Models\Order::frenchDate($o->created_at)?></h3>
		<form action="delete" method="post">
			<p><input type="hidden" name="id" value="<?=$o->id?>"></p>
			<p><input class="ui button red" type="submit" value="Effacer"></p>
		</form>
	</div>
	<div class="eleven wide column">
		<table class="ui celled table">
			<tr>
				<thead>
					<th>Nb de photos <?= count($o->basket['data'])?></th>
					<th>Liste et Format des photos commandées</th>
				</thead>
			</tr>
			<tr>
				<td><?php foreach ($o->basket['data'] as $p) { echo '<image height="80" src="'.$p['url'].'"/>'; echo '<br>';}?></td>
				<td><?php foreach ($o->basket['data'] as $p) { echo $p['url']; echo '<br>';echo '<h4>'.$p['format'].'</h4>'; echo '<br>';}?></td>
			</tr>
		</table>	
	</div>
	<?php require 'parts/footer.php' ?>