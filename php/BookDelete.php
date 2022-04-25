<?php
    session_start();
    // 沒登入
    if(!isset($_SESSION["account"])){
        header("Location: login.html"); 
        //確保重定向後，後續代碼不會被執行 
        exit;
    }

    $book_id = $_GET["book_id"];
    echo $book_id;
?>