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
	$(".discussion .postList").on("click", function(){

		$(".discussion .postList").toggleClass("display");
		//$(".discussion .postList").toggleClass("display");
		$(".discussion .form-article").toggleClass("display");
		$(this).next().toggleClass("display");
		$(this).toggleClass("display");
		$(this).find(".text-comments, .article").toggleClass("display");
		$(this).siblings(".article").toggleClass("display");

	});

	$(".discussion button.submitAnswer").trigger("submit", function(){
		console.log($(this).parent("li").prev().find("textarea").val(""));
	});


});
