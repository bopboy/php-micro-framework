<?php

require_once './vendor/autoload.php';
require_once './config.php';

use Onedb\Routing\Route;
use Onedb\Database\Adaptor;

Adaptor::setup('mysql:dbname='.$config['dbname'],$config['dbuser'],$config['password']);

Route::add('get', '/', function() {
    echo "hello, world";
});

Route::add('get', '/posts', function() {
    var_dump(Adaptor::getAll(('SELECT * FROM lectures LIMIT 3')));
});

Route::add('get', '/posts/{id}', function($id) {
    $post = Adaptor::getAll('SELECT * FROM lectures WHERE id = ?', [$id]);
    if($post) return var_dump($post);
    http_response_code(404);
});

Route::run();