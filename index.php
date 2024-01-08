<?php

require_once './vendor/autoload.php';
require_once './config.php';

use Onedb\Routing\Route;
use Onedb\Database\Adaptor;
use Onedb\Routing\Middleware;
use Onedb\Session\DatabaseSessionHandler;

Adaptor::setup('mysql:dbname='.$config['dbname'],$config['dbuser'],$config['password']);

// class HelloMiddleware extends Middleware {
//     public static function process() {
//         return true;
//     }
// }

// Route::add('get', '/', function() {
//     echo "hello, world";
// }, [HelloMiddleware::class]);

// Route::add('get', '/posts', function() {
//     var_dump(Adaptor::getAll(('SELECT * FROM lectures LIMIT 3')));
// });

// Route::add('get', '/posts/{id}', function($id) {
//     $post = Adaptor::getAll('SELECT * FROM lectures WHERE id = ?', [$id]);
//     if($post) return var_dump($post);
//     http_response_code(404);
// });

// Route::run();

session_set_save_handler(new DatabaseSessionHandler());
session_start();

$_SESSION['message'] = 'hello world';
$_SESSTION['foo'] = new stdClass();