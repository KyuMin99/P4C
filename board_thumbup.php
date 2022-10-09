<?php
	include "db_conn.php";
   
	$board_id = $_GET['id'];
    $board_thumbup =  mysqli_fetch_array(mysqli_query($conn,"select thumbup from board where id='$board_id';"));
    $board_thumbup = $board_thumbup['thumbup'] + 1;
    mysqli_query($conn,"update board set thumbup=".$board_thumbup." where id=".$board_id.";");
    ?>
    <script type="text/javascript">alert("추천되었습니다."); document.location.href="/board_read.html?id=<?php echo $board_id; ?>";</script>