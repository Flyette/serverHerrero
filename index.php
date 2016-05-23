<?php
require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/functions.php';
use Flyette\Models;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\HttpFoundation\StreamedResponse;

$templates = new League\Plates\Engine('views');

connect();

$app = new Silex\Application();

$app['debug'] = true;


$app->get('/resize', function() use ($resize){
	echo('coucou');
	$resize();
	return '';
});

$app->get('/img/{dossier}/{img}', function(Silex\Application $app, $dossier, $img) use ($getImage){
	$d= $getImage($dossier.'/'.$img);
	return $app->stream($d->send(), 200, ['Content-Type'=>'image/jpeg']);
});

//envoie les dossier photos 
$app->get('/photos', function(){
	$data = [];
	$dossiers = (glob('photos/*'));
	foreach ($dossiers as $dos) {
		$dossierParent = array(
			'title' => substr($dos, 7),
			'img' => []);
		foreach (glob($dos."/*") as $pic) {
			$pic = substr($pic, 7);
			$pic = 'index.php/img/'.$pic;
			array_push($dossierParent['img'], ['url'=>$pic]);
		}
		array_push($data, $dossierParent);
	};
	return json_encode($data);

});
//chemin des dossiers photos
$app->get('/photos/{dossier}', function($dossier) {
	$data = [];
	$dossiers = (glob('photos/'.$dossier.'/*'));
	foreach ($dossiers as $dos) {
		$dossierParent = array(
			'img' => $dos);
		foreach (glob($dos."/*") as $pic) {
			array_push($dossierParent, ['url'=>$pic]);
		}
		array_push($data, $dossierParent);
	};
	return json_encode($data);
});


$app->get('/', function () use ($app){
	return $app->redirect('index.php/commandes/');

});

//listes des commandes en cours
$app->get('/commandes/', function () use ($templates){
	// var_dump(glob('photos/*/*'));
	if(isset($_GET['id'])){
		echo $templates->render('show');
	} else {
		echo $templates->render('list');
	}
	return '';
});

$app->get('/commandes/fichier', function() use ($templates){
	return $templates->render('file');
});

//parcourir un dossier et l'ajouter dans dossier photos
$app->post('/commandes/post',function(){
	return '';

});

$app->get('/commandes/post', function(){
	return '';
});


$app->post('/commandes/archive', function () use ($app, $templates){
	if(isset($_POST['id'])){
		$order = new Flyette\Models\Order();
		$order->archiv($_POST['id']);
		echo $templates->render('list');
	} 
	return '';
});

$app->get('/commandes/archive', function() use ($templates){
	if(isset($_GET['id'])){
		echo $templates->render('show');
	}
	return '';
});


$app->get('/commandes/desarchive', function() use ($templates){
	if(isset($_GET['id'])){
		echo $templates->render('archive');
	}
	return '';
});


$app->get('/commandes/delete', function() use ($templates){
	if(isset($_GET['id'])){
		echo $templates->render('archive');
	}
	return '';
});

$app->post('/commandes/desarchive', function () use ($templates){
	if(isset($_POST['id'])){
		$order = new Flyette\Models\Order();
		$order->desarchiv($_POST['id']);
		echo $templates->render('listArchive');
	} 
	return '';
});

$app->get('/commandes/archives', function() use ($templates){
	if(isset($_GET['id'])){
		echo $templates->render('archive');
	}
	else {echo $templates->render('listArchive');
}
return '';

});

$app->get('/index', function() use ($templates){
	if(isset($_GET['id'])){
		echo $templates->render('show');
	}
	else {echo $templates->render('list');
}
return '';

});

$app->post('/commandes/create', function(){
	ob_start();
	create($_POST['tiens'], $_POST['identifiant']);
	$view = ob_get_contents();
	ob_end_clean();
	return $view;
});

$app->post('/commandes/delete', function() use ($templates){
	if(isset($_POST['id'])){
		$order = new Flyette\Models\Order();
		$order->deleteOrder($_POST['id']);
		echo $templates->render('listArchive');
	}
	return '';
});

function create($data, $name){
	$basket = ORM::for_table('basketBDD')->create();
	$basket->basket = $data;
	$basket->nom = $name;
	$basket->save();
}

$app->run();