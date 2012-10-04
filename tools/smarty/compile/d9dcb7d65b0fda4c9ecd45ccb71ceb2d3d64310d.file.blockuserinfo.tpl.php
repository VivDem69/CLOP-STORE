<?php /* Smarty version Smarty-3.0.7, created on 2012-10-03 18:12:30
         compiled from "C:\xampp\htdocs\clopstore/themes/leo_tshirt/modules/blockuserinfo/blockuserinfo.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17151506c63eed05391-09722278%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd9dcb7d65b0fda4c9ecd45ccb71ceb2d3d64310d' => 
    array (
      0 => 'C:\\xampp\\htdocs\\clopstore/themes/leo_tshirt/modules/blockuserinfo/blockuserinfo.tpl',
      1 => 1349280130,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17151506c63eed05391-09722278',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>


<!-- Block user information module HEADER -->
<div id="header_user">

	<p id="header_user_info">		
		<?php if ($_smarty_tpl->getVariable('cookie')->value->isLogged()){?>
			<?php echo smartyTranslate(array('s'=>'Welcome','mod'=>'blockuserinfo'),$_smarty_tpl);?>
,
			<span><?php echo $_smarty_tpl->getVariable('cookie')->value->customer_firstname;?>
 <?php echo $_smarty_tpl->getVariable('cookie')->value->customer_lastname;?>
</span>
			(<a class="logout" href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('index.php');?>
?mylogout" title="<?php echo smartyTranslate(array('s'=>'Log me out','mod'=>'blockuserinfo'),$_smarty_tpl);?>
"><?php echo smartyTranslate(array('s'=>'Log out','mod'=>'blockuserinfo'),$_smarty_tpl);?>
</a>)
		<?php }else{ ?>
			<a href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('my-account.php',true);?>
"><?php echo smartyTranslate(array('s'=>'Log in','mod'=>'blockuserinfo'),$_smarty_tpl);?>
</a>
			<a href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('my-account.php',true);?>
"><?php echo smartyTranslate(array('s'=>'Register','mod'=>'blockuserinfo'),$_smarty_tpl);?>
</a>
			<a href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('mywishlist.php',true);?>
"><?php echo smartyTranslate(array('s'=>'My Wishlist','mod'=>'blockuserinfo'),$_smarty_tpl);?>
</a>
			<a class="Shoppingcart" href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('order.php?step=1',true);?>
"><?php echo smartyTranslate(array('s'=>'Shopping cart','mod'=>'blockuserinfo'),$_smarty_tpl);?>
</a>
		<?php }?>
	</p>
	<ul id="header_nav" style="display:none;">
		<?php if (!$_smarty_tpl->getVariable('PS_CATALOG_MODE')->value){?>
		<li id="shopping_cart">
			<a href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink(($_smarty_tpl->getVariable('order_process')->value).".php",true);?>
" title="<?php echo smartyTranslate(array('s'=>'Your Shopping Cart','mod'=>'blockuserinfo'),$_smarty_tpl);?>
"><?php echo smartyTranslate(array('s'=>'Cart:','mod'=>'blockuserinfo'),$_smarty_tpl);?>
</a>
			<span class="ajax_cart_quantity<?php if ($_smarty_tpl->getVariable('cart_qties')->value==0){?> hidden<?php }?>"><?php echo $_smarty_tpl->getVariable('cart_qties')->value;?>
</span>
			<span class="ajax_cart_product_txt<?php if ($_smarty_tpl->getVariable('cart_qties')->value!=1){?> hidden<?php }?>"><?php echo smartyTranslate(array('s'=>'product','mod'=>'blockuserinfo'),$_smarty_tpl);?>
</span>
			<span class="ajax_cart_product_txt_s<?php if ($_smarty_tpl->getVariable('cart_qties')->value<2){?> hidden<?php }?>"><?php echo smartyTranslate(array('s'=>'products','mod'=>'blockuserinfo'),$_smarty_tpl);?>
</span>
			<?php if ($_smarty_tpl->getVariable('cart_qties')->value>=0){?>
				<span class="ajax_cart_total<?php if ($_smarty_tpl->getVariable('cart_qties')->value==0){?> hidden<?php }?>">
					<?php if ($_smarty_tpl->getVariable('priceDisplay')->value==1){?>
						<?php $_smarty_tpl->tpl_vars['blockuser_cart_flag'] = new Smarty_variable(constant('Cart::BOTH_WITHOUT_SHIPPING'), null, null);?>
						<?php echo Product::convertPrice(array('price'=>$_smarty_tpl->getVariable('cart')->value->getOrderTotal(false,$_smarty_tpl->getVariable('blockuser_cart_flag')->value)),$_smarty_tpl);?>

					<?php }else{ ?>
						<?php $_smarty_tpl->tpl_vars['blockuser_cart_flag'] = new Smarty_variable(constant('Cart::BOTH_WITHOUT_SHIPPING'), null, null);?>
						<?php echo Product::convertPrice(array('price'=>$_smarty_tpl->getVariable('cart')->value->getOrderTotal(true,$_smarty_tpl->getVariable('blockuser_cart_flag')->value)),$_smarty_tpl);?>

					<?php }?>
				</span>
			<?php }?>
			<span class="ajax_cart_no_product<?php if ($_smarty_tpl->getVariable('cart_qties')->value>0){?> hidden<?php }?>"><?php echo smartyTranslate(array('s'=>'(empty)','mod'=>'blockuserinfo'),$_smarty_tpl);?>
</span>
		</li>
		<?php }?>		
	</ul>
</div>

<!-- /Block user information module HEADER -->
