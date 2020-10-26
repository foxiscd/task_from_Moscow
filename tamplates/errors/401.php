<?php include __DIR__ . '/../header.php'; ?>
    <h1>Вы не авторизованы</h1>
    Для доступа к этой странице нужно <a href="/users/login">войти на сайт</a>
<?php if (!empty($error)): ?>
    <div style="color: red;">Текст ошибки:<?= $error ?></div>
<?php endif; ?>
<?php include __DIR__ . '/../footer.php'; ?>