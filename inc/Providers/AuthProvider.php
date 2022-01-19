<?php


namespace Providers;


use Exception;

class AuthProvider implements IProvider
{
	private $App;

	function __construct($App)
	{
		$this->App = $App;
	}

	function provide() {
		// Реализация провайдера авторизации
		if(isset($_SESSION['AUTH'])) {
			return true;
		} else {
			$this->App->redirect('/login-form/');
		}
	}
}