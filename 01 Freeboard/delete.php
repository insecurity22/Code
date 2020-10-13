<?php
    include './lib/dbconn.php';

    $num = $_GET['num'];
    $sql = "delete from freeboard where num='$num';";
    mysqli_query($conn, $sql);
?>

<script>
    alert("삭제되었습니다.");
    location.replace("<?php echo 'list.php?page=1'?>");
</script>
