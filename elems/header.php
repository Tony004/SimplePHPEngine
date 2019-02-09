<?php
//Функция меню
    function createLink($url, $ancor){
        $ourUrl = "/LearnPHP/$url";
        $class = "";

        if ($_SERVER['REQUEST_URI'] == $ourUrl){
            $class = 'class="active"';
        }
        elseif ($ourUrl == "/LearnPHP/index.php/"){

        }

        echo "<a href=\"?file=$url\"$class>$ancor</a> ";
    }

    $query = "SELECT * FROM pages WHERE url!='404'";
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);

    foreach($data as $elem)
        createLink($elem["url"], $elem["title"]);
