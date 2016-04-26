
<?php
require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/functions.php';


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
			array_push($images, ['url'=>$pic]);
		}
		return json_encode($images);
	
});

$app->post('/', function(){
	ob_start();
	create($_POST['tiens'], $_POST['identifiant']);
	$view = ob_get_contents();
	ob_end_clean();
	return $view;
	});


$app['debug'] = true;

$app->run();

function create($data, $name){
	$basket = ORM::for_table('basketBDD')->create();
	$basket->basket = $data;
	$basket->nom = $name;
	$basket->save();
}

