<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css" type="text/css">
</head>
<body>
    <div id="board_write">
        <h1>자유게시판</h1>
        <p>글쓰기</p>

        <form action="insert.php" method="post" id="insertForm">
            <table>
                <tr>
                    <td>이름</td>
                    <td><input type="text" name="name" size=20></td>
                </tr>
                <tr>
                    <td>제목</td>
                    <td><input type="text" name="title" size=60></td>
                </tr>
                <tr>
                    <td>내용</td>
                    <td><textarea name="content" cols="85" rows="15"></textarea></td>
                </tr>
                <tr>
                    <td>비밀번호</td>
                    <td><input type="password" name="passwd" size=15></td>
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