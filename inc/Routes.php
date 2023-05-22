<?php

// Simple routes
/*
 * URL обязательно заканчивать на /
 * Можно использовать ожидаемые параметры /url/path/$value1/$value2
 * $value1 и $value2 будут переданы в параметры  метода контроллера по порядку
 * index($value1, $value2)
 *
 * '*@/', 'GET@/', 'POST@/'
 *
 * Загружает классы из inc/
 *
 */
return [
	// httpsMethod@Path => ControllerAction ControllerClass@ControllerClassMethod
	'*@/' => 'IndexController@index',

	// Админка
	'*@/admin/' => ['Admin\DashboardController@index', 'AuthProvider'],
		// Компании
		'*@/admin/companies/' => ['Admin\CompanyController@index', 'AuthProvider'],
		'*@/admin/companies/edit/' => ['Admin\CompanyController@add', 'AuthProvider'],
		'*@/admin/companies/edit/$id/' => ['Admin\CompanyController@form', 'AuthProvider'],
		'*@/admin/companies/save/' => ['Admin\CompanyController@save', 'AuthProvider'],

		// Предложения
		'*@/admin/offers/' => ['Admin\OfferController@index', 'AuthProvider'],
		'*@/admin/offers/filter/*' => ['Admin\OfferController@index', 'AuthProvider'],
		'*@/admin/offers/edit/' => ['Admin\OfferController@add', 'AuthProvider'],
		'*@/admin/offers/edit/$id/' => ['Admin\OfferController@form', 'AuthProvider'],
		'*@/admin/offers/save/' => ['Admin\OfferController@save', 'AuthProvider'],
		'*@/admin/offers/copy/$id/' => ['Admin\OfferController@copy', 'AuthProvider'],
		'*@/admin/offers/remove/$id/' => ['Admin\OfferController@remove', 'AuthProvider'],

		// Блюда
		'*@/admin/meals/' => ['Admin\DashboardController@index', 'AuthProvider'],

		// Отзывы
		'*@/admin/reviews/' => ['Admin\DashboardController@index', 'AuthProvider'],

		// Отзывы
		'*@/admin/blog/' => ['Admin\DashboardController@index', 'AuthProvider'],

		// Файловый менеджер
		'*@/admin/file-manager/*' => ['Admin\FilemanagerController@index', 'AuthProvider'],

	// Вход и выход
	'GET@/login-form/' => ['Auth\AuthController@index'],
	'POST@/login/' => ['Auth\AuthController@login'],
	'GET@/logout/' => ['Auth\AuthController@logout'],


	// Публичные страницы
	'GET@/offers/' => ['IndexController@offers'],
	'GET@/offers/filter/*' => ['IndexController@offers'],
	'GET@/companies/' => ['IndexController@index'],
	'GET@/about/' => ['IndexController@index'],
	'GET@/contacts/' => ['IndexController@index'],

	// 404
	'*@/404/' => 'IndexController@error404',
];
