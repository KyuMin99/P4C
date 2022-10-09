<?php
    include_once("db_conn.php");

    if(isset($_SESSION['username'])){
        $id = $_SESSION['username'];
        $list_query = $conn->prepare("SELECT username FROM users WHERE username=?;");
        $list_query->bind_param("i",$username);
        $list_query->execute();

        $result = $list_query->get_result();
        $list_query->close();

        $data = $result->fetch_assoc();
        $session_user = $data['username'];
    }

    

    if(isset($_GET['search'])){
        if($_GET['search']=='all'){
          $search_query = $conn->prepare("SELECT * FROM board WHERE LOCATE(?, title) > 0 or LOCATE(?, content) > 0 LIMIT 20;");
          $search_query->bind_param("ss",$_GET['search_content'],$_GET['search_content']);
          $search_query->execute();
          $result = $search_query->get_result();
          $search_query->close();
        } else if($_GET['search']=='title') {
          $search_query = $conn->prepare("SELECT * FROM board WHERE LOCATE(?, title) > 0 LIMIT 20;");
          $search_query->bind_param("s",$_GET['search_content']);
          $search_query->execute();
          $result = $search_query->get_result();
          $search_query->close();
        } else if($_GET['search']=='content') {
          $search_query = $conn->prepare("SELECT * FROM board WHERE LOCATE(?, content) > 0 LIMIT 20;");
          $search_query->bind_param("s",$_GET['search_content']);
          $search_query->execute();
          $result = $search_query->get_result();
          $search_query->close();
        }
      } else {
        $list_query = $conn->prepare("SELECT * FROM board LIMIT 20;");
        $list_query->execute();
        $result = $list_query->get_result();
        $list_query->close();
      }

?>