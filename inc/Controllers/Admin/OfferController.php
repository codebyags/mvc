<?php

namespace Controllers\Admin;

use Controller;

class OfferController extends Controller {
	public function index($filters_param = false) {
		$vars = [];

		// Для красоты
		$vars['title'] = 'Предложения';
		$vars['description'] = 'Предложения';

		// Шаблон админки обязательно ждёт меню !
		$menu = $this->controller('Admin\\MenuController');
		$vars['menu'] = $menu->index();


		// Список предложений
		$offerModel = $this->model('OfferModel'); // Модель оффера

		$vars['filters'] = [];
		$filterController = $this->controller('FilterController');
		$arFilters = $filterController->filters($offerModel->filters, $filters_param);

		$vars['filters'] = $arFilters['html'];
		$vars['offers'] = $offerModel->getList($arFilters['find'], $arFilters['options']);

		$companyModel = $this->model('CompanyModel'); // Модель компании
		foreach($vars['offers'] as &$offer) {
			if(!empty($offer['_id_company'])) {
				$companyModel->findById($offer['_id_company']);
				$offer['company'] = $companyModel->getField('name');
			} else {
				$offer['company'] = '';
			}
		}

		return $this->setTemplate('admin')->render('admin/offers/list', $vars);
	}

	public function form($id) {
		$vars = [];

		// Ищем компанию по ID
		$offerModel = $this->model('OfferModel'); // Модель
		$offer = $offerModel->findById($id);
		$vars = array_merge($vars, $offer->fieldsArray());

		// Список компаний
		$companyModel = $this->model('CompanyModel'); // Модель
		$vars['companies'] = $companyModel->prepareSelect($companyModel->getList(), '_id', $vars['_id_company'], 'name');

		// Для красоты
		$vars['title'] = 'Предложение ' .$vars['name'];
		$vars['description'] = 'Предложение ' .$vars['name'];

		// Шаблон админки обязательно ждёт меню !
		$menu = $this->controller('Admin\\MenuController');
		$vars['menu'] = $menu->index();

		// Ошибки
		$vars['errors'] = [];

		return $this->setTemplate('admin')->render('admin/offers/form', $vars);
	}

	public function add() {
		$vars = [];

		$offerModel = $this->model('OfferModel'); // Модель
		$vars = array_merge($vars, $offerModel->fieldsArray()); // Наполняем пустыми значениями, так как новый.

		// Список компаний
		$companyModel = $this->model('CompanyModel'); // Модель
		$vars['companies'] = $companyModel->prepareSelect($companyModel->getList(), '_id', $vars['_id_company'], 'name');


		// Для красоты
		$vars['title'] = 'Новое предложение';
		$vars['description'] = 'Новое предложение';

		// Шаблон админки обязательно ждёт меню !
		$menu = $this->controller('Admin\\MenuController');
		$vars['menu'] = $menu->index();

		// Ошибки
		$vars['errors'] = [];

		return $this->setTemplate('admin')->render('admin/offers/form', $vars);
	}

	public function save() {
		$offerModel = $this->model('OfferModel'); // Модель
		$id = $offerModel->fill($_POST)->save();
		if($id) {
			$this->App->message->add('Сохранено !', 'INFO', 'SYSTEM');
			$this->App->redirect('/admin/offers/edit/'.$id.'/');
		} else {
			$this->App->message->add('Ошибка сохранения', 'ERROR', 'SYSTEM');
			$this->App->redirect('/admin/offers/edit/');
		}

	}

	public function copy($id) {
		$offerModel = $this->model('OfferModel'); // Модель
		$offer = $offerModel->findById($id);

		$newoffer = $this->model('OfferModel'); // Модель
		$fields = $offer->fieldsArray();
		unset($fields['_id']);
		$newoffer->fill($fields);
		$new_offer_id = $newoffer->save();

		$this->App->redirect('/admin/offers/edit/' . $new_offer_id . '/');
	}

	public function remove($id) {
		$offerModel = $this->model('OfferModel'); // Модель
		if($offerModel->removeById($id)) {
			$this->App->redirect('/admin/offers/');
		} else {
			$this->App->message->add('Ошибка удаления', 'ERROR', 'SYSTEM');
			$this->App->redirect('/admin/offers/edit/' . $id . '/');
		}
	}
}