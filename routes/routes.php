<?php

use Catalog\Controllers\CategoryController;
use Catalog\Controllers\DashboardController;
use Catalog\Controllers\HomeController;
use Catalog\Controllers\LoginController;
use Catalog\Controllers\ProductController;
use Catalog\Middleware\AdminMiddleware;
use Catalog\Routes\Route;
use Catalog\Routes\Routes;

Routes::add(new Route(HomeController::class, 'renderHomePage', '/', 'GET'));

Routes::add(new Route(LoginController::class, 'renderLoginForm', '/login', 'GET'));
Routes::add(new Route(LoginController::class, 'loginAction', '/login', 'POST'));

Routes::add(new Route(DashboardController::class, 'index', '/admin', 'GET', [AdminMiddleware::class]));

Routes::add(new Route(CategoryController::class, 'index', '/admin/categories', 'GET', [AdminMiddleware::class]));

Routes::add(new Route(ProductController::class, 'index', '/admin/products', 'GET', [AdminMiddleware::class]));