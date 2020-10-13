<?php
    $id = $_GET['id'];
    if(!$id) {
        echo("
            <script>
                alert('아이디를 입력해주세요.')
            </script>
        ");
    } else {
        
        include "./lib/dbconn.php";

        $sql = "select * from member where id='$id'";
        $result = mysqli_query($conn, $sql);
        $num_record = mysqli_num_rows($result);
        if($num_record) {
            echo("
                <script>
                    alert('아이디가 중복됩니다. 다른 아이디를 사용해주세요.')
                    history.go(-1)
                </script>
            ");
        } else {
            echo("
                <script>
                    alert('사용 가능한 아이디입니다.')
                </script>
            ");
        }

        mysqli_close();
    }
?>