<?php
namespace Main\Controller;

use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\ResponseInterface;
use Main\Service\XMLService;

class ReportController extends BaseController
{
  public function report(Request $req, Response $res)
  {
    $container = $this->slim->getContainer();
    $db = $container->medoo;

    return $container->view->render($res, "report/list.twig", [
    ]);
	}
}
