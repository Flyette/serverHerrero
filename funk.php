<?php
require_once __DIR__.'/vendor/autoload.php';
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use League\Glide\ServerFactory;

$server = League\Glide\ServerFactory::create([
	'source' => __DIR__.'photos/doosier1/img',
	'cache' => __DIR__.'/new_images',
	]);

// $server->setBaseUrl('/photos/')

function riddim ($image) {
	$server->outputImage($image, ['w' => 300, 'h' => 400]);
}

$resize = function() use($server) {

	$dir = __DIR__.'/photos/doosier1/img/';
	$foo = glob($dir.'*');

	foreach ($foo as $path) {
		$tgallan = str_replace($dir, '',$path);
		var_dump($tgallan);
		riddim($tgallan);
		echo 'redim terminé';
	}
};

$getImage = function() use($server) {
	$fooPath = $_SERVER["REQUEST_URI"];
	$path = substr(strrchr($fooPath, '/'), 1);
	$server->outputImage($path, ['w' => 300, 'h' => 400]);
};

$genTableau = function() {

};
