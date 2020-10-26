<?php include __DIR__ . '/../header.php'; ?>
<div style="text-align: left; margin-right: 20%">
    <h2> Авторизация</h2>
    <?php if (!empty($error)): ?>
        <div style="background-color: maroon"> <?= $error; ?> </div>
    <?php endif; ?>
    <br>

    <form action="/users/login" method="post">
        <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?= $_POST['email'] ?? '' ?>">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="password" value="<?= $_POST['password'] ?? '' ?>">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</div>
<?php include __DIR__ . '/../footer.php'; ?>
