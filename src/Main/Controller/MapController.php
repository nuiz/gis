<?php
namespace Main\Controller;

use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\ResponseInterface;
use Main\Service\XMLService;

class CareergroupController extends BaseController
{
  public function map(Request $req, Response $res)
  {
    $container = $this->slim->getContainer();
    $db = $container->medoo;

    $persons = $db->select("person", "*");
    $careergroups = $db->select("careergroup", "*");
    $learningcenters = $db->select("learningcenter", "*");
    $this->buildItems($items);

    return $container->view->render($res, "careergroup/list.twig", [
      "persons"=> $persons,
      "careergroups"=> $careergroups,
      "learningcenters"=> $learningcenters
    ]);
	}
}
