<?php

use core\Router;
use src\Controllers\ArticleController;

Router::get('/', [ArticleController::class, 'index']); // the root/index page

// TODO: add routes for login, logout, register, all article actions, settings
