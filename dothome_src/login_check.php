<?php

  session_start();
  $username = $_GET['username'];
  $password = $_GET['password'];
  $is_verify = $_GET['is_verify'];

  if(empty($username) || empty($password)) {
    echo "<script> window.location.href='/login.html'; </script>";
  }
  
  

  include "db_conn.php";

  if(!isset($_SESSION['username'])) {
    $query = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $query);
    $re_cnt = mysqli_num_rows($result);

    $email_query = "SELECT * FROM verify WHERE username='$username' and isverify=1";
    $email_result = mysqli_query($conn, $email_query);
    $email_cnt = mysqli_num_rows($email_result);

    if(($re_cnt > 0) && ($email_cnt > 0)) {
      $row = mysqli_fetch_array($result);
  
      if($row['password'] == $password) {
        $_SESSION['username'] = $row['username'];
        mysqli_free_result($result);
        mysqli_close($conn);
        // session_start();
        echo "<script> window.location.href='/index.html'; </script>";
      }
    } else if($re_cnt > 0) {
      echo "<script>
              alert(\"이메일 인증을 해주세요~\");
              window.location.href='/login.html';
              event.preventDefault();
            </script>
      ";
    } else {
      echo "<script>
              alert(\"로그인 실패! 정보를 다시 한번 확인해주세요~\");
              window.location.href='/login.html';
              event.preventDefault();
            </script>
      ";
    }
    
  } else {
    echo "<script>
            alert(\"로그인 중입니다~\");
            history.back();
          </script>
    ";
  }
  
?>
