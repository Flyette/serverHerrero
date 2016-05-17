<?php 
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use League\Glide\ServerFactory;
use League\Glide\Responses\SymfonyResponseFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$imgsize = ['w' => 600];

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

$riddim = function($image) use ($server, $imgsize){
	$server->makeImage($image, $imgsize);
};

$resize = function() use($server, $riddim) {

	$dir = __DIR__.'/img/';
	$foo = glob($dir.'*');

	foreach ($foo as $path) {
		$tgallan = str_replace($dir, '',$path);
		$riddim($tgallan);
	}
};

$getImage = function($img) use($server) {
	return $server->getImageResponse($img, $imgsize);
};