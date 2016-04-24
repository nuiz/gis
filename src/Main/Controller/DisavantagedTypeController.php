<?php
namespace Main\Controller;

use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\ResponseInterface;
use Main\Service\XMLService;

class DisavantagedTypeController extends BaseController
{
  public function disavantaged_types(Request $req, Response $res)
  {
    $container = $this->slim->getContainer();
    $db = $container->medoo;

    $items = $db->select("disavantaged_type", "*");
    $this->buildItems($items);

    return $container->view->render($res, "disavantaged_type/list.twig", [
      "items"=> $items
    ]);
	}

  public function disavantaged_type(Request $req, Response $res, $attr = [])
  {
    $container = $this->slim->getContainer();
    $db = $container->medoo;

    $item = $db->get("disavantaged_type", "*", ["id"=> $attr["id"]]);
    if(!$item) {
      return $res->withHeader("Location", $req->getUri()->getBasePath()."/disavantaged_type");
    }

    return $container->view->render($res, "disavantaged_type/item.twig", [
      "item"=> $item
    ]);
  }

  public function disavantaged_typeGetAdd(Request $req, Response $res)
  {
    $container = $this->slim->getContainer();

    return $container->view->render($res, "disavantaged_type/form.twig");
  }

  public function disavantaged_typePostAdd(Request $req, Response $res)
  {
    $container = $this->slim->getContainer();
    $db = $container->medoo;

    $postBody = $req->getParsedBody();
    $insertParams = $this->adapterParams($postBody);

    if($db->insert("disavantaged_type", $insertParams)) {
      return $res->withHeader("Location", $req->getUri()->getBasePath()."/disavantaged_type");
    }

    return $container->view->render($res, "disavantaged_type/form.twig", [
      "form"=> $postBody
    ]);
  }

  public function disavantaged_typeGetEdit(Request $req, Response $res, $attr = [])
  {
    $container = $this->slim->getContainer();
    $db = $container->medoo;

    $item = $db->get("disavantaged_type", "*", ["id"=> $attr["id"]]);
    if(!$item) {
      return $res->withHeader("Location", $req->getUri()->getBasePath()."/disavantaged_type");
    }

    return $container->view->render($res, "disavantaged_type/form.twig", [
      "form"=> $item
    ]);
  }

  public function disavantaged_typePostEdit(Request $req, Response $res, $attr = [])
  {
    $container = $this->slim->getContainer();
    $db = $container->medoo;

    $postBody = $req->getParsedBody();
    $editParams = $this->adapterParams($postBody);

    if($db->update("disavantaged_type", $editParams, ["id"=> $attr["id"]])) {
      return $res->withHeader("Location", $req->getUri()->getBasePath()."/disavantaged_type");
    }

    return $container->view->render($res, "disavantaged_type/form.twig", [
      "form"=> $postBody
    ]);
  }

  public function disavantaged_typeRemove(Request $req, Response $res, $attr = [])
  {
    $container = $this->slim->getContainer();
    $db = $container->medoo;

    $db->delete("disavantaged_type", ["id"=> $attr["id"]]);
    $db->delete("person_disavantaged", ["disavantaged_id"=> $attr["id"]]);
    return $res->withHeader("Location", $req->getUri()->getBasePath()."/disavantaged_type");
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
