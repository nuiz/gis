<?php
namespace Main\Controller;

use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\ResponseInterface;

class AccountController extends BaseController
{
  public function accounts(Request $req, Response $res)
  {
    $container = $this->slim->getContainer();
    $db = $container->medoo;

    $queryParams = $req->getQueryParams();
    $where = [];
    $where["level"] = ["staff", "user"];

    $total = $db->count("account", $where);

    // count
    // item per page
    $perPage = 50;
    $maxPage = ceil($total/$perPage);

		$page = @$queryParams['page']? $queryParams['page']: 1;
		$start = ($page-1) * $perPage;

    $where["LIMIT"] = [$start, $perPage];
    // end count

    $where["ORDER"] = "id";

    $items = $db->select("account", "*", $where);

    return $container->view->render($res, "account/list.twig", [
      "form"=> $queryParams,
      "items"=> $items,
      "page"=> $page,
      "maxPage"=> $maxPage
    ]);
	}

  public function account(Request $req, Response $res, $attr = [])
  {
    $container = $this->slim->getContainer();
    $db = $container->medoo;

    $item = $db->get("account", "*", ["id"=> $attr["id"]]);
    if(!$item) {
      return $res->withHeader("Location", $req->getUri()->getBasePath()."/account");
    }

    return $container->view->render($res, "account/item.twig", [
      "item"=> $item
    ]);
  }

  public function accountGetAdd(Request $req, Response $res)
  {
    $container = $this->slim->getContainer();
    $db = $container->medoo;

    return $container->view->render($res, "account/form.twig");
  }

  public function accountPostAdd(Request $req, Response $res)
  {
    $container = $this->slim->getContainer();
    $db = $container->medoo;

    $postBody = $req->getParsedBody();

    $insertParams = $this->adapterParams($postBody);

    if($db->count("account", ["username"=> @$postBody["username"]]) > 0) {
      return $container->view->render($res, "account/form.twig", [
        "form"=> $postBody,
        "error_message"=> "ชื่อผู้ใช้งานซ้ำกับผู้ใช้งานอื่น"
      ]);
    }

    $id = $db->insert("account", $insertParams);
    if($id) {
      return $res->withHeader("Location", $req->getUri()->getBasePath()."/account");
    }

    return $container->view->render($res, "account/form.twig", [
      "form"=> $postBody
    ]);
  }

  public function accountGetEdit(Request $req, Response $res, $attr = [])
  {
    $container = $this->slim->getContainer();
    $db = $container->medoo;

    $item = $db->get("account", "*", ["id"=> $attr["id"]]);
    if(!$item) {
      return $res->withHeader("Location", $req->getUri()->getBasePath()."/account");
    }

    return $container->view->render($res, "account/form.twig", [
      "form"=> $item
    ]);
  }

  public function accountPostEdit(Request $req, Response $res, $attr = [])
  {
    $container = $this->slim->getContainer();
    $db = $container->medoo;

    $postBody = $req->getParsedBody();

    $editParams = $this->adapterParams($postBody);

    // var_dump($editParams); exit();
    if($db->count("account", ["AND"=> ["username"=> @$postBody["username"], "id[!]"=> $attr["id"]]]) > 0) {
      return $container->view->render($res, "account/form.twig", [
        "form"=> $postBody,
        "error_message"=> "ชื่อผู้ใช้งานซ้ำกับผู้ใช้งานอื่น"
      ]);
    }

    if($db->update("account", $editParams, ["id"=> $attr["id"]]) !== false) {
      return $res->withHeader("Location", $req->getUri()->getBasePath()."/account");
    }

    return $container->view->render($res, "account/form.twig", [
      "form"=> $postBody
    ]);
  }

  public function accountRemove(Request $req, Response $res, $attr = [])
  {
    $container = $this->slim->getContainer();
    $db = $container->medoo;

    $db->delete("account", ["id"=> $attr["id"]]);
    return $res->withHeader("Location", $req->getUri()->getBasePath()."/account");
  }

  public function adapterParams($input)
  {
    $account = $input;
    // $account["password"] = md5(@$input["password"]);

    return $account;
  }
}
