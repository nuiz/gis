<?php

namespace Main;
use Slim\App;
use Main\Controller\IndexController;
use Main\Controller\PersonController;
use Main\Controller\CareergroupController;
use Main\Controller\LearningcenterController;
use Main\Controller\MapController;
use Main\Controller\CrippleTypeController;
use Main\Controller\DisavantagedTypeController;
use Main\Controller\ScholarTypeController;

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
		$this->slim->get('/person/{id:[0-9]+}', PersonController::class. ':person');
		$this->slim->get('/person/add', PersonController::class. ':personGetAdd');
		$this->slim->post('/person/add', PersonController::class. ':personPostAdd');
		$this->slim->get('/person/edit/{id:[0-9]+}', PersonController::class. ':personGetEdit');
		$this->slim->post('/person/edit/{id:[0-9]+}', PersonController::class. ':personPostEdit');
		$this->slim->get('/person/remove/{id:[0-9]+}', PersonController::class. ':personRemove');

		$this->slim->get('/careergroup', CareergroupController::class. ':careergroups');
		$this->slim->get('/careergroup/{id:[0-9]+}', CareergroupController::class. ':careergroup');
		$this->slim->get('/careergroup/add', CareergroupController::class. ':careergroupGetAdd');
		$this->slim->post('/careergroup/add', CareergroupController::class. ':careergroupPostAdd');
		$this->slim->get('/careergroup/edit/{id:[0-9]+}', CareergroupController::class. ':careergroupGetEdit');
		$this->slim->post('/careergroup/edit/{id:[0-9]+}', CareergroupController::class. ':careergroupPostEdit');
		$this->slim->get('/careergroup/remove/{id:[0-9]+}', CareergroupController::class. ':careergroupRemove');

		$this->slim->get('/cripple_type', CrippleTypeController::class. ':cripple_types');
		$this->slim->get('/cripple_type/{id:[0-9]+}', CrippleTypeController::class. ':cripple_type');
		$this->slim->get('/cripple_type/add', CrippleTypeController::class. ':cripple_typeGetAdd');
		$this->slim->post('/cripple_type/add', CrippleTypeController::class. ':cripple_typePostAdd');
		$this->slim->get('/cripple_type/edit/{id:[0-9]+}', CrippleTypeController::class. ':cripple_typeGetEdit');
		$this->slim->post('/cripple_type/edit/{id:[0-9]+}', CrippleTypeController::class. ':cripple_typePostEdit');
		$this->slim->get('/cripple_type/remove/{id:[0-9]+}', CrippleTypeController::class. ':cripple_typeRemove');

		$this->slim->get('/disavantaged_type', DisavantagedTypeController::class. ':disavantaged_types');
		$this->slim->get('/disavantaged_type/{id:[0-9]+}', DisavantagedTypeController::class. ':disavantaged_type');
		$this->slim->get('/disavantaged_type/add', DisavantagedTypeController::class. ':disavantaged_typeGetAdd');
		$this->slim->post('/disavantaged_type/add', DisavantagedTypeController::class. ':disavantaged_typePostAdd');
		$this->slim->get('/disavantaged_type/edit/{id:[0-9]+}', DisavantagedTypeController::class. ':disavantaged_typeGetEdit');
		$this->slim->post('/disavantaged_type/edit/{id:[0-9]+}', DisavantagedTypeController::class. ':disavantaged_typePostEdit');
		$this->slim->get('/disavantaged_type/remove/{id:[0-9]+}', DisavantagedTypeController::class. ':disavantaged_typeRemove');

		$this->slim->get('/scholar_type', ScholarTypeController::class. ':scholar_types');
		$this->slim->get('/scholar_type/{id:[0-9]+}', ScholarTypeController::class. ':scholar_type');
		$this->slim->get('/scholar_type/add', ScholarTypeController::class. ':scholar_typeGetAdd');
		$this->slim->post('/scholar_type/add', ScholarTypeController::class. ':scholar_typePostAdd');
		$this->slim->get('/scholar_type/edit/{id:[0-9]+}', ScholarTypeController::class. ':scholar_typeGetEdit');
		$this->slim->post('/scholar_type/edit/{id:[0-9]+}', ScholarTypeController::class. ':scholar_typePostEdit');
		$this->slim->get('/scholar_type/remove/{id:[0-9]+}', ScholarTypeController::class. ':scholar_typeRemove');

		$this->slim->get('/learningcenter', LearningcenterController::class. ':learningcenters');
		$this->slim->get('/learningcenter/{id:[0-9]+}', LearningcenterController::class. ':learningcenter');
		$this->slim->get('/learningcenter/add', LearningcenterController::class. ':learningcenterGetAdd');
		$this->slim->post('/learningcenter/add', LearningcenterController::class. ':learningcenterPostAdd');
		$this->slim->get('/learningcenter/edit/{id:[0-9]+}', LearningcenterController::class. ':learningcenterGetEdit');
		$this->slim->post('/learningcenter/edit/{id:[0-9]+}', LearningcenterController::class. ':learningcenterPostEdit');
		$this->slim->get('/learningcenter/remove/{id:[0-9]+}', LearningcenterController::class. ':learningcenterRemove');

		$this->slim->get('/map', MapController::class. ':map');
	}
}
