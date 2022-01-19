<?php

namespace Controllers\Admin;

use Controller;

class CompanyController extends Controller {
	public function index() {
		$vars = [];

		$vars['title'] = 'Компании - Административный раздел';
		$vars['description'] = 'Компании - Административный раздел';

		// Шаблон админки обязательно ждёт меню !
		$menu = $this->controller('Admin\\MenuController');
		$vars['menu'] = $menu->index();

		$companyModel = $this->model('CompanyModel'); // Модель
		$offerModel = $this->model('OfferModel'); // Модель

		// Список компаний
		$vars['companies'] = $companyModel->getList();
		foreach ($vars['companies'] as &$company) {
			$company['offers'] = $offerModel->count('_id_company', (string) $company['_id']);
		}

		return $this->setTemplate('admin')->render('admin/companies/list', $vars);
	}

	public function form($id) {
		$vars = [];

		// Ищем компанию по ID
		$companyModel = $this->model('CompanyModel'); // Модель
		$company = $companyModel->findById($id);
		$vars = array_merge($vars, $company->fieldsArray());

		$vars['title'] = 'Компания ' .$vars['name']. ' - Административный раздел';
		$vars['description'] = 'Компания ' .$vars['name']. ' - Административный раздел';

		// Шаблон админки обязательно ждёт меню !
		$menu = $this->controller('Admin\\MenuController');
		$vars['menu'] = $menu->index();

		// Ошибки
		$vars['errors'] = [];

		return $this->setTemplate('admin')->render('admin/companies/form', $vars);
	}

	public function add() {
		$vars = [];

		$companyModel = $this->model('CompanyModel'); // Модель
		$vars = array_merge($vars, $companyModel->fieldsArray()); // Наполняем пустыми значениями, так как новый.

		$vars['title'] = 'Новая компания - Административный раздел';
		$vars['description'] = 'Новая компания - Административный раздел';

		// Шаблон админки обязательно ждёт меню !
		$menu = $this->controller('Admin\\MenuController');
		$vars['menu'] = $menu->index();

		// Ошибки
		$vars['errors'] = [];

		return $this->setTemplate('admin')->render('admin/companies/form', $vars);
	}

	public function save() {
		$companyModel = $this->model('CompanyModel'); // Модель
		$id = $companyModel->fill($_POST)->save();
		if($id) {
			$this->App->message->add('Сохранено !', 'INFO', 'SYSTEM');
			$this->App->redirect('/admin/companies/edit/'.$id.'/');
		} else {
			$this->App->message->add('Ошибка сохранения', 'ERROR', 'SYSTEM');
			$this->App->redirect('/admin/companies/edit/');
		}

	}
}