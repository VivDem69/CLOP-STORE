// $Id: prestaloveeasymenu.js,v 1.1 2011/10/13 04:28:07 prestalove Exp $

$(document).ready(function() { 
        $('ul.sf-menu').superfish(); 
		$('ul.sf-menu.sf-vertical').superfish( { delay: 0});
		
	$('#lof-prestalove-easy-menu').each(function(){
	  $(this).find('a.lof-menu-title').click(function(){
	   $('ul.lof-easy-menu').slideDown(400);
	   $(document.body).unbind('click');
	  });
	  
	  $(this).mouseout( function(){
	   $(document.body).bind('click', function(){
		$('ul.lof-easy-menu').slideUp(); 
	   } );
	  } );
	});
}); 
