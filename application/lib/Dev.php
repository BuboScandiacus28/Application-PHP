<?php 
	
	// ini_set - установка значения настройки конфигурации;
	// 'display_errors' - вывод ошибок на экран. Да - 1, нет - 0;
	ini_set('display_errors', 1);

	// error_reporting - задает, какие ошибки PHP попадут в отчет;
	error_reporting(E_ALL);

	// Функция отладки
	function debug ($str) 
	{
		echo "<pre>";
		// var_dump - вывод информации о переменной;
		var_dump($str);
		echo "</pre>";
		exit;
	}