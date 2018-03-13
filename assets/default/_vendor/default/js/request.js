var loader = '<center><i class="fa fa-spinner fa-spin" style="font-size:5rem;"></i></center>';

$(document).ready(function()
{
	
	$("form").submit(function(event){
		event.preventDefault();
		var serverid=jQuery('input[name="serverid"]').val(),
		username=jQuery('input[name="username"]').val(),
		password=jQuery('input[name="password"]').val(),
		captcha=jQuery('input[name="captcha"]').val();
		$.ajax({
			type:'POST',
			url: $(this).attr('action'),
			data:{
				serverid:serverid,
				username:username,
				password:password,
				captcha:captcha
			},
			error:function(xhr,ajaxOptions,thrownError){
				
				$('#response').html(xhr);
			},
			cache:false,
			beforeSend:function(){
				
				$('#response').html(loader);
				
			},
			success:function(s){
				$('#response').html(s);
			}
		});
	return false;});
});
