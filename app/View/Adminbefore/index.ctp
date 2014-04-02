admin page





<div class="admin_wrapper">
	

	<div class="admin_login_div">
		<div style="text-align:center;" ><img src="/<?=Configure::read('site_name')?>/zzz/picture/logo/skull_logo_original.png" /></div>
			<form action="/<?= Configure::read('site_name')?>/adminbefore/loginCheck" id="" method="post" accept-charset="utf-8">
					<table cellspacing=2 cellpadding=0 width=300 border=0 style="padding:30px;" >
					<tr>
					<td><font class="en1">管理员:</font> </td>
					<td><input size=60 name="data[Admin][username]" id="username"  
					class="input1"
					onblur="this.className='input1'" 
					onfocus="this.className='input1-bor'" />
					</td>
					</tr>
					<tr>
					<td><font class="en1">密码:</font> </td>
					<td><input size=60 name="data[Admin][password]" id="password"  type="password"
					class="input1"
					onblur="this.className='input1" 
					onfocus="this.className='input1-bor'" />
					</td>
					</tr>
					<tr>
					<td><font class="en1"></font> </td>
					<td> <input type="submit" value="登陆" id="submit" class="" />
					</td>
					</tr>
					
						
					</table>
			</form>
	

	</div>

</div>