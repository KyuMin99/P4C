<?php 

    session_start();
    include "db_conn.php";
    
    $username = $_SESSION['username'];

    if(isset($username) and isset($_POST['title']) and isset($_POST['content'])){
    $title = $_POST['title'];
    $content = $_POST['content'];
    $time = date("Y-m-d H:i:s");

    $tmpfile =  $_FILES['file']['tmp_name'];
    $origin_name = $_FILES['file']['name'];
    $filename = iconv("UTF-8", "EUC-KR", $origin_name);
    $folder = "./upload/".$filename;
    move_uploaded_file($tmpfile,$folder);


    $write_query = $conn->prepare("INSERT INTO board(username,title,content,date,file) VALUES(?,?,?,?,?);");
    $write_query->bind_param("sssss",$username,$title,$content,$time,$origin_name);
    $write_query->execute();
    $write_query->close();

    echo("<script> 
        alert('게시글이 작성되었습니다.');
        document.location.href='/index.html';
        </script>");

  }
?>