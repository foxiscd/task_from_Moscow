<?php

namespace controllers;


use models\articles\Article;
use models\comments\Comment;
use models\users\User;
use Services\Db;
use Services\UsersAuthService;
use Services\Vardump;
use view\View;

class MainController extends AbstractController

{
    private $db;

    public function main()
    {
        $comments = Comment::findAll();
        $error = null;

        $this->view->renderHtml('main/main.php', [
            'user' => UsersAuthService::getUserByToken(),
            'comments' => $comments,
            'error' => $error
        ]);
    }

    public function sayHello(string $name)
    {
        $this->view->renderHtml('main/hello.php', ['name' => $name, 'title' => 'страница преветствия', 'getPonos' => ' тут словестный понос']);
    }

    public function sayBye(string $name)
    {
        $this->view->renderHtml('main/bye.php', ['name' => $name]);
    }


}

