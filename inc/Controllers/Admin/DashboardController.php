<?php

namespace Controllers\Admin;

use Controller;

class DashboardController extends Controller {
	public function index() {
		$vars = [];

		$vars['title'] = 'Административный раздел';
		$vars['description'] = 'Административный раздел';

		// Шаблон админки обязательно ждёт меню !
		$menu = $this->controller('Admin\\MenuController');
		$vars['menu'] = $menu->index();


		return $this->setTemplate('admin')->render('admin/dashboard', $vars);
	}
}