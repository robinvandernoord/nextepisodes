$(function(){

	var form = $('#login-register');

	form.on('submit', function(e){

		if(form.is('.loading, .loggedIn')){
			return false;
		}

		var email = form.find('input').val(),
			messageHolder = form.find('span');

		e.preventDefault();

		$.post(this.action, {email: email}, function(m){
			
			if(m.error){
				form.addClass('error');
				messageHolder.text(m.message);
			}
			else{
				form.removeClass('error').addClass('loggedIn');
				messageHolder.text(m.message);
			}
		});

	});

	$(document).ajaxStart(function(){
		form.addClass('loading');
	});

	$(document).ajaxComplete(function(){
		form.removeClass('loading');
	});
});