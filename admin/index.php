<?php
    include "elems/connect.php";
    //Показать таблицу с данными из БД
    function showPageTable($link){
        $title = "Admin main page";

        $query = "SELECT id, title, url FROM pages WHERE url!=404";
        $result = mysqli_query($link, $query) or die(mysqli_error($link));
        for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);

        $content = "<table><tr>
                                <th>title</th>
                                <th>url</th>
                                <th>edit</th>
                                <th>delete</th>
                           </tr>";
        foreach ($data as $page){
        $content .= "<tr>
                        <td>{$page['title']}</td>
                        <td>{$page['url']}</td>
                        <td><a href=\"edit.php?id={$page['id']}\">edit</a></td>
                        <td><a href=\"?delete={$page['id']}\">delete</a></td>
                    </tr>";
        }
        $content .= "</table>";

        include "layout/layout.php";
    }

    //Удаление строки из БД
    include ("layout/delete.php");

    //Проверка авторизации
    if(!empty($_SESSION["auth"])){
        deletePage($link);
        showPageTable($link);
    }
    else{
        header('location: layout/login.php');
        die();
    }
