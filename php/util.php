<?php
    //顯示通知並回到登入介面
    function AlertBackLogin($alert_str){
        echo "<script>alert('$alert_str')</script>";
        echo "<script>window.location.href = '../website/login.html'</script>";
        exit;
    }
?>