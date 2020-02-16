<?php 
	
	namespace application\core;

	use application\lib\Db;

	abstract class Model
	{
		
		public $db;

		public function __construct()
		{
			$this->db = new Db; 
			//echo htmlspecialchars($_GET['cod'].' - '.$_GET['lvl']);
		}
	}