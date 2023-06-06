<?php include __DIR__ . "/../header.php";
?>
<h2>
    <?= $comment->getCommentText(); ?>
</h2>
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
<ul>

    <li><a href="/phplabs/Project/www/comments/edit/<?= $comment->getId(); ?>">Редактировать комментарий</a></li>
    <li><a href="/phplabs/Project/www/comments/delete/<?= $comment->getId(); ?>">Удалить комментарий</a></li>

</ul>
<?php include __DIR__ . "/../footer.html"; ?>