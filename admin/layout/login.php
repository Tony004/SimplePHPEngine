<?php
    include "../elems/connect.php";

    if(isset($_POST["password"]) AND $_POST["password"] == '123'){
        $_SESSION["auth"] = true;

        $_SESSION['message'] = [
             "text" => "Welcome!",
             "status" => "success"
        ];

        header('location: ../index.php');
        die();
    }
        else{
            ?>
            <form action="" method="POST">
                <input type="password" name="password">
                <input type="submit">
            </form>
            <?php
    }
?>
