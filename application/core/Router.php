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
				// Занесение в переменную $path пути к вызываемому контроллеру
				$path = 'application\controllers\\'.ucfirst($this->params['controller']).'Controller';

				// Проверка на существование контроллера
				if (class_exists($path)) 
				{
					// Занесение в переменную $action вызываемого действия
					$action = $this->params['action'].'Action';
					// Проверка на существование действия в классе
					if(method_exists($path,$action))
					{
						$controller = new $path($this->params);
						$controller->$action();
					} else {
						echo 'Не найдено действие: '.$action;
					}
				} else {
					echo 'Не найден контроллер: '.$path;
				}
			} else {
				echo 'Маршрут не найден';
			}
		}
	}