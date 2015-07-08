<?php
include_once("process.php");
$arr = $_REQUEST;
$result = valdate($arr);

if($result["status"] === true){
    $url='http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"];
    $current = dirname($url) . "/" . "current.php";
    
    header("Location: " . $current);
}else{
    echo "非法操作";
}
?>