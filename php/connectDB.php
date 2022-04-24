<?php

    //Query資料庫的Function(只Query一個)
    function DBQuery($sql_query){
        $db_link = @mysqli_connect("localhost", "root", "54600611", "library_system") or die("MySQL伺服器連結失敗!<br>");  
        //如果連結失敗，則終止程式執行，並顯示連結失敗的訊息
        if(!$db_link)
        {
            die("無法開啟資料庫!<br>");
        } else  {
            //echo "資料庫開啟成功!<br/>";
            //讀取format_report資料
            $result = mysqli_query($db_link, $sql_query);
            if ($result){ //如果有資料
                $inf = mysqli_fetch_row($result);
            }

        }
        mysqli_close($db_link);

        return $inf;

    }

    //Query資料庫的Function(Query所有)
    function DBQueryAll($sql_query){
        $db_link = @mysqli_connect("localhost", "root", "54600611", "library_system") or die("MySQL伺服器連結失敗!<br>");  
        //如果連結失敗，則終止程式執行，並顯示連結失敗的訊息
        if(!$db_link)
        {
            die("無法開啟資料庫!<br>");
        } else  {
            //echo "資料庫開啟成功!<br/>";
            //讀取format_report資料
            $result = mysqli_query($db_link, $sql_query);
            if ($result){ //如果有資料
                while ($row = mysqli_fetch_row($result)){ //讀取所有資料
                    $all_inf[] = $row; //紀錄所有資料的id
                }
            }

        }
        mysqli_close($db_link);

        return $all_inf;

    }
?>