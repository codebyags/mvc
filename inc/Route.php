<?php


class Route
{
	/**
	 * @var mixed
	 */
	private $rules;
	private $App;

	function __construct($App)
	{
		$this->App = $App;
		$this->rules = include_once($this->App->root . "/inc/Routes.php");

		try {
			$this->parseRules();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	private function parseRules()
	{
		$exec = false;
		foreach ($this->rules as $key => $rule) {

			$provider = false;
			if(is_array($rule)) {

				$rule_current = $rule[0];

				if(!empty($rule[1])) {
					$provider = $rule[1];
				}

				$rule = $rule_current;
			}



			$arKey = explode('@', $key);

			if (count($arKey) != 2) {
				continue;
			}

			$method = $arKey[0];
			$url_path = $arKey[1];

			if ($method != '*' && $method != $_SERVER['REQUEST_METHOD']) {
				continue;
			}

			$params = [];
			if(strpos($url_path, '$') === false && strpos($url_path, '*') === false) {
				// Прямое совпадение
				if ($url_path != $_SERVER['REQUEST_URI']) {
					continue;
				}
			}  else {
				// Ожидаемые параметры
				// Создаём регулярку из паттерна url
				$pre_reg = str_replace('*', '(.{0,})', $url_path);
				$pre_reg = str_replace('/', '\\/', $pre_reg);
				$preg_pattern = preg_replace('/(\$[a-zA-Z\d]{0,})/', '([a-zA-Z\d]{0,})', $pre_reg);
				$preg_pattern = '/^' . $preg_pattern . '$/m';

				// Чекаем
				preg_match($preg_pattern, $_SERVER['REQUEST_URI'], $matches);

				if(empty($matches)) {
					continue;
				}

				foreach ($matches as $key => $param) {
					if(!$key) {
						continue;
					}

					$params[] = $param;
				}

			}

			$arRule = explode('@', $rule);

			if (count($arKey) != 2) {
				continue;
			}

			$arRule[0] = 'Controllers\\' . $arRule[0];


			// Вызов провайдеров
			if(!empty($provider)) {
				if(is_array($provider)) {
					foreach ($provider as $provider_item) {
						$this->execProvider($provider_item);
					}
				} else {
					$this->execProvider($provider);
				}
			}


			if (class_exists($arRule[0])) {
				// Cache can make here
				$controller = new $arRule[0]($this->App);

			} else {
				throw new Exception('Class ' . $arRule[0] . ' not find ');
			}

			if (!method_exists($controller, $arRule[1])) {
				throw new Exception('Method ' . $arRule[1] . ' not find in class ' . $arRule[0]);
			}

			echo $controller->{$arRule[1]}(...$params);
			$exec = true;
			break;
		}

		if(!$exec) {
			$this->App->redirect('/404/');
		}
	}

	private function execProvider($providerName) {
		$provider_file = 'Providers\\' .$providerName;
		if(class_exists($provider_file)) {
			$classProvider = new $provider_file($this->App);
			$result = $classProvider->provide();
			if(!$result) {
				throw new Exception($providerName . ' stop application');
			}
		} else {
			throw new Exception('Provider class ' . $provider_file . ' not find ');
		}
	}

};