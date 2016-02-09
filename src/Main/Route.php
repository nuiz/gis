<?php

namespace Main;
use Slim\App;
use Main\Controller\MainController;

class Route
{
	private $slim;

	public function __construct(App $slim)
	{
		$this->slim = $slim;
	}

	public function run()
	{
		$this->slim->get('/person', MainController::class. ':persons');
		$this->slim->get('/person/add', MainController::class. ':personGetAdd');
		$this->slim->post('/person/add', MainController::class. ':personPostAdd');
		$this->slim->get('/person/edit/{id:[0-9]+}', MainController::class. ':personGetEdit');
		$this->slim->post('/person/edit/{id:[0-9]+}', MainController::class. ':personPostEdit');
		$this->slim->get('/person/remove/{id:[0-9]+}', MainController::class. ':personRemove');
	}
}
