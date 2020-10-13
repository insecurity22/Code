<?php
    include "./lib/dbconn.php";

    $sql = "select * from freeboard order by num desc";
    $result = mysqli_query($conn, $sql);
    
    $pageTotal = mysqli_num_rows($result); // 게시판 총 글 수
    $pageNum = 5; // 한 페이지에 보여줄 개수
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
    <div class="board_list">
        <h1>자유게시판</h1>
        <p>전체 <?php echo $pageTotal; ?>건</p>

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
            <?php
                // 전체 페이지 수 계산
                if($pageTotal % $pageNum == 0) {
                    $total_page = floor($pageTotal/$pageNum);
                } else {
                    $total_page = floor($pageTotal/$pageNum) + 1;
                }

                // 페이지 번호가 0일 때, 1로 초기화
                $currentPage = $_GET['page'];
                if($currentPage == 0) {
                    $currentPage = 1; 
                } 

                // 표시할 페이지의 $start 계산
                $start = ($currentPage - 1) * $pageNum;

                // 해당하는 페이지 목록 보여줌($start ~ $start+$scale)
                for($i=$start; $i<$start+$pageNum && $i < $pageTotal; $i++) {
                    
                    // 위치 이동
                    mysqli_data_seek($result, $i);
                    $row = mysqli_fetch_array($result);
                    echo "<tr>
                            <td>$row[num]</td>
                            <td><a href='view.php?num=$row[num]&page=$currentPage'>$row[subject]</a></td>
                            <td>$row[name]</td>
                            <td>$row[regist_day]</td>
                            <td>$row[hit]</td>
                        </tr>";
                }
            ?>
            </tbody>
        </table>

        <div class="center">
            <?php
                // 게시판 목록 하단에 페이지 링크 번호 출력
                for($i=1; $i<=$total_page; $i++) {
                    if($currentPage == $i) { // 현재 페이지
                        echo "<font color='black'><b> [$i]</b></font>";
                    } else { // 다른 페이지 버튼 눌렀을 때
                        echo "<a href='list.php?page=$i' style='text-decoration: none;'>
                            <font color='gray'><b>[$i]</b></font></a>";
                    }
                }
            ?>
        </div>

        <div>
            <!-- 검색하기 -->
            <div id="list_search">
                <div id="left">
                    <form action="search.php" method="get">
                        <select name="find" class="txt">
                            <option value="subject">제목</option>
                            <option value="content">본문</option>
                            <option value="name">작성자</option>
                        </select>

                        <input type="text" name="search" size=10>
                        <input type="submit" value="검색">
                    </form>
                </div>

                <div id="right">
                    <a href="write.php"><button>글쓰기<button></a>
                    <a href="list.php?page=1"><button>목록보기<button></a>
                </div>
            </div>
        </div>
    <div>
</body>
</html>
