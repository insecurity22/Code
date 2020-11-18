<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css" type="text/css">
    <script>
        
        var nowPage = 1;
        function search(page) {

            if(page === undefined) page = nowPage;

            $.ajax({
                type: 'GET',
                url: './json/return_boardjsonGET.php',
                data: {
                    requestValue: 'search',
                    find: <?php echo "\"".$_GET['find']."\"" ?>,
                    search: <?php echo "\"".$_GET['search']."\"" ?>,
                    page: page
                },
                contentType: 'application/json; charset=utf-8',
                dataType: 'json'
            })
            .done(function(data) {
    
                // 1. 전체 건수 출력
                $('.board_list > p').empty();
                $('.board_list > p').append("전체 " + data.paging[0].pageTotal + "건");

                // 2. 해당하는 페이지 목록 보여줌
                $('.list_table > tbody').empty();
                for($i=0; $i<data.paging[0].count; $i++) {
                    $appenddata = "<tr><td>" + data.content[$i].num + "</td>"
                                    + "<td><a href='view.php?num=" + data.content[$i].num + "&page=" + data.paging[0].currentPage + "'>" + data.content[$i].title + "</a></td>"
                                    + "<td>" + data.content[$i].name + "</td>"
                                    + "<td>" + data.content[$i].date + "</td>"
                                    + "<td>" + data.content[$i].hit + "</td></tr>"
                    $(".list_table > tbody").append($appenddata);
                }

                // 3. 게시판 목록 하단에 페이지 링크 번호 출력
                $('.center').empty();
                for($i=1; $i<=data.paging[0].total_page; $i++) {
                    if(data.paging[0].currentPage == $i) { // 현재 페이지
                        $('.center').append("<font color='black'><b>[" + $i + "]</b></font>");
                    } else { // 다른 페이지 버튼 눌렀을 때
                        $('.center').append("<a href='javascript:search(" + $i + ")' style='text-decoration: none;'><font color='gray'><b>[" + $i + "]</b></font></a>");
              }
                }
                
            });
        }
        
        search();

    </script>
</head>
<body>
    <header>
        <div class="logo">
            <?php
                session_start();
                if(isset($_SESSION['user_id'])) {
                    echo("
                        <div class='loginout_btn'>
                            <a href='logout.php'>LOGOUT</a>
                        </div>
                    ");
                } else { 
                    echo("
                        <div class='loginout_btn'>
                            <a href='login.php'>LOGIN</a>
                        </div>
                    ");
                }
            ?>
        </div>
    </header>
    
    <div class="board_list">
        <h1>게시판</h1>
        <p>
            <!-- 1. 전체 페이지 수 계산 -->
        </p>

        <table class="list_table">
            <thead>
                <tr>
                    <th>번호</th>
                    <th>제목</th>
                    <th>작성자</th>
                    <th>작성일</th>
                    <th>조회수</th>
                </tr>
            </thead>

            <tbody>
                <!-- 2. 해당하는 페이지 목록 보여줌 -->
            </tbody>
        </table>

        <div class="center">
            <!-- 3. 게시판 목록 하단에 페이지 링크 번호 출력 -->
        </div>

        <div>
            <!-- 검색하기 -->
            <div id="list_search">
                <div id="left">
                    <form action="search.php" method="get">
                        <select name="find" class="txt">
                            <option value="title">제목</option>
                            <option value="content">본문</option>
                            <option value="name">작성자</option>
                        </select>

                        <input type="text" name="search" size=10>
                        <input type="submit" value="검색">
                    </form>
                </div>

                <?php
                    if(isset($_SESSION['user_id'])) {
                        echo("
                            <div id='right'>
                                <a href='write.php'><button>글쓰기<button></a>
                                <a href='list.php?page=1'><button>목록보기<button></a>
                            </div>
                        ");
                    } else { 
                        echo("
                            <div id='right'>
                                <a href='list.php?page=1'><button>목록보기<button></a>
                            </div>
                        ");
                    }
                ?>
            </div>
        </div>
    <div>
    <script src="js/jquery-3.5.1.min.js"></script>
</body>
</html>
