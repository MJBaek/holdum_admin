<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/include/config/database.php";

$userNick = $_POST['user_nick'];
$ticketAmount = $_POST['ticket_amount'];

if($ticketAmount >0){
    try{
        // 해당 닉네임을 가진 사용자가 있는지 체크
        $sql ="
            SELECT count(1) AS cnt, MIN(user_id) AS user_id
            FROM user_info
            WHERE user_nick = '$userNick'
        ";
        $res = mysqli_query($conn, $sql);
        
        if (!$res) throw new Exception($conn->error);
        
        $row = mysqli_fetch_assoc($res);
        $cnt = $row["cnt"];
        $userId = $row["user_id"];
        
        if($cnt >0){
            $conn->autocommit(FALSE);
            // 유저 정보에서 티켓 수량 수정
            $sql = "
                UPDATE user_info
                SET available_ticket = available_ticket + $ticketAmount
                WHERE user_id='$userId'
            ";
            $res = mysqli_query($conn, $sql);
            
            if (!$res) throw new Exception($conn->error);
            
            // 유저 정보에서 티켓 수량 수정
            $sql = "
                INSERT INTO available_ticket
                VALUES('gimp','$userId','$ticketAmount')
                ON DUPLICATE KEY
 				UPDATE amount = amount + $ticketAmount
            ";
            $res = mysqli_query($conn, $sql);
            
            if (!$res) throw new Exception($conn->error);
            
            $conn->commit();
            
            // 히스토리에 저장
            $sql = "
                INSERT INTO user_history (center_id, user_id, ticket_type, ticket_use, amount)
                VALUES ('gimp', '$userId', 'at', '0', '$ticketAmount')
            ";
            $res = mysqli_query($conn, $sql);
            
            if (!$res) throw new Exception($conn->error);
            
            $conn->commit();
            
            
            header("Location:/payment.php");
        }else{
            die("<script>alert('해당 닉네임을 가진 사용자가 없습니다.'); history.back(-1);</script>");
        }
    }catch (Exception $e){
        $conn->rollback();
        $error = $e->getMessage();
        die("<script>alert(\"Error: $error\"); history.back(-1);</script>");
    }
}else{
    die("<script>alert('티켓 수량이 잘못 되었습니다.'); history.back(-1);</script>");
}

?>