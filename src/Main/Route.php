<?php

namespace Main;
use Slim\App;
use Main\Controller\IndexController;
use Main\Controller\PersonController;
use Main\Controller\CareergroupController;
use Main\Controller\ScholarController;
use Main\Controller\LearningcenterController;
use Main\Controller\MapController;
use Main\Controller\ReportController;
use Main\Controller\CrippleTypeController;
use Main\Controller\DisavantagedTypeController;
use Main\Controller\ScholarTypeController;
use Main\Controller\PersonTypeController;
use Main\Controller\AccountController;
use Main\Middleware\PermissionMiddleware;

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
		// inject permission to container
		$container = $this->slim->getContainer();
		PermissionMiddleware::setContainer($container);

		$this->slim->get('/', IndexController::class. ':index');
		$this->slim->get('/login', IndexController::class. ':getLogin');
		$this->slim->post('/login', IndexController::class. ':postLogin');
		$this->slim->any('/logout', IndexController::class. ':anyLogout');

		$this->slim->get('/person', PersonController::class. ':persons')->add(PermissionMiddleware::create(["admin", "staff", "user"]));
		$this->slim->get('/person_search', PersonController::class. ':personsSearch')->add(PermissionMiddleware::create(["admin", "staff", "user"]));
		$this->slim->get('/person/{id:[0-9]+}', PersonController::class. ':person')->add(PermissionMiddleware::create(["admin", "staff", "user"]));
		$this->slim->get('/person/add', PersonController::class. ':personGetAdd')->add(PermissionMiddleware::create(["admin", "staff"]));
		$this->slim->post('/person/add', PersonController::class. ':personPostAdd')->add(PermissionMiddleware::create(["admin", "staff"]));
		$this->slim->get('/person/edit/{id:[0-9]+}', PersonController::class. ':personGetEdit')->add(PermissionMiddleware::create(["admin", "staff"]));
		$this->slim->post('/person/edit/{id:[0-9]+}', PersonController::class. ':personPostEdit')->add(PermissionMiddleware::create(["admin", "staff"]));
		$this->slim->get('/person/remove/{id:[0-9]+}', PersonController::class. ':personRemove')->add(PermissionMiddleware::create(["admin", "staff"]));

		$this->slim->get('/careergroup', CareergroupController::class. ':careergroups')->add(PermissionMiddleware::create(["admin", "staff", "user"]));
		$this->slim->get('/careergroup/{id:[0-9]+}', CareergroupController::class. ':careergroup')->add(PermissionMiddleware::create(["admin", "staff", "user"]));
		$this->slim->get('/careergroup/add', CareergroupController::class. ':careergroupGetAdd')->add(PermissionMiddleware::create(["admin", "staff"]));
		$this->slim->post('/careergroup/add', CareergroupController::class. ':careergroupPostAdd')->add(PermissionMiddleware::create(["admin", "staff"]));
		$this->slim->get('/careergroup/edit/{id:[0-9]+}', CareergroupController::class. ':careergroupGetEdit')->add(PermissionMiddleware::create(["admin", "staff"]));
		$this->slim->post('/careergroup/edit/{id:[0-9]+}', CareergroupController::class. ':careergroupPostEdit')->add(PermissionMiddleware::create(["admin", "staff"]));
		$this->slim->get('/careergroup/remove/{id:[0-9]+}', CareergroupController::class. ':careergroupRemove')->add(PermissionMiddleware::create(["admin", "staff"]));

		$this->slim->get('/scholar', ScholarController::class. ':scholars')->add(PermissionMiddleware::create(["admin", "staff", "user"]));
		$this->slim->get('/scholar/{id:[0-9]+}', ScholarController::class. ':scholar')->add(PermissionMiddleware::create(["admin", "staff", "user"]));
		$this->slim->get('/scholar/add', ScholarController::class. ':scholarGetAdd')->add(PermissionMiddleware::create(["admin", "staff"]));
		$this->slim->post('/scholar/add', ScholarController::class. ':scholarPostAdd')->add(PermissionMiddleware::create(["admin", "staff"]));
		$this->slim->get('/scholar/edit/{id:[0-9]+}', ScholarController::class. ':scholarGetEdit')->add(PermissionMiddleware::create(["admin", "staff"]));
		$this->slim->post('/scholar/edit/{id:[0-9]+}', ScholarController::class. ':scholarPostEdit')->add(PermissionMiddleware::create(["admin", "staff"]));
		$this->slim->get('/scholar/remove/{id:[0-9]+}', ScholarController::class. ':scholarRemove')->add(PermissionMiddleware::create(["admin", "staff"]));

		$this->slim->get('/cripple_type', CrippleTypeController::class. ':cripple_types')->add(PermissionMiddleware::create(["admin", "staff"]));
		$this->slim->get('/cripple_type/{id:[0-9]+}', CrippleTypeController::class. ':cripple_type')->add(PermissionMiddleware::create(["admin", "staff"]));
		$this->slim->get('/cripple_type/add', CrippleTypeController::class. ':cripple_typeGetAdd')->add(PermissionMiddleware::create(["admin", "staff"]));
		$this->slim->post('/cripple_type/add', CrippleTypeController::class. ':cripple_typePostAdd')->add(PermissionMiddleware::create(["admin", "staff"]));
		$this->slim->get('/cripple_type/edit/{id:[0-9]+}', CrippleTypeController::class. ':cripple_typeGetEdit')->add(PermissionMiddleware::create(["admin", "staff"]));
		$this->slim->post('/cripple_type/edit/{id:[0-9]+}', CrippleTypeController::class. ':cripple_typePostEdit')->add(PermissionMiddleware::create(["admin", "staff"]));
		$this->slim->get('/cripple_type/remove/{id:[0-9]+}', CrippleTypeController::class. ':cripple_typeRemove')->add(PermissionMiddleware::create(["admin", "staff"]));

		$this->slim->get('/disavantaged_type', DisavantagedTypeController::class. ':disavantaged_types')->add(PermissionMiddleware::create(["admin", "staff"]));
		$this->slim->get('/disavantaged_type/{id:[0-9]+}', DisavantagedTypeController::class. ':disavantaged_type')->add(PermissionMiddleware::create(["admin", "staff"]));
		$this->slim->get('/disavantaged_type/add', DisavantagedTypeController::class. ':disavantaged_typeGetAdd')->add(PermissionMiddleware::create(["admin", "staff"]));
		$this->slim->post('/disavantaged_type/add', DisavantagedTypeController::class. ':disavantaged_typePostAdd')->add(PermissionMiddleware::create(["admin", "staff"]));
		$this->slim->get('/disavantaged_type/edit/{id:[0-9]+}', DisavantagedTypeController::class. ':disavantaged_typeGetEdit')->add(PermissionMiddleware::create(["admin", "staff"]));
		$this->slim->post('/disavantaged_type/edit/{id:[0-9]+}', DisavantagedTypeController::class. ':disavantaged_typePostEdit')->add(PermissionMiddleware::create(["admin", "staff"]));
		$this->slim->get('/disavantaged_type/remove/{id:[0-9]+}', DisavantagedTypeController::class. ':disavantaged_typeRemove')->add(PermissionMiddleware::create(["admin", "staff"]));

		$this->slim->get('/scholar_type', ScholarTypeController::class. ':scholar_types');
		$this->slim->get('/scholar_type/{id:[0-9]+}', ScholarTypeController::class. ':scholar_type');
		$this->slim->get('/scholar_type/add', ScholarTypeController::class. ':scholar_typeGetAdd');
		$this->slim->post('/scholar_type/add', ScholarTypeController::class. ':scholar_typePostAdd');
		$this->slim->get('/scholar_type/edit/{id:[0-9]+}', ScholarTypeController::class. ':scholar_typeGetEdit');
		$this->slim->post('/scholar_type/edit/{id:[0-9]+}', ScholarTypeController::class. ':scholar_typePostEdit');
		$this->slim->get('/scholar_type/remove/{id:[0-9]+}', ScholarTypeController::class. ':scholar_typeRemove');

		$this->slim->get('/learningcenter', LearningcenterController::class. ':learningcenters')->add(PermissionMiddleware::create(["admin", "staff"]));
		$this->slim->get('/learningcenter/{id:[0-9]+}', LearningcenterController::class. ':learningcenter')->add(PermissionMiddleware::create(["admin", "staff"]));
		$this->slim->get('/learningcenter/add', LearningcenterController::class. ':learningcenterGetAdd')->add(PermissionMiddleware::create(["admin", "staff"]));
		$this->slim->post('/learningcenter/add', LearningcenterController::class. ':learningcenterPostAdd')->add(PermissionMiddleware::create(["admin", "staff"]));
		$this->slim->get('/learningcenter/edit/{id:[0-9]+}', LearningcenterController::class. ':learningcenterGetEdit')->add(PermissionMiddleware::create(["admin", "staff"]));
		$this->slim->post('/learningcenter/edit/{id:[0-9]+}', LearningcenterController::class. ':learningcenterPostEdit')->add(PermissionMiddleware::create(["admin", "staff"]));
		$this->slim->get('/learningcenter/remove/{id:[0-9]+}', LearningcenterController::class. ':learningcenterRemove')->add(PermissionMiddleware::create(["admin", "staff"]));

		$this->slim->get('/map', MapController::class. ':map')->add(PermissionMiddleware::create(["admin", "staff", "user"]));
		$this->slim->get('/report', ReportController::class. ':report')->add(PermissionMiddleware::create(["admin", "staff", "user"]));
		// $this->slim->get('/report_die', ReportController::class. ':reportDie')->add(PermissionMiddleware::create(["admin", "staff", "user"]));
		// $this->slim->get('/report_reg', ReportController::class. ':reportReg')->add(PermissionMiddleware::create(["admin", "staff", "user"]));
		$this->slim->get('/report/map', ReportController::class. ':map')->add(PermissionMiddleware::create(["admin", "staff", "user"]));
		$this->slim->get('/report/older', ReportController::class. ':older')->add(PermissionMiddleware::create(["admin", "staff", "user"]));
		$this->slim->get('/report/cripple', ReportController::class. ':cripple')->add(PermissionMiddleware::create(["admin", "staff", "user"]));
		$this->slim->get('/report/disavantaged', ReportController::class. ':disavantaged')->add(PermissionMiddleware::create(["admin", "staff", "user"]));
		$this->slim->get('/report/register', ReportController::class. ':register')->add(PermissionMiddleware::create(["admin", "staff", "user"]));
		$this->slim->get('/report/die', ReportController::class. ':dies')->add(PermissionMiddleware::create(["admin", "staff", "user"]));

		$this->slim->get('/person_type', PersonTypeController::class. ':person_type')->add(PermissionMiddleware::create(["admin", "staff", "user"]));

		$this->slim->get('/account', AccountController::class. ':accounts')->add(PermissionMiddleware::create(["admin"]));
		$this->slim->get('/account/{id:[0-9]+}', AccountController::class. ':account')->add(PermissionMiddleware::create(["admin"]));
		$this->slim->get('/account/add', AccountController::class. ':accountGetAdd')->add(PermissionMiddleware::create(["admin"]));
		$this->slim->post('/account/add', AccountController::class. ':accountPostAdd')->add(PermissionMiddleware::create(["admin"]));
		$this->slim->get('/account/edit/{id:[0-9]+}', AccountController::class. ':accountGetEdit')->add(PermissionMiddleware::create(["admin"]));
		$this->slim->post('/account/edit/{id:[0-9]+}', AccountController::class. ':accountPostEdit')->add(PermissionMiddleware::create(["admin"]));
		$this->slim->get('/account/remove/{id:[0-9]+}', AccountController::class. ':accountRemove')->add(PermissionMiddleware::create(["admin"]));
	}
}
