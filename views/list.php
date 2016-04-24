
<?php require_once __DIR__.'./../vendor/autoload.php';
require 'parts/header.php';


?>

<table class="ui celled table">
	<tr>
		<thead>
			<th>Numéro de commande</th>
			<th>Détails</th>
		</thead>
	</tr>		
	<?php
	$baskets = ORM::for_table('basketBDD')->find_many();
	foreach ($baskets as $b):
		$panier = $b->basket;
		// $panier = json_decode($panier);

		echo $panier;


		// foreach ($panier as $i) {
		// echo '<br>';
		// echo $panier[$i];
		// echo '<br>';
		// }



	?>
	<tr>
		<td><?php echo $b->id?></td>
		<td><?php echo $b->basket?></td>
	</tr>
<?php endforeach ?>
</table>

<?php require 'parts/footer.php';?>
