<?php
spl_autoload_register(function (string $className) {
    require_once __DIR__ . '/../src/' . $className . '.php';
});

$request = $_POST;

foreach ($request as $key => $item) {
    switch ($key) {
        case ('text') : $text = $item; break;
        case ('userId') : $userId = $item; break;
    }
}

if (!empty($text)){
    $user = \models\users\User::getById($userId);
    $comment = \models\comments\Comment::createCommentFromArray($request, $user);
    if ($comment != null){
        echo 'комментарий добавлен';
    }else {
        echo 'ошибка';
    }
} else {
    echo 'данные не получены';
}
