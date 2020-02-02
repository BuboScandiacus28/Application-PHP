<?php 

	namespace application\core;
	
	abstract class Controller
	{
		
		public $route;

		public function __construcnt($route) 
		{
			$this->route = $route;
			echo '<p>Привет</p>';
		}

		
	}