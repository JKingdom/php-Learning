<?php

//phpinfo();



//first
$str1 = "baixinginterns";
$str2 = "baixing";

// if (strpos($str1, $str2)) {
//     echo "\"" . $str1 . "\" contains \"" . $str2 . "\"";
// } else {
//     echo "oops! \"" . $str1 . "\" does not contain \"" . $str2 . "\". Why ?";
// }
echo strpos($str1, $str2);

echo "<br/>";

if (!(strpos($str1, $str2) === false)) {
    echo "\"" . $str1 . "\" contains \"" . $str2 . "\"";
} else {
    echo "oops! \"" . $str1 . "\" does not contain \"" . $str2 . "\". Why ?";
}

//error
echo "<br/>";
$str1 = "baixinginterns";
$str2 = "baxxing";
if ((strpos($str1, $str2) >= 0)) {
    echo "\"" . $str1 . "\" contains \"" . $str2 . "\"";
} else {
    echo "oops! \"" . $str1 . "\" does not contain \"" . $str2 . "\". Why ?";
}


echo "<br/>";
$money=-10000000000000000000000000000000000000000000000;

y2f($money);
echo "<br/>";
f2y($money);

function f2y($amount) {
    if( is_numeric( $amount )) {
        if($amount<0) {
            echo "输入不能为负数";
            return ;
        }
        echo $amount."分 == ".($amount / 100).'元';
    }
    else {
        echo $amount.'不是可转换的数字';
    }
}
function y2f($amount) {
    if( is_numeric( $amount ) ) {
        if($amount<0) {
            echo "输入不能为负数";
            return ;
        }
        echo $amount."元 == ".($amount * 100).'分';
    }
    else {
        echo $amount.'不是可转换的数字';
    }
}

// third

$email = "xxx mail";

try {
$out = SplitEmailAddress($email);
print_r(array_values($out));
}catch (Exception $e){
    
}

function SplitEmailAddress($str){
   
        $tmp = explode("@",$str);
        
        isset($tmp[0])?$value["user"] = $tmp[0]:$value["user"] ='';
        isset($tmp[1])?$value["domain"] = $tmp[1]:$value["user"] ='';
       
        if($value["user"] === ''|| $value["domain"] === '')
        {
            echo "格式错误";
            //return;
            throw new Exception("格式错误");
        }
    return $value;
}

?>

<?php 



?>