<?php

namespace App;

use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Exception\NoConfigurationException;

class Router
{
    public function __invoke(RouteCollection $routes)
    {
        $context = new RequestContext();

        // Routing can match routes with incoming requests
        $matcher = new UrlMatcher($routes, $context);
        try {
            $requestUri = $_SERVER['REQUEST_URI'];
            $matcher = $matcher->match($requestUri);

            // Cast params to int if numeric
            array_walk($matcher, function (&$param) {
                if (is_numeric($param)) {
                    $param = (int)$param;
                }
            });

            // https://github.com/gmaccario/simple-mvc-php-framework/issues/2
            // Issue #2: Fix Non-static method ... should not be called statically
            $className = '\\App\\Controllers\\' . $matcher['controller'];
            $classInstance = new $className();

            $method = $matcher['method'];
            unset($matcher['controller'], $matcher['method'], $matcher['_route']);
            // Add routes as paramaters to the next class
            call_user_func_array([$classInstance, $method], $matcher);

        } catch (MethodNotAllowedException $e) {
            echo 'Route method is not allowed.';
        } catch (ResourceNotFoundException $e) {
            echo 'Route does not exists.';
        } catch (NoConfigurationException $e) {
            echo 'Configuration does not exists.';
        }
    }
}

$router = new Router();
$router($routes);