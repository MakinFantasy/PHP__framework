<?php include __DIR__ . "/../header.php";
?>
<h2>
    <?= $article->getTitle(); ?>
</h2>
<p>
    <?= $article->getText(); ?>
</p>
<p>Автор:
    <?= $article->getAuthorId()->getNickname() ?>
</p>

<ul>

    <li><a href="/phplabs/Project/www/article/edit/<?= $article->getId(); ?>">Редактировать статью</a></li>
    <li><a href="/phplabs/Project/www/article/delete/<?= $article->getId(); ?>">Удалить статью</a></li>

</ul>

<form action="/phplabs/Project/www/comments/store" method="post">
    <input type="text" name="text">
    <input type="text" name="articleId" value='<?= $article->getId(); ?>' hidden>
    <select name="authorId" id="">
        <?php foreach ($users as $user): ?>
            <option value="<?= $user->getId(); ?>"><?= $user->getNickname(); ?></option>
        <?php endforeach; ?>
    </select>
    <button type="submit">Добавить комментарий</button>
</form>

<p>


    <?php foreach ($comments as $comment): ?>
    <p>
        <?= $comment->getCommentText(); ?>
    </p>
    <div style="display:flex; justify-content:space-between;">
        <p>
            Автор:
            <?= $comment->getAuthor()->getNickname();
            ; ?>
        </p>
        <p>
        <?= $comment->getTime();
            ; ?>
        </p>
    </div>
    <a href="/phplabs/Project/www/comments/<?= $comment->getId(); ?>">Посмотреть комментарий</a>



    <hr>
<?php endforeach; ?>
<p>

    <?php include __DIR__ . "/../footer.html"; ?>