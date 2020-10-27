<?php

    include '../lib/dbconn.php';

    $resultArray = array();
    header('Content-Type: application/json');
    mysqli_set_charset($conn, "utf8"); // 기본 클라이언트 문자 집합 설정하기

    if($_POST['requestValue'] === "check_id") {

        $id = $_POST['id'];
        $sql = "select * from member where id='$id'";
        $result = mysqli_query($conn, $sql);
        $num_record = mysqli_num_rows($result);
        if($num_record) {
            $returnValue = 1; // 1. 아이디 중복
        } else {
            $returnValue = 2; // 2. 사용 가능한 아이디
        }

        $resultArray[1] = array('returnValue'=>$returnValue);
        echo json_encode($resultArray, JSON_PRETTY_PRINT);
    }

    if($_POST['requestValue'] === "join") {
        
        $id = $_POST['id'];
        $passwd = $_POST['passwd'];
        $name = $_POST['name'];
        $nickname = $_POST['nickname'];
        $sex = $_POST['gender'];
        $email = $_POST['email'];
        $date = date("Y-m-d (H:i)"); // 현재의 년-월-일-시-분을 저장
        $ip = $_SERVER['REMOTE_ADDR']; // 방문자의 IP 주소를 저장

        $sql = "select * from member where id='$id'";
        $result = mysqli_query($conn, $sql);
        $exist_id = mysqli_num_rows($result);
        if($exist_id) {
            $returnValue = 1; // 1. 해당 아이디가 존재
        } else {
            $sql = "insert into member(id, passwd, name, nickname, sex, email)
                        values('$id', '$passwd', '$name', '$nickname', '$sex', '$email')";
            $result = mysqli_query($conn, $sql);
            if($result) {
                $returnValue = 2; // 2. 회원가입 완료
            } else {
                $returnValue = 3; // 3. 회원가입 완료 안됨
            }
        }
        
        $resultArray[1] = array('returnValue'=>$returnValue);
        echo json_encode($resultArray, JSON_PRETTY_PRINT);
    }

    if($_POST['requestValue'] === "login") {
        
        $id = $_POST['id'];
        $passwd = $_POST['passwd'];

        $sql = "select * from member where id='$id'";
        $result = mysqli_query($conn, $sql);
        
        $num_match = mysqli_num_rows($result);
        if(!$num_match) {
            $returnValue = 1; // 1. 등록되지 않은 아이디일 때
        } else {
            $row = mysqli_fetch_array($result);

            $db_passwd = $row['passwd'];
            if($passwd != $db_passwd) {
                $returnValue = 2; // 2. 비밀번호가 틀릴 때
            } else {
                // 세션이 존재할 때
                session_start();
                if(isset($_SESSION['user_id'])) {
                    $returnValue = 3; // 3. 이미 로그인 되어있음
                } else {
                    // 4. 세션이 존재하지 않을 때
                    $_SESSION['user_id'] = $id;
                    $_SESSION['user_name'] = $row['name'];

                    $returnValue = 4;

                    array_push($resultArray, array('id'=>$row[0], 'passwd'=>$row[1],
                    'name'=>$row[2], 'nickname'=>$row[3],
                    'sex'=>$row[4], 'email'=>$row[5]));
                }
            }
        }

        $resultArray[6] = array('returnValue'=>$returnValue);
        echo json_encode($resultArray, JSON_PRETTY_PRINT); // 배열 형식의 결과를 json으로 변환

    }

    if($_POST['requestValue'] === "logout") {

        session_start();
        if(($_SESSION['user_id'] !== null) && $_SESSION['user_name']) {
            session_destroy();
            $returnValue = 1; // 1. 로그아웃 완료
        } else {
            $returnValue = 2; // 2. Error
        }

        $resultArray[1] = array('returnValue'=>$returnValue);
        echo json_encode($resultArray, JSON_PRETTY_PRINT);

    }

    // DB 접속 종료
    mysqli_close($conn);

?>