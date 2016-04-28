
<?php
require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/functions.php';
use Flyette\Models;

$templates = new League\Plates\Engine('views');

connect();


$app = new Silex\Application();



$app->get('/', function () use ($templates){
	if(isset($_GET['id'])){
		echo $templates->render('show');
	} else {
		echo $templates->render('list');
	}
	return '';
	// ob_start();
	// require 'views/list.php';
	// $view = ob_get_contents();
	// ob_end_clean();
	// return $view;
});

$app->get('/photos', function(){
	$images = [];
	foreach (glob("img/*.JPG") as $pic) {
		array_push($images, ['url'=>'http://192.168.1.14/phpHerrero/'.$pic]);
	}
	return json_encode($images);
	
});

$app->post('/archive', function () use ($templates){
	if(isset($_POST['id'])){
	} 
	Flyette\Models\Order::archive($_POST['id']);

	echo $templates->render('archive');
	return '';
});



$app->post('/', function(){
	ob_start();
	create($_POST['tiens'], $_POST['identifiant']);
	$view = ob_get_contents();
	ob_end_clean();
	return $view;
});


$app['debug'] = true;


function create($data, $name){
	$basket = ORM::for_table('basketBDD')->create();
	$basket->basket = json_decode($data);
	$basket->nom = $name;
	$basket->save();
}

$app->run();