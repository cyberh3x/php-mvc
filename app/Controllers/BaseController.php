<?php

namespace App\Controllers;

use Jenssegers\Blade\Blade;

class BaseController
{
    protected string $views = APP_ROOT . '/views/';
    protected string $viewsCachePath = APP_ROOT . '/storage/framework/views';

    protected function render(string $viewPath, array $data = [])
    {
        try {
            $blade = new Blade($this->views, $this->viewsCachePath);
            echo $blade->render($viewPath, $data);
            return true;
        } catch (\Exception $exception) {
            echo $exception->getMessage();
            return false;
        }
    }
}