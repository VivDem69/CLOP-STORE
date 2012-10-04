<?php /* Smarty version Smarty-3.0.7, created on 2012-10-03 17:59:33
         compiled from "C:\xampp\htdocs\clopstore/themes/prestashop/footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12894506c60e529a0e2-46170424%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '711c86f552dc8b32c29dde15bc58007be15cdd93' => 
    array (
      0 => 'C:\\xampp\\htdocs\\clopstore/themes/prestashop/footer.tpl',
      1 => 1328107369,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12894506c60e529a0e2-46170424',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>


		<?php if (!$_smarty_tpl->getVariable('content_only')->value){?>
				</div>

<!-- Right -->
				<div id="right_column" class="column">
					<?php echo $_smarty_tpl->getVariable('HOOK_RIGHT_COLUMN')->value;?>

				</div>
			</div>

<!-- Footer -->
			<div id="footer"><?php echo $_smarty_tpl->getVariable('HOOK_FOOTER')->value;?>
</div>
		</div>
	<?php }?>
	</body>
</html>
