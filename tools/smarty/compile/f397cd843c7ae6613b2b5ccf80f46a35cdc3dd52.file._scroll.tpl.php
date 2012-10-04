<?php /* Smarty version Smarty-3.0.7, created on 2012-10-03 18:12:32
         compiled from "C:\xampp\htdocs\clopstore/themes/leo_tshirt/modules/loftwitter/tmpl/default/_scroll.tpl" */ ?>
<?php /*%%SmartyHeaderCode:26515506c63f050a842-02860084%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f397cd843c7ae6613b2b5ccf80f46a35cdc3dd52' => 
    array (
      0 => 'C:\\xampp\\htdocs\\clopstore/themes/leo_tshirt/modules/loftwitter/tmpl/default/_scroll.tpl',
      1 => 1349280132,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '26515506c63f050a842-02860084',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="twitter-ticker" id="twitter-ticker1" style="width:<?php echo $_smarty_tpl->getVariable('moduleWidth')->value;?>
; height:<?php echo $_smarty_tpl->getVariable('moduleHeight')->value;?>
;display: block;">
	<div class="top-bar">
		<h2 class="tut"><span><?php echo $_smarty_tpl->getVariable('title')->value;?>
</span></h2>
	</div>
	
	<div id="lof_twitter<?php echo $_smarty_tpl->getVariable('prfSlide')->value;?>
<?php echo $_smarty_tpl->getVariable('blockid')->value;?>
" class="tweet-container" style="width:260px;height:360px;"></div>
	<div id="scroll"></div>
</div>