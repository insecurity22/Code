<?php

    include '../lib/dbconn.php';
    mysqli_set_charset($conn, "utf8");

    //print_r($_POST);
    //return;

    $resultArray = array();

    // IF $_POST 외에,
    // https://qastack.kr/programming/18866571/receive-json-post-with-php
    //
    // $data = json_decode(file_get_contents('php://input'), true);
    // print_r($data);
    // echo $data["requestValue"];

    if($_POST["requestValue"] === "modify") { 

        header('Content-Type: application/json');

        $num = $_POST["num"];
        $sql = "select * from board where num=$num";

        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        
        $content = str_replace("\n", "\n", $row['content']);
        $content = str_replace(" ", "&nbsp;", $content);
        $title = str_replace(" ", "&nbsp;", $row['title']);

        array_push($resultArray, array('num'=>$num, 'title'=>$title, 'content'=>$content));
        echo json_encode(array("content"=>$resultArray), JSON_PRETTY_PRINT); // 배열 형식의 결과를 json으로 변환
        
    }

    if($_POST["requestValue"] === "update") {

        $num = $_POST['num'];
        $name = $_POST['name'];
        $title = $_POST['title'];
        $content = $_POST['content'];

        $sql = "update board set name='$name', title='$title', content='$content' where num='$num'";
        mysqli_query($conn, $sql);
        return;

    }
    
    if($_POST["requestValue"] === "insert") {

        $name = $_POST['name'];
        $title = $_POST['title'];
        $content = $_POST['content'];
        
        $date = date('Y-m-d', time());
        $ip = $_SERVER['REMOTE_ADDR'];

        $sql = "insert into board(num, name, title, content, date, hit, ip) values(null, '$name', '$title', '$content', '$date', 0, '$ip')";
        mysqli_query($conn, $sql);
        return;

    }

    // DB 접속 종료
    mysqli_close($conn);
    
?>