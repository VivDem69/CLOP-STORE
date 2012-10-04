// JavaScript Document
$(document).ready( function(){
	$(".bgpattern").each( function(){
		var wrap = this;
		$("#" + $("input",wrap).val()).addClass("active"); 
		$("div",this).click( function(){
		 	  $("input",wrap).val( $(this).attr("id").replace(/\.\w+$/,"") );
			  $("div",wrap).removeClass( "active" );
			  $(this).addClass("active");
		} );
	} );
} );