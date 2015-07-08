<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript">
    $(function() { 
    	$(function() { 
    		$('.error').hide(); 
    		$(".button").click(function() { 
    		// 验证代码
    		$('.error').hide(); 
    		var name = $("input#name").val(); 
    		if (name == "") { 
    		$("label#name_error").show(); 
    		$("input#name").focus(); 
    		return false; 
    		} 
    		var email = $("input#email").val(); 
    		if (email == "") { 
    		$("label#email_error").show(); 
    		$("input#email").focus(); 
    		return false; 
    		} 
    		var phone = $("input#phone").val(); 
    		if (phone == "") { 
    		$("label#phone_error").show(); 
    		$("input#phone").focus(); 
    		return false; 
    		}
    		}); 

    		var dataString = 'name='+ name + '&email=' + email + '&phone=' + phone; 
    		//alert (dataString);return false;
    		$.ajax({ 
    		type: "POST", 
    		url: "third.php", 
    		data: dataString, 
    		success: function() { 
    		$('#contact_form').html("<div id='message'></div>"); 
    		$('#message').html("<h2>联系方式已成功提交！</h2>") 
    		.append("<p>Script design</p>") 
    		.hide() 
    		.fadeIn(1500, function() { 
    		$('#message').append("<img id='checkmark' src='images/check.png' />"); 
    		}); 
    		} 
    		}); 
    		return false;
    	}
    	}
    </script>

</head>
<body>

	<div id="contact_form">
		<form name="contact" method="post" action="">
			<fieldset>
				<label for="name" id="name_label">姓名</label> <input type="text"
					name="name" id="name" size="30" value="" class="text-input" /> <label
					class="error" for="name" id="name_error">此项必填</label> <label
					for="email" id="email_label">您的Email</label> <input type="text"
					name="email" id="email" size="30" value="" class="text-input" /> <label
					class="error" for="email" id="email_error">此项必填</label> <label
					for="phone" id="phone_label">您的联系电话</label> <input type="text"
					name="phone" id="phone" size="30" value="" class="text-input" /> <label
					class="error" for="phone" id="phone_error">此项必填</label> <br /> <input
					type="submit" name="submit" class="button" id="submit_btn"
					value="我要发送" />
			</fieldset>
		</form>
	</div>

</body>
</html>