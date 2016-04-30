<?php

use Slim\Views\JadeRenderer;

require '../vendor/autoload.php';
require '../src/JadeRenderer.php';

$app = new Slim\App();
$container = $app->getContainer();
$container['renderer'] = new JadeRenderer();

$app->get('/', function ($request, $response, $args) {
	return $this->renderer->render($response, 'hello', ['name'=>'hoge']);
});

$app->run();
