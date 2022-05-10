<?php
    session_start();
    // 沒登入
    if(!isset($_SESSION["account"])){
        header("Location: login.html"); 
        //確保重定向後，後續代碼不會被執行 
        exit;
    }

    $user_name = $_POST["user_name"];
    $user_account = $_SESSION["account"];
    $user_pwd = $_POST["user_pwd"];
    $user_email = $_POST["user_email"];
    $user_phone = $_POST["user_phone"];

    include("../php/connectDB.php");
    DBCommand("UPDATE user
             SET user_name='$user_name', user_pwd='$user_pwd', user_email='$user_email', user_phone='$user_phone'
             WHERE user_account='$user_account'");
    $_SESSION["name"] = $user_name;
    echo "<script>alert('修改成功');parent.location.href='../website/library.php'</script>";
?>