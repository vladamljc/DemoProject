<?php

use Catalog\Controllers\HomeController;
use Catalog\Routes\Route;
use Catalog\Routes\Routes;

$route2 = new Route(HomeController::class, 'renderHomePage', '/', 'GET');

Routes::add($route2);
