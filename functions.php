<?php 
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use League\Glide\ServerFactory;
use League\Glide\Responses\SymfonyResponseFactory;


function dd($var){
	echo '<pre>';
	var_dump($var);
	echo '</pre>'; 
	die();
}

function connect(){
	ORM::configure('mysql:host=localhost;dbname=Herrero');
	ORM::configure('username', 'root');
	ORM::configure('password', 'toor');
}


$server = League\Glide\ServerFactory::create([
	'source' => __DIR__.'/img',
	'cache' => __DIR__.'/new_images',
	'base_url' => '/',
	'response' => new SymfonyResponseFactory()
	]);

$riddim = function($image) use ($server){
	$server->outputImage($image, ['w' => 300, 'h' => 400]);
};

$resize = function() use($server, $riddim) {

	$dir = __DIR__.'/img/';
	$foo = glob($dir.'*');

	foreach ($foo as $path) {
		$tgallan = str_replace($dir, '',$path);
		$riddim($tgallan);
		echo 'redim terminé';
	}
};

$getImage = function($img) use($server) {

	// $fooPath = $_SERVER["REQUEST_URI"];
	// $path = substr(strrchr($fooPath, '/'), 1);
	return $server->getImageResponse($img, ['w' => 300, 'h' => 400]);

};