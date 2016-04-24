<?php
namespace Main\Service;

abstract class TypeService
{
  protected $table;

  public function __construct($db)
  {
    $this->db = $db;
  }

  public function gets()
  {
    return $this->db->select($this->table, "*");
  }

  public function getsBy($conditions = [])
  {
    $where = ["AND"=> $conditions];
    $items = $this->db->select($this->table, "*", $where);
    return $items;
  }

  public function getBy($conditions = [])
  {
    $where = ["AND"=> $conditions];
    $item = $this->db->get($this->table, "*", $where);
    return $item;
  }

  public function add($attr)
  {
    return $this->insert($this->table, $attr);
  }

  public function update($id, $attr)
  {
    return $this->insert($this->table, $attr, ["id"=> $id]);
  }

  public function remove($id)
  {
    return $this->delete($this->table, ["id"=> $id]);
  }
}
