<?php
namespace Main\Controller;

use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\ResponseInterface;
use Main\Service\XMLService;

class ScholarTypeController extends BaseController
{
  public function scholar_types(Request $req, Response $res)
  {
    $container = $this->slim->getContainer();
    $db = $container->medoo;

    $items = $db->select("scholar_type", "*");
    $this->buildItems($items);

    return $container->view->render($res, "scholar_type/list.twig", [
      "items"=> $items
    ]);
	}

  public function scholar_type(Request $req, Response $res, $attr = [])
  {
    $container = $this->slim->getContainer();
    $db = $container->medoo;

    $item = $db->get("scholar_type", "*", ["id"=> $attr["id"]]);
    if(!$item) {
      return $res->withHeader("Location", $req->getUri()->getBasePath()."/scholar_type");
    }

    return $container->view->render($res, "scholar_type/item.twig", [
      "item"=> $item
    ]);
  }

  public function scholar_typeGetAdd(Request $req, Response $res)
  {
    $container = $this->slim->getContainer();

    return $container->view->render($res, "scholar_type/form.twig");
  }

  public function scholar_typePostAdd(Request $req, Response $res)
  {
    $container = $this->slim->getContainer();
    $db = $container->medoo;

    $postBody = $req->getParsedBody();
    $insertParams = $this->adapterParams($postBody);

    if($db->insert("scholar_type", $insertParams)) {
      return $res->withHeader("Location", $req->getUri()->getBasePath()."/scholar_type");
    }

    return $container->view->render($res, "scholar_type/form.twig", [
      "form"=> $postBody
    ]);
  }

  public function scholar_typeGetEdit(Request $req, Response $res, $attr = [])
  {
    $container = $this->slim->getContainer();
    $db = $container->medoo;

    $item = $db->get("scholar_type", "*", ["id"=> $attr["id"]]);
    if(!$item) {
      return $res->withHeader("Location", $req->getUri()->getBasePath()."/scholar_type");
    }

    return $container->view->render($res, "scholar_type/form.twig", [
      "form"=> $item
    ]);
  }

  public function scholar_typePostEdit(Request $req, Response $res, $attr = [])
  {
    $container = $this->slim->getContainer();
    $db = $container->medoo;

    $postBody = $req->getParsedBody();
    $editParams = $this->adapterParams($postBody);

    if($db->update("scholar_type", $editParams, ["id"=> $attr["id"]])) {
      return $res->withHeader("Location", $req->getUri()->getBasePath()."/scholar_type");
    }

    return $container->view->render($res, "scholar_type/form.twig", [
      "form"=> $postBody
    ]);
  }

  public function scholar_typeRemove(Request $req, Response $res, $attr = [])
  {
    $container = $this->slim->getContainer();
    $db = $container->medoo;

    $db->delete("scholar_type", ["id"=> $attr["id"]]);
    return $res->withHeader("Location", $req->getUri()->getBasePath()."/scholar_type");
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
