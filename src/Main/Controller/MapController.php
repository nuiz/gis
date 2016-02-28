<?php
namespace Main\Controller;

use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\ResponseInterface;
use Main\Service\XMLService;

class MapController extends BaseController
{
  public function map(Request $req, Response $res)
  {
    $container = $this->slim->getContainer();
    $db = $container->medoo;

    $persons = $db->select("person", "*");
    $careergroups = $db->select("careergroup", "*");
    $learningcenters = $db->select("learningcenter", "*");

    return $container->view->render($res, "map/list.twig", [
      "persons"=> $persons,
      "careergroups"=> $careergroups,
      "learningcenters"=> $learningcenters
    ]);
	}
}
