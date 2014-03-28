<?php

$site_url = "bbs_example";

?>

<div class="wrapper">
User Register


	
	<form action="/bbs_example/user/register" id="UserRegisterForm" method="post" accept-charset="utf-8">
	<table cellspacing=2 cellpadding=0 width=300 border=0>
				<tr>
				<td><font class="en1">Username:</font> </td>
				<td><input size=60 name="data[User][username]" id="username"  
				class="input1"
				onblur="this.className='input1 validate[required] minSize[4] ajax[ajaxNameCallPhp]'" 
				onfocus="this.className='input1-bor validate[required] '" />
				</td>
				</tr>
				<tr>
				<td><font class="en1">Email:</font> </td>
				<td><input size=60 name="data[User][Email]" id="email"  class="input1 validate[required,custom[email]]" 
				onblur="this.className='input1 validate[required,custom[email],ajax[ajaxEmailCall]]'" onfocus="this.className='input1-bor validate[required,custom[email]]'" />
				</td>
				</tr>
				<tr>
				<td><font class="en1">Password:</font> </td>
				<td><input size=60  name="data[User][password]" id="password" type="password" class="input1 validate[required, minSize[6]]" onblur="this.className='input1 validate[required, minSize[6]]'" onfocus="this.className='input1-bor validate[required, minSize[6]]'" />
				</td>
				</tr>
				<tr>
				<td><font class="en1">Retype Pwd:</font> </td>
				<td><input size=60  id="retype"  class="input1 validate[equals[password]]" type="password" onblur="this.className='input1 validate[equals[password]]'" onfocus="this.className='input1-bor validate[equals[password]]'" />
				</td>
				</tr>
				<tr>
				<td><font class="en1">First Name:</font> </td>
				<td><input size=60 name="data[User][first_name]" id="first_name"  class="input1 validate[required]" onblur="this.className='input1 validate[required]'" onfocus="this.className='input1-bor validate[required]'" />
				</td>
				</tr>
				<tr>
				<td><font class="en1">Last Name:</font> </td>
				<td><input size=60 name="data[User][last_name]" id="last_name"  class="input1 validate[required]" onblur="this.className='input1 validate[required]'" onfocus="this.className='input1-bor validate[required]'" />
				</td>
				</tr>
			
				<tr>
				<td><font class="en1"></font> </td>
				<td>  <a class="cakeButton" id="reply_cancel_button" onclick="javascript:goback()">Cancel</a> <input type="submit" value="submit" id="submit" class="cakeButton" />
				</td>
				</tr>
				<input name="info" value="9" hidden	>
					
				</table>
	</form>
	
	
</div>



<script>
// Call ValidationEngine here
		jQuery(document).ready(function(){
			// binds form submission and fields to the validation engine
			jQuery("#UserRegisterForm").validationEngine();
			
						
			
		});
		/**
		*
		* @param {jqObject} the field where the validation applies
		* @param {Array[String]} validation rules for this field
		* @param {int} rule index
		* @param {Map} form options
		* @return an error string if validation failed
		*/
		function checkHELLO(field, rules, i, options){
			if (field.val() != "HELLO") {
				// this allows to use i18 for the error msgs
				return options.allrules.validate2fields.alertText;
			}
		}
	
</script>
<script>
function goback( ){
	//e.preventDefault();
	window.location.href="/<?=$site_url?>";
	
}
</script>




