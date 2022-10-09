<?php
	include "db_conn.php";
   
	$board_id = $_GET['id'];
	$sql = mysqli_query($conn, "select * from board where id='$board_id';");
	$board = $sql->fetch_array();
 ?>
<!DOCTYPE html>
<html>
  <head>
  <link rel="stylesheet" type="text/css" href="static/bootstrap-5.1.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="static/bootstrap-5.1.3-dist/css/signin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <title>slowturtle</title>
  </head>
</head>
<body>
    <div id="board_write">
        <h1><a href="/">자유게시판</a></h1>
        <h4>글을 수정합니다.</h4>
            <div id="write_area">
                <form action="board_modify_check.php?id=<?php echo $board_id; ?>" method="post">
                    <div id="in_title">
                        <textarea name="title" id="title" rows="1" cols="55" placeholder="제목" maxlength="100" required><?php echo $board['title']; ?></textarea>
                    </div>
                    <div class="wi_line"></div>
                    <div id="in_name">
                        <textarea name="username" id="username" rows="1" cols="55" placeholder="글쓴이" maxlength="100" required><?php echo $board['username']; ?></textarea>
                    </div>
                    <div class="wi_line"></div>
                    <div id="in_content">
                        <textarea name="content" id="content" placeholder="내용" required><?php echo $board['content']; ?></textarea>
                    </div>
                    <div id="in_pw">
                        <input type="password" name="password" id="password"  placeholder="비밀번호" required />  
                    </div>
                    <div class="bt_se">
                        <button type="submit">글 작성</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>