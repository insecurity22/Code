<?php
    include "./lib/dbconn.php";

    $num = $_GET['num'];
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
    <div class="board_passwd_form">
        <script>
            function checkUserPassword() {
                if(document.pwform.passwd.value == "") {
                    alert("비밀번호를 입력해주세요.");
                    return false;
                }
                document.pwform.submit();
            }

            function clean() {
                document.pwform.passwd.value = "";
            }
        </script>

        <form action="modify.php?num=<?php echo $num?>" method="post" id="modifyForm" name="pwform">
            <table class="passwd_form_table">
                <tbody>
                    <tr>
                        <th colspan="2">비밀번호를 입력하세요.</th>
                    </tr>
                    <tr>
                        <td>비밀번호</td>
                        <td><input type="password" name="passwd"></td>
                    </tr>
                </tbody>
            </table>
        </form>
        
        <div class="center">
                <button onclick="checkUserPassword()">확인</button>
                <button onclick="clean()">다시쓰기</button>
                <button onclick="javascript:history.back()">닫기</button>
        </div>
    <div>
</body>
</html>