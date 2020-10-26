<?php include __DIR__ . '/../header.php'; ?>
    <div style="text-align: center;">
        <h1>Регистрация прошла успешно!</h1>
        <?php if (empty($activate)): ?>
            <p> Ссылка для активации вашей учетной записи отправлена вам на email. </p>
        <?php else: ?>
            <p> Активация прошла успешно! </p>
            <br>
            <a href="/../../index.php"><button type="button" class="btn btn-primary">Войти на сайт</button></a>
        <?php endif; ?>
    </div>
<?php include __DIR__ . '/../footer.php'; ?>