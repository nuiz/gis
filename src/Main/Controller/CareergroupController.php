<?php
namespace Main\Controller;

use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\ResponseInterface;
use Main\Service\XMLService;

class CareergroupController extends BaseController
{
  public function careergroups(Request $req, Response $res)
  {
    $container = $this->slim->getContainer();
    $db = $container->medoo;

    $items = $db->select("careergroup", "*");
    $this->buildItems($items);

    return $container->view->render($res, "careergroup/list.twig", [
      "items"=> $items
    ]);
	}

  public function careergroup(Request $req, Response $res, $attr = [])
  {
    $container = $this->slim->getContainer();
    $db = $container->medoo;

    $item = $db->get("careergroup", "*", ["id"=> $attr["id"]]);
    if(!$item) {
      return $res->withHeader("Location", $req->getUri()->getBasePath()."/careergroup");
    }

    return $container->view->render($res, "careergroup/item.twig", [
      "item"=> $item
    ]);
  }

  public function careergroupGetAdd(Request $req, Response $res)
  {
    $container = $this->slim->getContainer();

    return $container->view->render($res, "careergroup/form.twig");
  }

  public function careergroupPostAdd(Request $req, Response $res)
  {
    $container = $this->slim->getContainer();
    $db = $container->medoo;

    $postBody = $req->getParsedBody();
    $insertParams = $this->adapterParams($postBody);

    if($db->insert("careergroup", $insertParams)) {
      return $res->withHeader("Location", $req->getUri()->getBasePath()."/careergroup");
    }

    return $container->view->render($res, "careergroup/form.twig", [
      "form"=> $postBody
    ]);
  }

  public function careergroupGetEdit(Request $req, Response $res, $attr = [])
  {
    $container = $this->slim->getContainer();
    $db = $container->medoo;

    $item = $db->get("careergroup", "*", ["id"=> $attr["id"]]);
    if(!$item) {
      return $res->withHeader("Location", $req->getUri()->getBasePath()."/careergroup");
    }

    return $container->view->render($res, "careergroup/form.twig", [
      "form"=> $item
    ]);
  }

  public function careergroupPostEdit(Request $req, Response $res, $attr = [])
  {
    $container = $this->slim->getContainer();
    $db = $container->medoo;

    $postBody = $req->getParsedBody();
    $editParams = $this->adapterParams($postBody);

    if($db->update("careergroup", $editParams, ["id"=> $attr["id"]])) {
      return $res->withHeader("Location", $req->getUri()->getBasePath()."/careergroup");
    }

    return $container->view->render($res, "careergroup/form.twig", [
      "form"=> $postBody
    ]);
  }

  public function careergroupRemove(Request $req, Response $res, $attr = [])
  {
    $container = $this->slim->getContainer();
    $db = $container->medoo;

    $db->delete("careergroup", ["id"=> $attr["id"]]);
    return $res->withHeader("Location", $req->getUri()->getBasePath()."/careergroup");
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
