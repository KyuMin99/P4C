<?php
	include "db_conn.php";
	
	$board_id = $_GET['id'];
	$sql = mysqli_query($conn, "delete from board where id='$board_id';");
?>
<script type="text/javascript">
alert("게시글 삭제를 완료했습니다.");
location.replace("/index.html");
</script>
<meta http-equiv="refresh" content="0 url=/index.html" />