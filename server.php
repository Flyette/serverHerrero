
<?php

require_once __DIR__.'/vendor/autoload.php';

function connect(){
	ORM::configure('mysql:host=localhost;dbname=Herrero');
	ORM::configure('username', 'root');
	ORM::configure('password', 'toor');
}
connect();


$app = new Silex\Application();


$app->get('/', function () {
	ob_start();
	require 'views/list.php';
	$view = ob_get_contents();
	ob_end_clean();
	return $view;
});

$app->post('/', function(){
	ob_start();
	create($_POST['tiens']);
	$view = ob_get_contents();
	ob_end_clean();
	return $view;
});

$app['debug'] = true;

$app->run();

// function all(){
// 	 $baskets = ORM::for_table('basketBDD')->find_many();
// 	 echo $baskets;
// };


function create($data){
	$basket = ORM::for_table('basketBDD')->create();
	$basket->basket = $data;
	$basket->save();
}



?>
