# php-cms-admin
* Slim3
* Twgig
* Doctrine 2
* Richardson Maturity Model (Level 2)

# Slim 3 Skeleton

This is a simple skeleton project for Slim 3 that includes Twig, Flash messages and Monolog.
forked by https://github.com/akrabat/slim3-skeleton

## Create your project:

    $ composer create-project --no-interaction --stability=dev akrabat/slim3-skeleton my-app

### Run it:

1. `$ cd my-app`
2. `$ php -S 0.0.0.0:8888 -t public public/index.php`
3. Browse to http://localhost:8888

## Key directories

* `app`: Application code
* `app/src`: All class files within the `App` namespace
* `app/templates`: Twig template files
* `cache/twig`: Twig's Autocreated cache files
* `log`: Log files
* `public`: Webserver root
* `vendor`: Composer dependencies

## Key files

* `public/index.php`: Entry point to application
* `app/settings.php`: Configuration
* `app/dependencies.php`: Services for Pimple
* `app/middleware.php`: Application middleware
* `app/routes.php`: All application routes are here
* `app/src/Action/HomeAction.php`: Action class for the home page
* `app/templates/home.twig`: Twig template file for the home page

https://stackoverflow.com/questions/2068344/how-do-i-get-a-youtube-video-thumbnail-from-the-youtube-api

## slime3 + Doctrine
* http://blog.sub85.com/slim-3-with-doctrine-2.html

'<?php
 $page      = 1; // Página Atual
 $numByPage = 5; // Número de registros por Página
 $Empresa = $em->createQuery("SELECT e FROM Empresa e ")
               ->setFirstResult( ( $numByPage * ($page-1) ) )
               ->setMaxResults( $numByPage );
 $Empresa = new \Doctrine\ORM\Tools\Pagination\Paginator($Empresa);'
 
 ## Generate Entities
 
     ./vendor/doctrine/orm/bin/doctrine orm:convert-mapping --namespace="App\\Entities\\" --force  --from-database annotation ./app/src/Entities
     ./vendor/doctrine/orm/bin/doctrine orm:generate-entities ./app/src/Entities/ --generate-annotations=true
     ./vendor/doctrine/orm/bin/doctrine orm:generate-entities --generate-annotations="true" app/src/Entity
     ./vendor/doctrine/orm/bin/doctrine orm:generate-entities --generate-annotations="true" --generate-methods="true" --regenerate-entities="true" --update-entities="true"  app/src/Entity

