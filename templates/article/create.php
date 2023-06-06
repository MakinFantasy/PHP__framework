<?php include __DIR__ . "/../header.php";
?>
<form action="../article/store" method="post">
    <input tupe="text" name="title" id="">
    <input tupe="text" name="text" id="">
    <select name="author" id="">
        <?php foreach($users as $user): ?>
            <option value="<?=$user->getId();?>"><?=$user->getNickname();?></option>
            <?php endforeach;?>
    </select>
    <button type="submit">Save</button>
</form>
<?php include __DIR__ . "/../footer.html"; ?>