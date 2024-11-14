<?php

use Dotenv\Dotenv;

session_start();

require_once __DIR__. '/vendor/autoload.php';
Dotenv::createImmutable(__DIR__)->load();
require_once __DIR__. '/routers/index.php';