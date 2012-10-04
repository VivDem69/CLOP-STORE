<?php /* Smarty version Smarty-3.0.7, created on 2012-10-03 18:04:35
         compiled from "C:\xampp\htdocs\clopstore\modules\lofnewproduct/tmpl/_item/newproduct.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9475506c62138c5653-34554788%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '64370d36056b1e2854a048015df2eba78cabbd6a' => 
    array (
      0 => 'C:\\xampp\\htdocs\\clopstore\\modules\\lofnewproduct/tmpl/_item/newproduct.tpl',
      1 => 1349280192,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9475506c62138c5653-34554788',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include 'C:\xampp\htdocs\clopstore\tools\smarty\plugins\modifier.escape.php';
?>    <?php if ($_smarty_tpl->getVariable('showTips')->value=='lof-tipbox'){?>
    <script type="text/javascript">
    /* <![CDATA[ */
    	jQuery(document).ready(function($) {
    		$(".lof-box-tools-featured .product_label").hover(function() {
    			$(".lof-box-tools-featured .product_label").removeClass("open");
    			$(this).removeClass("opacize").addClass("open");
    		}, function () {
    			$(this).removeClass("open");			
    		});	
    		$(".lof-box-tools-featured .product_label .close").click(function() {
    			$(this).parents(".product_label").removeClass("open");
    			$(".lof-box-tools-featured .product_label").removeClass("opacize");
    		});
    	});
    /* ]]> */
    </script>
    <?php }?>
    <?php if ((count($_smarty_tpl->getVariable('listloffeatureds')->value)>$_smarty_tpl->getVariable('countitemperpage')->value)){?>
    <script type="text/javascript">            
    	jQuery(document).ready(function() {	
    		jQuery("#lof-content-main-featured-<?php echo $_smarty_tpl->getVariable('moduleId')->value;?>
").SliderNew({
                prevId: 'lof-prev-new-<?php echo $_smarty_tpl->getVariable('moduleId')->value;?>
',         			 
                nextId: 'lof-next-new-<?php echo $_smarty_tpl->getVariable('moduleId')->value;?>
',
                catId: 'featured',
                numeric: <?php echo $_smarty_tpl->getVariable('controls_btn_show')->value;?>
,
                totalPage: <?php echo $_smarty_tpl->getVariable('hlofmissitem')->value;?>
,
                moduleTheme: '<?php echo $_smarty_tpl->getVariable('theme')->value;?>
',
    			auto: <?php echo $_smarty_tpl->getVariable('autoPlay')->value;?>
,
    			widthPage: <?php echo $_smarty_tpl->getVariable('module_width')->value;?>
,
    			speed: <?php echo $_smarty_tpl->getVariable('speed')->value;?>
,
    			continuous: true,
    			controlsShow: true
    		});
            
            <?php if ($_smarty_tpl->getVariable('showButton')->value=='0'){?>
                $('.lofcontrol').css('display','none');
                $('.lofbtnextpre').css('display','none');
            <?php }?>
            
    	});	
    </script>
    <?php }?>
    
    <div id="lof-tabs-<?php echo $_smarty_tpl->getVariable('moduleId')->value;?>
-featured" class="lof-content-tab lof-content-tab-<?php echo $_smarty_tpl->getVariable('moduleId')->value;?>
">
        <div class="lof-container" id="lof-content-main-featured-<?php echo $_smarty_tpl->getVariable('moduleId')->value;?>
"  style="width:<?php echo $_smarty_tpl->getVariable('module_width')->value-10;?>
px;">
        <?php if ((!empty($_smarty_tpl->getVariable('loflistFeatureds',null,true,false)->value[0]))){?>
            <ul class="lof-content-main">
                    <?php  $_smarty_tpl->tpl_vars['lists'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('loflistFeatureds')->value[0]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['lists']->key => $_smarty_tpl->tpl_vars['lists']->value){
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['lists']->key;
?>                        
                    <li class="lof-main-item" style="width:<?php echo $_smarty_tpl->getVariable('module_width')->value-20;?>
px;">
                            <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['lists']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['i']->value = $_smarty_tpl->tpl_vars['item']->key;
?>                             
                            <div class="lof-content-main-item <?php if (($_smarty_tpl->tpl_vars['i']->value+1)%$_smarty_tpl->getVariable('limitnumcols')->value==0){?>lastitem<?php }?>"  style="width:<?php echo $_smarty_tpl->getVariable('itemWidth')->value;?>
%">
                                <div class="bd-lof-content ajax_block_product clearfix" style="text-align:center;margin:0 auto;">
                                    <?php if ($_smarty_tpl->getVariable('showImage')->value==1){?>
                                        <div class="lof-box-tools-featured lof-box-tools">
                                            <div class="product_label lof-tool-item lof-tool-item-<?php echo $_smarty_tpl->getVariable('moduleId')->value;?>
" style="height:<?php echo $_smarty_tpl->getVariable('thumbmainHeight')->value;?>
px;width:<?php echo $_smarty_tpl->getVariable('thumbmainWidth')->value;?>
px;">
                                                <?php if ($_smarty_tpl->tpl_vars['item']->value['lof_online_only_icon']!=''&&$_smarty_tpl->getVariable('onlineIcon')->value==1){?>
                                                <div class="<?php echo $_smarty_tpl->tpl_vars['item']->value['lof_online_only_icon'];?>
">&nbsp;</div>
                                                <?php }?>
                                                <?php if ($_smarty_tpl->tpl_vars['item']->value['lof_sale_icon']!=''&&$_smarty_tpl->getVariable('saleIcon')->value==1){?>
                                                <div class="<?php echo $_smarty_tpl->tpl_vars['item']->value['lof_sale_icon'];?>
">&nbsp;</div>
                                                <?php }?>
                                                <?php if ($_smarty_tpl->tpl_vars['item']->value['lof_new_icon']!=''&&$_smarty_tpl->getVariable('newIcon')->value==1){?>
                                                <div class="<?php echo $_smarty_tpl->tpl_vars['item']->value['lof_new_icon'];?>
">&nbsp;</div>
                                                <?php }?>
                                                <?php if ($_smarty_tpl->tpl_vars['item']->value['lof_features']!=''&&$_smarty_tpl->getVariable('featureIcon')->value==1){?>
                                                <div class="<?php echo $_smarty_tpl->tpl_vars['item']->value['lof_features'];?>
">&nbsp;</div>
                                                <?php }?>
                    							<a href="<?php echo $_smarty_tpl->tpl_vars['item']->value['link'];?>
" target="<?php echo $_smarty_tpl->getVariable('target')->value;?>
" class="product_img_link product_image"><img src="<?php echo $_smarty_tpl->tpl_vars['item']->value['mainImge'];?>
" alt="" /></a>
                                                <?php if (($_smarty_tpl->getVariable('showTips')->value=="lof-tipbox")){?>
                                                <div class="lof-content-tools-text">
                                                    <h4><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</h4>
                                                    <div class="box-price">
                                                        <span class="lof-price"><b><?php echo $_smarty_tpl->tpl_vars['item']->value['price'];?>
</b></span>
                                                        <?php if ((($_smarty_tpl->tpl_vars['item']->value['reduction'])!=($_smarty_tpl->tpl_vars['item']->value['price']))&&($_smarty_tpl->getVariable('priceSpecial')->value==1)){?>&nbsp;&nbsp;<span class="lof-price-discount"><?php echo Product::displayWtPrice(array('p'=>$_smarty_tpl->tpl_vars['item']->value['price_without_reduction']),$_smarty_tpl);?>
</span><?php }?>
                                                    </div>
                                                    <div class="box-detail"><a href="<?php echo $_smarty_tpl->tpl_vars['item']->value['link'];?>
"><?php echo smartyTranslate(array('s'=>'Detail','mod'=>'lofnewproduct'),$_smarty_tpl);?>
</a></div>
                                                    <span class="close"></span>
                                                </div>
                                                <?php }?>
                    						</div>
                                        </div>
                                        <?php if ((($_smarty_tpl->getVariable('showTips')->value=="lof-tooltip")&&($_smarty_tpl->getVariable('checkversion')->value>=1.4))){?>
                                        <div class="tooltip">
                                            <div style="position: relative;background: #FFFFFF;width:430px;height: 200px;">
                                                <div style="position: relative;width:430px;height: 200px;overflow: hidden;">
                                                <span class="lof-tooltip-image"><a href="<?php echo $_smarty_tpl->tpl_vars['item']->value['link'];?>
" target="<?php echo $_smarty_tpl->getVariable('target')->value;?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['item']->value['thumbImge'];?>
" alt="" style="height:100%;"/></a></span>
                                                </div>
                                                <div class="lof-tools-opacity" style="width:100%;">
                                                    <h4><a href="<?php echo $_smarty_tpl->tpl_vars['item']->value['link'];?>
" target="<?php echo $_smarty_tpl->getVariable('target')->value;?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</a></h4>
                                                </div>
                                            </div>
                                        </div>
                                        <?php }?>
                                    <?php }?>
                                   <div class="lof-item-content">
                                        <?php if (($_smarty_tpl->getVariable('showTitle')->value==1)){?><h4><a href="<?php echo $_smarty_tpl->tpl_vars['item']->value['link'];?>
" target="<?php echo $_smarty_tpl->getVariable('target')->value;?>
"><?php echo smarty_modifier_escape(smarty_modifier_truncate($_smarty_tpl->tpl_vars['item']->value['name'],20,'...'),'htmlall','UTF-8');?>
</a></h4><?php }?>
                                        <?php if (($_smarty_tpl->getVariable('showPuplic')->value==1)){?>
                                        <span style="color: #333333;font-size:11px;font-style: italic;">
                                            <?php echo $_smarty_tpl->tpl_vars['item']->value['dateAdd'];?>

                                        </span>
                                        <?php }?>
                                        <?php if ($_smarty_tpl->getVariable('showDesc')->value=='1'){?>
                                        <p class="lof-des">
                                            <?php echo $_smarty_tpl->tpl_vars['item']->value['description'];?>

                                        </p>
                                        <?php }?>
										  
										<?php if (($_smarty_tpl->getVariable('showPrice')->value==1)){?>
                                        <span class="lof-price-contain">
                                            <span class="lof-price"><strong><?php echo $_smarty_tpl->tpl_vars['item']->value['price'];?>
</strong></span>
                            			</span>
										<?php }?>
										 <a class="view" href="<?php echo $_smarty_tpl->tpl_vars['item']->value['link'];?>
"><?php echo smartyTranslate(array('s'=>'Detail','mod'=>'lofnewproduct'),$_smarty_tpl);?>
</a>
										<?php if ((($_smarty_tpl->tpl_vars['item']->value['quantity']>0||$_smarty_tpl->tpl_vars['item']->value['allow_oosp']))){?>
                                        <a class="lof-add-cart ajax_add_to_cart_button" rel="ajax_id_product_<?php echo $_smarty_tpl->tpl_vars['item']->value['id_product'];?>
" href="<?php echo $_smarty_tpl->getVariable('site_url')->value;?>
cart.php?add&amp;id_product=<?php echo $_smarty_tpl->tpl_vars['item']->value['id_product'];?>
&amp;token=<?php echo $_smarty_tpl->getVariable('token')->value;?>
"><span><?php echo smartyTranslate(array('s'=>'Add to cart','mod'=>'lofnewproduct'),$_smarty_tpl);?>
</span></a>
                                        <?php }else{ ?>
                                            <span class="lof-add-cart"><?php echo smartyTranslate(array('s'=>'Add to cart','mod'=>'lofnewproduct'),$_smarty_tpl);?>
</span></a>
                                        <?php }?>
										<div class="lofbottom">&nbsp;</div>
                                   </div>
								   
                                  
                                   
                                </div>
                            </div>
                            <?php if ((($_smarty_tpl->tpl_vars['i']->value+1)%$_smarty_tpl->getVariable('limitnumcols')->value==0&&$_smarty_tpl->tpl_vars['i']->value<count($_smarty_tpl->tpl_vars['lists']->value)-1)){?>
                            <div class="clr clearfix"></div>
                            <?php }?>
                        <?php }} ?>
                        <div class="clr clearfix"></div>
                    </li>
                    <?php }} ?>
            </ul>
            <?php }else{ ?>
            <div><?php echo smartyTranslate(array('s'=>'Has not products featured','mod'=>'lofnewproduct'),$_smarty_tpl);?>
</div>
            <div class="clr clearfix"></div>
        <?php }?>
        </div>
    </div>