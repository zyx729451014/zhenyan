$(function(){ 
	var isUname,isUpass = false;
		$('input[name=uname]').focus(function()
		{	
			$('span:eq(0)').html('<font color="#CBCBCB">请输入8-16字母数字下划线组合</font>');
		})
		$('input[name=uname]').blur(function(){
			var user_preg = /^[A-Za-z0-9_\u4e00-u9fa5]{2,10}$/; 
			var user_vals = $(this).val();
			if(user_preg.test(user_vals)){
				$.ajaxSetup({
			        headers: {
			            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			        }
				});
				$.ajax({
					url:'/home/user/checkname',
					type:'post',
					data:{'uname':user_vals},
					success:function(msg){
						if(msg == 'success'){
							isUname = true;
							$('span:eq(0)').html('<font color="#1f6b10">恭喜用户名可用</font>');
						}else{
							$('span:eq(0)').html('<font color="red">用户已经存在</font>') ;
						}
					},
					dataType:'html',
			 		async:false
				});
				
			}else{
				isUname = false;
				$('span:eq(0)').html('<font color="red">用户名格式错误</font>');
			}
		});

		$('input[name=upass]').focus(function()
		{	
			$('span:eq(1)').html('<font color="#CBCBCB">请输入6-16位的密码</font>');
		});
		$('input[name=upass]').keyup(function(){
			$('li').each(function(){
				$('li').css('background','');
				$('ul:eq(0)').hide();
			})
			var pass_vals = $(this).val();
			if(pass_vals.length < 6){
				return;
			}
			if(pass_vals.length > 16){
				$('span:eq(1)').html( '✖ 密码长度为6-16位');
				$('ul:eq(0)').hide();
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
					$('li:eq(0)').css('background','#AD4242');
					$('li:eq(0)').css('color','#666');
					$('ul:eq(0)').show();
					$('span:eq(1)').html('');
			}else if(temp.length==2){
					$('li:eq(1)').css('background','#BEB367');
					$('li:eq(1)').css('color','#666');
					$('ul:eq(0)').show();
					$('span:eq(1)').html('');
			}else if(temp.length==3){
					$('li:eq(2)').css('background','#628B3E');
					$('li:eq(2)').css('color','#666');
					$('ul:eq(0)').show();
					$('span:eq(1)').html('');	
			}else if(temp.length==4){
					$('li:eq(3)').css('background','#40C032');
					$('li:eq(3)').css('color','#666');
					$('ul:eq(0)').show();
					$('span:eq(1)').html('');
			}
			

		}); 
		$('input[name=upassok]').keyup(function(){
			var passok_vals = $(this).val();
			if (passok_vals==$('input[name=upass]').val()) {
				isUpass=true;
				$('span:eq(2)').html('<font color="green">两次密码输入一致</font>');
			}else{
				$('span:eq(2)').html('<font color="red">两次密码输入不一致</font>');
			};

		});
		$('form').submit(function(){
			if(isUname && isUpass){
				return true;
			}
			return false;
		});
});