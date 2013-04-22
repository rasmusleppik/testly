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

//user tüüp objekti atribuut nimega $logged_in, vaikeväärtusega FALSE.
	public $logged_in = FALSE;

	function __construct()
	{
		session_start();
		if (isset($_SESSION['user_id'])) {
			$this->logged_in = TRUE;
		}
	}


	public function require_auth()
	{
		global $request;
		if ($this->logged_in !== TRUE) {
			if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])
				&& $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'
			) {
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