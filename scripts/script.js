$(document).ready(function(){
	$('#loginSubmit').click(function(){
		if(!$('#username').val() || !$('#password').val()){
			alert("Am I a mind reader? Put in a username and password!");
			return false;
		}
	});	
	
	$("#accordianMenu h3").click(function(){
		//slide up all the link lists
		$("#accordianMenu ul ul").slideUp();
		//slide down the link list below the h3 clicked - only if its closed
		if(!$(this).next().is(":visible"))
		{
			$(this).next().slideDown();
		}
	});
	$("#logout").click(function(){
		window.location.href = "logout.php";
	});
	
})