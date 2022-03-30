<?php

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

require_once "vendor/autoload.php";

$config = Setup::createAnnotationMetadataConfiguration(
    [__DIR__."/src"],
    true,
    null,
    null,
    false
);

$conn = [
    'driver' => 'pdo_pgsql',
    'user' => 'postgres',
    'password' => 'mysecretpassword',
    'host' => '127.0.0.1',
    'port' => '5432',
    'dbname' => 'postgres',
];

$entityManager = EntityManager::create($conn, $config);
