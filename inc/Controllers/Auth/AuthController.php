<?php

namespace Controllers\Auth;

use Controller;

class AuthController extends Controller
{
	function index() {
		$vars = [];
		$vars['title'] = 'Вход на сайт';
		$vars['description'] = 'Вход на сайт';

		// Вывод ошибок, если есть
		$vars['errors'] = $this->App->message->find('AUTH_LOGIN_FORM');

		// Отображение формы авторизации
		return $this->render('login/form', $vars);
	}

	function login() {

		// Якобы выполняем проверку, что такой юзер есть
		if($_POST['login'] != 'login' || $_POST['password'] != 'pass') {

			// Ошибка формы
			$this->App->message->add('Неверный логин или пароль', 'ERROR', 'AUTH_LOGIN_FORM');

			// Редирект на форму
			$this->App->redirect('/login-form/');

		} else {
			// Авторизируемся
			$_SESSION['AUTH'] = [
				"USER_ID" => 1
			];

			// В админку
			$this->App->redirect('/admin/');
		}
	}

	function logout() {
		// Авторизируемся
		unset($_SESSION['AUTH']);

		// На форму регистрации
		$this->App->redirect('/login-form/');
	}
}