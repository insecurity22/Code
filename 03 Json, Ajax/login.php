<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/login.css" type="text/css">
    <script src="js/jquery-3.5.1.min.js"></script>
    <script>

        $(document).ready(function(){ 

            $('.loginBtn').click(function(e) {
            
                e.preventDefault();

                if(!document.loginForm.id.value) {
                    alert("아이디를 입력해주세요.");
                    document.loginForm.id.focus();
                    return;
                }
                    
                if(!document.loginForm.passwd.value) {
                    alert("비밀번호를 입력해주세요.");
                    document.loginForm.passwd.focus();
                    return;
                }

                var datasloginBtn = jQuery("#loginForm").serialize();
                datasloginBtn += "&requestValue=login";

                $.ajax({
                    url: './json/return_memberjson.php',
                    method: 'POST',
                    data: datasloginBtn,
                    success: function(data) {
                        // console.log(data);
                        switch(data[6].returnValue) {
                            case 1:
                                alert("등록되지 않은 아이디입니다.");
                                break;
                            case 2:
                                alert("비밀번호가 틀립니다.");
                                break;
                            case 3:
                                alert("이미 로그인되셨습니다.");
                                history.go(-1)
                                break;
                            case 4:
                                alert(data[0].id + "님 안녕하세요.");
                                location.replace("<?php echo 'list.php?page=1' ?>");
                                break;
                        }
                    },
                    error: function(request, status, error) {
                        alert("FAIL");
                    }
                });

            });
        });

    </script>
</head>
<body>
    <div id="login_box">
        <h2>로그인</h2>
        <form method="post" id="loginForm" name="loginForm">
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
                    <td colspan="2"><input type="submit" class="loginBtn" value="로그인"></td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>