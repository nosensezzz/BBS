<?php


	$this->extend('/forum/template');
	
	$this->start( 'main' );
?>
<div class="wrapper_2">
<div class="inner_wrapper" >
	<div class="user_edit_div">
		User Info Edit
		
		<div class="edit_form">
			<form action="/bbs_example/user/user_edit/<?= $user['id']?>"  enctype="multipart/form-data"  id="UserEditForm" method="post" accept-charset="utf-8">
			<table cellspacing=2 cellpadding=0 width=300 border=0>
				<tr>
				<td><font class="en1">Avatar:</font> </td>
				<td>
				<?php	if( empty($user['avatar'])  ):  ?>
				<img src="/<?=Configure::read('site_name')?>/zzz/avatar/1.jpg" height=100px width=100px id="user_avatar" />
				<?php	else:  ?>
				<img src="/<?=Configure::read('site_name')?>/zzz/picture/user/<?= $user['id']?>/<?= $user['avatar']?>" height=100px  width=100px id="user_avatar" />
				<?php  endif;  ?>
				<input id="file_upload" name="file_upload" type="file" multiple="true">
				</td>
				</tr>
				<tr>
				<td><font class="en1">Username:</font> </td>
				<td><input size=60 name="data[User][username]" id="username" 
				value="<?=$user['username']?>"
				class="input1"
				onblur="this.className='input1 validate[required] minSize[4] ajax[ajaxEditCall]'" 
				onfocus="this.className='input1-bor validate[required] '" />
				</td>
				</tr>
				<tr>
				<td><font class="en1">Email:</font> </td>
				<td><input size=60 <input name="data[User][Email]" value="<?= $user['Email']?>" id="email"  class="input1 validate[required,custom[email]]" 
				onblur="this.className='input1 validate[required,custom[email],ajax[ajaxEditCall]]'" onfocus="this.className='input1-bor validate[required,custom[email]]'" />
				</td>
				</tr>
				<tr>
				<td><font class="en1">First Name:</font> </td>
				<td><input size=60 name="data[User][first_name]" value="<?= $user['first_name']?>"  id="first_name"  class="input1 validate[required]" onblur="this.className='input1 validate[required]'" onfocus="this.className='input1-bor validate[required]'" />
				</td>
				</tr>
				<tr>
				<td><font class="en1">Last Name:</font> </td>
				<td><input size=60 name="data[User][last_name]" value="<?= $user['last_name']?>" id="last_name"  class="input1 validate[required]" onblur="this.className='input1 validate[required]'" onfocus="this.className='input1-bor validate[required]'" />
				</td>
				</tr>
				<tr>
				<td><font class="en1">New Password:</font>
				<td><input size=60 name="data[User][password]" id="password" type="password" disabled class="input1 validate[required, minSize[6]]" onblur="this.className='input1 validate[required, minSize[6]]'" onfocus="this.className='input1-bor validate[required, minSize[6]]'" />
				<input id="PwdSwitch" type="checkbox" onclick="javascript:changePwd( )" value="1" name="pwd" /></td>
				</td>
				</tr>
				<tr>
				<td><font class="en1">Retype Pwd:</font> </td>
				<td><input size=60  id="retype"  class="input1 validate[equals[password]]" disabled type="password" onblur="this.className='input1 validate[equals[password]]'" onfocus="this.className='input1-bor validate[equals[password]]'" />
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
</div>
<script>
function changePwd(){
	  if($("#PwdSwitch").is(":checked")){
		$('#password').removeAttr("disabled");
		$('#retype').removeAttr("disabled");	
	  }else{
		$('#password').attr("disabled" , true);
		$('#retype').attr("disabled" , true);
		$('#password').val("");
		$('#retype').val("");
		$('.passwordformError').click();
		$('.retypeformError').click();
			}
}

function goback(){
	window.location.href="/bbs_example/forum";
}
</script>
<script>
function avatarChange(){
	//$("#picture").addClass('validate[ajax[ajaxAvatarCall]]');
}
</script>
<script>
// Call ValidationEngine here
		jQuery(document).ready(function(){
			// binds form submission and fields to the validation engine
			jQuery("#UserEditForm").validationEngine();
			
						
			
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

<script type="text/javascript">
		<?php $timestamp = time();?>
		$(function() {
			$('#file_upload').uploadify({
				'formData'     : {
					'timestamp' : '<?php echo $timestamp;?>',
					'token'     : '<?php echo md5('unique_salt' . $timestamp);?>'
				},
				'swf'      : '/<?= Configure::read('site_name') ?>/zzz/uploadify/uploadify.swf',
				'uploader' : '/<?= Configure::read('site_name') ?>/user/avatarCheck',
				'script'   : '/<?= Configure::read('site_name') ?>/zzz/uploadify/uploadify.php',
				'fileTypeDesc':'File Type: ',
				'fileTypeExts':'*.jpg;*.jpge;*.gif;*.png',
				'fileSizeLimit':'3MB',
				'onSelect' : function(file) {
                  
				},
				 'onSelectError':function(file, errorCode, errorMsg){
						switch(errorCode) {
							case -100:
								alert("too many files, "+$('#file_upload').uploadify('settings','queueSizeLimit')+" only.");
								break;
							case -110:
								alert("file ["+file.name+"] over "+$('#file_upload').uploadify('settings','fileSizeLimit')+"limit!");
								break;
							case -120:
								alert("file ["+file.name+"] size wrong!");
								break;
							case -130:
								alert("file ["+file.name+"] type wrong!");
								break;
						}
				},
				'onFallback':function(){
					alert("need install flash add");
				},
					//上传到服务器，服务器返回相应信息到data里
					'onUploadSuccess':function(file, data, response){
					}
				});
		});
	</script>

<?php
	$this->end( 'main' );
?>