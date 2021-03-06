<?php 

	namespace application\core;

	use application\core\View;
	
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
			$url = explode('/?', trim($_SERVER['REQUEST_URI'],'/'), 2)[0];
			//debug($url);
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
					if(method_exists($path, $action))
					{
						$controller = new $path($this->params);
						$controller->$action();
					} else {
						// Вызывает страницу с кодом ответа
						View::errorCode(403);
					}
				} else {
					// Вызывает страницу с кодом ответа
					View::errorCode(403);
				}
			} else {
				// Вызывает страницу с кодом ответа
				View::errorCode(404);
			}
		}
	}