<?php

require_once('../vendor/autoload.php');

require_once('../config.php');

use Catalog\Http\ExceptionResponse;
use Catalog\Http\RequestFactory;
use Catalog\Loader;
use Catalog\Services\Dispatcher;

$loader = new Loader();
$loader->load();

$request = RequestFactory::makeNewRequest();

$dispatcher = new Dispatcher();
$response = $dispatcher->dispatch($request);
if ($response instanceof ExceptionResponse) {
    exit;
}
echo $response->getContent();


