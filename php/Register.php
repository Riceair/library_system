<?php

    include("../php/connectDB.php");
    $user_name = $_POST["user_name"];
    $user_account = $_POST["user_account"];
    $user_pwd = $_POST["user_pwd"];
    $user_email = $_POST["user_email"];
    $user_phone = $_POST["user_phone"];

    $isAccountExist = DBQuery("SELECT user_account FROM user WHERE user_account='$user_account'");
    if($isAccountExist!==NULL){
        echo "<script>alert('帳號已有人使用');parent.location.href='../website/register.html'</script>";
    }
    else{
        DBQuery("INSERT
                 INTO user
                 VALUES ('$user_name', '$user_account', '$user_pwd', '$user_email', '$user_phone')");
        echo "<script>alert('註冊完成');parent.location.href='../website/login.html'</script>";
    }
?>