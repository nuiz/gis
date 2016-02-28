<?php
namespace Main\Controller;

use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\ResponseInterface;
use Main\Service\XMLService;

class PersonController extends BaseController
{
  public function persons(Request $req, Response $res)
  {
    $container = $this->slim->getContainer();
    $db = $container->medoo;
    // $session = $container->session;
    // $segment = $session->getSegment("login");
    // $segment->set("username", "papangping");
    // $session->commit();

    $oldersService = XMLService::getInstance("olders");
    $cripplesService = XMLService::getInstance("cripples");
    $disavantagedsService = XMLService::getInstance("disavantageds");
    $scholarsService = XMLService::getInstance("scholars");

    $olders = $oldersService->gets();
    $cripples = $cripplesService->gets();
    $disavantageds = $disavantagedsService->gets();
    $scholars = $scholarsService->gets();

    $queryParams = $req->getQueryParams();
    $where = [];
    if(!empty($queryParams["is_older"])) {
      $where["is_older"] = $queryParams["is_older"];
    }
    if(!empty($queryParams["cripple_id"])) {
      $where["cripple_id"] = $queryParams["cripple_id"];
    }
    if(!empty($queryParams["disa_id"])) {
      $where["disa_id"] = $queryParams["disa_id"];
    }
    if(!empty($queryParams["scho_id"])) {
      $where["scho_id"] = $queryParams["scho_id"];
    }
    if(!empty($queryParams["keyword"])) {
      $where["first_name[~]"] = "%".$queryParams["keyword"]."%";
    }
    if(count($where) > 0) $where = ["AND"=> $where];

    $items = $db->select("person", "*", $where);
    $this->buildItems($items);

    // var_dump($items[0]); exit();

    return $container->view->render($res, "person/list.twig", [
      "form"=> $queryParams,
      "items"=> $items,
      "olders"=> $olders,
      "cripples"=> $cripples,
      "disavantageds"=> $disavantageds,
      "scholars"=> $scholars
    ]);
	}

  public function person(Request $req, Response $res, $attr = [])
  {
    $container = $this->slim->getContainer();
    $db = $container->medoo;

    $cripplesService = XMLService::getInstance("cripples");
    $disavantagedsService = XMLService::getInstance("disavantageds");
    $scholarsService = XMLService::getInstance("scholars");

    $item = $db->get("person", "*", ["id"=> $attr["id"]]);
    if(!$item) {
      return $res->withHeader("Location", $req->getUri()->getBasePath()."/person");
    }
    $this->buildItem($item);

    // var_dump($item); exit();

    return $container->view->render($res, "person/item.twig", [
      "item"=> $item,
      "cripples"=> $cripplesService->gets(),
      "disavantageds"=> $disavantagedsService->gets(),
      "scholars"=> $scholarsService->gets()
    ]);
  }

  public function personGetAdd(Request $req, Response $res)
  {
    $container = $this->slim->getContainer();

    $cripplesService = XMLService::getInstance("cripples");
    $disavantagedsService = XMLService::getInstance("disavantageds");
    $scholarsService = XMLService::getInstance("scholars");

    return $container->view->render($res, "person/form.twig", [
      "cripples"=> $cripplesService->gets(),
      "disavantageds"=> $disavantagedsService->gets(),
      "scholars"=> $scholarsService->gets()
    ]);
  }

  public function personPostAdd(Request $req, Response $res)
  {
    $container = $this->slim->getContainer();
    $db = $container->medoo;

    $cripplesService = XMLService::getInstance("cripples");
    $disavantagedsService = XMLService::getInstance("disavantageds");
    $scholarsService = XMLService::getInstance("scholars");
    $postBody = $req->getParsedBody();

    $insertParams = $this->adapterParams($postBody);

    if($db->insert("person", $insertParams)) {
      return $res->withHeader("Location", $req->getUri()->getBasePath()."/person");
    }

    return $container->view->render($res, "person/form.twig", [
      "form"=> $postBody,
      "cripples"=> $cripplesService->gets(),
      "disavantageds"=> $disavantagedsService->gets(),
      "scholars"=> $scholarsService->gets()
    ]);
  }

  public function personGetEdit(Request $req, Response $res, $attr = [])
  {
    $container = $this->slim->getContainer();
    $db = $container->medoo;

    $cripplesService = XMLService::getInstance("cripples");
    $disavantagedsService = XMLService::getInstance("disavantageds");
    $scholarsService = XMLService::getInstance("scholars");

    $item = $db->get("person", "*", ["id"=> $attr["id"]]);
    if(!$item) {
      return $res->withHeader("Location", $req->getUri()->getBasePath()."/person");
    }

    return $container->view->render($res, "person/form.twig", [
      "form"=> $item,
      "cripples"=> $cripplesService->gets(),
      "disavantageds"=> $disavantagedsService->gets(),
      "scholars"=> $scholarsService->gets()
    ]);
  }

  public function personPostEdit(Request $req, Response $res, $attr = [])
  {
    $container = $this->slim->getContainer();
    $db = $container->medoo;

    $cripplesService = XMLService::getInstance("cripples");
    $disavantagedsService = XMLService::getInstance("disavantageds");
    $scholarsService = XMLService::getInstance("scholars");
    $postBody = $req->getParsedBody();

    $editParams = $this->adapterParams($postBody);

    if($db->update("person", $editParams, ["id"=> $attr["id"]])) {
      return $res->withHeader("Location", $req->getUri()->getBasePath()."/person");
    }

    return $container->view->render($res, "person/form.twig", [
      "form"=> $postBody,
      "cripples"=> $cripplesService->gets(),
      "disavantageds"=> $disavantagedsService->gets(),
      "scholars"=> $scholarsService->gets()
    ]);
  }

  public function personRemove(Request $req, Response $res, $attr = [])
  {
    $container = $this->slim->getContainer();
    $db = $container->medoo;

    $db->delete("person", ["id"=> $attr["id"]]);
    return $res->withHeader("Location", $req->getUri()->getBasePath()."/person");
  }

  public function adapterParams($input)
  {
    $dateRegex = "/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/";
    $params = $input;
    $params["is_older"] = @$input["is_older"]?: 0;
    $params["created_at"] = date("Y-m-d H:i:s");
    $params["updated_at"] = date("Y-m-d H:i:s");
    $params["die_date"] = preg_match($dateRegex, $input["die_date"])? $input["die_date"]: null;
    $params["reg_date"] = preg_match($dateRegex, $input["reg_date"])? $input["reg_date"]: null;
    $params["birth_date"] = preg_match($dateRegex, $input["birth_date"])? $input["birth_date"]: null;

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
    $dateRegex = "/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/";

    $oldersService = XMLService::getInstance("olders");
    $cripplesService = XMLService::getInstance("cripples");
    $disavantagedsService = XMLService::getInstance("disavantageds");
    $scholarsService = XMLService::getInstance("scholars");

    $item["age"] = preg_match($dateRegex, $item["birth_date"])?
      \DateTime::createFromFormat('Y-m-d', $item["birth_date"])->diff(new \DateTime('now'))->y:
      null;

    $item["older"] = $oldersService->getBy(["min[<=]"=> $item["age"], "max[>=]"=> $item["age"]]);
    $item["cripple"] = $cripplesService->getBy(["id"=> $item["cripple_id"]]);
    $item["disavantaged"] = $disavantagedsService->getBy(["id"=> $item["disa_id"]]);
    $item["scholar"] = $scholarsService->getBy(["id"=> $item["scho_id"]]);

    $item["total_allowance"] = 0;
    $item["total_allowance"] += $item["is_older"]? @$item["older"]["allowance"]: 0;
    $item["total_allowance"] += @$item["cripple"]["allowance"];
    $item["total_allowance"] += @$item["disavantaged"]["allowance"];
    $item["total_allowance"] += @$item["scholar"]["allowance"];
  }

}
