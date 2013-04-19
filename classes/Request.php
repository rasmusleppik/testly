<?php
//defineerib uue muutuja tüübi
class Request
{

	public $controller = DEFAULT_CONTROLLER;
	public $action = 'index';
	public $params = array();

	public function __construct()
	{
		//kui kasutaja on kirjutanud midagi addressirea lõppu
		if (isset($_SERVER['PATH_INFO'])) {

			// $_SERVER['PATH_INFO'] = /kasutajad(controller)/vaatamine(action)/23(parameeter)
			if ($path_info = explode('/', $_SERVER['PATH_INFO'])) {

				array_shift($path_info);

				// Kontrollime kas pathinfo[0] 1. liige on olemas, siis antud classi omaduse väärtuseks saab pathinfo
				//massiivi esimene liige (mis samas ka eemaldatakse pathinfost). Kui pathinfos pole esimest liiget,
				//pannakse antud classi controller omaduse väärtuseks welcome
				$this->controller = isset($path_info[0]) ? array_shift($path_info) : 'welcome';

				//Kontrollime kas pathinfo[0] 1. liige on olemas ja ei ole tühi, siis antud classi actioni väärtuseks saab
				// allesjäänud pathinfo esimene liige (mis samas ka eemaldatakse). Juhul, kui pathinfos pole esimest liiget
				//pannakse antud classi  actioni omaduse väärtuseks index
				$this->action = isset($path_info[0]) && ! empty ($path_info[0]) ? array_shift($path_info) : 'index';

				//Kontrollime, kas pathinfo [0] 1. liige on olemas, kui on olemas, saab antud classi parameetriteks kõik
				// path info massiivi alles jäänud liikmed. Kui ei ole, annab väärtuseks NULL
				$this->params = isset($path_info[0]) ? $path_info : NULL;
			}
		}
	}
	//Funktsioon ümbersuunamiseks . Selle parameetriks on $destination , mis saab väärtuse sellel  hetkel kui ta välja kutsutakse
	//$request->redirect('tests');   redirect on meetod, mis omab parameetrit nimega $destination ja käivitumisel saab brauseri
    //URLiks antud juhul BASE_URL (/testly/) ja liimib sellele otsa $ destination (tests) väärtuse.
	public function redirect($destination)
	{
		header('Location: '.BASE_URL.$destination);
	}
}

//Kuu kusasgil tehakse $requesti vastu päring, siis käivitub uuesti Request classi .
$request = new Request;