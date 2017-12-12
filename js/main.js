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
//Afficher les commentaires de chaques posts de manière $(this).
	$(".discussion .postElement").on("click", function(){
		$(this).find(".form-comments, .text-comments").toggleClass("display");
	});
});
