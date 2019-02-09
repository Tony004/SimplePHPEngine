<?php
    include "elems/connect.php";

    function getForm(){

    $title = "Admin add form";
        //Если мы отправили что-то, но неудачно, то в полях будет отправка.
        //Если мы ничего не отправляли, то поля будут пусты
        if(isset($_POST['title']) AND isset($_POST['url']) AND isset($_POST['text'])){
            $pageTitle = $_POST["title"];
            $url = $_POST["url"];
            $text = $_POST["text"];
        }
        else {
            $pageTitle = '';
            $url = '';
            $text = '';
        }

        //Функция для заполнения полей
        ob_start();
        include "elems/form.php";
        $content = ob_get_clean();

        include "layout/layout.php";
    };

    function addPage($link){
        if(isset($_POST['title']) AND isset($_POST['url']) AND isset($_POST['text'])){
            $title = mysqli_real_escape_string($link, $_POST["title"]);
            $url = mysqli_real_escape_string($link, $_POST["url"]);
            $text = mysqli_real_escape_string($link, $_POST["text"]);

            //Смотрим, есть ли такая страница в БД по юрл
            $query = "SELECT COUNT(*) as count FROM pages WHERE url='$url'";
            $result = mysqli_query($link, $query) or die(mysqli_error($link));
            $isPage = mysqli_fetch_assoc($result)["count"];

            if ($isPage){
                $_SESSION['message'] = [
                     "text" => "Page already exists!",
                     "status" => "error"
                ];
            }
            else {
                $query = "INSERT INTO pages (title, url, text) VALUES ('$title', '$url', '$text')";
                mysqli_query($link, $query) or die(mysqli_error($link));

            $_SESSION['message'] = [
                 "text" => "Page added successfully!",
                 "status" => "success"
            ];

            header('location: index.php'); die();
            }
        }
    }

    if(!empty($_SESSION["auth"])){
        addPage($link);
        getForm();
    }
    else{
        header('location: layout/login.php');
        die();
    }
