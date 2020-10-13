<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/login.css" type="text/css">
</head>
<body>
    <div id="login_box">
        <h2>로그인</h2>
        <form method="post" action="login_ok.php">
            <table>
                <tr>
                    <td>아이디</td>
                    <td><input type="text" name="id" style="width: 200px;"></td>
                </tr>
                <tr>
                    <td>비밀번호</td>
                    <td><input type="password" name="passwd" style="width: 200px;"></td>
                </tr>
                <tr>
                    <td colspan="2">아직 회원이 아니시라면 <a href="join.php">회원가입</a></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" value="로그인"></td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>