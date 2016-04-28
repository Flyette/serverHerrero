<?php 
require 'parts/header.php';


$order = new Flyette\Models\Order();
$o = $order->get($_POST['id']);
var_dump($o->basket);
?>

<table class="ui celled table">
	<tr>
		<thead>
			<th>Nom</th>
			<th>Identifiant</th>
			<th>Nb de photos</th>
			<th>Date de la commande</th>
			<th>statut</th>
		</thead>
	</tr>
	<tr>
		<td><?=$o->nom?></td>
		<td><?=$o->id?></td>
		<td><?= count($o->basket['data'])?></td>
		<td><?= Flyette\Models\Order::frenchDate($o->created_at)?></td>
		<td>Fait</td>
	</tr>
</table>	

<div class="ui vertical floated right menu">
	<div class="header">Liste des photos</div>
	<div class="menu">
		<div class="item"><?php foreach ($o->basket['data'] as $p) {echo $p['url']; echo '<br>';}?></div>
	</div>
</div>

<div>Vue des photos : <br><?php foreach ($o->basket['data'] as $p) {echo '<image height="80" src="'.$p['url'].'"/>'; echo '<br>';}?></div>
<?php require 'parts/footer.php' ?>