<?php
// $arr = $_POST; //若以$.get()方式发送数据，则要改成$_GET.或者干脆:$_REQUEST
$arr = $_REQUEST;
$result = valdate($arr);

$myjson = my_json_encode($result);
echo $myjson;

function valdate($arr)
{
    $object = new MyValidator();
    $result = "";
    // email
    if ($arr["email"] == null || $arr["email"] == "") {
        $result["status"] = false;
        $result["email"] = "没有填写";
        return $result;
    } else {
        $object->setEmail($arr["email"]);
        if ($object->email()) {
            $result["email"] ="正确";
        } else {
            $result["status"] = false;
            $result["email"] = "邮件格式错误";
            return  $result;
        }
    }
    // mobile 手机
    if ($arr["mobile"] == null || $arr["mobile"] == "") {
        $result["status"] = false;
        $result["mobile"] = "没有填写";
        return $result;
    } else {
        $object->setMobile($arr["mobile"]);
        if($object->mobile()){
            $result["mobile"] = "正确";
        }else{
            $result["status"] = false;
            $result["mobile"] = "手机格式错误";
            return $result;
        }
    }
    // tel 座机
    if ($arr["tel"] == null || $arr["tel"] == "") {
        $result["status"] = false;
        $result["tel"] = "没有填写";
        return $result;
    } else {
        $object->setTel($arr["tel"]);
        if($object->telephone()){
            $result["tel"] = "正确";
        }else{
            $result["status"] = false;
            $result["tel"] = "座机格式错误";
            return $result;
        }
    }
    
    // number
    if ($arr["number"] == null || $arr["number"] == "") {
        $result["status"] = false;
        $result["number"] = "没有填写";
        return $result;
    } else {
        $object->setNumber($arr["number"]);
        if($object->number()){
            $result["number"] = "正确";
        }else{
            $result["status"] = false;
            $result["number"] = "数字格式错误";
            return $result;
        }
    }
    
    
    $result["status"] = true;
    return $result;
}

function my_json_encode($phparr)
{
    return json_encode($phparr);
}

class MyValidator
{
  
      private $email;
      private $tel;
      private $mobile;
      private $number;
      /**
       * 输入一个数字串。返回他是否为一个合法数字, e.g. $this->value = 123;
       * @return int
       */
      public function setEmail($email){
          $this->email = $email;
      }
      
      public function setNumber($number){
          $this->number = $number;
      }
      
      public function setMobile($mobile){
          $this->mobile = $mobile;
      }
      
      public function setTel($tel){
          $this->tel = $tel;
      }
      public function number() {
  
          if(!is_numeric($this->number))
              return false;
          if(preg_match("/^(-)?[0-9]+(.[0-9]+)?$/", $this->number)){
              return true;
          } else {
              return false;
          }
      }
      public function mobile() {
          //现有手机号段:
          // 移动：139 138 137 136 135 134 147 150 151 152 157 158 159 178 182 183 184 187 188
          // 联通： 130 131 132 155 156 185 186 145 176
          // 电信： 133 153 177 180 181 189
          //$tmp = trim($this->value,"+");  // 去除 86+之类的+号
          $tmp = str_replace('+', '', $this->mobile);
  
          if(!is_numeric($tmp))
              return false;
          // 匹配号码
          if(preg_match("/^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/", $tmp)){
              return true;
          } else {
              return false;
          }
      }
      public function telephone() {
          //其实我不知道座机号码的号段·· 没查到，似乎是1开头的不能用，然后总共6或者7位的样子
          if(preg_match("/^[2-9][0-9]{6,7}$/", $this->tel)){
              return true;
          } else {
              return false;
          }
      }
      public function email() {
          // 物理哥给的那个链接的正则太专业了，我还是来个不专业的吧
          // 不能以.开头的_数字字符
          $tmp = explode("@",$this->email);
          
          isset($tmp[0])?$value["user"] = $tmp[0]:$value["user"] ='';
          isset($tmp[1])?$value["domain"] = $tmp[1]:$value["domain"] ='';
          //超出长度
          if(!((strlen($value["user"])>0||strlen($value["user"])<=64)
              &&
              (strlen($value["domain"])>0||strlen($value["domain"])<=255)))
                  return false;
          if(preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*$/i", $this->email)){
              return true;
          } else {
              return false;
          }
      }
  }
?>