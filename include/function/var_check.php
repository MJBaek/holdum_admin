<?php 
function var_check($targetArr, $requireArr){
    $res = false;    
    $emptyCheck = array_empty_check($targetArr, $requireArr);

    if(!empty($emptyCheck)){
        foreach ($emptyCheck as $k){
            echo $k."<br>";
        }
    } else {
        $dataTypeCheck = array_data_type_check($targetArr, $requireArr);
        if(!empty($dataTypeCheck)){
            foreach ($dataTypeCheck as $k){
                echo $k."<br>";
            }
        }else{
            $res = true;
        }
    }
    return $res;
}
/**
 * @param target array. $targetArr
 * @param check require array. $requireArr
 * @example
 * $targetArr = $_POST
 * $requireArr = [
 *"game_title" => "str",
 *"game_table" => "str",
 *"game_ticket" => "str",
 *"game_ticket_amount" => "num",
 *"game_start" => "date",
 *"game_entry_max" => "num",
 *"game_buy_max" => "num" ]
 * @return empty array.
 */
function array_empty_check($targetArr, $requireArr){
    $emptyError = [];
    
    foreach ($requireArr as $k => $v){
        if(!isset($targetArr[$k])){
            array_push($emptyError, $k ." not found.");
        }else{
            if($targetArr[$k] === ""){
                array_push($emptyError, $k ." is empty.");
            }
        }
    }
    return $emptyError;
}

function array_data_type_check($targetArr, $requireArr){
    $dataTypeError = [];
    $i = 0;
    foreach ($requireArr as $k=>$v) {
        if ($v === "str"){
            if (!is_string($targetArr[$k])) {
                array_push($dataTypeError, $k . " is not string. (".$targetArr[$k].")");
            }
        } else if($v === "num") {
            if (!is_numeric($targetArr[$k])) {
                array_push($dataTypeError, $k . " is not number. (".$targetArr[$k].")");
            }
        } else if($v === "date") {
            if (!is_date($targetArr[$k])) {
                array_push($dataTypeError, $k . " is not date. (".$targetArr[$k].")");
            }
        } else if($v === "datetime") {
            if (!is_datetime($targetArr[$k])) {
                array_push($dataTypeError, $k . " is not date. (".$targetArr[$k].")");
            }
        }
    }
    return $dataTypeError;
}
function is_date( $str ) {
    $d = date('Y-m-d', strtotime( $str ));
    return $d == $str;
}

function is_datetime( $str ) {
    $d = date('Y-m-d H:i:s', strtotime( $str ));
    return $d == $str;
}
?>