<?php


class Controller
{
	protected $App;
	private $templateName;

	function __construct($App, $template = true)
	{
		$this->App = $App;
		$this->is_need_template = $template;
	}

	public function setTemplate($templateName) {
		$this->templateName = $templateName;
		return $this;
	}

	protected function render($view, $vars = [], $without_template = false)
	{

		$viewFile = $this->App->root . '/inc/Views/' . $view . '.php';

		if ($without_template) {
			extract($this->App->sittings['template_vars']);
			extract($vars);
			if (file_exists($viewFile)) {
				include($viewFile);
			} else {
				throw new Exception('View ' . $view . ' not found');
			}
		}

		if(empty($this->templateName)) {
			$templateName = $this->App->sittings['template'];
		} else {
			$templateName = $this->templateName;
		}

		$templateHeader = $this->App->root . '/templates/' . $templateName . '/header.php';
		$templateFooter = $this->App->root . '/templates/' . $templateName . '/footer.php';
		$template = '/templates/' . $templateName;

		if (!file_exists($templateHeader) || !file_exists($templateFooter)) {
			throw new Exception('Template ' . $templateName . ' are not correct! ' .
				print_r([$templateHeader, $templateFooter], 1)
			);
		}


		if (file_exists($viewFile)) {
			extract($this->App->sittings['template_vars']);
			extract($vars);

			if ($this->is_need_template) {

				ob_start();

				include($templateHeader);
				include($viewFile);
				include($templateFooter);

				return ob_get_clean();
			} else {
				ob_start();
				include($viewFile);
				return ob_get_clean();
			}
		} else {
			throw new Exception('View ' . $view . ' not found');
		}
	}

	function controller($controllerClassName)
	{
		$controllerClassName = 'Controllers\\' . $controllerClassName;

		return new $controllerClassName($this->App, false);
	}

	function model($modelClassName) {
		$modelClassName = 'Models\\' . $modelClassName;
		return new $modelClassName($this->App);
	}
}