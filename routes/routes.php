<?php

use Catalog\Controllers\HomeController;
use Catalog\Routes\Route;
use Catalog\Routes\Routes;

Routes::add(new Route(HomeController::class, 'renderHomePage', '/', 'GET'));

