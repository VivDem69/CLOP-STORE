<?php /* Smarty version Smarty-3.0.7, created on 2012-10-03 18:04:36
         compiled from "C:\xampp\htdocs\clopstore/modules/loftwitter/tmpl/default/_scroll.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1790506c6214189464-84487800%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6697e3b82c1b9d6a5c48e42f7d8cca732252bfff' => 
    array (
      0 => 'C:\\xampp\\htdocs\\clopstore/modules/loftwitter/tmpl/default/_scroll.tpl',
      1 => 1349280191,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1790506c6214189464-84487800',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="twitter-ticker" id="twitter-ticker1" style="width:<?php echo $_smarty_tpl->getVariable('moduleWidth')->value;?>
; height:<?php echo $_smarty_tpl->getVariable('moduleHeight')->value;?>
; margin-top:10px; display: block;">
	<div class="top-bar">
		<div class="twitIcon"><img src="<?php echo $_smarty_tpl->getVariable('site_url')->value;?>
/modules/loftwitter/tmpl/<?php echo $_smarty_tpl->getVariable('theme')->value;?>
/assets/images/twitter_64.png" width="64" height="64" alt="Twitter icon" /></div>
		<h2 class="tut"><?php echo $_smarty_tpl->getVariable('title')->value;?>
</h2>
	</div>
	<div id="lof_twitter<?php echo $_smarty_tpl->getVariable('prfSlide')->value;?>
<?php echo $_smarty_tpl->getVariable('blockid')->value;?>
" class="tweet-container" style="width:300px;height:360px;"></div>
	<div id="scroll"></div>
</div>