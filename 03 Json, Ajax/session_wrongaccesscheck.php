<?php
    
    $name = $_GET['name'];
    if(isset($_SESSION['user_id']) && $_SESSION['user_id'] != $name) {
        echo("
            <script>
                alert('잘못된 접근입니다.')
                history.go(-1)
            </script>
        ");
        exit;
    }
    
?>