<?php include __DIR__ . '/../header.php'; ?>
<?php foreach ($users as $user): ?>
    Имя: <?= $user['nickname'] ?>
    <br>
    Номер в списке: <?= $user['id'] ?>
    <br>
    Пароль: <?= $user['password_hash'] ?>
    <br>
    Пароль: <?= $user['email'] ?>
<?php endforeach; ?>
<?php include __DIR__ . '/../footer.php'; ?>