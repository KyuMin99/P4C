<?php

  include('PHPMailer/src/Exception.php');
  include('PHPMailer/src/PHPMailer.php');
  include('PHPMailer/src/SMTP.php');

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
  use PHPMailer\PHPMailer\SMTP;
  
  // 에러 출력
  // error_reporting(E_ALL);
  // ini_set('display_errors', '1');

  // post한 id, pw 받기
  $username = $_POST['username'];
  $password = $_POST['password'];
  $email = $_POST['email'];
  
  // db_conn의 mysqli_connect 연결
  include "db_conn.php";
  
  $id_query = "select * from users where username='$username'";
  $id_result = $conn->query($id_query);
  $count = mysqli_num_rows($id_result);
  
  // 중복 ID 검사
  if ($count) {
  ?>
    <script>
      alert("중복된 계정입니다.");
      history.back();
    </script>
  <?php } 
  else {

    $reg_msg = 'True';

    $mail = new PHPMailer(true);
    $mail->ContentType='text/html';
    $mail->CharSet='utf-8';
    $mail->IsSMTP();

      try {
        $random = rand (1000000000,9999999999);
        $date = $time = date("YmdHis");
        $verify_code = $date.$time.$username;
        $is_verify = 0;

        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Port = 465;
        $mail->SMTPSecure = "ssl";
        $mail->Username   = "gmail계정";
        $mail->Password   = "gmail비번";
        $mail->SMTPKeepAlive = true;


        $mail->SetFrom('slowturtles99@gmail.com', 'SlowTurtle 서비스를 이용하기 위한 이메일 인증입니다.');
        $mail->AddAddress($email, $username);

        $mail->Subject = 'Email verify!'; 
        $mail->MsgHTML("SlowTurtle 서비스를 이용하기 위한 이메일 링크입니다.\nhttp://slowturtle.dothome.co.kr/email_verify.php?code=".$verify_code."&username=".$username."\n
                        해당 링크에 접속하여 회원가입을 완료해주세요!\nSlowTurtle 서비스를 이용해주셔서 감사합니다.");

        $mail->Send(); 

        echo "Message Sent OK<p></p>\n";

      } catch (Exception $e) {
        $reg_msg = 'REGISTER FAILED : Invalid email.';
      }

      

    if ($reg_msg == 'True') {

      $email_query = "insert into verify(username, email, code, isverify) values('$username', '$email', '$verify_code', '$is_verify')";
      $email_result = $conn->query($email_query);

      $sign_query = "insert into users(username, password, email) values('$username', '$password', '$email')";
      $sign_result = $conn->query($sign_query);

    ?> 
      <script>
        alert('회원가입에 성공하였습니다.\n다시 로그인 해주세요.');
        location.replace("/index.html");
      </script>
    <?php } 
    else {
    ?> 
      <script>
        alert("회원가입에 실패하였습니다.");
        history.back();
      </script>
    <?php }
  }

  mysqli_close($connect);

?>
