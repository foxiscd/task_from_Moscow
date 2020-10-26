<?php

return [
    '~^$~'  => [ controllers\MainController::class , 'main'],
    '~^users/(\d+)$~' => [controllers\UsersController::class, 'user'],
    '~^users/register$~' => [\controllers\UsersController::class , 'signUp'],
    '~^users/(\d+)/activate/(.+)$~' => [\controllers\UsersController::class , 'activate'],
    '~^users/login$~' => [\controllers\UsersController::class, 'login'],
    '~^users/logout$~' => [\controllers\UsersController::class , 'logout'],
    '~^comment/add$~' => [\controllers\CommentsController::class, 'add'],
    '~^comment/(\d+)$~' => [\controllers\CommentsController::class, 'viewComment'],
    '~^comment/(\d+)/delete$~' => [\controllers\CommentsController::class, 'deleteComment'],
    '~^comment/(\d+)/edit$~' => [\controllers\CommentsController::class, 'editComment'],
    ];