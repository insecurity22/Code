<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/login.css" type="text/css">
    <script src="js/jquery-3.5.1.min.js"></script>
    <script>

        function validateEmail(email) {
            const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(String(email).toLowerCase());
        }

        function check_id() {
            window.open("check_id.php?id="+document.joinForm.id.value, "IDcheck",
                            "left=200, top=200, width=350, height=100, scrollbars=no, resizable=yes");
        }
            
        $(document).ready(function(){ 

            $('.joinBtn').click(function(e) { // 작성

                e.preventDefault();

                if(!document.joinForm.id.value) {
                    alert("아이디를 입력해주세요.");
                    document.joinForm.id.focus();
                    return;
                }

                if(!document.joinForm.name.value) {
                    alert("이름을 입력해주세요.");
                    document.joinForm.name.focus();
                    return;
                }

                if(!document.joinForm.passwd.value) {
                    alert("비밀번호를 입력해주세요.");
                    document.joinForm.passwd.focus();
                    return;
                }

                if(!document.joinForm.passwd_confirm.value) {
                    alert("비밀번호 확인을 입력해주세요.");
                    document.joinForm.passwd_confirm.focus();
                    return;
                }

                if(document.joinForm.passwd.value != document.joinForm.passwd_confirm.value) {
                    alert("비밀번호가 일치하지 않습니다.\n다시 입력해주세요.");
                    document.joinForm.passwd.focus();
                    document.joinForm.passwd.select();
                    return;
                }
                
                if(!document.joinForm.nickname.value) {
                    alert("닉네임을 입력해주세요.");
                    document.joinForm.nickname.focus();
                    return;
                }
                
                if(!document.joinForm.email.value) {
                    alert("이메일을 입력해주세요.");
                    document.joinForm.email.focus();
                    return;
                }

                if (!validateEmail(document.joinForm.email.value)) {
                    alert("이메일 형식에 맞지 않습니다.");
                    document.joinForm.email.focus();
                    return;
                }
                
                var datasjoinBtn = jQuery("#joinForm").serialize();
                    datasjoinBtn += "&requestValue=join";
                    
                $.ajax({
                    url: './json/return_memberjson.php',
                    method: 'POST',
                    data: datasjoinBtn,
                    success: function(data) {
                            // console.log(data);
                            switch(data[1].returnValue) {
                                case 1:
                                    alert("해당 아이디가 존재합니다.");
                                    break;
                                case 2:
                                    alert("회원가입이 완료되었습니다.");
                                    break;
                                case 3:
                                    alert("회원가입이 완료되지 않았습니다.");
                                    history.go(-1)
                                    break;
                                case 4:
                                    alert(data[0].id + "님 안녕하세요.");
                                    history.go(-1)
                                    break;
                            }
                            location.replace("<?php echo 'login.php' ?>");
                    },
                    error: function(request, status, error) {
                        console.log('code: ' + request.status + '\n' + 'message:' + request.responseText + '\n');
                        console.log('error:' + error);
                    }
                });
            });
        });

        function reset_form() {
            document.joinForm.id.value = "";
            document.joinForm.name.value = "";
            document.joinForm.passwd.value = "";
            document.joinForm.passwd_confirm.value = "";
            document.joinForm.nickname.value = "";
            document.joinForm.tel.value = "";
            document.joinForm.email.value = "";

            document.joinForm.id.focus();

            return;
        }

</script>
</head>
<body>
    <div id="join_box">
        <h2>회원가입</h2>
        <form method="post" id="joinForm" name="joinForm">
            <table>
                <tr>
                    <td>아이디</td>
                    <td><input type="text" name="id" style="width: 200px;"></td>
                    <td><input type="button" value="중복 확인" onclick="check_id()"></td>
                </tr>
                <tr>
                    <td>이름</td>
                    <td><input type="text" name="name" style="width: 200px;"></td>
                </tr>
                <tr>
                    <td>비밀번호</td>
                    <td><input type="password" name="passwd" style="width: 200px;"></td>
                </tr>
                <tr>
                    <td>비밀번호 확인</td>
                    <td><input type="password" name="passwd_confirm" style="width: 200px;"></td>
                </tr>
                <tr>
                    <td>닉네임</td>
                    <td><input type="text" name="nickname" style="width: 200px;"></td>
                </tr>
                <tr>
                    <td>이메일</td>
                    <td><input type="email" name="email" pattern="/^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/" style="width: 200px;"></td>
                </tr>
                <tr>
                    <td>성별</td>
                    <td colspan="2">
                        남<input type="radio" value="M" name="gender" checked>
                        여<input type="radio" value="W" name="gender">
                    </td>
                </tr>
            </table>
        </form>
        
        <div class="center">
            <button class="joinBtn">가입하기</button>
            <button onclick="reset_form()">다시쓰기</button>
        </div>
    </div>
</body>
</html>