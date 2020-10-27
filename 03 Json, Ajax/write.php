<?php
    include "./session_logincheck.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css" type="text/css">
    <script src="js/jquery-3.5.1.min.js"></script>
    <script>
    
        $(document).ready(function(){ 

            $('.insertBtn').click(function(e) { // 작성
            
                e.preventDefault();

                if(!document.insertForm.name.value) {
                    alert("이름을 입력해주세요.");
                    document.insertForm.name.focus();
                    return;
                }
                    
                if(!document.insertForm.title.value) {
                    alert("제목을 입력해주세요.");
                    document.insertForm.title.focus();
                    return;
                }
                
                if(!document.insertForm.content.value) {
                    alert("내용을 입력해주세요.");
                    document.insertForm.content.focus();
                    return;
                }

                var datasInsertBtn = jQuery("#insertForm").serialize();
                datasInsertBtn += "&requestValue=insert";

                $.ajax({
                    url: './json/return_boardjsonPOST.php',
                    method: 'POST',
                    data: datasInsertBtn,
                    success: function(data) {
                        alert("글이 등록되었습니다.");
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
    <div class="board_write">
        <h1>게시판</h1>
        <p>글쓰기</p>

        <form method="post" id="insertForm" name="insertForm">
            <table>
                <tr>
                    <td>작성자</td>
                    <td><input type="text" name="name" value="<?php echo $_SESSION['user_id'] ?>" size=20 readonly></td>
                </tr>
                <tr>
                    <td>제목</td>
                    <td><input type="text" name="title" size=60></td>
                </tr>
                <tr>
                    <td>내용</td>
                    <td><textarea name="content" cols="85" rows="15"></textarea></td>
                </tr>
            </table>
        </form>
        
        <div class="center">
            <button class="insertBtn" form="insertForm">작성하기</button>
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