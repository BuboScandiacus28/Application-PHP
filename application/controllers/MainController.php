<?php 

	namespace application\controllers;

	use application\core\Controller;
	use application\lib\Db;
	
	class MainController extends Controller
	{

		public function indexAction()
		{
			// Создание экземпляра класса БД
			$db = new Db;

			$data = $db->row('SELECT * FROM news');
			debug($data);

			$this->view->render('Главная страница');
		}

	}