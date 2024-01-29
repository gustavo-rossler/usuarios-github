<?php

use Pecee\SimpleRouter\SimpleRouter;

SimpleRouter::setCustomClassLoader(new \Inklo\Config\CustomClassLoader());

SimpleRouter::group([
    'exceptionHandler' => \Inklo\Exceptions\CustomExceptionHandler::class,
], function() {
    SimpleRouter::get('/', [\Inklo\Controllers\GithubUsersController::class, 'index']);
    SimpleRouter::all('/salvar-local', [\Inklo\Controllers\GithubUsersController::class, 'save']);
});
