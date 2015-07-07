<?php

$test = new MyValidator("renjiangang@baixing.com");
$test->email();

class MyValidator {

    private $value;

    public function __construct($value) {
        $this->value = $value;
    }

    /**
     * 输入一个数字串。返回他是否为一个合法数字, e.g. $this->value = 123;
     * @return int
     */
    
    public function setValue($val){
        $this->value = $val;
    }
    
    public function number() {
        
        if(!is_numeric($this->value))
            return 0;
        
        if(preg_match("/^(-)?[0-9]+(.[0-9]+)?$/", $this->value)){
            return 1;
        } else {
            return 0;
        }
    }

    /**
     * 输入一个数字串。返回他是否为一个手机号，e.g. $this->value = 18616612321;
     * @return int
     */
    public function mobile() {
        //现有手机号段:
        // 移动：139 138 137 136 135 134 147 150 151 152 157 158 159 178 182 183 184 187 188  
        // 联通： 130 131 132 155 156 185 186 145 176
        // 电信： 133 153 177 180 181 189 
        
        //$tmp = trim($this->value,"+");  // 去除 86+之类的+号
        $tmp = str_replace('+', '', $this->value);
        
        if(!is_numeric($tmp))
            return 0;
        // 匹配号码
        if(preg_match("/^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/", $tmp)){
            return 1;
        } else {
            return 0;
        }
    }

    /**
     * 输入一个数字串。返回他是否座机号码，e.g. $this->value = 65536445;
     * @return int
     */
    public function telephone() {
        //其实我不知道座机号码的号段·· 没查到，似乎是1开头的不能用，然后总共6或者7位的样子
        if(preg_match("/^[2-9][0-9]{6,7}$/", $this->value)){
            return 1;
        } else {
            return 0;
        }
    }

    /**
     * 输入一个字符串。返回他是否为合法的电子邮件格式，
     * e.g. $this->value = 'renjiangang@baixing.com';
     * @return int
     */
    public function email() {
        // 物理哥给的那个链接的正则太专业了，我还是来个不专业的吧
        // 不能以.开头的_数字字符
        
        $tmp = explode("@",$str);
        isset($tmp[0])?$value["user"] = $tmp[0]:$value["user"] ='';
        isset($tmp[1])?$value["domain"] = $tmp[1]:$value["user"] ='';
        
        //超出长度
        if(!((strlen($value["user"])>0||strlen($value["user"])<=64)
                &&
                (strlen($value["domain"])>0||strlen($value["domain"])<=255)))
            return 0;
        
        
        if(preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*$/i", $this->value)){
            return 1;
        } else {
            return 0;
        }
    }  
}

//3
function validateNumber($input){
    if($input.is_numeric($input)){
        echo $input."￥";
    }else{
        $tmp;
        //含有非数字，进行匹配
        if(strpos($input, "-") ){
            $tmp = splitToUpAndDown($input, "-");
        }elseif(strpos($input, "至")){
            $tmp = splitToUpAndDown($input, "至");
        }else{
            $tmp = $input;
        }
        
        if(is_array($tmp)){
            $o = "";
            foreach ($tmp as $t){
                $o .+ "-" .+isCn($t);
            }
            $o = trim($o, "-");
            return $o;
        }else{
            if(strpos($tmp,"$")){
                $tmp = dollarToYuan($tmp);
                return $tmp;
            }
        }
        
    }
    echo "error";
}

// dollar to yuan
function dollarToYuan($input){
    return $input * 6;
}

// 根据  - / 至   进行拆分并去除空格
function splitToUpAndDown($input, $singal){
    $tmp = explode($singal,$input);
    
    isset($tmp[0])?$value["down"] = $tmp[0]:$value["down"] ='';
    isset($tmp[1])?$value["up"] = $tmp[1]:$value["up"] ='';
    $value["down"] = trim($value["down"]," ");
    $value["up"] = trim($value["up"]," ");
    return $value;
}

// 我在这里添加上正则判断
function isCn($var){
    if(preg_match("/^[亿|万|千|百|十|一|零|二|三|四|五|六|七|八|九]+$/", $var)){
        return CnToInt($var);
    }else {
        return $var;
    }
}
// 我承认，下面的这段是网上的
/**
 * 中文转数字
 * @param String $var 需要解析的中文数
 * @param Int $start 初始值
 * @return int
 */
function CnToInt($var, $start = 0) {
    if (is_numeric($var)) {
        return $var;
    }
    
    if (intval($var) === 0) {
        $splits = array('亿' => 100000000, '万' => 10000);
        $chars = array('万' => 10000, '千' => 1000, '百' => 100, '十' => 10, '一' => 1, '零' => 0);
        $Ints = array('零' => 0, '一' => 1, '二' => 2, '三' => 3, '四' => 4, '五' => 5, '六' => 6, '七' => 7, '八' => 8, '九' => 9, '十' => 10);
        $var = str_replace('零', "", $var);
        foreach ($splits as $key => $step) {
            if (strpos($var, $key)) {
                $strs = explode($key, $var);
                $start += CnToInt(array_shift($strs)) * $step;
                $var = join('', $strs);
            }
        }
        foreach ($chars as $key => $step) {
            if (strpos($var, $key) !== FALSE) {
                $vs = explode($key, $var);
                if ($vs[0] === "") {
                    $vs[0] = '一';
                }
                $start += $Ints[array_shift($vs)] * $step;
                $var = join('', $vs);
            } elseif (mb_strlen($var, 'utf-8') === 1) {
                $start += $Ints[$var];
                $var = '';
                break;
            }
        }
        return $start;
    } else {
        return intval($var);
    }
}















?>