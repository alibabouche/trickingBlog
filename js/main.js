$(document).ready(function(){
	"use strict";


//event sur la page TUTAUX:
	$(".tutaux .elans").click(function(){
		
		$(".elan").toggle(500);
		$(".kicks").toggle(500);
		$(".acros").toggle(500);
		
	});

	$(".tutaux .kicks").click(function(){

		$(".kick").toggle(500);
		$(".elans").toggle(500);
		$(".acros").toggle(500);
		
	});

	$(".tutaux .acros").click(function(){

		$(".acro").toggle(500);
		$(".elans").toggle(500);
		$(".kicks").toggle(500);
		
	});

//event sur la page DISCUSSION
	$(".discussion .postList").on("click", function(){
		$(this).next("form").toggleClass("display");
		console.log($(this).next("form"));
	});



});
