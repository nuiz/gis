<?php
namespace Main\Controller;

use Slim\Http\Request;
use Slim\Http\Response;

class IndexController extends BaseController
{
  public function index(Request $req, Response $res)
  {
    $container = $this->slim->getContainer();
    return $res->withHeader("Location", $req->getUri()->getBasePath()."/login");
  }

  public function getLogin(Request $req, Response $res)
  {
    $container = $this->slim->getContainer();
    return $container->view->render($res, "login.twig");
  }

  public function postLogin(Request $req, Response $res)
  {
    $reqBody = $req->getParsedBody();
    $container = $this->slim->getContainer();
    /** @var Aura\Session\Session */
    $session = $container->session;
    $loginSegment = $session->getSegment("login");

    if(@$reqBody["username"] != $container->config["login"]["username"]) {
      $loginSegment->clear();
      return $container->view->render($res, "login.twig", ["error_message"=> "Invalid Username"]);
    }

    if(@$reqBody["password"] != $container->config["login"]["password"]) {
      $loginSegment->clear();
      return $container->view->render($res, "login.twig", ["error_message"=> "Invalid Password"]);
    }

    $loginSegment->set("user", [
      "username"=> "admin"
    ]);
    $session->commit();

    return $res->withHeader("Location", $req->getUri()->getBasePath()."/person");
  }

  public function anyLogout(Request $req, Response $res)
  {
    $container = $this->slim->getContainer();
    /** @var Aura\Session\Session */
    $session = $container->session;
    $loginSegment = $session->getSegment("login");
    $loginSegment->clear();
    $session->commit();

    return $res->withHeader("Location", $req->getUri()->getBasePath()."/login");
  }
}
