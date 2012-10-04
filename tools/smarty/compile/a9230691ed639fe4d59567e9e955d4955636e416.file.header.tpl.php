<?php /* Smarty version Smarty-3.0.7, created on 2012-10-03 18:12:31
         compiled from "C:\xampp\htdocs\clopstore/themes/leo_tshirt/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:30485506c63ef273028-73551676%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a9230691ed639fe4d59567e9e955d4955636e416' => 
    array (
      0 => 'C:\\xampp\\htdocs\\clopstore/themes/leo_tshirt/header.tpl',
      1 => 1349280127,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '30485506c63ef273028-73551676',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include 'C:\xampp\htdocs\clopstore\tools\smarty\plugins\modifier.escape.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $_smarty_tpl->getVariable('lang_iso')->value;?>
">
	<head>
		<title><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('meta_title')->value,'htmlall','UTF-8');?>
</title>
<?php if (isset($_smarty_tpl->getVariable('meta_description',null,true,false)->value)&&$_smarty_tpl->getVariable('meta_description')->value){?>
		<meta name="description" content="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('meta_description')->value,'html','UTF-8');?>
" />
<?php }?>
<?php if (isset($_smarty_tpl->getVariable('meta_keywords',null,true,false)->value)&&$_smarty_tpl->getVariable('meta_keywords')->value){?>
		<meta name="keywords" content="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('meta_keywords')->value,'html','UTF-8');?>
" />
<?php }?>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
		<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
		<meta name="generator" content="PrestaShop" />
		<meta name="robots" content="<?php if (isset($_smarty_tpl->getVariable('nobots',null,true,false)->value)){?>no<?php }?>index,follow" />
		<link rel="icon" type="image/vnd.microsoft.icon" href="<?php echo $_smarty_tpl->getVariable('img_ps_dir')->value;?>
favicon.ico?<?php echo $_smarty_tpl->getVariable('img_update_time')->value;?>
" />
		<link rel="shortcut icon" type="image/x-icon" href="<?php echo $_smarty_tpl->getVariable('img_ps_dir')->value;?>
favicon.ico?<?php echo $_smarty_tpl->getVariable('img_update_time')->value;?>
" />
		<script type="text/javascript">
			var baseDir = '<?php echo $_smarty_tpl->getVariable('content_dir')->value;?>
';
			var static_token = '<?php echo $_smarty_tpl->getVariable('static_token')->value;?>
';
			var token = '<?php echo $_smarty_tpl->getVariable('token')->value;?>
';
			var priceDisplayPrecision = <?php echo $_smarty_tpl->getVariable('priceDisplayPrecision')->value*$_smarty_tpl->getVariable('currency')->value->decimals;?>
;
			var priceDisplayMethod = <?php echo $_smarty_tpl->getVariable('priceDisplay')->value;?>
;
			var roundMode = <?php echo $_smarty_tpl->getVariable('roundMode')->value;?>
;
		</script>
<?php if (isset($_smarty_tpl->getVariable('css_files',null,true,false)->value)){?>
	<?php  $_smarty_tpl->tpl_vars['media'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['css_uri'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('css_files')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['media']->key => $_smarty_tpl->tpl_vars['media']->value){
 $_smarty_tpl->tpl_vars['css_uri']->value = $_smarty_tpl->tpl_vars['media']->key;
?>
	<link href="<?php echo $_smarty_tpl->tpl_vars['css_uri']->value;?>
" rel="stylesheet" type="text/css" media="<?php echo $_smarty_tpl->tpl_vars['media']->value;?>
" />
	<?php }} ?>
<?php }?>
<?php if ($_smarty_tpl->getVariable('LEO_SKIN_DEFAULT')->value&&$_smarty_tpl->getVariable('LEO_SKIN_DEFAULT')->value!="default"){?>
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->getVariable('content_dir')->value;?>
themes/leo_tshirt/skins/<?php echo $_smarty_tpl->getVariable('LEO_SKIN_DEFAULT')->value;?>
/css/skin.css" media="<?php echo $_smarty_tpl->getVariable('media')->value;?>
">
<?php }?>
<?php if ($_smarty_tpl->getVariable('LEO_PANELTOOL')->value){?>
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->getVariable('content_dir')->value;?>
themes/leo_tshirt/css/paneltool.css" media="<?php echo $_smarty_tpl->getVariable('media')->value;?>
">
<?php }?>

<?php if ($_smarty_tpl->getVariable('lang_iso')->value=="fr"){?>
<link href="<?php echo $_smarty_tpl->getVariable('content_dir')->value;?>
themes/leo_stylish/css/fr.css" rel="stylesheet" type="text/css" media="<?php echo $_smarty_tpl->getVariable('media')->value;?>
" />
<?php }?>
<!--[if IE 7]>
		<link href="<?php echo $_smarty_tpl->getVariable('content_dir')->value;?>
themes/leo_tshirt/css/ie7.css" rel="stylesheet" type="text/css" />
<![endif]-->
<?php if (isset($_smarty_tpl->getVariable('js_files',null,true,false)->value)){?>
	<?php  $_smarty_tpl->tpl_vars['js_uri'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('js_files')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['js_uri']->key => $_smarty_tpl->tpl_vars['js_uri']->value){
?>
	<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['js_uri']->value;?>
"></script>
	<?php }} ?>
<?php }?>
		<?php echo $_smarty_tpl->getVariable('HOOK_HEADER')->value;?>

	</head>
	
	<body <?php if ($_smarty_tpl->getVariable('page_name')->value){?>id="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('page_name')->value,'htmlall','UTF-8');?>
"<?php }?>>
	<?php if (isset($_smarty_tpl->getVariable('ad',null,true,false)->value)&&isset($_smarty_tpl->getVariable('live_edit',null,true,false)->value)){?>
		<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('tpl_dir')->value)."./live_edit.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
	<?php }?>
	<?php if (!$_smarty_tpl->getVariable('content_only')->value){?>
		<?php if (isset($_smarty_tpl->getVariable('restricted_country_mode',null,true,false)->value)&&$_smarty_tpl->getVariable('restricted_country_mode')->value){?>
		<div id="restricted-country">
			<p><?php echo smartyTranslate(array('s'=>'You cannot place a new order from your country.'),$_smarty_tpl);?>
 <span class="bold"><?php echo $_smarty_tpl->getVariable('geolocation_country')->value;?>
</span></p>
		</div>
		<?php }?>
        <div id="page">
		
			<!-- Header -->
			<div id="header">
				<div class="leo-wrapper">
					
						<div id="header_right">
						<div id="logo">
							<a id="header_logo" href="<?php echo $_smarty_tpl->getVariable('base_dir')->value;?>
" title="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('shop_name')->value,'htmlall','UTF-8');?>
">
							<img class="logo" src="<?php echo $_smarty_tpl->getVariable('img_ps_dir')->value;?>
logo.jpg?<?php echo $_smarty_tpl->getVariable('img_update_time')->value;?>
" alt="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('shop_name')->value,'htmlall','UTF-8');?>
" <?php if ($_smarty_tpl->getVariable('logo_image_width')->value){?>width="<?php echo $_smarty_tpl->getVariable('logo_image_width')->value;?>
"<?php }?> <?php if ($_smarty_tpl->getVariable('logo_image_height')->value){?>height="<?php echo $_smarty_tpl->getVariable('logo_image_height')->value;?>
" <?php }?> />
							</a>
						</div>
							<?php echo $_smarty_tpl->getVariable('HOOK_TOP')->value;?>

						</div>
					
				</div>
			</div>
		<div id="wrapper_container">
			<div class="leo-wrapper">
				
				<div id="columns" class="layout<?php echo $_smarty_tpl->getVariable('LEO_LAYOUT_DIRECTION')->value;?>
">			
					<!-- Center -->
					<div id="center_column">
		<?php }?>
