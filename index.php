<?php
// võtame kasutusele järgnevate failide sisu
require 'config.php';
require 'classes/Request.php';
require 'classes/user.php';
require 'classes/database.php';

//  1. Võtan $request objekti kontrolleri väärtuse
// 2. liidan saadud väärtuse kahe stringiga ('controllers/' ja '.php') kontrollime, kas saadud nimega kontroller eksisteerib.
if (file_exists('controllers/'.$request->controller.'.php')) {
	// selle kontrolleri sisu kasutusele võtmine
	require 'controllers/'.$request->controller.'.php';
	// teen uue objekti $controller
	$controller = new $request->controller;
	// TODO Henno, seleta!
	if (isset($controller->requires_auth)) {
		//küsime autentimist
		$_user->require_auth();
	}
	// Omistame antud kontrollerile $requestist saadud actioni
	$controller->{$request->action}();
}
	// kui tahetud kontrollerit ei leitud kuva veateade
	else {
	echo "The page '{$request->controller}' does not exist";
	//var_dump($request->controller);
}
