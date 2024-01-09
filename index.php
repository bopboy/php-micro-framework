<?php

require_once './vendor/autoload.php';
require_once './config.php';

use Onedb\Support\ServiceProvider;
use Onedb\Application;

class SessionServicProvider extends ServiceProvider {
    public static function register() {}
    public static function boot() { session_start();}
}

$app = new Application([
    SessionServicProvider::class
]);
$app->boot();