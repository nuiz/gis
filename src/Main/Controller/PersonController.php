<?php
namespace Main\Controller;

use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\ResponseInterface;
use Main\Service\XMLService;
use Main\Service\CrippleService;
use Main\Service\DisavantagedService;
use Main\Service\ScholarService;

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
    $cripplesService = new CrippleService($db);
    $disavantagedsService = new DisavantagedService($db);
    $scholarsService = new ScholarService($db);

    $olders = $oldersService->gets();
    $cripples = $cripplesService->gets();
    $disavantageds = $disavantagedsService->gets();
    $scholars = $scholarsService->gets();

    $queryParams = $req->getQueryParams();
    $where = [];
    if(@$queryParams["is_older"] == "0" || @$queryParams["is_older"] == "1") {
      $where["is_older"] = $queryParams["is_older"];
    }
    if(!empty($queryParams["cripple_id"])) {
      $where["person_cripple.cripple_id"] = $queryParams["cripple_id"];
    }
    if(!empty($queryParams["disa_id"])) {
      $where["person_disavantaged.disavantaged_id"] = $queryParams["disa_id"];
    }
    if(!empty($queryParams["scho_id"])) {
      $where[".person_scholar.scholar_id"] = $queryParams["scho_id"];
    }
    if(!empty($queryParams["keyword"])) {
      $where["OR"] = [];
      $where["OR"]["first_name[~]"] = "%".$queryParams["keyword"]."%";
      $where["OR"]["last_name[~]"] = "%".$queryParams["keyword"]."%";
      $where["OR"]["card_id[~]"] = "%".$queryParams["keyword"]."%";
    }
    if(count($where) > 0) $where = ["AND"=> $where];

    $join = [
      "[>]person_cripple"=> ["id"=> "person_id"],
      "[>]person_disavantaged"=> ["id"=> "person_id"],
      "[>]person_scholar"=> ["id"=> "person_id"]
    ];
    $column = [
      "person.id",
      "person.card_id",
      "person.first_name",
      "person.last_name",
      "person.reg_date",
      "person.die_date",
      "person.birth_date",
      "person.is_older"
    ];

    $total = $db->count("person", $join, "person.id", $where);

    // count
    // item per page
    $perPage = 50;
    $maxPage = ceil($total/$perPage);

		$page = @$queryParams['page']? $queryParams['page']: 1;
		$start = ($page-1) * $perPage;

    $where["LIMIT"] = [$start, $perPage];
    // end count


    $where["GROUP"] = "person.id";
    $where["ORDER"] = "person.card_id";

    $items = $db->select("person", $join, $column, $where);

    $this->buildItems($items);

    // var_dump($items[0]); exit();

    return $container->view->render($res, "person/list.twig", [
      "form"=> $queryParams,
      "items"=> $items,
      "olders"=> $olders,
      "cripples"=> $cripples,
      "disavantageds"=> $disavantageds,
      "scholars"=> $scholars,
      "page"=> $page,
      "maxPage"=> $maxPage
    ]);
	}

  public function personsSearch(Request $req, Response $res)
  {
    $container = $this->slim->getContainer();
    $db = $container->medoo;
    // $session = $container->session;
    // $segment = $session->getSegment("login");
    // $segment->set("username", "papangping");
    // $session->commit();

    $oldersService = XMLService::getInstance("olders");
    $cripplesService = new CrippleService($db);
    $disavantagedsService = new DisavantagedService($db);
    $scholarsService = new ScholarService($db);

    $olders = $oldersService->gets();
    $cripples = $cripplesService->gets();
    $disavantageds = $disavantagedsService->gets();
    $scholars = $scholarsService->gets();

    $queryParams = $req->getQueryParams();
    $where = [];
    if(@$queryParams["is_older"] == "0" || @$queryParams["is_older"] == "1") {
      $where["is_older"] = $queryParams["is_older"];
    }
    if(!empty($queryParams["cripple_id"])) {
      $where["person_cripple.cripple_id"] = $queryParams["cripple_id"];
    }
    if(!empty($queryParams["disa_id"])) {
      $where["person_disavantaged.disavantaged_id"] = $queryParams["disa_id"];
    }
    if(!empty($queryParams["scho_id"])) {
      $where[".person_scholar.scholar_id"] = $queryParams["scho_id"];
    }
    if(!empty($queryParams["keyword"])) {
      $where["OR"] = [];
      $where["OR"]["first_name[~]"] = "%".$queryParams["keyword"]."%";
      $where["OR"]["last_name[~]"] = "%".$queryParams["keyword"]."%";
      $where["OR"]["card_id[~]"] = "%".$queryParams["keyword"]."%";
    }
    if(count($where) > 0) $where = ["AND"=> $where];

    $join = [
      "[>]person_cripple"=> ["id"=> "person_id"],
      "[>]person_disavantaged"=> ["id"=> "person_id"],
      "[>]person_scholar"=> ["id"=> "person_id"]
    ];
    $column = [
      "person.id",
      "person.card_id",
      "person.first_name",
      "person.last_name",
      "person.reg_date",
      "person.die_date",
      "person.birth_date",
      "person.is_older"
    ];

    $total = $db->count("person", $join, "person.id", $where);

    // count
    // item per page
    $perPage = 50;
    $maxPage = ceil($total/$perPage);

		$page = @$queryParams['page']? $queryParams['page']: 1;
		$start = ($page-1) * $perPage;

    $where["LIMIT"] = [$start, $perPage];
    // end count


    $where["GROUP"] = "person.id";
    $where["ORDER"] = "person.card_id";

    $items = $db->select("person", $join, $column, $where);

    $this->buildItems($items);

    // hardcode for empty page
    if(count($where) <= 3) {
      $items = [];
    }

    return $container->view->render($res, "person/list_search.twig", [
      "form"=> $queryParams,
      "items"=> $items,
      "olders"=> $olders,
      "cripples"=> $cripples,
      "disavantageds"=> $disavantageds,
      "scholars"=> $scholars,
      "page"=> $page,
      "maxPage"=> $maxPage
    ]);
	}

  public function person(Request $req, Response $res, $attr = [])
  {
    $container = $this->slim->getContainer();
    $db = $container->medoo;

    $cripplesService = new CrippleService($db);
    $disavantagedsService = new DisavantagedService($db);
    $scholarsService = new ScholarService($db);

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
    $db = $container->medoo;

    $cripplesService = new CrippleService($db);
    $disavantagedsService = new DisavantagedService($db);
    $scholarsService = new ScholarService($db);

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

    $cripplesService = new CrippleService($db);
    $disavantagedsService = new DisavantagedService($db);
    $scholarsService = new ScholarService($db);
    $postBody = $req->getParsedBody();

    $insertParams = $this->adapterParams($postBody);

    $id = $db->insert("person", $insertParams["person"]);
    if($id && $this->saveType($id, $insertParams)) {
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

    $cripplesService = new CrippleService($db);
    $disavantagedsService = new DisavantagedService($db);
    $scholarsService = new ScholarService($db);

    $item = $db->get("person", "*", ["id"=> $attr["id"]]);
    if(!$item) {
      return $res->withHeader("Location", $req->getUri()->getBasePath()."/person");
    }

    $dateRegex = "/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/";
    $item["die_date"] = preg_match($dateRegex, $item["die_date"])? $this->budDate($item["die_date"]): null;
    $item["reg_date"] = preg_match($dateRegex, $item["reg_date"])? $this->budDate($item["reg_date"]): null;
    $item["birth_date"] = preg_match($dateRegex, $item["birth_date"])? $this->budDate($item["birth_date"]): null;

    $item["cripple_id"] = $db->select("person_cripple", "*", ["person_id"=> $attr["id"]]);
    $item["disa_id"] = $db->select("person_disavantaged", "*", ["person_id"=> $attr["id"]]);
    $item["scho_id"] = $db->select("person_scholar", "*", ["person_id"=> $attr["id"]]);

    $item["cripple_id"] = array_map(function($item){ return $item["cripple_id"]; }, $item["cripple_id"]);
    $item["disa_id"] = array_map(function($item){ return $item["disavantaged_id"]; }, $item["disa_id"]);
    $item["scho_id"] = array_map(function($item){ return $item["scholar_id"]; }, $item["scho_id"]);

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

    $cripplesService = new CrippleService($db);
    $disavantagedsService = new DisavantagedService($db);
    $scholarsService = new ScholarService($db);
    $postBody = $req->getParsedBody();

    $editParams = $this->adapterParams($postBody);

    // var_dump($editParams); exit();

    if($db->update("person", $editParams["person"], ["id"=> $attr["id"]]) !== false && $this->saveType($attr["id"], $editParams)) {
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
    $db->delete("person_cripple", ["person_id"=> $attr["id"]]);
    $db->delete("person_disavantaged", ["person_id"=> $attr["id"]]);
    $db->delete("person_scholar", ["person_id"=> $attr["id"]]);
    return $res->withHeader("Location", $req->getUri()->getBasePath()."/person");
  }

  public function adapterParams($input)
  {
    $dateRegex = "/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/";
    $person = $input;
    $person["is_older"] = @$input["is_older"]?: 0;
    $person["created_at"] = date("Y-m-d H:i:s");
    $person["updated_at"] = date("Y-m-d H:i:s");
    $person["die_date"] = preg_match($dateRegex, $input["die_date"])? $this->christDate($input["die_date"]): null;
    $person["reg_date"] = preg_match($dateRegex, $input["reg_date"])? $this->christDate($input["reg_date"]): null;
    $person["birth_date"] = preg_match($dateRegex, $input["birth_date"])? $this->christDate($input["birth_date"]): null;

    $cripple = is_array(@$person["cripple_id"])? $person["cripple_id"]: [];
    $disavantaged = is_array(@$person["disa_id"])? $person["disa_id"]: [];
    $scholar = is_array(@$person["scho_id"])? $person["scho_id"]: [];
    unset($person["cripple_id"]);
    unset($person["disa_id"]);
    unset($person["scho_id"]);

    $params = [
      "person"=> $person,
      "cripple"=> $cripple,
      "disavantaged"=> $disavantaged,
      "scholar"=> $scholar
    ];
    return $params;
  }

  public function christDate($date)
  {
    $d = explode("-", $date);
    $y = $d[0];
    if($y >= 2100)
      $y -= 543;
    $d[0] = $y;

    return implode("-", $d);
  }

  public function budDate($date)
  {
    $d = explode("-", $date);
    $y = $d[0];
    if($y < 2100)
      $y += 543;
    $d[0] = $y;

    return implode("-", $d);
  }

  public function saveType($personId, $adapterParams)
  {
    $container = $this->slim->getContainer();
    $db = $container->medoo;

    $db->delete("person_cripple", ["person_id"=> $personId]);
    $db->delete("person_disavantaged", ["person_id"=> $personId]);
    $db->delete("person_scholar", ["person_id"=> $personId]);

    foreach($adapterParams["cripple"] as $val) {
      $db->insert("person_cripple", ["person_id"=> $personId, "cripple_id"=> $val]);
    }
    foreach($adapterParams["disavantaged"] as $val) {
      $db->insert("person_disavantaged", ["person_id"=> $personId, "disavantaged_id"=> $val]);
    }
    foreach($adapterParams["scholar"] as $val) {
      $db->insert("person_scholar", ["person_id"=> $personId, "scholar_id"=> $val]);
    }

    return true;
  }

  public function buildItems(&$items)
  {
    foreach ($items as $key => &$item) {
      $this->buildItem($item);
    }
  }

  public function buildItem(&$item)
  {
    $container = $this->slim->getContainer();
    $db = $container->medoo;

    $dateRegex = "/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/";

    $item["age"] = preg_match($dateRegex, $item["birth_date"])?
      \DateTime::createFromFormat('Y-m-d', $item["birth_date"])->diff(new \DateTime('now'))->y:
      null;

    $item["die_date"] = preg_match($dateRegex, $item["die_date"])? $this->budDate($item["die_date"]): null;
    $item["reg_date"] = preg_match($dateRegex, $item["reg_date"])? $this->budDate($item["reg_date"]): null;
    $item["birth_date"] = preg_match($dateRegex, $item["birth_date"])? $this->budDate($item["birth_date"]): null;

    $oldersService = XMLService::getInstance("olders");
    $cripplesService = new CrippleService($db);
    $disavantagedsService = new DisavantagedService($db);
    $scholarsService = new ScholarService($db);

    $item["older"] = $oldersService->getBy(["min[<=]"=> $item["age"], "max[>=]"=> $item["age"]]);
    $item["cripple"] = $db->select("person_cripple", ["[>]cripple_type"=> ["cripple_id"=> "id"]], "*", ["person_id"=> $item["id"]]);
    $item["disavantaged"] = $db->select("person_disavantaged", ["[>]disavantaged_type"=> ["disavantaged_id"=> "id"]], "*", ["person_id"=> $item["id"]]);
    $item["scholar"] = $db->select("person_scholar", ["[>]scholar_type"=> ["scholar_id"=> "id"]], "*", ["person_id"=> $item["id"]]);

    $item["total_allowance"] = 0;
    $item["total_allowance"] += $item["is_older"]? @$item["older"]["allowance"]: 0;

    // foreach($item["cripple"] as $val) {
    //   $item["total_allowance"] += $val["allowance"];
    // }
    // foreach($item["disavantaged"] as $val) {
    //   $item["total_allowance"] += $val["allowance"];
    // }
    // foreach($item["scholar"] as $val) {
    //   $item["total_allowance"] += $val["allowance"];
    // }

    $item["total_allowance"] += count($item["cripple"]) > 0? 800: 0;
    $item["total_allowance"] += count($item["disavantaged"]) > 0? 500: 0;
    // $item["total_allowance"] += count($item["scholar"]);
  }
}
