<?php

$container = $app->getContainer();

$container['view'] = function ($c) {
    $view = new \Slim\Views\Twig('src/views', [
        'cache' => false,
    ]);

    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $c['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($c['router'], $basePath));
    $view['baseUrl'] = $c['request']->getUri()->getBaseUrl();
    $view['imageUrl'] = config('SITE_IMG');

    return $view;
};
