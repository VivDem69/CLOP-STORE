<?php /* Smarty version Smarty-3.0.7, created on 2012-10-03 18:12:32
         compiled from "C:\xampp\htdocs\clopstore/themes/leo_tshirt/modules/lofadvancecustom/tmpl/default/default.tpl" */ ?>
<?php /*%%SmartyHeaderCode:5072506c63f0588138-83947275%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '024263bbaade53e8dc5e2004409a6cf75db93b19' => 
    array (
      0 => 'C:\\xampp\\htdocs\\clopstore/themes/leo_tshirt/modules/lofadvancecustom/tmpl/default/default.tpl',
      1 => 1349280130,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5072506c63f0588138-83947275',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div style="clear:both"></div>
<div id="lofadvafooter<?php echo $_smarty_tpl->getVariable('pos')->value;?>
" class="lofadvafooter">
	<?php  $_smarty_tpl->tpl_vars['blocks'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key_pos'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('lofpositions')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['blocks']->key => $_smarty_tpl->tpl_vars['blocks']->value){
 $_smarty_tpl->tpl_vars['key_pos']->value = $_smarty_tpl->tpl_vars['blocks']->key;
?>
		<div id="lofadva-pos-<?php echo $_smarty_tpl->tpl_vars['key_pos']->value+1;?>
" class="lof-position" style="width:100%">
			<div class="lof-position-wrap">
			<?php  $_smarty_tpl->tpl_vars['block'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key_block'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['blocks']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['block']->key => $_smarty_tpl->tpl_vars['block']->value){
 $_smarty_tpl->tpl_vars['key_block']->value = $_smarty_tpl->tpl_vars['block']->key;
?>
				<div id="lofadva-block-<?php echo $_smarty_tpl->tpl_vars['key_block']->value+1;?>
" class="lof-block" style="width:<?php echo $_smarty_tpl->tpl_vars['block']->value['width'];?>
%; float:left;">
					<div class="lof-block-wrap">
						<?php if ($_smarty_tpl->tpl_vars['block']->value['show_title']){?>
							<h2><span><?php echo $_smarty_tpl->tpl_vars['block']->value['title'];?>
</span></h2>
						<?php }?>
						<ul class="lof-items">
						<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key_item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['block']->value['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['key_item']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
							<?php if ($_smarty_tpl->tpl_vars['item']->value['type']=='link'){?>
								<li class="link"><a href="<?php echo $_smarty_tpl->tpl_vars['item']->value['link_item'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['item']->value['title'];?>
" target="<?php echo $_smarty_tpl->tpl_vars['item']->value['target'];?>
" <?php if ($_smarty_tpl->tpl_vars['item']->value['target']=='_newwithout'){?>onclick='javascript: window.open("<?php echo $_smarty_tpl->tpl_vars['item']->value['link_item'];?>
", "", "toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes"); return false;'<?php }?>><?php if ($_smarty_tpl->tpl_vars['item']->value['show_title']){?><?php echo $_smarty_tpl->tpl_vars['item']->value['title'];?>
<?php }?></a></li>
							<?php }elseif($_smarty_tpl->tpl_vars['item']->value['type']=='module'){?>
								<li class="lof-module">
									<?php if ($_smarty_tpl->tpl_vars['item']->value['show_title']){?><h2><?php echo $_smarty_tpl->tpl_vars['item']->value['title'];?>
</h2><?php }?>
									<?php echo $_smarty_tpl->tpl_vars['item']->value['module'];?>

								</li>
							<?php }elseif($_smarty_tpl->tpl_vars['item']->value['type']=='custom_html'){?>
								<li class="lof-text">
									<?php if ($_smarty_tpl->tpl_vars['item']->value['show_title']){?><h2><span><?php echo $_smarty_tpl->tpl_vars['item']->value['title'];?>
</span></h2><?php }?>
									<?php echo $_smarty_tpl->tpl_vars['item']->value['text'];?>

								</li>
							<?php }elseif($_smarty_tpl->tpl_vars['item']->value['type']=='gmap'){?>
								<li class="lof-gmap">
									<?php if ($_smarty_tpl->tpl_vars['item']->value['show_title']){?><h2><?php echo $_smarty_tpl->tpl_vars['item']->value['title'];?>
</h2><?php }?>
									
									<script type="text/javascript">
									  function initialize() {
										  var myOptions = {
											zoom: 8,
											center: new google.maps.LatLng(<?php echo $_smarty_tpl->tpl_vars['item']->value['latitude'];?>
, <?php echo $_smarty_tpl->tpl_vars['item']->value['longitude'];?>
),
											mapTypeId: google.maps.MapTypeId.ROADMAP
										  }
										  var map = new google.maps.Map(document.getElementById("lofmap_canvas<?php echo $_smarty_tpl->tpl_vars['item']->value['id_loffc_block_item'];?>
"), myOptions);
										}
										function loadScript() {
										  var script = document.createElement("script");
										  script.type = "text/javascript";
										  script.src = "http://maps.googleapis.com/maps/api/js?key=AIzaSyCgnzQHpG4TAVJJAFgEp6u1arCQ3dlwVB8&sensor=true&callback=initialize";
										  document.body.appendChild(script);
										}
										window.onload = loadScript;
									</script>
									
									<div id="lofmap_canvas<?php echo $_smarty_tpl->tpl_vars['item']->value['id_loffc_block_item'];?>
" class="lofmap_canvas"></div>
								</li>
							<?php }elseif($_smarty_tpl->tpl_vars['item']->value['type']=='addthis'){?>
								<li class="lof-addthis">
									<?php if ($_smarty_tpl->tpl_vars['item']->value['show_title']){?><h2><?php echo $_smarty_tpl->tpl_vars['item']->value['title'];?>
</h2><?php }?>
									<div class="addthis_toolbox addthis_default_style ">
										<a class="addthis_button_preferred_1"></a>
										<a class="addthis_button_preferred_2"></a>
										<a class="addthis_button_preferred_3"></a>
										<a class="addthis_button_preferred_4"></a>
										<a class="addthis_button_compact"></a>
										<a class="addthis_counter addthis_bubble_style"></a>
									</div>
									
									<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
									<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4fc893c046e9bd1b"></script>
									
								</li>
							<?php }?>
						<?php }} ?>
						</ul>
					</div>
				</div>
			<?php }} ?>
			<div style="clear:both;"></div>
			</div>
		</div>
	<?php }} ?>
</div>