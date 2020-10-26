<?php include __DIR__ . '/../header.php'; ?>
    <div>
        <h1>Регистрация</h1>
        <?php if (!empty($error)): ?>
            <div style="background-color: red;padding: 5px;margin: 15px"><?= $error ?></div>
        <?php endif; ?>

        <form action="/users/register" method="post">
            <div class="form-group">
                <label for="exampleInputNickname">Nickname</label>
                <input type="text" name="nickname" class="form-control" id="exampleInputNickname" value="<?= $_POST['nickname'] ?? '' ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input name="email" type="email" class="form-control" id="exampleInputEmail1" value="<?= $_POST['email'] ?? '' ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password" value="<?= $_POST['password'] ?? '' ?>">
            </div>
            <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
        </form>

    </div>
<?php include __DIR__ . '/../footer.php'; ?>