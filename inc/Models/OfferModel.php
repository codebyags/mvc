<?php
namespace Models;

use Model;
use MongoDB;

class OfferModel extends Model
{
	protected $collectionName = 'offers';

	// Разрешённые поля
	protected $allowed = [
		"_id",
		"_id_company",
		"name",
		"vegan_meal", // Подходит вегетарианцам
		"calories", // Калорийность блюда
		"days", 	// Продолжительность питания
		'weeks',    // Продолжительность питания в неделях
		'weekdays',	// Дни питания если предусмотрены недели
		'meals',    // Количество приёмов пищи
		'meals_count', // Количество блюд в одном дне

		"about",	// Дополнительная информация

		"price",    // Финальная стоимость предложения
		"percent",  // Процент скидки

		"promocode", // Промокод
		"bonus",
		"cacheback",

		"date_create", 	// Дата создания документа
		"date_edit", 	// Дата редактирования документа
	];


	// Отображемый фильтр при необходимости
	// Можно переопределить через метод Модели setFilter
	public $filters = [
		"_id_company" => [
			"type" => "select",
			"label" => "Компания",
			"model" => 'Models\\CompanyModel'
		],
		"name" => [
			"type" => "text",
			"label" => "Название",
		],
		"calories" => [
			"type" => "range",
			"label" => "Калорийность",
		],
		"price" => [
			"type" => "range",
			"label" => "Цена",
		],
		"percent" => [
			"type" => "number",
			"label" => "Процент скидки",
		],
		"weeks" => [
			"type" => "number",
			"label" => "Продолжительность питания в неделях",
		],
		"weekdays" => [
			"type" => "select-checkbox-weekdays",
			"label" => "Дни питания если предусмотрены недели",
		]
	];
}