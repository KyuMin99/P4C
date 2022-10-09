<?php
include "db_conn.php";

$board_id = $_GET['id'];
$username = $_POST['username'];
$userpw = password_hash($_POST['password'], PASSWORD_DEFAULT);
$title = $_POST['title'];
$content = $_POST['content'];
$sql = mysqli_query($conn, "update board set username='".$username."',password='".$userpw."',title='".$title."',content='".$content."' where id='".$board_id."'"); ?>

<script type="text/javascript">alert("게시글 수정을 완료했습니다."); </script>
<meta http-equiv="refresh" content="0 url=/index.html">