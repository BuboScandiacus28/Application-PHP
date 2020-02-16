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
			$this->model = $this->loadModel($route['controller']);
		}

		// Загрузка модели
		public function loadModel($name) 
		{
			$path = 'application\models\\'.ucfirst($name);
			if (class_exists($path))
			{
				//debug($path);
				return new $path;
			}
		}
		
	}