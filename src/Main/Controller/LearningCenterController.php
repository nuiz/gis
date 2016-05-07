<?php
namespace Main\Controller;

use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\ResponseInterface;
use Main\Service\XMLService;

class LearningcenterController extends BaseController
{
  public function learningcenters(Request $req, Response $res)
  {
    $container = $this->slim->getContainer();
    $db = $container->medoo;

    $items = $db->select("learningcenter", "*");
    $this->buildItems($items);

    return $container->view->render($res, "learningcenter/list.twig", [
      "items"=> $items
    ]);
	}

  public function learningcenter(Request $req, Response $res, $attr = [])
  {
    $container = $this->slim->getContainer();
    $db = $container->medoo;

    $item = $db->get("learningcenter", "*", ["id"=> $attr["id"]]);
    if(!$item) {
      return $res->withHeader("Location", $req->getUri()->getBasePath()."/learningcenter");
    }

    return $container->view->render($res, "learningcenter/item.twig", [
      "item"=> $item
    ]);
  }

  public function learningcenterGetAdd(Request $req, Response $res)
  {
    $container = $this->slim->getContainer();

    return $container->view->render($res, "learningcenter/form.twig");
  }

  public function learningcenterPostAdd(Request $req, Response $res)
  {
    $container = $this->slim->getContainer();
    $db = $container->medoo;

    $postBody = $req->getParsedBody();
    $insertParams = $this->adapterParams($postBody);

    if($db->insert("learningcenter", $insertParams)) {
      return $res->withHeader("Location", $req->getUri()->getBasePath()."/learningcenter");
    }

    return $container->view->render($res, "learningcenter/form.twig", [
      "form"=> $postBody
    ]);
  }

  public function learningcenterGetEdit(Request $req, Response $res, $attr = [])
  {
    $container = $this->slim->getContainer();
    $db = $container->medoo;

    $item = $db->get("learningcenter", "*", ["id"=> $attr["id"]]);
    if(!$item) {
      return $res->withHeader("Location", $req->getUri()->getBasePath()."/learningcenter");
    }

    return $container->view->render($res, "learningcenter/form.twig", [
      "form"=> $item
    ]);
  }

  public function learningcenterPostEdit(Request $req, Response $res, $attr = [])
  {
    $container = $this->slim->getContainer();
    $db = $container->medoo;

    $postBody = $req->getParsedBody();
    $editParams = $this->adapterParams($postBody);

    if($db->update("learningcenter", $editParams, ["id"=> $attr["id"]]) !== false) {
      return $res->withHeader("Location", $req->getUri()->getBasePath()."/learningcenter");
    }

    return $container->view->render($res, "learningcenter/form.twig", [
      "form"=> $postBody
    ]);
  }

  public function learningcenterRemove(Request $req, Response $res, $attr = [])
  {
    $container = $this->slim->getContainer();
    $db = $container->medoo;

    $db->delete("learningcenter", ["id"=> $attr["id"]]);
    return $res->withHeader("Location", $req->getUri()->getBasePath()."/learningcenter");
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
