<?php
namespace Main\Controller;

abstract class BaseController
{
  /**
  * @var Slim\App $slim;
  */
  protected $slim;
  public function __construct()
  {
      global $slim;
      $this->slim = $slim;
  }
}
