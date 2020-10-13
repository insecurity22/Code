<?php
    session_start();
    if(!isset($_SESSION['user_id'])) {
        echo("
            alert('로그인 해주세요.')
            history.go(-1)
        ");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css" type="text/css">
</head>
<body>
    <div class="board_write">
        <h1>게시판</h1>
        <p>글쓰기</p>

        <form action="insert.php" method="post" id="insertForm">
            <table>
                <tr>
                    <td>작성자</td>
                    <td><input type="text" name="name" value="<?php echo $_SESSION['user_id'] ?>" size=20 readonly></td>
                </tr>
                <tr>
                    <td>제목</td>
                    <td><input type="text" name="title" size=60></td>
                </tr>
                <tr>
                    <td>내용</td>
                    <td><textarea name="content" cols="85" rows="15"></textarea></td>
                </tr>
            </table>
        </form>
        
        <div class="center">
            <button type="submit" form="insertForm">작성하기</button>
            <a href="list.php?page=1"><button>목록보기</button></a>
        </div>
    </div>

    <!-- <xmp>
    <?php
        //print_r($_SERVER);
    ?>
    </xmp> -->
</body>
</html>