<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Rait
 * Date: 16.04.13
 * Time: 13:03
 * To change this template use File | Settings | File Templates.
 */
//uus objektitüüp nimega user
class user
{

	//user tüüp objekti atribuut nimega $logged in, vaikeväärtusega false
	public $logged_in = FALSE;

	//funktsioon, mis käivitatakse iga kord kui seda tüüpi muutuja/objekt luuakse
	function __construct()
	{
		//sessiooni algus (server hoiab $_SESSION massiivis andmeid alles üle korduvate päringute(kasutajainfo),
		//muutuja mis jääb alles.
		session_start();

		//Kontrollitakse kas $_SESSIONIS eksisteerib 'user_id'.
		//Kui eksisteerib siis atribuudile logged_in omistatakse väärtus TRUE
		if (isset($_SESSION['user_id'])) {
			$this->logged_in = TRUE;
		}
	}

	/**
	 * Funktsioon kontrollib, kas kasutaja on sisse logitud. Kui ei ole siis suunab sisselogimiselehele.
	 */
	public function require_auth()
	{
		// annab ligipääsu request objektile
		global $request;
		//Kontroll, kas kasutaja pole sisse logitu
		if ($this->logged_in !== TRUE) {

			// Kontroll kas päring tuli ajaxiga (asi käib taustal, reloadimist ei toimu) või otse brauserist
			// Kas päring on tulnud läbi ajaxi
			// Kas tal on vastav väärtus
			if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])
				&& $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'
			) {
				// vastuses brauserile lisastakse HTTP error kood(mida javascript kontrollib)
				header('HTTP/1.0 401 Unauthorized');
				exit(json_encode(array('data' => 'session_expired')));
			} else {

				$_SESSION['session_expired'] = TRUE;
				$request->redirect('auth');
			}
		}
	}
}

$_user = new user;