<?php include __DIR__ . "/../header.php";
?>
<form action="/phplabs/Project/www/article/update/<?= $article->getId(); ?>" method="post">
    <input type="text" name="title" id="" value=<?= $article->getTitle(); ?>>
    <input type="text" name="text" id="" value=<?= $article->getText(); ?>>
    <select name="author_id" id="">
        <?php foreach ($users as $user): ?>
            <option value="<?= $user->getId(); ?>"><?= $user->getNickname(); ?></option>
        <?php endforeach; ?>
    </select>
    <button type="submit">Обновить</button>
</form>

<?php include __DIR__ . "/../footer.html"; ?>