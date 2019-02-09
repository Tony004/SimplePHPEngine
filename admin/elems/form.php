<form action="" method="POST">
    <p>
        <input value="<?= $pageTitle ?>"
        type="text" name="title" placeholder="Title">
    </p>
    <p>
        <input value="<?= $url ?>"
        type="text" name="url" placeholder="URL">
    </p>
    <p>
        <textarea name="text" rows="4" cols="15"
        placeholder="type text"><?= $text ?></textarea>
    </p>
    <input type="submit">
</form>
