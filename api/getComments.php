<?php
spl_autoload_register(function (string $className) {
    require_once __DIR__ . '/../src/' . $className . '.php';
});

$request = $_GET;

foreach ($request as $key => $item) {
   switch ($key) {
       case ('controllerName') : $controllerName = $item ; break;
       case ('methodName') : $methodName = $item ; break;
       case ('User') : $user = $item ; break;
   }
}

if ($controllerName == 'Comment') {
    $objs = \models\comments\Comment::$methodName();

    foreach ($objs as $comment): ?>

        <div><h4>Автор: <?= $comment->getAuthor()->getNickname() ?></h4></div>
        <div style="height: 50px;"> <?= $comment->getText() ?> </div>

        <?php if ($user != 'null' && $comment->getAuthor()->getId() == $user): ?>
            <div style="overflow: hidden; ">
                <div style="position: relative">
                    <div style="float: left">
                        <a href="/comment/<?= $comment->getId() ?>/edit">
                            <button type="button" class="btn btn-success">Редактировать комментарий</button>
                        </a>
                    </div>
                    <div style="float: right">
                        <a style="" href="/comment/<?= $comment->getId() ?>/delete">
                            <button type="button" class="btn btn-danger" onclick="delete()">Удалить комментарий</button>
                        </a>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <hr>

    <?php
    endforeach;
} else {
    echo 'Ошибка';
}


