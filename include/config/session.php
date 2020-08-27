<?php 
// 쿠키 동작 문제 해결.
header('P3P: CP="ALL CURa ADMa DEVa TAIa OUR BUS IND PHY ONL UNI PUR FIN COM NAV INT DEM CNT STA POL HEA PRE LOC OTC"');
// 세션 파일을 저장할 경로 설정. 설정하지 않으면 php.ini에 기본 경로에 저장.
ini_set('session.save_path',$_SERVER['DOCUMENT_ROOT']."/session");
// 세션 ID를 저장한 쿠키의 유효 시간 설정. 설정하지 않거나 0으로 설정하면 브라우저가 종료되면 쿠키는 파기. (초 단위)
ini_set('session.cookie_lifetime', 0) ;
// 사용되지 않는 세션 파기 유효 시간 설정. (초단위)
ini_set('session.gc_maxlifetime', 1440);
// 서버에 저장된 세션 ID 활성화 시간. (분단위)
ini_set('session.cache_expire', 1440);
// 세션 시작
session_start();

if($_SERVER['REQUEST_URI'] !== "/process/process_login.php"){
    if(empty($_SESSION["sess_id"])){
//         header("Location:/");
        die("<script>alert('로그인이 필요합니다.');location.href='/';</script>");
    }
}
?>