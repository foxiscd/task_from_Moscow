<?php include __DIR__ . '/../header.php'; ?>
    <h1>Редактирование комментария</h1>

<?php if (!empty($error)): ?>
    <div style="color: red;"><?= $error ?></div>
<?php endif; ?>


    <form action="" method="post">
        <label for="exampleFormControlTextarea1">Текст комментария</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="text"><?= $_POST['text'] ?? $comment->getText() ?></textarea><br>
        <button type="submit" class="btn btn-primary">Изменить</button>
    </form>

<?php include __DIR__ . '/../footer.php'; ?>