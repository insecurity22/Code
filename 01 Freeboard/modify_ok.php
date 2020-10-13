<?php

    include './lib/dbconn.php';

    $num = $_GET['num'];
    $name = $_POST['name'];
    $passwd = $_POST['passwd'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    
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
    
    $sql = "update freeboard set name='$name', passwd='$passwd', subject='$title', content='$content' where num='$num'";
    mysqli_query($conn, $sql);
?>

<script>
    alert("수정되었습니다.");
    location.replace("<?php echo "view.php?num=".$num ?>");
</script>
