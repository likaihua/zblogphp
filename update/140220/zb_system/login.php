<?php
require './function/c_system_base.php';

$zbp->CheckGzip();
$zbp->Load();

?><!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php if(strpos(GetVars('HTTP_USER_AGENT','SERVERS'),'MSIE')){?>
	<meta http-equiv="X-UA-Compatible" content="IE=EDGE" />
<?php }?>
	<meta name="robots" content="none" />
	<meta name="generator" content="<?php echo $option['ZC_BLOG_PRODUCT_FULL']?>" />
	<link rel="stylesheet" href="css/admin.css" type="text/css" media="screen" />
	<script src="script/common.js" type="text/javascript"></script>
	<script src="script/md5.js" type="text/javascript"></script>
	<script src="script/c_admin_js_add.php" type="text/javascript"></script>
	<title><?php echo $blogname . '-' . $lang['msg']['login']?></title>
<?php

foreach ($GLOBALS['Filter_Plugin_Login_Header'] as $fpname => &$fpsignal) {$fpname();}

?>
</head>
<body>
<div class="bg">
<div id="wrapper">
  <div class="logo"><img src="image/admin/none.gif" title="Z-BlogPHP" alt="Z-BlogPHP"/></div>
  <div class="login">
    <form method="post" action="#">
    <dl>
      <dt></dt>
      <dd class="username"><label for="edtUserName"><?php echo $lang['msg']['username']?>:</label><input type="text" id="edtUserName" name="edtUserName" size="20" value="<?php echo GetVars('username','COOKIE')?>" tabindex="1" /></dd>
      <dd class="password"><label for="edtPassWord"><?php echo $lang['msg']['password']?>:</label><input type="password" id="edtPassWord" name="edtPassWord" size="20" tabindex="2" /></dd>
    </dl>
    <dl>
      <dt></dt>
      <dd class="checkbox"><input type="checkbox" name="chkRemember" id="chkRemember"  tabindex="3" /><label for="chkRemember"><?php echo $lang['msg']['stay_signed_in']?></label></dd>
      <dd class="submit"><input id="btnPost" name="btnPost" type="submit" value="<?php echo $lang['msg']['login']?>" class="button" tabindex="4"/></dd>
    </dl>
	<input type="hidden" name="username" id="username" value="" />
	<input type="hidden" name="password" id="password" value="" />
	<input type="hidden" name="savedate" id="savedate" value="0" />
    </form>
  </div>
</div>
</div>

<script type="text/javascript">

$("#btnPost").click(function(){

	var strUserName=$("#edtUserName").val();
	var strPassWord=$("#edtPassWord").val();
	var strSaveDate=$("#savedate").val()

	if((strUserName=="")||(strPassWord=="")){
		alert("<?php echo $lang['error']['66']?>");
		return false;
	}

	$("#edtUserName").remove();
	$("#edtPassWord").remove();

	strUserName=strUserName;
	strPassWord=MD5(strPassWord);

	$("form").attr("action","cmd.php?act=verify");
	$("#username").val(strUserName);
	$("#password").val(strPassWord);
	$("#savedate").val(strSaveDate);
})

$(document).ready(function(){
	if (!$.support.leadingWhitespace) {
		alert("<?php echo $lang['error']['74']?>");
	}
});

$("#chkRemember").click(function(){
	$("#savedate").attr("value",$("#chkRemember").attr("checked")=="checked"?30:0);
})
</script>
</body>
</html>
<?php

RunTime();
?>