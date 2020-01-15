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

Routes::add(new Route(CategoryController::class, 'addCategory', '/admin/categories', 'POST'));

Routes::add(new Route(CategoryController::class, 'showAddNewCategoryForm', '/admin/categories/addFormView', 'GET',
    [AdminMiddleware::class]));

Routes::add(new Route(CategoryController::class, 'showAddNewSubCategoryForm', '/admin/categories/addSubFormView',
    'GET'));
Routes::add(new Route(CategoryController::class, 'addSubCategory', '/admin/categories/addSubCategory', 'POST',
    [AdminMiddleware::class]));
Routes::add(new Route(CategoryController::class, 'showSelectedCategory', '/admin/categories/showSelectedCategory',
    'GET', [AdminMiddleware::class]));

Routes::add(new Route(CategoryController::class, 'getAllCategories', '/admin/categories/getJSON', 'GET',
    [AdminMiddleware::class]));

Routes::add(new Route(CategoryController::class, 'getEditCategoryView', '/admin/categories/getEditCategoryView', 'GET',
    [AdminMiddleware::class]));
Routes::add(new Route(CategoryController::class, 'editCategory', '/admin/categories/editCategory', 'PUT',
    [AdminMiddleware::class]));
Routes::add(new Route(CategoryController::class, 'deleteCategory', '/admin/categories/deleteCategory', 'DELETE',
    [AdminMiddleware::class]));

Routes::add(new Route(ProductController::class, 'getAddNewProductView', '/admin/product/create', 'GET'));
Routes::add(new Route(ProductController::class, 'addNewProduct', '/admin/product/create', 'POST'));
Routes::add(new Route(ProductController::class, 'uploadProductImage', '/admin/product/uploadImage', 'POST'));
Routes::add(new Route(ProductController::class, 'getPage', '/admin/products/getPage', 'GET'));
Routes::add(new Route(ProductController::class, 'enableProducts', '/admin/products/enableProducts', 'POST'));
Routes::add(new Route(ProductController::class, 'disableProducts', '/admin/products/disableProducts', 'POST'));






