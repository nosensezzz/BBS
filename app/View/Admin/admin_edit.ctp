<div class='user_info'>
			<ul class="menu">
			<li class="top"><div class="time_panel" style="margin-left:10px;" ><?= $admin['Admin']['admin']?></div></li>
			<li class="top_right"><a href="/<?= Configure::read('site_name')?>/admin/logout" class="top_link"><span>Logout</span></a></li>
			<li class="top_right"><a href="/<?= Configure::read('site_name')?>/admin/admin_edit" class="top_link"><span>Edit</span></a></li>
			<li class="top_right">
						<div class="time_panel">
						<?php echo date('Y-m-d H:i', time());  ?>
						</div>
			</li>
			</ul>	
</div>	
AdminEdit
<div class="admin_wrapper">
	<?php
		//var_dump($admin);
	?>
		<div class="user_edit_div">
		Admin Info Edit
		
		<div class="edit_form">
			<form action="/bbs_example/admin/admin_edit/<?= $admin['Admin']['id']?>"   id="AdminEditForm" method="post" accept-charset="utf-8">
			<table cellspacing=2 cellpadding=0 width=300 border=0>
				<tr>
				<td><font class="en1">Admin name:</font> </td>
				<td><input size=60 name="data[Admin][admin]" id="username" 
				value="<?=$admin['Admin']['admin']?>"
				class="input1"
				onblur="this.className='input1 validate[required] minSize[4] ajax[ajaxEditCall]'" 
				onfocus="this.className='input1-bor validate[required] '" />
				</td>
				</tr>
				<tr>
				<td><font class="en1">New Password:</font>
				<td><input size=60 name="data[Admin][password]" id="password" type="password" class="input1 validate[required, minSize[6]]" onblur="this.className='input1 validate[required, minSize[6]]'" onfocus="this.className='input1-bor validate[required, minSize[6]]'" />
				<!--input id="PwdSwitch" type="checkbox" onclick="javascript:changePwd( )" value="1" name="pwd" /--></td>
				</td>
				</tr>
				<tr>
				<td><font class="en1">Retype Pwd:</font> </td>
				<td><input size=60  id="retype"  class="input1  validate[equals[password]]" type="password" onblur="this.className='input1 validate[equals[password]]'" onfocus="this.className='input1-bor  validate[equals[password]]'" />
				</td>
				</tr>
				
			
				<tr>
				<td><font class="en1"></font> </td>
				<td>  <a class="cakeButton" id="reply_cancel_button" onclick="javascript:goback()">Cancel</a> <input type="submit" value="submit" id="submit" class="cakeButton" />
				</td>
				</tr>
				
					
				</table>
				
			</form>
		</div>
		
	</div>

</div>

<script>
// Call ValidationEngine here
		jQuery(document).ready(function(){
			// binds form submission and fields to the validation engine
			jQuery("#AdminEditForm").validationEngine();
			
						
			
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
		function goback(){
			window.location.href="/bbs_example/admin";
		}
	
</script>