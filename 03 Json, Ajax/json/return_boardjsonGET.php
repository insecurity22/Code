<?php

    include '../lib/dbconn.php';

    mysqli_set_charset($conn, "utf8");

    // ---------------- list.php
    if($_GET['requestValue'] === "list") {
        header('Content-Type: application/json');
        $currentPage = $_GET['page'];
        $sql = "select * from board order by num desc";
    }
    
    // ---------------- search.php
    if($_GET['requestValue'] === 'search') {

        header('Content-Type: application/json');
        $find = $_GET['find'];
        $search = $_GET['search'];

        $sql = "select * from board where $find like '%$search%' order by num desc";
        
    }

    // ---------------- view.php
    if($_GET['requestValue'] === 'view') {

        header('Content-Type: application/json');
        $num = $_GET['num'];
        $page = $_GET['page'];
        $sql = "select * from board where num=$num";

        // 조회수 증가
        if(!empty($num) && empty($_COOKIE['board'.$num])) { 
            $result = mysqli_query($conn, "update board set hit=hit+1 where num=$num");
            if(empty($result)) {
                echo("
                    <script>
                        window.alert('오류가 발생했습니다.')
                        history.go(-1)
                    </script>
                ");
            } else {
                setcookie('board'.$num, TRUE, time() + (60*60*24), '/');
            }
        }
        
    }
    
    // ---------------- delete.php
    if($_GET['requestValue'] === 'delete') {

        $num = $_GET['num'];

        $sql = "delete from board where num='$num';";
        mysqli_query($conn, $sql);
        return;
    }

    $result = mysqli_query($conn, $sql);

    // 페이징
    $board_result = array();
    $paging_result = array();
        
    $pageTotal = mysqli_num_rows($result); // 게시판 총 글 수
    $pageNum = 5; // 한 페이지에 보여줄 개수
    $count = 0; // 한 페이지에 실제로 보여줄 데이터 개수
        
    if(!isset($currentPage) || $currentPage == 0) { // 페이지 번호가 0일 때, 1로 초기화
        $currentPage = 1;
    }

    // 전체 페이지 수 계산
    if($pageTotal % $pageNum == 0) {
        $total_page = floor($pageTotal/$pageNum);
    } else {
        $total_page = floor($pageTotal/$pageNum) + 1;
    }

    // 표시할 페이지의 $start 계산
    $start = ($currentPage - 1) * $pageNum;

    // 해당하는 페이지 목록 저장
    for($i=$start; $i<$start+$pageNum && $i<$pageTotal; $i++) {

        // 위치 이동
        mysqli_data_seek($result, $i);
        $row = mysqli_fetch_array($result);
        array_push($board_result, array('num'=>$row['num'], 'name'=>$row['name'], 
                                        'title'=>$row['title'], 'content'=>$row['content'], 
                                        'date'=>$row['date'], 'hit'=>$row['hit'], 'ip'=>$row['ip']));
        $count++;

    }
    array_push($paging_result, array('pageTotal'=>$pageTotal, 'pageNum'=>$pageNum, 'total_page'=>$total_page, 'currentPage'=>$currentPage, 'count'=>$count));

    // 배열 형식의 결과를 json으로 변환
    echo json_encode(array("content"=>$board_result, "paging"=>$paging_result), JSON_PRETTY_PRINT); // JSON_UNESCAPED_UNICODE

    // DB 접속 종료
    mysqli_close($conn);
    
?>