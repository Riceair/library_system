<?php
    session_start();
    include("connectDB.php");
    include("util.php");
    $account = $_POST["account"];
    $pwd = $_POST["pwd"];

    //帳號或密碼輸入為空
    if($account==="" || $pwd===""){
        AlertBackLogin("請輸入帳號與密碼");
        //會回到Login，以下程式碼不執行
    }

    //取得資料庫內帳密資訊
    $sql_query = "SELECT user_account, user_pwd, user_name FROM user WHERE user_account='$account'";
    $user_inf = DBQuery($sql_query);

    //查無帳號
    if($user_inf[0]===NULL){
        AlertBackLogin("無此帳號");
        //會回到Login，以下程式碼不執行
    }
    
    //密碼錯誤
    if($pwd!==$user_inf[1]){
        AlertBackLogin("密碼錯誤");
        //會回到Login，以下程式碼不執行
    }
    
    //session記錄登入帳號，並導向圖書館系統
    $_SESSION["account"] = $account;
    $_SESSION["name"] = $user_inf[2];
    header("Location: ../website/library.php"); 
?>