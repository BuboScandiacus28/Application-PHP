<?php 

	namespace application\lib;

	use PDO;
	
	class Db
	{
		
		protected $db;

		public function __construct()
		{
			//config - массив с данными о хосте, БД и пользователе
			$config = require 'application/config/db.php';
			//Подключение к БД
			$this->db = new PDO('mysql:host='.$config['host'].';dbname='.$config['dbname'], $config['user'], $config['password']);
		}

		public function query($sql, $params = []) 
		{
			// Защита БД от нежелательных запросов
			// prepare - подготавливает запрос к выполнению и возвращает связанный с этим запросом объект
			$stmt = $this->db->prepare($sql);
			// Проверка на наличие дополнительных параметров
			if (!empty($params))
			{

				foreach ($params as $key => $val)
				{
					//bindValue - связывает параметр с заданным значением
					$stmt->bindValue(':'.$key, $val);
				}
			}
			//Запускает подготовленный запрос
			$stmt->execute();
			return $stmt;
		}
		
		// Вывод запроса строкой (-ами) 
		public function row($sql, $params = [])
		{
			// Выполнение запроса
			$result = $this->query($sql, $params);
			// Вывод ассоциативным массивом
			return $result->fetchAll(PDO::FETCH_ASSOC);
		}
		
		// Вывод запроса постолбцово
		public function column($sql, $params = []) 
		{
			// Выполнение запроса
			$result = $this->query($sql, $params);
			// Вывод ассоциативным массивом
			return $result->fetchColumn();
		}
	}