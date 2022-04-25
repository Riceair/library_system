<?php
    session_start();
    // 沒登入
    if(!isset($_SESSION["account"])){
        header("Location: login.html"); 
        //確保重定向後，後續代碼不會被執行 
        exit;
    }

    $author = $_POST["author"];
    $book_name = $_POST["book_name"];
    $publication_item = $_POST["publication_item"];
    $caname = $_POST["caname"];

    include("connectDB.php");
    include("sendmail.php");

    //取得類別id
    $caid = DBQuery("SELECT caid
                     FROM book_category
                     WHERE category='$caname'")[0];

    //產生書本id
    $book_id = DBQuery("SELECT MAX(book_id) FROM book")[0];
    if($book_id===NULL){
        $book_id = 0;
    }
    else{
        $book_id += 1;
    }

    DBQuery("INSERT
             INTO book
             VALUES ($book_id, '$author', '$book_name', '$publication_item', $caid)");

    //取得所有人的email
    $emails = DBQueryAll("SELECT user.user_email
                          FROM user");
    foreach($emails as $email){ //寄送email
        sendmail_Group($email[0], $book_name);
    }

    echo "<script>alert('已新增');parent.location.href='../website/library.php'</script>";
?>