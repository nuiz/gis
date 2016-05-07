<?php
namespace Main\Controller;

use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\ResponseInterface;
use Main\Service\XMLService;

class ScholarController extends BaseController
{
  public function scholars(Request $req, Response $res)
  {
    $container = $this->slim->getContainer();
    $db = $container->medoo;

    $items = $db->select("scholar", "*");
    $this->buildItems($items);

    return $container->view->render($res, "scholar/list.twig", [
      "items"=> $items
    ]);
	}

  public function scholar(Request $req, Response $res, $attr = [])
  {
    $container = $this->slim->getContainer();
    $db = $container->medoo;

    $item = $db->get("scholar", "*", ["id"=> $attr["id"]]);
    if(!$item) {
      return $res->withHeader("Location", $req->getUri()->getBasePath()."/scholar");
    }

    return $container->view->render($res, "scholar/item.twig", [
      "item"=> $item
    ]);
  }

  public function scholarGetAdd(Request $req, Response $res)
  {
    $container = $this->slim->getContainer();

    return $container->view->render($res, "scholar/form.twig");
  }

  public function scholarPostAdd(Request $req, Response $res)
  {
    $container = $this->slim->getContainer();
    $db = $container->medoo;

    $postBody = $req->getParsedBody();
    $insertParams = $this->adapterParams($postBody);

    if($db->insert("scholar", $insertParams)) {
      return $res->withHeader("Location", $req->getUri()->getBasePath()."/scholar");
    }

    return $container->view->render($res, "scholar/form.twig", [
      "form"=> $postBody
    ]);
  }

  public function scholarGetEdit(Request $req, Response $res, $attr = [])
  {
    $container = $this->slim->getContainer();
    $db = $container->medoo;

    $item = $db->get("scholar", "*", ["id"=> $attr["id"]]);
    if(!$item) {
      return $res->withHeader("Location", $req->getUri()->getBasePath()."/scholar");
    }

    return $container->view->render($res, "scholar/form.twig", [
      "form"=> $item
    ]);
  }

  public function scholarPostEdit(Request $req, Response $res, $attr = [])
  {
    $container = $this->slim->getContainer();
    $db = $container->medoo;

    $postBody = $req->getParsedBody();
    $editParams = $this->adapterParams($postBody);

    if($db->update("scholar", $editParams, ["id"=> $attr["id"]]) !== false) {
      return $res->withHeader("Location", $req->getUri()->getBasePath()."/scholar");
    }

    return $container->view->render($res, "scholar/form.twig", [
      "form"=> $postBody
    ]);
  }

  public function scholarRemove(Request $req, Response $res, $attr = [])
  {
    $container = $this->slim->getContainer();
    $db = $container->medoo;

    $db->delete("scholar", ["id"=> $attr["id"]]);
    return $res->withHeader("Location", $req->getUri()->getBasePath()."/scholar");
  }

  public function adapterParams($input)
  {
    $params = $input;

    return $params;
  }

  public function buildItems(&$items)
  {
    foreach ($items as $key => &$item) {
      $this->buildItem($item);
    }
  }

  public function buildItem(&$item)
  {

  }

}
