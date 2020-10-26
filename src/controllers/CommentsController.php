<?php

namespace controllers;

use http\Client\Curl\User;
use http\Exception\InvalidArgumentException;
use Exceptions\Forbidden;
use Exceptions\LoginExceptions;
use Exceptions\UnauthorizedException;
use models\articles\Article;
use models\comments\Comment;
use Services\Vardump;

class CommentsController extends AbstractController
{
    public function viewComment($commentId)
    {
        $comment = Comment::getById($commentId);
        $error = null;
        $this->view->renderHtml('comments/view.php', ['comment' => $comment, 'error' => $error]);
    }

    public function add()
    {
        if (empty($this->user)) {
            throw new UnauthorizedException('Добавлять комментарии могут только авторизованные юзеры');
        }

        if (!empty($_POST)) {
            try {
                $comment = Comment::createCommentFromArray($_POST, $this->user);
            } catch (\myproject\Exceptions\InvalidArgumentException $e) {
                $this->view->renderHtml('comments/add.php', ['error' => $e->getMessage()]);
                return;
            }

            header('Location: /comment/' . $comment->getId());
            exit();
        }
        $this->view->renderHtml('comments/add.php', []);
    }

    public function deleteComment($commentId)
    {
        if (empty($this->user)) {
            throw new UnauthorizedException('Редактировать комментарии могут только авторизованные юзеры');
        }

        $comment = Comment::getById($commentId);

        if ($this->user->getId() !== $comment->getAuthorId() and $this->user->getRole() !== 'admin') {
            throw new Forbidden('У вас нет прав на удаление этого комментария');
        }


        if ($commentId == true) {
            $comment->delete();
            header('Location: /');
        }
        return 'Комментарий не найден';
    }

    public function editComment($commentId)
    {
        $comment = Comment::getById($commentId);

        if (empty($this->user)) {
            throw new UnauthorizedException('Редактировать комментарии могут только авторизованные юзеры');
        }

        if ($this->user->getRole() != "admin" and $this->user->getId() !== $comment->getAuthorId()) {
            throw new Forbidden('У вас нет прав на редактирования этого комментария');
        }

        if (!empty($_POST)) {
            try {
                $comment->edit($_POST['text']);

            } catch (\Exceptions\InvalidArgumentException $e) {
                $this->view->renderHtml('comments/edit.php', ['error' => $e->getMessage()]);
                return;
            }
            $test = true;
            $this->view->renderHtml('comments/view.php', ['comment' => $comment, 'test' => $test]);
            exit();
        }
        $this->view->renderHtml('comments/edit.php', ['comment' => $comment]);

    }

}