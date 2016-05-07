<?php
namespace Main\Middleware;

use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\ResponseInterface;
use Interop\Container\ContainerInterface;

class PermissionMiddleware
{
  private static $container;
  private $allow;

  public static function setContainer(ContainerInterface $container)
  {
    self::$container = $container;
  }

  public static function getUser()
  {
    return self::$container->session->getSegment("login")->get("user");
  }

  public function __construct($allow)
  {
    $this->allow = $allow;
  }

  public static function create($allow)
  {
    return new self($allow);
  }

  public function __invoke(Request $req, Response $res, callable $next)
  {
    // $path = $req->getUri()->getPath();
    // $path = "/".trim($path, "/");
    $user = self::getUser();
    if(empty($user)) {
      return $res->withHeader("Location", $_SERVER['HTTP_REFERER']);
    }
    if(!in_array($user["level"], $this->allow)) {
      return $res->withHeader("Location", $_SERVER['HTTP_REFERER']);
    }
    return $next($req, $res);
  }
}
