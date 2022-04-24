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
    $bid = $_GET["bid"]; //borrow_list id
    $current_time = date("Y/m/d H:i:s");

    include("connectDB.php");

    DBQuery("UPDATE borrow_list
             SET return_date='$current_time'
             WHERE bid=$bid");
    echo "<script>alert('歸還成功');parent.location.href='../website/library.php'</script>";
?>