<?php 
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