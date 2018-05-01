<?php
// Routes

//

$app->group('/painel', function() use ($app) {
    $app->get('',App\Action\CMSAction::class . ':page')->setName('homepage');
    $app->map(['GET', 'POST','DELETE','PUT'], '/menu', App\Action\CMSAction::class . ':page');
    $app->map(['GET', 'POST','DELETE','PUT'], '/page', App\Action\CMSAction::class . ':page');
    $app->map(['GET', 'POST','DELETE','PUT'], '/page-details', App\Action\CMSAction::class . ':page');
    $app->map(['GET', 'POST','DELETE','PUT'], '/gallery', App\Action\CMSAction::class . ':page');
    $app->get('/img-video',App\Action\CMSAction::class . ':page');
    $app->get('/tag',App\Action\CMSAction::class . ':page');
    $app->get('/tag-values',App\Action\CMSAction::class . ':page');
    $app->get('/banner',App\Action\CMSAction::class . ':page');
    $app->get('/tariff',App\Action\CMSAction::class . ':page');
    $app->get('/hotel',App\Action\CMSAction::class . ':page');
    $app->get('/room',App\Action\CMSAction::class . ':page');
    $app->get('/room-values',App\Action\CMSAction::class . ':page');
    $app->post('/upload',App\Action\CMSAction::class . ':upload');

});

$app->get('/', App\Action\HomeAction::class)->setName('homepage');
