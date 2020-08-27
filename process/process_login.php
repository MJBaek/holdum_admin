<?php 
require_once $_SERVER["DOCUMENT_ROOT"].'/include/config/session.php'; //세션
$userId = $_POST["user_id"];
$userPw = $_POST["user_pw"];

if($userId === "admin-gimpo" && $userPw === "Holdum$2020"){
    $_SESSION["sess_id"] = $userId;
    header("Location:/payment.php");
}else{
    header("Location:/");
}
?>