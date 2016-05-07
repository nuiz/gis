<?php
namespace Main\Controller;

use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\ResponseInterface;
use Main\Service\XMLService;

class PersonTypeController extends BaseController
{
  public function person_type(Request $req, Response $res)
  {
    $container = $this->slim->getContainer();
    return $container->view->render($res, "person_type/list.twig");
	}
}
