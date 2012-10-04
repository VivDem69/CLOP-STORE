<?php /* Smarty version Smarty-3.0.7, created on 2012-10-03 18:04:35
         compiled from "C:\xampp\htdocs\clopstore/modules/prestaloveeasymenu/prestaloveeasymenu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:22887506c6213237b63-20713390%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '06bb0d02165b7d3bcc81d3f3072984e998f073d4' => 
    array (
      0 => 'C:\\xampp\\htdocs\\clopstore/modules/prestaloveeasymenu/prestaloveeasymenu.tpl',
      1 => 1349280189,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '22887506c6213237b63-20713390',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
        <!-- Menu -->
        <?php if ($_smarty_tpl->getVariable('MENU')->value!=''){?> 
			<div id="lof-prestalove-easy-menu">
				<div class="prestalove-easy-menu">
					<a href="javascript:void(0)" class="lof-menu-title" style="display: none"><?php echo smartyTranslate(array('s'=>'Menu','mod'=>'prestakiveeasymenu'),$_smarty_tpl);?>
</a>
					<?php echo $_smarty_tpl->getVariable('MENU')->value;?>

					<?php echo $_smarty_tpl->getVariable('MENU_RESPONSIVE')->value;?>

				</div>
			</div>
		<!--/ Menu -->
        <?php }?>	
        