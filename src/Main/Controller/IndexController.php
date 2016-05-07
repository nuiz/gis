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

    $db = $container->medoo;
    $acc = $db->get("account", "*", ["username"=> @$reqBody["username"]]);

    if(!$acc) {
      $loginSegment->clear();
      return $container->view->render($res, "login.twig", ["error_message"=> "Not found ".@$reqBody["username"]]);
    }

    if(@$reqBody["password"] != $acc["password"]) {
      $loginSegment->clear();
      return $container->view->render($res, "login.twig", ["error_message"=> "Invalid Password"]);
    }

    $loginSegment->set("user", $acc);
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
