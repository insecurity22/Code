<?php
    include "./lib/dbconn.php";

    $num = $_GET['num'];
    $page = $_GET['page'];
    if(!empty($num) && empty($_COOKIE['freeboard'.$num])) {
        $result = mysqli_query($conn, "update freeboard set hit=hit+1 where num=$num");
        if(empty($result)) {
            ?>
            <script>
                alert('오류가 발생했습니다.');
            </script>
            <?php
        } else {
            setcookie('freeboard'.$num, TRUE, time() + (60*60*24), '/');
        }
    }
    
    $sql = "select * from freeboard where num=$num";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);

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
    <div class="board_view">
        <h1>자유게시판</h1>

        <table class="view_table">
            <thead>
                <tr>
                    <td colspan="4"><?php echo $subject ?></td>
                </tr>
            </thead>

            <tbody>
                <tr id="view_color">
                    <td>작성자</td>
                    <td><?php echo $row['name'] ?></td>

                    <td>조회수</td>
                    <td><?php echo $row['hit'] ?></td>
                </tr>

                <tr id="view_content">
                    <td colspan="4"><?php echo $row['content'] ?></td>
                </tr>

                <?php
                    echo "<tr id='view_link'>
                            <td colspan='4'>
                                <a href='list.php?page=$page'><button>목록으로</button></a>
                                <a href='passwd_form.php?num=$num'><button>수정</button></a>
                            </td>
                          </tr>";
                ?>
            </tbody>
        </table>
    <div>
</body>
</html>