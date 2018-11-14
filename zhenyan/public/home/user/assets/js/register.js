$(function(){ 
	//alert($);
	var isUpass,isEmail,isPhone = false;
			$('input[name=email]').focus(function()
			{	
				$('#email span:eq(0)').html('<font color="#CBCBCB">请输入邮箱号</font>');
			})
			$('input[name=email]').blur(function(){
				var email_preg = /^[A-Za-z\d]+([-_.][A-Za-z\d]+)*@([A-Za-z\d]+[-.])+[A-Za-z\d]{2,4}$/;
				var email_vals = $(this).val();
				if(email_preg.test(email_vals)){
					$.ajaxSetup({
				        headers: {
				            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				        }
					});
					$.ajax({
						url:'/home/user/checkemail',
						type:'post',
						data:{'email':email_vals},
						success:function(msg){
							if(msg == 'success'){
								isEmail = true;
								$('#email span:eq(0)').html('<font color="#CBCBCB">恭喜邮箱可以注册</font>');
							}else{
								$('#email span:eq(0)').html('<font color="red">邮箱号已经存在</font>') ;
							}
						},
						dataType:'html',
				 		async:false
					});
					
				}else{
					isEmail = false;
					$('#email span:eq(0)').html('<font color="red">邮箱格式错误</font>');
				}
			});
		
			$('input[name=phone]').focus(function()
			{	
				$('#phone span:eq(0)').html('<font color="#CBCBCB">请输入手机号</font>');
			})
			$('input[name=phone]').blur(function(){
				var phone_preg = /^1{1}[3-9]{1}[0-9]{9}$/;
				var phone_vals = $(this).val();
				if(phone_preg.test(phone_vals)){
					$.ajaxSetup({
				        headers: {
				            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				        }
					});
					$.ajax({
						url:'/home/user/checkphone',
						type:'post',
						data:{'phone':phone_vals},
						success:function(msg){
							if(msg == 'success'){
								isPhone = true;
								$('#phone span:eq(0)').html('<font color="#CBCBCB">恭喜手机号可以注册</font>');
							}else{
								$('#phone span:eq(0)').html('<font color="red">手机号已经存在</font>') ;
							}
						},
						dataType:'html',
				 		async:false
					});
					
				}else{
					isPhone = false;
					$('#phone span:eq(0)').html('<font color="red">手机号格式错误</font>');
				}
			});
		

		$('#email input[name=upass]').focus(function()
		{	
			$('#email span:eq(1)').html('<font color="#CBCBCB">请输入6-16位的密码</font>');
		});
		$('#phone input[name=upass]').focus(function()
		{	
			$('#phone span:eq(1)').html('<font color="#CBCBCB">请输入6-16位的密码</font>');
		});
		$('#email input[name=upass]').keyup(function(){
			$('#email li').each(function(){
				$('#email li').css('background','');
				$('#email ul:eq(0)').hide();
			})
			
			var pass_vals = $(this).val();
			if(pass_vals.length < 6){
				return;
			}
			if(pass_vals.length > 16){
				$('#phone span:eq(1)').html( '✖ 密码长度为6-16位');
				$('#phone ul:eq(0)').hide();
				return;
			}
			var temp = [];
			var n_preg = /[0-9]+/g;
			if(n_preg.test(pass_vals)){
				temp.push('数字');
			}
			var ms_preg = /[a-z]+/g;
			if(ms_preg.test(pass_vals)){
				temp.push('小写字母');
			}
			var bg_preg = /[A-Z]+/g;
			if(bg_preg.test(pass_vals)){
				temp.push('大写字母');
			}
			var ts_preg = /[^0-9a-zA-Z]+/g;
			if(ts_preg.test(pass_vals)){
				temp.push('特殊字符');
			}
			if(temp.length==1){
					$('#email li:eq(0)').css('background','#AD4242');
					$('#email li:eq(0)').css('color','#666');
					$('#email ul:eq(0)').show();
					$('#email span:eq(1)').html('');
			}else if(temp.length==2){
					$('#email li:eq(1)').css('background','#BEB367');
					$('#email li:eq(1)').css('color','#666');
					$('#email ul:eq(0)').show();
					$('#email span:eq(1)').html('');
			}else if(temp.length==3){
					$('#email li:eq(2)').css('background','#628B3E');
					$('#email li:eq(2)').css('color','#666');
					$('#email ul:eq(0)').show();
					$('#email span:eq(1)').html('');					
			}else if(temp.length==4){
					$('#email li:eq(3)').css('background','#40C032');
					$('#email li:eq(3)').css('color','#666');
					$('#email ul:eq(0)').show();
					$('#email span:eq(1)').html('');
			}
			

		}); 
		$('#phone input[name=upass]').keyup(function(){
			$('#phone li').each(function(){
				$('#phone li').css('background','');
				$('#phone ul:eq(0)').hide();
			})
			
			var pass_vals = $(this).val();
			if(pass_vals.length < 6){
				return;
			}
			if(pass_vals.length > 16){
				$('#phone span:eq(1)').html( '✖ 密码长度为6-16位');
				$('#phone ul:eq(0)').hide();
				return;
			}
			var temp = [];
			var n_preg = /[0-9]+/g;
			if(n_preg.test(pass_vals)){
				temp.push('数字');
			}
			var ms_preg = /[a-z]+/g;
			if(ms_preg.test(pass_vals)){
				temp.push('小写字母');
			}
			var bg_preg = /[A-Z]+/g;
			if(bg_preg.test(pass_vals)){
				temp.push('大写字母');
			}
			var ts_preg = /[^0-9a-zA-Z]+/g;
			if(ts_preg.test(pass_vals)){
				temp.push('特殊字符');
			}
			if(temp.length==1){
					$('#phone li:eq(0)').css('background','#AD4242');
					$('#phone li:eq(0)').css('color','#666');
					$('#phone ul:eq(0)').show();
					$('#phone span:eq(1)').html('');
			}else if(temp.length==2){
					$('#phone li:eq(1)').css('background','#BEB367');
					$('#phone li:eq(1)').css('color','#666');
					$('#phone ul:eq(0)').show();
					$('#phone span:eq(1)').html('');
			}else if(temp.length==3){
					$('#phone li:eq(2)').css('background','#628B3E');
					$('#phone li:eq(2)').css('color','#666');
					$('#phone ul:eq(0)').show();
					$('#phone span:eq(1)').html('');	
			}else if(temp.length==4){
					$('#phone li:eq(3)').css('background','#40C032');
					$('#phone li:eq(3)').css('color','#666');
					$('#phone ul:eq(0)').show();
					$('#phone span:eq(1)').html('');
					$('#email li:eq(0)').css('background','#AD4242');
					$('#email li:eq(0)').css('color','#666');
					$('#email ul:eq(0)').show();
					$('#email span:eq(1)').html('');
			}else if(temp.length==2){
					$('#email li:eq(1)').css('background','#BEB367');
					$('#email li:eq(1)').css('color','#666');
					$('#email ul:eq(0)').show();
					$('#email span:eq(1)').html('');
			}else if(temp.length==3){
					$('#email li:eq(2)').css('background','#628B3E');
					$('#email li:eq(2)').css('color','#666');
					$('#email ul:eq(0)').show();
					$('#email span:eq(1)').html('');					
			}else if(temp.length==4){
					$('#email li:eq(3)').css('background','#40C032');
					$('#email li:eq(3)').css('color','#666');
					$('#email ul:eq(0)').show();
					$('#email span:eq(1)').html('');
			}
			

		}); 
		$('#email input[name=upassok]').keyup(function(){
			var passok_vals = $(this).val();
			if (passok_vals==$('#email input[name=upass]').val()) {
		$('#phone input[name=upass]').keyup(function(){
			$('#phone li').each(function(){
				$('#phone li').css('background','');
				$('#phone ul:eq(0)').hide();
			})
			var pass_vals = $(this).val();
			if(pass_vals.length < 6){
				return;
			}
			if(pass_vals.length > 16){
				$('#phone span:eq(1)').html( '✖ 密码长度为6-16位');
				$('#phone ul:eq(0)').hide();
				return;
			}
			var temp = [];
			var n_preg = /[0-9]+/g;
			if(n_preg.test(pass_vals)){
				temp.push('数字');
			}
			var ms_preg = /[a-z]+/g;
			if(ms_preg.test(pass_vals)){
				temp.push('小写字母');
			}
			var bg_preg = /[A-Z]+/g;
			if(bg_preg.test(pass_vals)){
				temp.push('大写字母');
			}
			var ts_preg = /[^0-9a-zA-Z]+/g;
			if(ts_preg.test(pass_vals)){
				temp.push('特殊字符');
			}
			if(temp.length==1){
					$('#phone li:eq(0)').css('background','#AD4242');
					$('#phone li:eq(0)').css('color','#666');
					$('#phone ul:eq(0)').show();
					$('#phone span:eq(1)').html('');
			}else if(temp.length==2){
					$('#phone li:eq(1)').css('background','#BEB367');
					$('#phone li:eq(1)').css('color','#666');
					$('#phone ul:eq(0)').show();
					$('#phone span:eq(1)').html('');
			}else if(temp.length==3){
					$('#phone li:eq(2)').css('background','#628B3E');
					$('#phone li:eq(2)').css('color','#666');
					$('#phone ul:eq(0)').show();
					$('#phone span:eq(1)').html('');	
			}else if(temp.length==4){
					$('#phone li:eq(3)').css('background','#40C032');
					$('#phone li:eq(3)').css('color','#666');
					$('#phone ul:eq(0)').show();
					$('#phone span:eq(1)').html('');
			}
			

		}); 
		$('#email input[name=upassok]').keyup(function(){
			var passok_vals = $(this).val();
			if (passok_vals==$('input[name=upass]').val()) {
				isUpass=true;
				$('#email span:eq(2)').html('<font color="green">两次密码输入一致</font>');
			}else{
				$('#email span:eq(2)').html('<font color="red">两次密码输入不一致</font>');
			};

		});
		$('#phone input[name=upassok]').keyup(function(){
			var passok_vals = $(this).val();
			if (passok_vals==$('#phone input[name=upass]').val()) {
				isUpass=true;
				$('#phone span:eq(2)').html('<font color="green">两次密码输入一致</font>');
			}else{
				$('#phone span:eq(2)').html('<font color="red">两次密码输入不一致</font>');
			};

		});
		$('form').submit(function(){
			if((isEmail || isPhone ) && isUpass){
				return true;
			}
			return false;
		});
});