<?php
    $id = $_POST['id'];
    $passwd = $_POST['passwd'];
    $name = $_POST['name'];
    $nickname = $_POST['nickname'];
    $sex = $_POST['gender'];
    $email = $_POST['email'];

    include "./lib/dbconn.php";
    
    $sql = "select * from member where id='$id'";
    $result = mysqli_query($conn, $sql);
    $exist_id = mysqli_num_rows($result);
    if($exist_id) {
        echo("
            <script>
                window.alert('해당 아이디가 존재합니다.')
                history.go(-1)
            </script>
        ");
        exit;
    }

    $date = date("Y-m-d (H:i)"); // 현재의 년-월-일-시-분을 저장
    $ip = $_SERVER['REMOTE_ADDR']; // 방문자의 IP 주소를 저장

    $sql = "insert into member(id, passwd, name, nickname, sex, email) 
                values('$id', '$passwd', '$name', '$nickname', '$sex', '$email')";

    $result = mysqli_query($conn, $sql);
    if($result) {
        echo("
            <script>
                window.alert('회원가입이 완료되었습니다.')
                location.replace('login.php');
            </script>
        ");
    } else {
        echo("
            <script>
                window.alert('회원가입이 완료되지 않았습니다. 다시 회원가입을 해주세요.')
            </script>
        ");
    }

    mysqli_close($conn);
?>

<script>
</script>