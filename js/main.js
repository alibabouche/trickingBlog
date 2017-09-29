$(document).ready(function(){

//event sur la page TUTAUX:
	$(".tutaux .elans").click(function(){
		
		$(".elan").slideToggle(1000);
		//$(".kick").hide();
		//$(".acro").hide();
	});

	$(".tutaux .kicks").click(function(){

		$(".kick").slideToggle(1000);
		//$(".elan").hide();
		//$(".acro").hide();
	});

	$(".tutaux .acros").click(function(){

		$(".acro").slideToggle(1000);
		//$(".elan").hide();
		//$(".kick").hide();
	});
});