<?php
    session_start();
    // 沒登入
    if(!isset($_SESSION["account"])){
        header("Location: login.html"); 
        //確保重定向後，後續代碼不會被執行 
        exit;
    }

    $book_id = $_GET["book_id"];
    
    include("connectDB.php");
    //刪除書本
    DBQuery("DELETE
             FROM book
             WHERE book_id=$book_id");
    //刪除相關的借閱紀錄
    DBQuery("DELETE
             FROM borrow_list
             WHERE book_id=$book_id");

    echo "<script>alert('刪除成功');parent.location.href='../website/library.php'</script>";
?>