<?php
namespace Main\Controller;

use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\ResponseInterface;
use Main\Service\XMLService;
use Main\Controller\BaseController;


class LearningCenterController extends BaseController
{
  public function index(Request $req, Response $res)
  {
    $container = $this->slim->getContainer();
    $db = $container->medoo;
  }

  public function getDb()
  {
    $container = $this->slim->getContainer();
    return $container->medoo;
  }
}
