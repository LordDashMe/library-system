<?php

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$entityPath =  __DIR__ . '/src/Domain/Entity/'; 

$paths = array($entityPath);
$isDevMode = true;

$dbParams = array(
    'driver'   => 'pdo_mysql',
    'user'     => 'root',
    'password' => '',
    'host' => '127.0.0.1:3307',
    'dbname'   => 'dev_library_system',
);

$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode, null, null, false);

$entityManager = EntityManager::create($dbParams, $config);

global $entityManager;
