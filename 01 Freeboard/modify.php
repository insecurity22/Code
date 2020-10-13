<?php
    include "./lib/dbconn.php";

    $num = $_GET['num'];
    $sql = "select * from freeboard where num=$num";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);

    $passwd = $_POST['passwd'];
    if($passwd != $row['passwd']) {
        echo "
            <script>
                alert('비밀번호가 틀립니다.')
                history.go(-1)
            </script>
        ";
        exit;
    }

    $content = str_replace("\n", "<br>", $row['content']);
    $content = str_replace(" ", "&nbsp;", $content);
    $subject = str_replace(" ", "&nbsp;", $row['subject']);
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
    <div class="board_update">
        <h1>자유게시판</h1>

        <form action="modify_ok.php?num=<?php echo $num?>" method="post" id="modifyForm">
            <table class="update_table">
                <thead>
                    <tr>
                        <td colspan="2"><b>글 수정하기</b></td>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <th>이름</th>
                        <td><input type="text" name="name" size=20 value="<?php echo $row['name'] ?>"></td>
                    </tr>
                    <tr>
                        <th>제목</th>
                        <td><input type="text" name="title" size=60 value="<?php echo $subject ?>"></td>
                    </tr>
                    <tr>
                        <th>내용</th>
                        <td><textarea name="content" cols="85" rows="15"><?php echo $content ?></textarea></td>
                    </tr>
                    <tr>
                        <th>비밀번호</th>
                        <td><input type="password" name="passwd" size=15 value="<?php echo $row['passwd'] ?>"></td>
                    </tr>
                </tbody>
            </table>
        </form>
        
        <div class="center">
                <button form="modifyForm">수정</button>
                <a href='delete.php?num=<?php echo $num?>'><button>삭제</button></a>
                <a href='list.php?page=1'><button>목록</button></a>
        </div>
    <div>
</body>
</html>