<?php
return [
  'database_type' => 'mysql',
  'server' => 'localhost',
  // 'database_name' => 'papangping_gis',
  // 'username' => 'papangping_gis',
  // 'password' => '111111',
  'database_name' => 'gis',
  'username' => 'root',
  'password' => '',
  'port' => 3306,
  'charset' => 'utf8',
  'option' => [
      \PDO::ATTR_CASE => \PDO::CASE_NATURAL,
      \PDO::ATTR_EMULATE_PREPARES => false
  ]
];
