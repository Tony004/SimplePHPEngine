<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="style/style.css">
        <title><?= $title; ?></title>
    </head>
    <body>
        <header>
                Header
            <p>
                <a href="add.php">Add new page</a>
                <a href="layout/logout.php">Logout</a>
            </p>
        </header>
        <main>
            <p>
                <?php include "elems/info.php"; ?>
                <?= $content; ?>
            </p>
        </main>
        <footer>
            <p>
                Footer
            </p>
        </footer>
    </body>
</html>
