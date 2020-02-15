<?php 

	namespace application\core;
	
	use application\core\View;

	abstract class Controller
	{
		
		public $route;
		public $view;
		public $model;

		public function __construct($route) 
		{
			// Получение маршрута
			$this->route = $route;
			// Создание экземпляра класса View и занесение в конструктор сетевого маршрута
			$this->view = new View($route);
			//$this->before();
			//debug($route);
			$this->model = $this->loadModel($route['controller']);
		}

		public function loadModel($name) 
		{
			$path = 'application\models\\'.ucfirst($name);
			//debug($path);
			if (class_exists($path))
			{
				return new $path;
			}
		}
		
	}