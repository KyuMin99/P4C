<?php
    session_start();
    session_destroy();
    
    echo "<script> document.location.href='/index.html'; alert('로그아웃 하셨습니다.'); </script>"; 
?>