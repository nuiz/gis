<?php

namespace Main;

use Slim\App;
use Interop\Container\ContainerInterface;
use Aura\Session\SessionFactory;
use Main\Service\XMLService;
use Main\Middleware\AuthMiddleware;

class Main {
	private $slim, $route, $configFolder;

	public function __construct($configFolder)
	{
		$this->configFolder = $configFolder;
	}

	public function run(){
		global $slim;

		$configuration = [
	    'settings' => [
        'displayErrorDetails' => true,
	    ],
		];
		$c = new \Slim\Container($configuration);
		// create slim application
		$this->slim = $slim = new App($configuration);

		// injection container
		$this->injectContainer();
		// add Middleware
		$this->addMiddleware();

		// load and run route
		$this->route = new Route($this->slim);
		$this->route->run();

		// run slim application
		$this->slim->run();
	}

	public function injectContainer()
	{
		$container = $this->slim->getContainer();
		// Register component on container
		// inject config
		$container["config_folder"] = $this->configFolder;
		$container["config"] = function(ContainerInterface $container){
			$files = scandir($container["config_folder"]);
			$configs = [];
			foreach($files as $item) {
				$path = $container["config_folder"]."/".$item;
				if(is_file($path)) {
					$name = basename($path, ".php");
					$configs[$name] = include($path);
				}
			}
			return $configs;
		};

		// injection aura/session
		$container["session"] = function(ContainerInterface $container){
			$session_factory = new SessionFactory();
			return $session_factory->newInstance($_COOKIE);
		};

		// injection twig-view template engine
		$container["view"] = function(ContainerInterface $container)
		{
			// get aura session add global to twig-view
			$session = $container["session"];
			$segment = $session->getSegment("login");

			// new instance twig-view
	    $view = new \Slim\Views\Twig($container["config"]["twig"]["templates"], [
        // 'cache'=> $container["config"]["twig"]["cache"]
	    ]);
			$view->getEnvironment()->addGlobal('login', $segment);

			// add extension slim
	    $view->addExtension(new \Slim\Views\TwigExtension(
        $container["router"],
        $container["request"]->getUri()
	    ));
			$view->addExtension(new \Twig_Extension_Debug());

	    return $view;
		};

		// injection medoo database libary
		$container["medoo"] = function(ContainerInterface $container)
		{
    	return new \medoo($container["config"]["medoo"]);
		};

		// ser xml resourcePath
		XMLService::setResourcePath($container->config["config"]["resource_path"]."/resource/");
	}

	public function addMiddleware()
	{
		$this->slim->add(new AuthMiddleware($this->slim->getContainer()));
	}
}
