<?php
    session_start();
    // 沒登入
    if(!isset($_SESSION["account"])){
        header("Location: login.html"); 
        //確保重定向後，後續代碼不會被執行 
        exit;
    }
    date_default_timezone_set('Asia/Taipei');
    $account = $_SESSION["account"];
    $book_id = $_GET["book_id"];
    $current_time = date("Y/m/d H:i:s");

    include("connectDB.php");
    $bid = DBQuery("SELECT MAX(bid) FROM borrow_list")[0]; //取得當前最大的借閱bid
    if($bid===NULL){
        $bid = 0;
    }
    else{
        $bid += 1;
    }

    DBQuery("INSERT
             INTO borrow_list
             VALUES ($bid, '$current_time', NULL, '$account', $book_id)");
    echo "<script>alert('借閱成功');parent.location.href='../website/library.php'</script>";
?>