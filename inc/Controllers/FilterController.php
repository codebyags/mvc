<?php

namespace Controllers;

use Controller;


class FilterController extends Controller
{
	function filters($arFields, $params)
	{
		$arFieldsResult = [
			'html' => [],
			'find' => [],
			'options' => []
		];

		// Подготоваливаем массив фильтров
		$arParams = [];
		if ($params) {
			$lastKey = false;
			foreach (explode('/', $params) as $param) {
				if(empty($param)) {
					break;
				}
				if(!$lastKey) {
					$lastKey = $param;
				} else {
					$arParams[$lastKey] = $param;
					$lastKey = false;
				}
			}
		}

		foreach ($arFields as $name => $field) {

			$var = [];
			$var['name'] = $name;
			$var['value'] = null;
			if(isset($arParams[$name])) {
				$var['value'] = $arParams[$name];
			}

			$var['label'] = $field['label'];

			switch ($field['type']) {
				case 'range':

					if($var['value'] !== null) {
						$arValues = explode("-", $var['value']);
					} else {
						$arValues = [];
					}

					if(count($arValues) != 2) {
						break;
					}

					if(!empty($arValues[0])) {
						$arFieldsResult['find'][$name]['$gte'] = +$arValues[0];
					}

					if(!empty($arValues[1])) {
						$arFieldsResult['find'][$name]['$lte'] = +$arValues[1];
					}

					$var['value_min'] = !empty($arValues[0])?$arValues[0]:'';
					$var['value_max'] = !empty($arValues[1])?$arValues[1]:'';

				break;

				case 'select-checkbox-weekdays':
					$arWeekdays = explode('-', 'mon-tue-wen-thu-fri-sat-sun');
					$arValues = [];
					if($var['value'] !== null) {
						$arValues = explode("-", $var['value']);
						$arFieldsResult['find'][$name] = $arValues;
					}
					$var['value'] = [];

					foreach($arWeekdays as $day) {
						if(in_array($day, $arValues)) {
							$var['value'][$day] = true;
						}
					}

				break;

				case 'select':
					if(isset($field['model'])) {
						$model = new $field['model']($this->App);
						$models = $model->getList([],['sort' => ['name' => 1]]);
						$val = $var['value'];

						if(!empty($val)) {
							$arFieldsResult['find'][$name] = $val;
						}

						$var['value'] = [];

						foreach ($models as $item) {
							$id = (string) $item['_id'];
							$is_selected = ($id === $val);

							$var['value'][] = [
								'selected'  => $is_selected,
								'name' 		=> $item['name'],
								'value' 	=> $id
							];
						}

					}
				break;

				case 'text':
					if ($var['value']) {
						$arFieldsResult['find'][$name] = rawurldecode($var['value']);
					}
				break;

				default: // number
					if ($var['value']) {
						$arFieldsResult['find'][$name] = +$var['value'];
					}
				break;
			}

			$arFieldsResult['html'][$name] = $this->render('samples/filters/' . $field['type'], $var);
		}

		return $arFieldsResult;
	}
}