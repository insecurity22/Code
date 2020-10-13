<?php
    $id = $_POST['id'];
    $passwd = $_POST['passwd'];
    if(!$id) {
        echo("
            <script>
                window.alert('아이디를 입력해주세요.')
                history.go(-1)
            </script>
        ");
        exit;
    }

    if(!$passwd) {
        echo("
            <script>
                window.alert('비밀번호를 입력해주세요.')
                history.go(-1)
            </script>
        ");
        exit;
    }

    include "./lib/dbconn.php";

    $sql = "select * from member where id='$id'";
    $result = mysqli_query($conn, $sql);
    $num_match = mysqli_num_rows($result);
    if(!$num_match) {
        echo("
            <script>
                window.alert('등록되지 않은 아이디입니다.')
                history.go(-1)
            </script>
        ");
    } else {
        $row = mysqli_fetch_array($result);

        $db_passwd = $row['passwd'];
        if($passwd != $db_passwd) {
            echo("
                <script>
                    window.alert('비밀번호가 틀립니다.')
                    history.go(-1)
                </script>
            ");
        } else {
            // 세션이 존재할 때
            session_start();
            if(isset($_SESSION['user_id'])) {
                echo("
                    <script>
                        window.alert('이미 로그인되셨습니다.')
                        location.replace('list.php?page=1');
                    </script>
                ");
            } else { 
                // 세션이 존재하지 않을 때
                $_SESSION['user_id'] = $id;
                $_SESSION['user_name'] = $row['name'];
                
                echo("
                    <script>
                        window.alert('$id 님 안녕하세요.')
                        location.replace('list.php?page=1');
                    </script>
                ");
            }
        }
    }
?>