<?php
/**
 * Use this file to override global defaults.
 *
 * See the individual environment DB configs for specific config information.
 */

return array(
  'active' => 'qloudr_dev',
  'qloudr_dev' => array(
    'type' => 'pdo',
      'connection' => array(
        'dsn' => 'mysql:host=localhost;dbname=blog_oguhouse;unix_socket=/private/tmp/mysql.sock',
        'username' => 'oguri',
        'password' => 'ryuunosuke2k2',
        'persistent' => false,
        'compress' => false,
      ),
    'identifier' => '`',
    'table_prefix' => '',
    'charset' => 'utf8',
    'enable_cache' => true,
    'profiling' => false,
  ),
);
