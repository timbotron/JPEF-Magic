/*
 * JPEF-Magic v1.0.0
 * http://github.com/timbotron/JPEF-Magic
 *
 * Author: Tim Habersack (tim@hithlonde.com - http://tim.hithlonde.com)
 * Licensed under a Creative Commons Attribution-ShareAlike 3.0 Unported License.
 *
 * Date: 2011.09.29
 */

function jpef_magic(form)
 {
 	
 	var Answer;
 	Answer='';
 	$(form).find('label.question').each(function() {
 		Answer+=$(this).text()+'\n';
 		if($('[name='+$(this).attr('for')+']:checked').length>=1)
 		{
 			$('[name='+$(this).attr('for')+']:checked').each(function() { //if a checkbox that has more than one, use
 					Answer+=$(this).val()+', ';

 				});
 				Answer=Answer.substring(0,Answer.length-2);
 				Answer+='\n\n';
 		}
 		else
 		{
 			Answer+=$('[name='+$(this).attr('for')+']').val()+'\n\n';

 		}
 		$('[name=email_body]').val(Answer); 		
 	});
 	form.submit();


 }

$(document).ready(function() {
	$.metadata.setType("attr", "validate");
	$("#the_form").validate({		
   		wrapper: "p class='invalid'",
   		errorClass: "invalid",
   		validClass: "",
   		highlight: function(element, errorClass, validClass) {
		 $(element).addClass(errorClass).removeClass(validClass);
	  },
	  unhighlight: function(element, errorClass, validClass) {
		 $(element).removeClass(errorClass).addClass(validClass);
	  },
	  	submitHandler: jpef_magic	
	});
	
});


 
