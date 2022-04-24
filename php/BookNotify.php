<?php
    session_start();
    // 沒登入
    if(!isset($_SESSION["account"])){
        header("Location: login.html"); 
        //確保重定向後，後續代碼不會被執行 
        exit;
    }

    $account = $_SESSION["account"];
    $bid = $_GET["bid"]; //borrow_list id

    include("connectDB.php");
    include("sendmail.php");
    

    $result = DBQuery("SELECT book.book_name, user.user_email
                       FROM borrow_list, user, book
                       WHERE borrow_list.bid=2 and borrow_list.borrow_account=user.user_account and
                             borrow_list.book_id=book.book_id;");
    $book_name = $result[0];
    $borrow_email = $result[1];
    $send_result = sendmail($borrow_email, $book_name);
    if($send_result){
        echo "<script>alert('已通知');parent.location.href='../website/library.php'</script>";
    }
    else{
        echo "<script>alert('通知失敗');parent.location.href='../website/library.php'</script>";
    }
?>