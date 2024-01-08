<?php

namespace Onedb\Routing;

abstract class Middleware {
    abstract public static function process();
}