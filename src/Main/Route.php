<?php

namespace Main;
use Slim\App;
use Main\Controller\IndexController;
use Main\Controller\PersonController;

class Route
{
	/** @var Slim\App; */
	private $slim;

	public function __construct(App $slim)
	{
		$this->slim = $slim;
	}

	public function run()
	{
		$this->slim->get('/', IndexController::class. ':index');
		$this->slim->get('/login', IndexController::class. ':getLogin');
		$this->slim->post('/login', IndexController::class. ':postLogin');
		$this->slim->any('/logout', IndexController::class. ':anyLogout');

		$this->slim->get('/person', PersonController::class. ':persons');
		$this->slim->get('/person/add', PersonController::class. ':personGetAdd');
		$this->slim->post('/person/add', PersonController::class. ':personPostAdd');
		$this->slim->get('/person/edit/{id:[0-9]+}', PersonController::class. ':personGetEdit');
		$this->slim->post('/person/edit/{id:[0-9]+}', PersonController::class. ':personPostEdit');
		$this->slim->get('/person/remove/{id:[0-9]+}', PersonController::class. ':personRemove');
	}
}
