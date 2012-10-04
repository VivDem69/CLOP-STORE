<?php /* Smarty version Smarty-3.0.7, created on 2012-10-03 18:04:35
         compiled from "C:\xampp\htdocs\clopstore/modules/lofnewsletter/lofnewsletter.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4793506c6213ee47f5-93160489%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5e297e2c5517aa864b47565de6e3ee258765397b' => 
    array (
      0 => 'C:\\xampp\\htdocs\\clopstore/modules/lofnewsletter/lofnewsletter.tpl',
      1 => 1349280189,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4793506c6213ee47f5-93160489',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>


<!-- Block LofNewsletter module-->

<div id="newsletter_block_left" class="block">
	<h4><?php echo smartyTranslate(array('s'=>'Newsletter','mod'=>'lofnewsletter'),$_smarty_tpl);?>
</h4>
	<div class="block_content">
	<?php if (isset($_smarty_tpl->getVariable('msg',null,true,false)->value)&&$_smarty_tpl->getVariable('msg')->value){?>
		<p class="<?php if ($_smarty_tpl->getVariable('nw_error')->value){?>warning_inline<?php }else{ ?>success_inline<?php }?>"><?php echo $_smarty_tpl->getVariable('msg')->value;?>
</p>
	<?php }?>
		<form action="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('index.php');?>
" method="post">
			<p><input type="text" name="email" size="18" value="<?php if (isset($_smarty_tpl->getVariable('value',null,true,false)->value)&&$_smarty_tpl->getVariable('value')->value){?><?php echo $_smarty_tpl->getVariable('value')->value;?>
<?php }else{ ?><?php echo smartyTranslate(array('s'=>'your e-mail','mod'=>'lofnewsletter'),$_smarty_tpl);?>
<?php }?>" onfocus="javascript:if(this.value=='<?php echo smartyTranslate(array('s'=>'your e-mail','mod'=>'lofnewsletter'),$_smarty_tpl);?>
')this.value='';" onblur="javascript:if(this.value=='')this.value='<?php echo smartyTranslate(array('s'=>'your e-mail','mod'=>'lofnewsletter'),$_smarty_tpl);?>
';" /></p>
			<p>
				<select name="action">
					<option value="0"<?php if (isset($_smarty_tpl->getVariable('action',null,true,false)->value)&&$_smarty_tpl->getVariable('action')->value==0){?> selected="selected"<?php }?>><?php echo smartyTranslate(array('s'=>'Subscribe','mod'=>'lofnewsletter'),$_smarty_tpl);?>
</option>
					<option value="1"<?php if (isset($_smarty_tpl->getVariable('action',null,true,false)->value)&&$_smarty_tpl->getVariable('action')->value==1){?> selected="selected"<?php }?>><?php echo smartyTranslate(array('s'=>'Unsubscribe','mod'=>'lofnewsletter'),$_smarty_tpl);?>
</option>
				</select>
				<input type="submit" value="ok" class="button_mini" name="submitNewsletter" />
			</p>
		</form>
	</div>
</div>

<!-- /Block Newsletter module-->
