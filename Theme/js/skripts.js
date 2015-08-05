$(document).ready(function() {
   
    $( "#dialog" ).dialog({
      autoOpen: false,
      show: {
        effect: "slideDown",
        duration: 1000
      },
      hide: {
        effect: "slideUp",
        duration: 1000
      }
    });
    
    $( "input[type=submit], a, button" )
		.button()
		.click(function( e ) {
		e.preventDefault();
	});
 
    $( "#opener" ).click(function() {
      	$( "#dialog" ).dialog( "open" );
    });
		
		$('#sub').on('click', function(e){
			e.preventDefault();
		if(($('#login').val() == "") || ($('#pass').val() == "")){
				$(this).siblings(":input").css({border : '2px solid red'}).attr({placeholder: "Заполните поля"});
			}else{
				$.ajax({
					type: 'POST',
					url: 'index.php',
					contentType: 'application/x-www-form-urlencoded',
					data: 	$('#login').attr('name')+'='+$('#login').val()+'&'+
							$('#pass').attr('name')+'='+$('#pass').val(),
					success: function(data){
						console.log($(data).find(".error"));
						if($(data).find(".error").text() === "Введены некоректные значения!"){
							if( !confirm("Введенные Вами значения некоректны, повторить попытку?") )
								$( "#dialog" ).dialog( "close" );	
						}else{
							console.log(data);
							$("body").html(data);
							alert("Данные отправлены");
						}
					},error : function(){
						alert("ERROR! Попробуйте познее.");
					} 
			
				});
			}
		
		});
		
		
	
});