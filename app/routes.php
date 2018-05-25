<?php
// Routes

//

$app->group('/painel', function() use ($app) {
    $app->get('',App\Action\CMSAction::class . ':page')->setName('homepage');
    $app->map(['GET', 'POST','DELETE','PUT'], '/menu', App\Action\CMSAction::class . ':page');
    $app->map(['GET', 'POST','DELETE','PUT'], '/page', App\Action\CMSAction::class . ':page');
    $app->map(['GET', 'POST','DELETE','PUT'], '/page-details', App\Action\CMSAction::class . ':page');
    $app->map(['GET', 'POST','DELETE','PUT'], '/gallery', App\Action\CMSAction::class . ':page');
    $app->map(['GET', 'POST','DELETE','PUT'], '/img', App\Action\CMSAction::class . ':page');
    $app->map(['GET', 'POST','DELETE','PUT'], '/img-gallery/{id:[0-9]+}', App\Action\CMSAction::class . ':page');
    $app->map(['GET', 'POST','DELETE','PUT'], '/video', App\Action\CMSAction::class . ':page');
    $app->map(['GET', 'POST','DELETE','PUT'], '/tariff', App\Action\CMSAction::class . ':page');
    $app->map(['GET', 'POST','DELETE','PUT'], '/tag', App\Action\CMSAction::class . ':page');
    $app->map(['GET', 'POST','DELETE','PUT'], '/hotel', App\Action\CMSAction::class . ':page');
    $app->map(['GET', 'POST','DELETE','PUT'], '/room', App\Action\CMSAction::class . ':page');
    $app->post('/upload',App\Action\CMSAction::class . ':upload');

});

$app->get('/', App\Action\HomeAction::class)->setName('homepage');
