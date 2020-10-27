<?php

    session_start();
    if(!isset($_SESSION['user_id'])) {
        echo("
            <script>
                alert('로그인 해주세요.')
                history.go(-1)
            </script>
        ");
    }
    
?>