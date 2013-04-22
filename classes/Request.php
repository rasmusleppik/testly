<?php
class Request
{

	public $controller = DEFAULT_CONTROLLER;
	public $action = 'index';
	public $params = array();

	public function __construct()
	{
		//kui kasutaja on kirjutanud aadressiribale
		if (isset($_SERVER['PATH_INFO'])) {
			if ($path_info = explode('/', $_SERVER['PATH_INFO'])) { // $_SERVER['PATH_INFO'] = /kasutajad/vaatamine/23
				array_shift($path_info);
				$this->controller = isset($path_info[0]) ? array_shift($path_info) : 'welcome';
				$this->action = isset($path_info[0]) && ! empty ($path_info[0]) ? array_shift($path_info) : 'index';
				$this->params = isset($path_info[0]) ? $path_info : NULL;
			}
		}
	}

	public function redirect($destination)
	{
		header('Location: '.BASE_URL.$destination);
	}
}


$request = new Request;