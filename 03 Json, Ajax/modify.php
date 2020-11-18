<?php

    include "./session_logincheck.php";
    include "./session_wrongaccesscheck.php";

    $num = $_GET['num'];
    $name = $_GET['name'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css" type="text/css">
    <script>
        
        var datasModify = { requestValue: "modify", "num": <?php echo "\"".$num."\"" ?> }; // 리스트 내용 가져오기
        $.ajax({
            url: './json/return_boardjsonPOST.php',
            //contentType: 'application/json; charset=utf-8', <-- post 데이터 안넘어가는 이유
            //dataType: 'text',
            method: 'POST',
            data: datasModify,
        })
        .done(function(data) {
            // 1. 제목 출력
            $('.update_table tbody tr:nth-child(2) td').append("<input type='text' name='title' size=60 value='" + data.content[0].title + "' />");

            // 2. 내용 출력
            $('.update_table tbody tr:nth-child(3) td').append("<textarea name='content' cols='85' rows='15'>" + data.content[0].content + "</textarea>");
        });

        $(document).ready(function(){ 
            
            $('.modifyBtn').click(function(e) { // 수정

                e.preventDefault();

                var datasModifyBtn = jQuery("#modifyForm").serialize();
                datasModifyBtn += "&requestValue=update&num=<?php echo $num ?>";
                $.ajax({
                    url: './json/return_boardjsonPOST.php',
                    method: 'POST',
                    data: datasModifyBtn,
                    success: function(data) {
                        alert("수정되었습니다.");
                        location.replace("<?php echo 'view.php?num='.$num.'&page=1&name='.$name ?>");
                    },
                    error: function(request, status, error) {
                        alert("FAIL.");
                        location.replace("<?php echo 'view.php?num='.$num.'&page=1&name='.$name ?>");
                    }
                });

            });
            
            $('.deleteBtn').click(function(e) { // 삭제

                e.preventDefault();

                var datasDeleteBtn = { requestValue: "delete", "num": <?php echo "\"".$num."\"" ?> };
                $.ajax({
                    url: './json/return_boardjsonGET.php',
                    method: 'GET',
                    data: datasDeleteBtn,
                    success: function(data) {
                        alert("삭제되었습니다.");
                        location.replace("<?php echo 'list.php?page=1' ?>");
                    },
                    error: function(request, status, error) {
                        alert("FAIL");
                        location.replace("<?php echo 'list.php?page=1' ?>");
                    }
                });

            });
        });

    </script>
</head>
<body>
    <div class="board_update">
        <h1>게시판</h1>

        <form method="post" id="modifyForm">
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
                        <td></td>
                    </tr>
                    <tr>
                        <th>내용</th>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </form>
        
        <div class="center">
            <button class="modifyBtn" form="modifyForm">수정</button>
            <button class="deleteBtn">삭제</button>
            <a href='list.php?page=1'><button>목록</button></a>
        </div>
    <div>
    <script src="js/jquery-3.5.1.min.js"></script>
</body>
</html>