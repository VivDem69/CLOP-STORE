<?php /* Smarty version Smarty-3.0.7, created on 2012-10-03 18:12:32
         compiled from "C:\xampp\htdocs\clopstore/themes/leo_tshirt/footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:32713506c63f0758f22-15655704%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '69a0287e6c904c57970320a432de267f5fcc9f70' => 
    array (
      0 => 'C:\\xampp\\htdocs\\clopstore/themes/leo_tshirt/footer.tpl',
      1 => 1349280127,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '32713506c63f0758f22-15655704',
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
			</div>
<!-- Footer -->
			
		</div>
		<div id="footer">
			<div class="leo-wrapper-footer">
				<div class="leo-wrapper">
					<?php echo $_smarty_tpl->getVariable('HOOK_FOOTER')->value;?>

				</div>
			</div>
		</div>
	<?php }?>
    
    <?php if ($_smarty_tpl->getVariable('LEO_PANELTOOL')->value){?>
    	<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('tpl_dir')->value)."./info/paneltool.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
    <?php }?>
	</body>
</html>
