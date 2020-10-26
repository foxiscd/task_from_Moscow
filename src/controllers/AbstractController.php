<?php

namespace controllers;

use Models\users\User;
use Services\UsersAuthService;
use Services\Vardump;
use view\View;

abstract class AbstractController
{
    protected $view;
    protected $user;

    public function __construct()
    {
        $this->user = UsersAuthService::getUserByToken();
        $this->view = new View(__DIR__ . '/../../tamplates');
        $this->view->setVar('user', $this->user);
    }
}