<?php 
	
	// Массив со всеми маршрутами

	return 
	[
		'' => [
			'controller' => 'main',
			'action' => 'index',
		],

		'account/login' => [
			'controller' => 'account',
			'action' => 'login',
		],

		'account/register' => [
			'controller' => 'account',
			'action' => 'register',
		],

	];