<?php
function deletePage($link){
    if (isset($_GET['delete'])){
        $id = $_GET['delete'];
        $query = "DELETE FROM pages WHERE id=$id";
        $result = mysqli_query($link, $query) or die(mysqli_error($link));

        $_SESSION['message'] = [
             "text" => "Page successfully deleted!",
             "status" => "success"
        ];

        header('location: index.php');
        die();
    }
}
