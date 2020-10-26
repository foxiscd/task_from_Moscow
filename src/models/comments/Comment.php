<?php

namespace models\comments;

use http\Exception\InvalidArgumentException;
use models\ActiveRecordEntity;
use models\articles\Article;
use models\users\User;
use Services\Vardump;

class Comment extends ActiveRecordEntity
{
    protected $authorId;
    protected $text;
    protected $createdAt;

    public function getAuthorId(): int
    {
        return $this->authorId;
    }


    public function getText(): string
    {
        return $this->text;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setAuthorId($authorId)
    {
        $this->authorId = $authorId;
    }

    public function setText($text)
    {
        $this->text = $text;
    }

    public function getAuthor()
    {
        return User::getById($this->getAuthorId());
    }


    protected static function getTableName(): string
    {
        return 'comments';
    }

    public static function createCommentFromArray($field, User $user)
    {
        if (empty($field)) {
            throw new \myproject\Exceptions\InvalidArgumentException('вы не указали текст комментария');
        }

        $comment = new Comment();

        $comment->setText($field['text']);
        $comment->setAuthorId($user->getId());

        $comment->save();

        return $comment;
    }

    public function edit($fields)
    {
        if (empty($fields)) {
            throw new \myproject\Exceptions\InvalidArgumentException('Вы не указали текст комментария');
        }

        if ($fields === $this->getText()) {
            throw new \myproject\Exceptions\InvalidArgumentException('Вы не изменили текст комментария');
        }
        $this->setText($fields);
        $this->save();
    }


}