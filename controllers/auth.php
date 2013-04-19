<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Rait
 * Date: 16.04.13
 * Time: 13:34
 * To change this template use File | Settings | File Templates.
 */

class auth
{

	function index()
	{
		global $request;
		global $errors;
		if (isset($_SESSION['session expired'])) {
			$errors[] = "sessioon on aegunud!";
			unset($_SESSION['session expired']);
		}
		if (isset($_POST['username'])) {
			$username = $_POST['username'];
			$password = $_POST['password'];
			$user_id = get_one("SELECT user_id FROM user WHERE username='$username' AND password='$password'");
			if (! empty($user_id)) {
				$_SESSION['user_id'] = $user_id;
				$request->redirect('tests');
			}
			$errors[] = "vale kasutajanimi või parool!";

		}
		require 'views/auth_view.php';
	}

	function logout()
	{
		global $request;
		session_destroy();
		$request->redirect('auth');
	}
}