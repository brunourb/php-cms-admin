<?php
use Doctrine\ORM\Tools\Console\ConsoleRunner;

require 'vendor/autoload.php';

$settings = include 'app/settings.php';
$settings = $settings['settings']['doctrine'];

$config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration(
    $settings['meta']['entity_path'],
    $settings['meta']['auto_generate_proxies'],
    $settings['meta']['proxy_dir'],
    $settings['meta']['cache'],
    false
);

$em = \Doctrine\ORM\EntityManager::create($settings['connection'], $config);

$conn = $em->getConnection();
$conn->getDatabasePlatform()->registerDoctrineTypeMapping('tinyint', 'boolean');
$conn->getDatabasePlatform()->registerDoctrineTypeMapping('bit', 'boolean');
$conn->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');

$helpers = new Symfony\Component\Console\Helper\HelperSet(array(
    'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($em->getConnection()),
    'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($em)
));

return ConsoleRunner::createHelperSet($em);
