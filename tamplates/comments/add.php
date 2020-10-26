<?php include __DIR__ . '/../header.php'; ?>
<div style="text-align: left">
    <h2> Добавить статью </h2>
    <?php if (!empty($error)): ?>
        <div style="background-color: maroon; color: white"> <?= $error; ?> </div>
    <?php endif; ?>
    <br>
    <form action="" method="post">
        <label for="exampleFormControlTextarea1">Текст комментария</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="text"><?= $_POST['text'] ?? '' ?></textarea><br>
        <button type="submit" class="btn btn-primary">Написать</button>
    </form>

</div>
<?php include __DIR__ . '/../footer.php'; ?>
