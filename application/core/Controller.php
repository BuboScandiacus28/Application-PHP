<?php 

	namespace application\core;
	
	use application\core\View;

	abstract class Controller
	{
		
		public $route;
		public $view;

		public function __construct($route) 
		{
			// Получение маршрута
			$this->route = $route;
			// Создание экземпляра класса View и занесение в конструктор сетевого маршрута
			$this->view = new View($route);
			//$this->before();
		}

		
	}