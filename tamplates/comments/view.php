<?php include __DIR__ . '/../header.php'; ?>
<div style="background-color: azure; padding: 0 20px">
    <div><h4>Комментарий от <?= $comment->getAuthor()->getNickname() ?>:</h4></div>

    <div style="height: 50px;"> <?= $comment->getText() ?> </div>

    <?php if (!empty($user)): ?>

        <?php if ($user->getRole() === 'admin' || $comment->getAuthorId() === $user->getId()): ?>
            <div style="overflow: hidden;">
                <div style="position: relative">
                    <div style="float: left">
                        <a href="/comment/<?= $comment->getId() ?>/edit">
                            <button type="button" class="btn btn-success">Редактировать комментарий</button>
                        </a>
                    </div>
                    <div style="float: right">
                        <a style="" href="/comment/<?= $comment->getId() ?>/delete">
                            <button type="button" class="btn btn-danger">Удалить комментарий</button>
                        </a>
                    </div>
                </div>
            </div>
        <?php endif; ?>

    <?php endif; ?>
</div>
<?php if (!empty($test)): ?>
    <div style="background-color: chartreuse">Успешно обновлен</div>
<?php endif; ?>

<?php include __DIR__ . '/../footer.php'; ?>

