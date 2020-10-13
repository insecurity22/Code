<?php
    include "./lib/dbconn.php";

    $num = $_GET['num'];
    $sql = "select * from board where num=$num";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);

    $content = str_replace("\n", "\n", $row['content']);
    $content = str_replace(" ", "&nbsp;", $content);
    $title = str_replace(" ", "&nbsp;", $row['title']);

    include "./session_check.php";
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
        <h1>게시판</h1>

        <form action="modify_ok.php?num=<?php echo $num?>" method="post" id="modifyForm">
            <table class="update_table">
                <thead>
                    <tr>
                        <td colspan="2"><b>글 수정하기</b></td>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <th>작성자</th>
                        <td><input type="text" name="name" value="<?php echo $_SESSION['user_id'] ?>" size=20 readonly></td>
                    </tr>
                    <tr>
                        <th>제목</th>
                        <td><input type="text" name="title" size=60 value="<?php echo $title ?>"></td>
                    </tr>
                    <tr>
                        <th>내용</th>
                        <td><textarea name="content" cols="85" rows="15"><?php echo $content ?></textarea></td>
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