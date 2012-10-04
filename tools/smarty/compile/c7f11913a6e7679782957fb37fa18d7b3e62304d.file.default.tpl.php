<?php /* Smarty version Smarty-3.0.7, created on 2012-10-03 18:04:35
         compiled from "C:\xampp\htdocs\clopstore/modules/lofnewproduct/tmpl/default.tpl" */ ?>
<?php /*%%SmartyHeaderCode:434506c62136fde24-62226760%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c7f11913a6e7679782957fb37fa18d7b3e62304d' => 
    array (
      0 => 'C:\\xampp\\htdocs\\clopstore/modules/lofnewproduct/tmpl/default.tpl',
      1 => 1349280192,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '434506c62136fde24-62226760',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="clearfix clear clr"></div>
<div class="lof-module-newproduct <?php echo $_smarty_tpl->getVariable('theme')->value;?>
 lof-tabs-<?php echo $_smarty_tpl->getVariable('lofiso_code')->value;?>
 clearfix" style="width:<?php echo $_smarty_tpl->getVariable('moduleWidth')->value;?>
px;height:<?php echo $_smarty_tpl->getVariable('moduleHeight')->value;?>
">
    <div id="lof-tabnews-module-<?php echo $_smarty_tpl->getVariable('moduleId')->value;?>
" style="width:100%;">
        <?php if (($_smarty_tpl->getVariable('showTips')->value=="lof-tooltip")&&($_smarty_tpl->getVariable('checkversion')->value>=1.4)){?>
            <script type="text/javascript">  
                jQuery(document).ready(function() {
            		jQuery(".lof-tool-item-<?php echo $_smarty_tpl->getVariable('moduleId')->value;?>
").tooltip({ 
            			effect: 'slide',
            			offset: [0, 2],
            			onBeforeShow:	function(event, position) {
            			                this.getTip().appendTo(document.body);
                                        return true;}}
            		).dynamic({ bottom: { direction: 'down', bounce: true }});
                });
            </script>
        <?php }?>
        <div class="lof-tabnews-panel">
         	<ul class="tabs-panel tabs-panel-<?php echo $_smarty_tpl->getVariable('moduleId')->value;?>
">
                <?php if (($_smarty_tpl->getVariable('featuredTab')->value==1)){?>
                <li class="lof-tab">
                    <div class="bg-tabs-left-bd">
                        <a href="#lof-tabs-<?php echo $_smarty_tpl->getVariable('moduleId')->value;?>
-featured">
                            <span class="bg-tabs-left">
                                <span class="bg-tabs-middle"><?php echo smartyTranslate(array('s'=>'New ','mod'=>'lofnewproduct'),$_smarty_tpl);?>
</span>
								 <span class="bg-tabs-middle-right"><?php echo smartyTranslate(array('s'=>'Products','mod'=>'lofnewproduct'),$_smarty_tpl);?>
</span>
                            </span>
                        </a>
                    </div>
                </li>    
                <?php }?>
        	</ul>
        </div>
        <div class="lof-tabnews-content">
            <?php if ($_smarty_tpl->getVariable('featuredTab')->value==1){?>           
                <?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('featuredUrlLayouts')->value), $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
            <?php }?>
        </div>
        <div class="clr clearfix"></div>
    </div>
</div>
 <script type="text/javascript">
// <![CDATA[
	// we hide the tree only if JavaScript is activated
    jQuery(document).ready(function() {
           jQuery("#lof-tabnews-module-<?php echo $_smarty_tpl->getVariable('moduleId')->value;?>
").tabs({
    	       positionActive: <?php echo $_smarty_tpl->getVariable('posActive')->value;?>
,
    	       moduleId: '<?php echo $_smarty_tpl->getVariable('moduleId')->value;?>
',
               continuous: false
	   });
     });
    
// ]]>
</script>   
