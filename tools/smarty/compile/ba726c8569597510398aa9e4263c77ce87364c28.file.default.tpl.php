<?php /* Smarty version Smarty-3.0.7, created on 2012-10-03 18:04:35
         compiled from "C:\xampp\htdocs\clopstore/modules/lofcamera/themes/default/default.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8980506c62133ebab4-52364632%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ba726c8569597510398aa9e4263c77ce87364c28' => 
    array (
      0 => 'C:\\xampp\\htdocs\\clopstore/modules/lofcamera/themes/default/default.tpl',
      1 => 1349280190,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8980506c62133ebab4-52364632',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="lofcamera_container" style="<?php echo $_smarty_tpl->getVariable('container_style')->value;?>
">
    <?php if ($_smarty_tpl->getVariable('lofcameraParams')->value['showTitle']){?>
        <h4><?php echo $_smarty_tpl->getVariable('lofcameraParams')->value['title'];?>
</h4>
    <?php }?>  
    <div class="camera_wrap <?php echo $_smarty_tpl->getVariable('lofcameraParams')->value['skin'];?>
" id="<?php echo $_smarty_tpl->getVariable('hookname')->value;?>
"  >
        <?php  $_smarty_tpl->tpl_vars['img'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('images')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['img']->key => $_smarty_tpl->tpl_vars['img']->value){
?>
            <div data-thumb="<?php echo $_smarty_tpl->getVariable('thumb_uri')->value;?>
<?php echo $_smarty_tpl->tpl_vars['img']->value['name'];?>
" data-src="<?php echo $_smarty_tpl->getVariable('image_uri')->value;?>
<?php echo $_smarty_tpl->tpl_vars['img']->value['name'];?>
" >
                <?php if ($_smarty_tpl->tpl_vars['img']->value['title']&&$_smarty_tpl->getVariable('lofcameraParams')->value['showDesc']){?>                            
                    <div class="camera_caption fadeFromBottom" >             
                        <div class="lof_camera_title" >
                            <?php if ($_smarty_tpl->getVariable('lofcameraParams')->value['showLink']&&$_smarty_tpl->tpl_vars['img']->value['link']){?>
                                <a href="<?php echo $_smarty_tpl->tpl_vars['img']->value['link'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['img']->value['title'];?>
" <?php if ($_smarty_tpl->getVariable('lofcameraParams')->value['noFollow']){?>rel="nofollow"<?php }?> ><?php echo $_smarty_tpl->tpl_vars['img']->value['title'];?>
</a>
                            <?php }else{ ?>
                                <?php echo $_smarty_tpl->tpl_vars['img']->value['title'];?>

                            <?php }?>                            
                        </div>
						<?php if ($_smarty_tpl->tpl_vars['img']->value['price']){?>
                                <div class="lof_price"><?php echo $_smarty_tpl->tpl_vars['img']->value['price'];?>
</div>
                        <?php }?>
                        <div class="lof_camara_desc">
                            <?php echo $_smarty_tpl->tpl_vars['img']->value['desc'];?>

                        </div>
						<div class="lof_detail">
						<a href="<?php echo $_smarty_tpl->tpl_vars['img']->value['link'];?>
"> <?php echo smartyTranslate(array('s'=>'view product','mod'=>'lofcamera'),$_smarty_tpl);?>
 </a>
						</div>
                    </div>
                <?php }?>
            </div>
        <?php }} ?>    
    </div>
</div>