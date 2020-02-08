<?php 

	namespace application\core;
	
	class View
	{
		
		// Путь к файлу
		public $path;
		// Шаблон
		public $layout = 'default';
		// Маршрут
		public $route;

		public function __construct($route) 
		{
			$this->route = $route;
			// Преобразование полученного маршрута в путь к необходимому Виду
			$this->path = $route['controller'].'/'.$route['action'];
		}
		
		// title - заголовок
		public function render($title, $vars = [])
		{
			extract($vars);
			$path = 'application/views/'.$this->path.'.php';
			// Проверка на существование вызываемого Вида
			if (file_exists($path))
			{
				// ob_start - включение буферизации вывода. Если буферизация вывода активна, никакой вывод скрипта не отправляется (кроме заголовков), а сохраняется во внутреннем буфере. 
				ob_start();
				// Подключение Вида и занесение его в буфер
				require $path;
				// ob_get_clean - Получение содержимого текущего буфера и его удаление
				// $content - хранит в себе разметку вызываемого вида и вызывается в шаблоне (при подключении)
				$content = ob_get_clean();
				// Подключение Шаблона
				require 'application/views/layouts/'.$this->layout.'.php';
			} else {
				echo 'Вид не найден: '.$this->path;
			}
			
		}

		public function redirect($url)
		{
			header('location: '.$url);
			exit;
		}

		public static function errorCode($code)
		{
			// http_response_code - устанавливает код ответа HTTP
			http_response_code($code);
			// Вызывает страницу с кодом ответа
			$path =	'application/views/errors/'.$code.'.php';
			if (file_exists($path))
			{
				require $path;
			}
			exit;
		}
		
	}