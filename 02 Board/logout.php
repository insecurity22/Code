<?php
    session_start();
    if($_SESSION['user_id'] != null && $_SESSION['user_name']) {
        session_destroy();
        echo("
            <script>
                window.alert('로그아웃 되었습니다.');
            </script>
        ");
    }

    echo "<script>location.href='login.php';</script>";
?>