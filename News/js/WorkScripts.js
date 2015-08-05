$(document).ready(function(){
	var links = $('a');
	var form = $('#title').siblings().andSelf();
	var btn = $(':submit');
	
	$("hr").filter(":last").css({display: 'none'});
		
	links.hover(function(){
		$(this).css({textDecoration: 'none'});
	},function(){
		$(this).css({textDecoration: 'underline'});
	});
	
	
	form.on('focus', function(){
		$(this).css({outline : '2px solid rgb(40, 180, 200)', OutlineRadius: '5px'});
	});
	
	form.on('blur', function(e){
		if($(this).val() == ''){
			$(this).css({outline: '2px solid red', OutlineRadius: '5px'})
			.attr({placeholder: 'Заполните поле'});
		}else{
			$(this).css({outline: 'none'});
		}	
	});
	
	btn.on('click', function(e){
		e.preventDefault();
		$.ajax({
			type: 'POST',
			url: 'index.php',
			contentType: 'application/x-www-form-urlencoded',
			data: 	$('#title').attr('name')+'='+$('#title').val()+'&'+
					$('#category').attr('name')+'='+$('#category').val()+'&'+
					$('#desc').attr('name')+'='+$('#desc').val()+'&'+
					$('#source').attr('name')+'='+$('#source').val(),
			success: function(data){
				$('body').hide().fadeIn(400).html(data);
			}
		});	
	});
})