<?php

use NewCo\UserService\Controllers\UploadController;
use Symfony\Component\Routing;

$routes = new Routing\RouteCollection();

$routes->add('upload', new Routing\Route('/upload', [
    '_controller' => [new UploadController(), 'upload']
]));

$routes->add('index', new Routing\Route('/', [
    '_controller' => [new UploadController(), 'upload']
]));


return $routes;
