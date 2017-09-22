#!/usr/bin/env php
<?php
require __DIR__.'/vendor/autoload.php';
include "config/db.php";

use Composer\Autoload\ClassLoader;
use Symfony\Component\Console\Application;
use Command\ImportWaze;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

define("APP_ROOT", __DIR__);

$loader = new ClassLoader();
$loader->add('Command', __DIR__.'/');
$loader->add('Entity', __DIR__.'/');
$loader->add('Acem', __DIR__.'/');
$loader->register();

$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/Entity"), $isDevMode);
$entityManager = EntityManager::create($dbParams, $config);

$application = new Application();
$application->entityManager = $entityManager;
$application->add(new ImportWaze());
$application->run();
