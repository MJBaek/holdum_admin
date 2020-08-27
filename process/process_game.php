<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/include/config/database.php";
require_once $_SERVER["DOCUMENT_ROOT"]."/include/function/var_check.php";

$type = $_POST['type']; // reg : 등록, edit : 수정

$requireArr = [
    "game_title" => "str",
    "game_table" => "str",
    "game_ticket" => "str",
    "game_ticket_amount" => "num",
    "game_status" => "num",
    "game_start" => "datetime",
    "game_entry_max" => "num",
    "game_buy_max" => "num"
];

// var_dump($_POST);


if($type === "reg"){
    $check = var_check($_POST,$requireArr);
    if($check){
        try{
            $sql = "
                INSERT INTO 
                game_info ( 
                    game_title, 
                    game_table, 
                    game_ticket, 
                    game_ticket_amount, 
                    game_status, 
                    game_start, 
                    game_entry_max, 
                    game_buy_max
                )
                VALUES(
                    '$_POST[game_title]', 
                    '$_POST[game_table]', 
                    '$_POST[game_ticket]', 
                    '$_POST[game_ticket_amount]', 
                    '$_POST[game_status]', 
                    '$_POST[game_start]', 
                    '$_POST[game_entry_max]', 
                    '$_POST[game_buy_max]' 
                )
            ";
            $conn->autocommit(FALSE);
            $res = mysqli_query($conn, $sql);
            
            if (!$res) throw new Exception($conn->error);
            $conn->commit();
            header("Location:/history_game.php");
        }catch (Exception $e){
            $error = $e->getMessage();
            die("<script>alert(\"Error: $error\"); history.back(-1);</script>");
        }
    }else {
        exit;
    }
} else if($type ==="edit"){
    $check = var_check($_POST,$requireArr);
    if($check){
        try{
            $sql = "
                UPDATE game_info
                SET 
                    game_title =  '$_POST[game_title]',
                    game_table = '$_POST[game_table]',
                    game_ticket = '$_POST[game_ticket]',
                    game_ticket_amount =  '$_POST[game_ticket_amount]',
                    game_status = '$_POST[game_status]',
                    game_start = '$_POST[game_start]',
                    game_entry_max = '$_POST[game_entry_max]',
                    game_buy_max = '$_POST[game_buy_max]'
                WHERE game_id = '$_POST[game_id]'
            ";
            $conn->autocommit(FALSE);
            $res = mysqli_query($conn, $sql);
            
            if (!$res) throw new Exception($conn->error);
            $conn->commit();
            header("Location:/history_game.php");
        }catch (Exception $e){
            $error = $e->getMessage();
            die("<script>alert(\"Error: $error\"); history.back(-1);</script>");
        }
    }else {
        exit;
    }
}
?>