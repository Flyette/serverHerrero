<?php
require_once __DIR__.'/vendor/autoload.php';
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use League\Glide\ServerFactory;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;

// Create the logger
$logger = new Logger('my_logger');
// Now add some handlers
$logger->pushHandler(new StreamHandler(__DIR__.'/my_app.log', Logger::DEBUG));
$logger->pushHandler(new FirePHPHandler());


$server = League\Glide\ServerFactory::create([
	'source' => __DIR__.'/photos',
	'cache' => __DIR__.'/new_images',
	]);

// $server->setBaseUrl('/photos/')

function riddim ($image) {
	$server->outputImage($image, ['w' => 300, 'h' => 400]);
}

$resize = function() use($server) {


	$dir = __DIR__.'/photos/';
	$dosParent = glob($dir.'*');
	
	foreach ($dosParent as $dosEnfant) {
		$candidat = glob($dosEnfant.'/*');

		foreach ($candidat as $path) {
			$tgallan = str_replace($dir, '',$path);
			echo($tgallan);
			riddim($tgallan);
			echo 'redim terminé';
		}
	}
};

$getImage = function() use($server) {
	$fooPath = $_SERVER["REQUEST_URI"];
	$path = substr(strrchr($fooPath, '/'), 1);
	$server->outputImage($path, ['w' => 300, 'h' => 400]);
};

$genTableau = function() {

};
