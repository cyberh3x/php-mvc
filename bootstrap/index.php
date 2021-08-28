<?php

require_once '../config/constant.php';
$appConfig = require_once APP_ROOT . '/config/app.php';
require_once APP_ROOT . '/config/pdo.php';
require_once APP_ROOT . '/config/capsule.php';

// Models
require_once APP_ROOT . '/app/Models/User/User.php';

// Configure Project
date_default_timezone_set($appConfig['timezone']);