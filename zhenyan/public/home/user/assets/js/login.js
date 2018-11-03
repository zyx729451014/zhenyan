$(function(){ 
	var isUname,isUpass = false;
	$('form').submit(function(){
		user_vals=$('input[name=uname]').val();
		upass_vals=$('input[name=upass]').val();
		if (!isUname) {
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
						alert('用户不存在请核对用户名');

					}else{
						isUname = true;
					}
				},
				dataType:'html',
		 		async:false
			});
		}
		if (isUname && !isUpass) {
			$.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
			});
			$.ajax({
				url:'/home/user/dologin',
				type:'post',
				data:{'uname':user_vals,'upass':upass_vals},
				success:function(msg){
					if(msg == 'error'){
						alert('用户名和密码不匹配');
					}else{
						isUpass=true;
					}
				},
				dataType:'html',
		 		async:false
			});
		};
		if(isUname && isUpass){
			return true;
		}
		return false;
	});
});