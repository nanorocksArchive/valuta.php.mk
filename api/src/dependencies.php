<?php

// Register self autoloader for classes
spl_autoload_register(function ($name) {
    if (strpos(strtolower($name), 'class')) {
        require_once __DIR__ . '/class/' . $name . '.php';
    } elseif (strpos(strtolower($name), 'helper')) {
        require_once __DIR__ . '/helper/' . $name . '.php';
    }
});