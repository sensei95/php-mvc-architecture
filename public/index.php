<?php

use App\Exceptions\NotFoundException;
use Router\Router;

require_once '../vendor/autoload.php';

define('VIEWS_PATH', dirname(__DIR__).DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR);
define('SCRIPTS_PATH', dirname($_SERVER['SCRIPT_NAME']).DIRECTORY_SEPARATOR);

const DB_NAME = 'php-mvc';
const DB_HOST = 'localhost';
const DB_USER = 'root';
const DB_PASSWORD = 'root';

$router = new Router($_GET['url']);

require_once __DIR__.'/../routes/web.php';


try {
    $router->run();
} catch (NotFoundException $e) {
    echo $e->error404();
}
