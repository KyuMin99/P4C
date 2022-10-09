<?php
    include_once("db_conn.php");
    if(isset($_GET['code']) and isset($_GET['username'])){

    $verify = $conn->prepare("SELECT * FROM verify WHERE code=? and username=?;");
    $verify->bind_param("ss",$_GET['code'],$_GET['username']);
    $verify->execute();
    $res = $verify->get_result();
    $verify->close();
    $data = $res->fetch_assoc();

    if($data['isverify'] == 0){
        $is_verify = 1;

        $verify = $conn->prepare("UPDATE verify SET isverify=? WHERE code=? and username=?;");
        $verify->bind_param("iss",$is_verify,$_GET['code'],$_GET['username']);
        $verify->execute();
        $verify->close();

        echo('<script> alert("회원가입을 축하합니다! 로그인 후 이용해주세요~"); document.location.href="/login.html";</script>');
    }

}
?>