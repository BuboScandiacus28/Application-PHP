<?php 

	namespace application\core;
	
	class Router 
	{
			
		protected $routes = [];
		protected $params = [];

		function __construct()
		{
			$arr = require 'application/config/routes.php';

			foreach ($arr as $key => $val) 
			{
				$this->add($key, $val);
			}
		}
		
		// Добавление нового маршрута
		public function add($route, $params)
		{
			// Создание регулярного выражения из строки $route
			$route = '#^'.$route.'$#';
			// Добавление нового значения в ассоциативный массив $routes с ключем $route и массивом значений $params 
			$this->routes[$route] = $params;
		}

		// Проверка маршрута
		public function match() 
		{
			// Запись в переменную $url страницы на которой сейчас находится пользователь  
			$url = trim($_SERVER['REQUEST_URI'],'/'); 

			foreach ($this->routes as $route => $params)
			{
				// Проверка $url на соответствие одному из маршрутов $route 
				if (preg_match($route, $url, $matches))
				{
					$this->params = $params;
					return true;
				}
			}
			return false;
		}

		// Запуск роутера
		public function run()
		{
			if ($this->match())
			{
				$controller = 'application\controllers\\'.ucfirst($this->params['controller']).'Controller.php';
				if (class_exists($controller)) 
				{
					//
				} else {
					echo 'Не найден'.$controller;
				}
			} else {
				echo 'Маршрут не найден';
			}
		}
	}