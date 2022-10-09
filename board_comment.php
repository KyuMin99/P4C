
<?php
    session_start();
	include_once("db_conn.php");

    $board_id = $_GET['id'];
    $username = $_SESSION['username'];
    $time = date("Y-m-d H:i:s");
    
    if($_POST['content']){
        mysqli_query($conn, "insert into comment(com_num,username,content,date) values('".$board_id."','".$username."','".$_POST['content']."','".$time."')");
        echo "<script>
        alert('댓글이 작성되었습니다.');
        location.href='/board_read.html.?id=$board_id'
        </script>";
    }else{
        echo "<script>alert('댓글 작성에 실패했습니다.'); 
        history.back();</script>";
    }