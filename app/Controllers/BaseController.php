<?php

namespace App\Controllers;

use Jenssegers\Blade\Blade;

class BaseController
{
    protected string $views = APP_ROOT . '/views/';
    protected string $cachePath = APP_ROOT . '/bootstrap/cache/';

    protected function render(string $viewPath, array $data = [])
    {
        try {
            $blade = new Blade($this->views, $this->cachePath);
            echo $blade->render($viewPath, $data);
            return true;
        } catch (\Exception $exception) {
            echo $exception->getMessage();
            return false;
        }
    }
}