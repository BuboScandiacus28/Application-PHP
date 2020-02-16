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

		'component/show' => [
			'controller' => 'component',
			'action' => 'show',
		],

		'component/back' => [
			'controller' => 'component',
			'action' => 'back',
		],

		'component/add' => [
			'controller' => 'component',
			'action' => 'add',
		],

	];