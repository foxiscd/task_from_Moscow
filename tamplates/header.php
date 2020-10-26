<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title> <?= $title ?? 'Комментарии' ?> </title>
    <link rel="stylesheet" type="text/css" href="/Style.css">


    <!--  jquery  -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"
            integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <!-- bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
<div class="container" style="border: 1px solid black;">
    <div class="header">
        <div class="row">
            <div class="col-md-6">
                <a href="/"><h1>Комментарии</h1></a>
            </div>
            <div class="col-md-6">
                <div style=";position:relative; text-align: center;">
                    <?php if (!empty($user)): ?>
                        <?php if (empty($check)): ?>
                            Привет, <?= $user->getNickname() ?>
                        <?php else: ?>
                            Аккаунт- <?= $user->getNickname() ?>
                        <?php endif; ?>
                        <a href="/users/logout">
                            <button type="button" class="btn btn-primary">Выйти</button>
                        </a>
                    <?php else: ?>
                        <a href="/users/login">
                            <button type="button" class="btn btn-primary">Войти</button>
                        </a>
                        <a href="/users/register">
                            <button type="button" class="btn btn-primary">Зарегестрироваться</button>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <hr>

    <div class="row" style=" min-height: 40vh">
        <div class="col-md-9">
            <div>
                <?php if (!empty($user)): ?>
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample"
                            aria-expanded="false" aria-controls="collapseExample">
                        Написать комментарий
                    </button>
                    <div class="collapse" id="collapseExample">
                        <div class="card card-body">
                            <label for="exampleFormControlTextarea1">Текст комментария</label>
                            <input class="hidden" type="hidden" value="<?= $user->getId() ?>" id="userId">
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="5"
                                      name="text"></textarea><br>
                            <button class="btn btn-primary" id="commentSend" onclick="send(), request()">Написать
                            </button>
                        </div>
                    </div>

                    <hr>
                    <script type="text/javascript">
                        function send() {
                            var lol = document.getElementById('commentSend');

                            var commentText = document.querySelector('textarea').value;
                            var user = document.getElementById('userId').value;

                            console.log(jQuery.ajax());
                            jQuery.ajax({
                                method: "POST",
                                url: "/api/addComment.php",
                                data: {text: commentText, userId: user},
                                success: function (data) {
                                    alert(data);
                                    document.querySelector('textarea').value = '';
                                    request();
                                }
                            });
                        }
                    </script>

                <?php endif; ?>
