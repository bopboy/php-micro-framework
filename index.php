<?php

echo "test\n";
require_once './vendor/autoload.php';
require_once './config.php';

use Onedb\Database\Adaptor;

Adaptor::setup('mysql:dbname='.$config['dbname'],$config['dbuser'],$config['password']);

class Post {

}

$posts1 = Adaptor::getAll('SELECT * FROM lectures LIMIT 3');
$posts2 = Adaptor::getAll('SELECT * FROM lectures LIMIT 10', [], Post::class);
var_dump($posts2);