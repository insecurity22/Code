<?php

    $name = $_POST['name'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $passwd = $_POST['passwd'];

    if(!$name) {
        echo("
            <script>
                window.alert('이름을 입력해주세요.')
                history.go(-1)
            </script>
        ");
        exit;
    }
    
    if(!$title) {
        echo("
            <script>
                window.alert('제목을 입력해주세요.')
                history.go(-1)
            </script>
        ");
        exit;
    }

    if(!$content) {
        echo("
            <script>
                window.alert('내용을 입력해주세요.')
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

    $date = date('Y-m-d', time());
    $ip = $_SERVER['REMOTE_ADDR'];
    $URL = 'list.php?page=1'; // return URL

    $query = "insert into freeboard(num, name, passwd, subject, content, regist_day, hit, ip)
                values(null, '$name', '$passwd', '$title', '$content', '$date', 0, '$ip')";

    $result = mysqli_query($conn, $query);
    if($result) {
?>
        <script>
            alert("<?php echo "글이 등록되었습니다."?>");
            location.replace("<?php echo $URL?>");
        </script>
<?php
    } else {
?>
        <script>
            alert("<?php echo "FAIL"?>");
            history.go(-1)
        </script>
<?php
    }
    mysqli_close($conn);
?>