<?php 

	require 'application/lib/Dev.php';
	
	use application\core\Router;
	
	// spl_autoload_register - автозагрузка классов
	spl_autoload_register(function ($class) 
	{
		// Замена всех знаков "\" на "/" в строке $class
		$path = str_replace('\\', '/', $class . '.php');
		
		// Проверка на существование файла
		if (file_exists($path))
		{
			require $path;
		}

	});
 
	session_start();

	$router = new Router;
	$router->run();