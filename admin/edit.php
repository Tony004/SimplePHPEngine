<?php
    include "elems/connect.php";

    //Получение выбранной страницы из БД
    function getPage($link){
        $title = "Admin add form";

        //Получили ID get запросом и нашли нужную строку
        if(isset($_GET["id"])){
            $id = $_GET["id"];

            $query = "SELECT * FROM pages WHERE id=$id";
            $result = mysqli_query($link, $query) or die(mysqli_error($link));
            $page = mysqli_fetch_assoc($result);

            //Если мы что-то отпраляли, то данные в поля из пост запроса.
            //Если отправки еще не было, то берем данные о записи из БД
            if(isset($_POST['title']) AND isset($_POST['url']) AND isset($_POST['text'])){
                $pageTitle = $_POST["title"];
                $url = $_POST["url"];
                $text = $_POST["text"];
            }
            else{
                $pageTitle = $page['title'];
                $url = $page['url'];
                $text = $page['text'];
            }
                //Функция для записи в форму
                ob_start();
                include "elems/form.php";
                $content = ob_get_clean();
        }
        else{
            $content = "Page does not exist";
        }
                include "layout/layout.php";
    };

    //Добавление изменений в БД
    function addPage($link){
        if(isset($_POST['title']) AND isset($_POST['url']) AND isset($_POST['text'])){
            //Данные из гет и пост запросов
            $id = $_GET["id"];
            $title = mysqli_real_escape_string($link, $_POST["title"]);
            $url = mysqli_real_escape_string($link, $_POST["url"]);
            $text = mysqli_real_escape_string($link, $_POST["text"]);

            //Проверка на существование записи с таким же адресом
            $query = "SELECT COUNT(*) as count FROM pages WHERE url='$url'";
            $result = mysqli_query($link, $query) or die(mysqli_error($link));
            $isPage = mysqli_fetch_assoc($result)["count"];

            //Если запись с введенным юрл есть в таблице
            if($isPage == 1){
                    print_r($_POST);
                $_SESSION['message'] = [
                    "text" => "Page with this url already exists!",
                    "status" => "error"
                ];
            }
            //Если записей нет
            else{
                $query = "UPDATE pages SET title='$title', url='$url', text='$text' WHERE id=$id";
                mysqli_query($link, $query) or die(mysqli_error($link));

                $_SESSION['message'] = [
                   "text" => "Page successfully edited!",
                   "status" => "success"
                ];

                header('location: index.php'); die();
            }
        }
    }

    if(!empty($_SESSION["auth"])){
        getPage($link);
        addPage($link);
    }
    else{
        header('location: layout/login.php');
        die();
    }
