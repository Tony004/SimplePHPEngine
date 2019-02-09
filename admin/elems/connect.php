<?php
    session_start();

    $host = "localhost";
    $user = "root";
    $password = "root";
    $db = "test";
    //Database connection
    $link = mysqli_connect($host, $user, $password, $db);
    mysqli_query($link, "SET NAMES 'utf8'");
