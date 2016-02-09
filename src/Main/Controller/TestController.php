<?php
namespace Main\Controller;

use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\ResponseInterface;

class TestController extends BaseController
{
  public function index(Request $req, Response $res)
  {
    $container = $this->slim->getContainer();
    $session = $container->session;
    $segment = $session->getSegment("test");
    $segment->setFlash("message", "test msg");
    $session->commit();
    return $container->view->render($res, "index.twig");
	}

  public function test2(Request $req, Response $res)
  {
    $container = $this->slim->getContainer();
    return $container->view->render($res, "index.twig", ["message"=> print_r($container->medoo, true)]);
    // $db = $container->medoo;
    $session = $container->session;
    $segment = $session->getSegment("test");
    return $res->write(print_r($_GET, true));
    return $res->write($segment->getFlash("message"));
    return $container->view->render($res, "index.twig", ["message"=> $segment->getFlash("message")]);
	}
}
