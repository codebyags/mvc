<?php

namespace Controllers;

use Controller;

class IndexController extends Controller
{
	function index() {

		$vars = [];
		$vars['title'] = 'Главная страница';
		$vars['description'] = '';

		$offerModel = $this->model('OfferModel'); // Модель оффера
		$vars['offers'] = $offerModel->getList([],[],5);
		$companyModel = $this->model('CompanyModel'); // Модель компании
		foreach($vars['offers'] as &$offer) {
			if(!empty($offer['_id_company'])) {
				$companyModel->findById($offer['_id_company']);
				$offer['company'] = $companyModel->getField('name');
			} else {
				$offer['company'] = '';
			}
		}

		return $this->render('index', $vars);
	}


	function offers($filters_param = false) {

		$vars = [];
		$vars['title'] = 'Поиск предложений';
		$vars['description'] = '';

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

		return $this->render('offers', $vars);
	}

	function error404() {
		$vars = [];
		$vars['title'] = '404';
		$vars['description'] = 'Страница не найдена !';

		return $this->render('404', $vars);
	}
}