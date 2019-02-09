<?php
    include "elems/connect.php";

    if (isset($_GET["file"]))
        $page = $_GET["file"];
    else{
        $page = "index";
    }

    $query = "SELECT * FROM pages WHERE url='$page'";
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    $page = mysqli_fetch_assoc($result);

    if(!$page){
        $query = "SELECT * FROM pages WHERE url='404'";
        $result = mysqli_query($link, $query) or die(mysqli_error($link));
        $page = mysqli_fetch_assoc($result);
        header("HTTP/1.0 404 Not found");
    }

    $title = $page["title"];
    $content = $page["text"];

    include "layout/layout.php";
