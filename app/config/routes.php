<?php
/**
 * Created by PhpStorm.
 * User: vietnt
 * Date: 7/7/14
 * Time: 1:58 PM
 */

$router = new Phalcon\Mvc\Router();

$router->add('/login', array(
    'controller' => 'users',
    'action' => 'login',
));

return $router;