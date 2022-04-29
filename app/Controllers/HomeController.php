<?php

namespace App\Controllers;

use App\Models\Users\User;

class HomeController extends BaseController
{
    public function index(): bool
    {
        return $this->render('home');
    }
}