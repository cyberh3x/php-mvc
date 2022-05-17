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

        $matcher = new UrlMatcher($routes, $context);
        try {
            $requestUri = $_SERVER['REQUEST_URI'];
            $rootUrl = explode('/', $requestUri);
            $matcher = $matcher->match(str_replace("/$rootUrl[1]", '', $_SERVER['REQUEST_URI']));

            array_walk($matcher, function (&$param) {
                if (is_numeric($param)) {
                    $param = (int)$param;
                }
            });

            $className = '\\App\\Controllers\\' . $matcher['controller'];
            $classInstance = new $className();

            $method = $matcher['method'];
            unset($matcher['controller'], $matcher['method'], $matcher['_route']);
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
