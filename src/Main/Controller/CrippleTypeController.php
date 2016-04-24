<?php
namespace Main\Controller;

use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\ResponseInterface;
use Main\Service\XMLService;

class CrippleTypeController extends BaseController
{
  public function cripple_types(Request $req, Response $res)
  {
    $container = $this->slim->getContainer();
    $db = $container->medoo;

    $items = $db->select("cripple_type", "*");
    $this->buildItems($items);

    return $container->view->render($res, "cripple_type/list.twig", [
      "items"=> $items
    ]);
	}

  public function cripple_type(Request $req, Response $res, $attr = [])
  {
    $container = $this->slim->getContainer();
    $db = $container->medoo;

    $item = $db->get("cripple_type", "*", ["id"=> $attr["id"]]);
    if(!$item) {
      return $res->withHeader("Location", $req->getUri()->getBasePath()."/cripple_type");
    }

    return $container->view->render($res, "cripple_type/item.twig", [
      "item"=> $item
    ]);
  }

  public function cripple_typeGetAdd(Request $req, Response $res)
  {
    $container = $this->slim->getContainer();

    return $container->view->render($res, "cripple_type/form.twig");
  }

  public function cripple_typePostAdd(Request $req, Response $res)
  {
    $container = $this->slim->getContainer();
    $db = $container->medoo;

    $postBody = $req->getParsedBody();
    $insertParams = $this->adapterParams($postBody);

    if($db->insert("cripple_type", $insertParams)) {
      return $res->withHeader("Location", $req->getUri()->getBasePath()."/cripple_type");
    }

    return $container->view->render($res, "cripple_type/form.twig", [
      "form"=> $postBody
    ]);
  }

  public function cripple_typeGetEdit(Request $req, Response $res, $attr = [])
  {
    $container = $this->slim->getContainer();
    $db = $container->medoo;

    $item = $db->get("cripple_type", "*", ["id"=> $attr["id"]]);
    if(!$item) {
      return $res->withHeader("Location", $req->getUri()->getBasePath()."/cripple_type");
    }

    return $container->view->render($res, "cripple_type/form.twig", [
      "form"=> $item
    ]);
  }

  public function cripple_typePostEdit(Request $req, Response $res, $attr = [])
  {
    $container = $this->slim->getContainer();
    $db = $container->medoo;

    $postBody = $req->getParsedBody();
    $editParams = $this->adapterParams($postBody);

    if($db->update("cripple_type", $editParams, ["id"=> $attr["id"]])) {
      return $res->withHeader("Location", $req->getUri()->getBasePath()."/cripple_type");
    }

    return $container->view->render($res, "cripple_type/form.twig", [
      "form"=> $postBody
    ]);
  }

  public function cripple_typeRemove(Request $req, Response $res, $attr = [])
  {
    $container = $this->slim->getContainer();
    $db = $container->medoo;

    $db->delete("cripple_type", ["id"=> $attr["id"]]);
    $db->delete("person_cripple", ["cripple_id"=> $attr["id"]]);
    return $res->withHeader("Location", $req->getUri()->getBasePath()."/cripple_type");
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
