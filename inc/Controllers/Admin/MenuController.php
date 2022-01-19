<?php


namespace Controllers\Admin;

use Controller;

class MenuController extends Controller
{
	function index() {
		$vars = [];

		return $this->render('admin/menu', $vars);
	}
}