<?php
namespace Main\Service;

class XMLService
{
  private $xmlServiceName;
  private $xmlElement;
  private $items = [];

  private static $services = [];
  private static $resourcePath;
  public static function getInstance($xmlServiceName)
  {
    if(!isset(static::$services[$xmlServiceName]))
      static::$services[$xmlServiceName] = new self($xmlServiceName);

    return static::$services[$xmlServiceName];
  }

  private function __construct($xmlServiceName)
  {
    $this->xmlServiceName = $xmlServiceName;
    $this->xmlElement = new \SimpleXMLElement(file_get_contents(static::$resourcePath."/".$this->xmlServiceName.".xml"));
    $this->xmlElement = $this->xml2array($this->xmlElement);
    $this->items = $this->xmlElement[$this->xmlServiceName];
  }

  public static function setResourcePath($resourcePath)
  {
    static::$resourcePath = $resourcePath;
  }

  public function gets($conditions = [])
  {
    $items = [];
    foreach ($this->items as $key => $item) {
      if($this->assertConditions($item, $conditions))
        $items[] = $item;
    }
    return $items;
  }

  public function getBy($conditions = [])
  {
    foreach($this->items as $item) {
      if ($this->assertConditions($item, $conditions))
        return $item;
    }
    return null;
  }

  public function assertConditions($item, $conditions)
  {
    foreach($conditions as $key=> $value) {
      if(!$this->assertCondition($item, $key, $value))
        return false;
    }
    return true;
  }

  public function assertCondition($item, $key, $value)
  {
    preg_match('/(#?)([\w\.\-]+)(\[(\>|\>\=|\<|\<\=|\!)\])?/i', $key, $match);
    $column = $match[2];

    if(isset($match[4])) {
      $operator = $match[4];
      if($operator == "!") {
        if($item[$column] != $value)
          return true;
      }
      else if($operator == ">") {
        if($item[$column] > $value)
          return true;
      }
      else if($operator == ">=") {
        if($item[$column] >= $value)
          return true;
      }
      else if($operator == "<") {
        if($item[$column] < $value)
          return true;
      }
      else if($operator == "<=") {
        if($item[$column] <= $value)
          return true;
      }
    }
    else {
      if($item[$column] == $value)
        return true;
    }
    return false;
  }

  function xml2array($xmlObject, $out = [])
  {
    foreach((array)$xmlObject as $index=> $node)
      $out[$index] = is_object($node) || is_array($node)? $this->xml2array($node): $node;
    return $out;
  }
}
