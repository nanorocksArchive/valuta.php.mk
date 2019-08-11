<?php
/**
 * Composer
 */
require_once __DIR__ . './../vendor/autoload.php';


$mainPath = __DIR__ . './../src/';

/**
 * Dependencies
 */
require_once $mainPath . 'dependencies.php';

/**
 * Config
 */
require_once $mainPath . 'config.php';

/**
 * Routes
 */
require_once $mainPath . 'route/api.php';

/**
 * App Start
 */
Flight::start();