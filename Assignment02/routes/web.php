<?php

use core\Router;
use src\Controllers\ArticleController;
use src\Controllers\LoginController;
use src\Controllers\LogoutController;
use src\Controllers\RegistrationController;
use src\Controllers\SettingsController;

Router::get('/', [ArticleController::class, 'index']); // the root/index page

Router::get('/login', [LoginController::class, 'index']);
Router::post('/login', [LoginController::class, 'login']);

Router::post('/logout', [LogoutController::class, 'logout']);

Router::get('/register', [RegistrationController::class, 'index']);
Router::post('/register', [RegistrationController::class, 'register']);

Router::get('/articles', [ArticleController::class, 'index']);
Router::get('/articles/create', [ArticleController::class, 'create']);
Router::post('/articles/create', [ArticleController::class, 'store']);
Router::get('/articles/edit', [ArticleController::class, 'edit']);
Router::post('/articles/edit', [ArticleController::class, 'update']);
Router::get('/articles/delete', [ArticleController::class, 'delete']);

Router::get('/settings', [SettingsController::class, 'index']);
Router::post('/settings', [SettingsController::class, 'update']);

