<?php
$input = "0123456789abcdefghijklmnopqrstuvwxyz";
$count = 8;

echo GeneratePassword($input, $count);

function GeneratePassword($chars, $len){
    $charsLen = strlen($chars) -1;
    //echo $charsLen;
    str_shuffle($chars);//打乱字符串
    $output = '';
    for ($i=0; $i<$len; $i++)    {
        $output .= $chars[mt_rand(0, $charsLen)];
    }
    return $output;
}


echo "<br/>";
$arr =  array("ffffffff","sdfsfsd","fdsfsfsdfsfds","fdsdfdssfsdfsfsdfds");

echo GetLongestString($arr);

function GetLongestString($arrayString){
    $i = 0;
    foreach ($arrayString as $str){
        if(strlen($str) > $i)
            $i = strlen($str);
    }
    return $i;
}


echo "<br/>";
// 6
echo  "time:";
echo is_working_hour(1420077600);

function is_working_hour($time = null) {
    if(!is_numeric($time)){
        echo "错误";
        return (bool) false;
    }
    $str = date("W Y m d", $time);
    $timeArr = explode(" ",$str);
    if(! ($timeArr[1] === "2015")){
        return false;
    }
    //1-4特殊  唯一是周日但是是工作日的一天
    if($timeArr[2] == "01" && $timeArr[3]=="04"){
        return true;
    }
    // 周末
    if($timeArr[0] === '06' || $timeArr[0] === '07')
        return false;
    //假日
    // 1-1  1-3
    if($timeArr[2] == "01" && ((int)$timeArr[3]>=1 && (int)$timeArr[3] <=3 )){
        return false;
    }
    // 2-18 2 -23
    if($timeArr[2] == "02" && ((int)$timeArr[3]>=18 && (int)$timeArr[3] <=23 )){
        return false;
    }
    // 4-4 4-6
    if($timeArr[2] == "04" && ((int)$timeArr[3]>=4 && (int)$timeArr[3] <=6 )){
        return false;
    }
    // 5-1 5-3
    if($timeArr[2] == "05" && ((int)$timeArr[3]>=1 && (int)$timeArr[3] <=3 )){
        return false;
    }
    // 6-20 6-22
    if($timeArr[2] == "06" && ((int)$timeArr[3]>=20 && (int)$timeArr[3] <=22 )){
        return false;
    }
    // 9-26 9-28
    if($timeArr[2] == "09" && ((int)$timeArr[3]>=26 && (int)$timeArr[3] <=28 )){
        return false;
    }
    // 10-1 10-7
    if($timeArr[2] == "10" && ((int)$timeArr[3]>=1 && (int)$timeArr[3] <=7 )){
        return false;
    }
    //工作日
    return true;
}


?>