<?php
    $id = $_GET['id'];
    if(!$id) {
        echo("
            <script>
                alert('아이디를 입력해주세요.')
            </script>
        ");
    } else {
?>
    <script src="js/jquery-3.5.1.min.js"></script>
    <script> 
        $.ajax({
            url: './json/return_memberjson.php',
            method: 'POST',
            data: { 
                requestValue: 'check_id',
                "id": <?php echo "\"".$id."\"" ?>
            },
            success: function(data) {
                console.log(data[1].returnValue);
                switch(data[1].returnValue) {
                    case 1:
                        alert("아이디가 중복됩니다. 다른 아이디를 사용해주세요.");
                        break;
                    case 2:
                        alert("사용 가능한 아이디입니다.");
                        break;
                }
            },
            error: function(request, status, error) {
                console.log('code: ' + request.status + '\n' + 'message:' + request.responseText + '\n');
                console.log('error:' + error);
            }
        });
    </script>
<?php
    }
?>
    