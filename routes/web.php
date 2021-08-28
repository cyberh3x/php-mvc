<?php

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

$routes = new RouteCollection();
$routes->add('home', new Route('/', ['controller' => 'HomeController', 'method' => 'index'], []));
$routes->add('auth.login', new Route('/auth/login', ['controller' => 'Auth\\LoginController', 'method' => 'index'], []));