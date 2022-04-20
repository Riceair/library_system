<?php
    $account = $_GET["account"];
    $pwd = $_GET["pwd"];

    $db_link = @mysqli_connect("localhost", "root", "54600611", "library_system") or die("MySQL伺服器連結失敗!<br>");  
    //如果連結失敗，則終止程式執行，並顯示連結失敗的訊息
    if(!$db_link)
    {
        die("無法開啟資料庫!<br>");
    } else  {
        //echo "phpbook_db資料庫開啟成功!<br/>";
        //讀取format_report資料
        $sql_query="SELECT user_account FROM user WHERE user_account=$account";
        $result = mysqli_query($db_link, $sql_query);
        if ($result){ //如果有資料
            $user_inf = mysqli_fetch_row($result);
        }

    }
    mysqli_close($db_link);

    echo $user_inf;
?>