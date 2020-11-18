<?php
    $num = $_GET['num'];
    $page = $_GET['page'];
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

        $.ajax({
            type: 'GET',
            url: './json/return_boardjsonGET.php',
            data: {
                requestValue: 'view',
                num:  <?php echo "\"".$num."\"" ?>,
                page: <?php echo "\"".$page."\"" ?>
            },
            contentType: 'application/json; charset=utf-8',
            dataType: 'json',
        })
        .done(function(data) {

            // 1. 제목 출력
            $('.view_table thead tr td').append(data.content[0].title);

            // 2. 이름 출력
            $('#view_color td:nth-child(2)').append(data.content[0].name);

            // 3. 조회수 출력
            $('#view_color td:nth-child(4)').append(data.content[0].hit);

            // 4. 내용 출력
            $('#view_content td').append(data.content[0].content);

            // 5. 글 수정
            <?php
                session_start();
                if(isset($_SESSION['user_id']) && ($_SESSION['user_id'] == $name)) {
            ?>
                $('#view_link td').append("<a href='list.php?page=1'><button>목록으로</button></a>\
                                            <a href='modify.php?num=<?php echo $num ?>&name=<?php echo $name ?>'><button>수정</button></a>");
            <?php
                } else {
            ?>
                $('#view_link td').append("<a href='list.php?page=1'><button>목록으로</button></a>");
            <?php
                }
            ?>

        });
    </script>
</head>
<body>
    <div class="board_view">
        <h1>게시판</h1>

        <table class="view_table">
            <thead>
                <tr>
                    <td colspan="4">
                        <!-- 1. 제목 출력 -->
                    </td>
                </tr>
            </thead>

            <tbody>
                <tr id="view_color">
                    <td>작성자</td>
                    <td>
                        <!-- 2. 이름 출력 -->
                    </td>

                    <td>조회수</td>
                    <td>
                        <!-- 3. 조회수 출력 -->
                    </td>
                </tr>

                <tr id="view_content">
                    <td colspan="4">
                        <!-- 4. 내용 출력 -->
                    </td>
                </tr>

                <tr id="view_link">
                    <td colspan='4'>
                        <!-- 5. 글 수정 -->
                    </td>
                </tr>
            </tbody>
        </table>
    <div>
    <script src="js/jquery-3.5.1.min.js"></script>
</body>
</html>