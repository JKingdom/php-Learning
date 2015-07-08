
<html>
<head>
<title>第三天</title>
</head>
<style type="text/css">
</style>
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link rel="alternate icon" type="image/png" href="/i/favicon.png">
<link rel="stylesheet" href="amazeui.min.css" />
<style>
.header {
	text-align: center;
}

.header h1 {
	font-size: 200%;
	color: #333;
	margin-top: 30px;
}

.header p {
	font-size: 14px;
}
</style>
<script type="text/javascript"
	src="http://code.jquery.com/jquery.min.js"></script>
<script type="text/javascript">

$(document).ready(function ()
{

});

function validate(){
    var params=$('input').serialize(); //序列化表单的值
    $.ajax({
      url:'process.php', //后台处理程序
      type:'post',         //数据发送方式
      dataType:'json',     //接受数据格式
      data:params,         //要传递的数据
      success:update_page  //回传函数(这里是函数名)
    });
  }


function update_page (json)  //回传函数实体，参数为XMLhttpRequest.responseText
{
    if(json.status){
        $("#real_submit").removeAttr('disabled');
        $("#label1").html(json.email);
        $("#label1").show();
        $("#label2").html(json.mobile);
        $("#label2").show();
        $("#label3").html(json.tel);
        $("#label3").show();
        $("#label4").html(json.number);
        $("#label4").show();
    }else {
        if(!(json["email"] == undefined)){
        	$("#label1").html(json.email);
            $("#label1").show();
        }
        if(!(json["mobile"] == undefined)){
        	$("#label2").html(json.mobile);
            $("#label2").show();
        }
        if(!(json["tel"] == undefined)){
        	$("#label3").html(json.tel);
            $("#label3").show();
        }
        if(!(json["number"] == undefined)){
        	$("#label4").html(json.number);
            $("#label4").show();
        }
        
    }

}
</script>
<body>
	<div class="am-g">
		<div class="am-u-lg-6 am-u-md-8 am-u-sm-centered">
			<form id="formtext" action="submit.php" method="post" class="am-form">
				<p>
					<label for="email">输入邮箱：</label><input type="text" name="email"
						id="input1" onblur="validate()" />
						<font size="2" color="red"><label id="label1" hidden="ture" ></label></font>
						
				</p>
				<p>
					<label for="email">输入电话：</label><input type="text" name="mobile" id="input2"
						onblur="validate()" />
						<font size="2" color="red"><label id="label2" hidden="ture"></label></font>
				</p>
				<p>
					<label for="email">输入座机：</label><input type="text" name="tel" id="input3"
						onblur="validate()" />
						<font size="2" color="red"><label id="label3" hidden="ture"></label></font>
				</p>
				<p>
					<label for="email">输入数字：</label><input type="text" name="number" id="input4"
						onblur="validate()" />
						<font size="2" color="red"><label id="label4" hidden="ture"></label></font>
				</p>
				<div class="am-cf">
				
				<input type="submit" id="real_submit" disabled class="am-btn am-btn-primary am-btn-sm am-fl"/>
				</div>
			</form>
		</div>
	</div>
</body>

</html>