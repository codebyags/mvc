<?php

class App
{
	public $root;
	public $sittings;
	private $route;

	public $message;
	public $messages;

	public $db;

	function __construct()
	{
		$this->root = $_SERVER['DOCUMENT_ROOT'];
		$this->registerAutoload();
		$this->getSittings();

		include "Functions.php";

		// TODO: Создать интерфейс для разных баз данных
		$db = new MongoDB\Client($this->sittings['database']['mongodb']);
		$this->db = $db->mealgear;

		session_start();
		$this->message = new Message;
		$this->messages = $this->message->flush();

		$this->route = new Route($this);
	}

	private function getSittings() {
		$this->sittings = include_once($this->root . "/inc/Sittings.php");
	}

	private function registerAutoload() {
		if(is_file($this->root .'/vendor/autoload.php')) {
			require_once($this->root .'/vendor/autoload.php');
		}

		spl_autoload_register(function ($class_name) {
			$class_name = $this->replacePathSeparator($class_name);
			$file = $this->root . "/inc/" . $class_name . '.php';
			if(is_file($file)) {
				include $file;
			}
		});

		spl_autoload_register(function ($class_name) {
			$class_name = $this->replacePathSeparator($class_name);
			$file = $this->root . "/inc/Controllers/" . $class_name . '.php';
			if(is_file($file)) {
				include $file;
			}
		});

		spl_autoload_register(function ($class_name) {
			$class_name = $this->replacePathSeparator($class_name);
			$file = $this->root . "/inc/Models/" . $class_name . '.php';
			if(is_file($file)) {
				include $file;
			}
		});

	}

	public function redirect($to) {
		header('Location: ' . $to);
		exit;
	}

	protected function replacePathSeparator($path) {
		return str_replace('\\', DS, $path);
	}
}

$App = new App;