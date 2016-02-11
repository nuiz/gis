<?php
namespace Main\Middleware;

use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\ResponseInterface;
use Interop\Container\ContainerInterface;

class AuthMiddleware
{
  public function __construct(ContainerInterface $container)
  {
    $this->container = $container;
  }

  public function __invoke(Request $req, Response $res, callable $next)
  {
    $path = $req->getUri()->getPath();
    $allowNotAuth = ["/", "/login"];
    if(!in_array($path, $allowNotAuth)) {
      /** @var Aura\Session\Session */
      $session = $this->container["session"];
      $loginSegment = $session->getSegment("login");

      if(empty($loginSegment->get("user"))) {
        return $res->withHeader("Location", $req->getUri()->getBasePath()."/login");
      }
    }
    return $next($req, $res);
  }
}
