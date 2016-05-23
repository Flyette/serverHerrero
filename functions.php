<?php 
require_once __DIR__.'/vendor/autoload.php';
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
	'source' => __DIR__.'/photos',
	'cache' => __DIR__.'/new_images',
	'watermarks' => new Filesystem(new Local(__DIR__.'/watermark')),
	]);

$riddim = function($image) use ($server){
	$server->outputImage($image, ['w' => 400]);
};

$resize = function() use($server, $riddim) {
	$dir = __DIR__.'/photos/';
	$dosParent = glob($dir.'*');
	foreach ($dosParent as $dosEnfant) {
		if(is_dir($dosEnfant)){

		$candidat = glob($dosEnfant.'/*');
		foreach ($candidat as $path) {
			$tgallan = str_replace($dir, '',$path);
			echo($tgallan);
			$riddim($tgallan);
			echo 'redim terminé';
		}
		}
	}
};

$getImage = function($path=null) use($server) {
	if(is_null($path)){
		$fooPath = $_SERVER["REQUEST_URI"];
		$path = substr(strrchr($fooPath, '/'), 1);
		
	}
	$server->outputImage($path, ['w' => 350]);
};

$genTableau = function() {

};
