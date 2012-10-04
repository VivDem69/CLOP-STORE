<!-- Block user information module HEADER -->

<div id="lof_header_user">
	<div id="lof_wrraper">
	<!--- LOGIN - REGISTER BLOCK --->
	<div id="lof_header_user_info">
        <ul>
            <li>
            {if $cookie->isLogged()}
                <a class="lof_btnsignin" href="{$link->getPageLink('index.php')}?mylogout" title="{l s='Log me out' mod='lofuserinfo'}"><span>{l s='Log Out' mod='lofuserinfo'}&nbsp;&nbsp;&nbsp;/</span></a>
            {else}
                <a class="lof_btnsignin" href="{$link->getPageLink('my-account.php', true)}"><span>{l s='Login' mod='lofuserinfo'}&nbsp;&nbsp;&nbsp;/</span></a> 
            {/if}
            	<div class="lof_container_signin lof_popup">
                  		<div class="lof_wrapper">
                          {if !$cookie->isLogged()}
                         <form action="{$link->getPageLink('authentication.php', true)}" method="post" id="loflogin_form" class="lof-form">
                                <fieldset>
      
                                    <p class="text">
                                        <label for="email">{l s='E-mail address'}</label><br />
                                        <span><input type="text" id="email" name="email" value="{if isset($smarty.post.email)}{$smarty.post.email|escape:'htmlall':'UTF-8'|stripslashes}{/if}" class="account_input" /></span>
                                    </p>
                                    <p class="text">
                                        <label for="passwd">{l s='Password'}</label>
                                        <span><input type="password" id="passwd" name="passwd" value="{if isset($smarty.post.passwd)}{$smarty.post.passwd|escape:'htmlall':'UTF-8'|stripslashes}{/if}" class="account_input" /></span>
                                    </p>
                                    <p class="submit">
                                        {if isset($back)}<input type="hidden" class="hidden" name="back" value="{$back|escape:'htmlall':'UTF-8'}" />{/if}
                                        <input type="submit" id="SubmitLogin" name="SubmitLogin" class="button" value="{l s='Log in'}" />
                                    </p>
                                    <p class="lost_password"><a href="{$link->getPageLink('password.php')}">{l s='Forgot your password?'}</a></p>
                                </fieldset>
                            </form>	
                              {else}
                                  <p class="lof_greeting"> 	{l s='Welcome' mod='blockuserinfo'}, <span>{$cookie->customer_firstname} {$cookie->customer_lastname}</span> (<a   href="{$link->getPageLink('index.php')}?mylogout" title="{l s='Log me out' mod='lofuserinfo'}"><span>{l s='Log out' mod='lofuserinfo'}</span></a>)
                                	</p>
                                {/if}
                   		 </div>
                  </div>
            </li>
            
            {if !$cookie->isLogged() &&  !isset($email_create)}
              <li>
                  <a  class="lof_btnregister" href="{$link->getPageLink('my-account.php', true)}"><span>{l s='Register' mod='lofuserinfo'}</span></a>
                  
                  <div class="lof_container_register lof_popup">
                        <div class="lof_wrapper">
                                <form action="{$link->getPageLink('authentication.php', true)}" method="post" id="lof_create-account_form" class="std">
                                        <fieldset>
                                            <h3>{l s='Create your account'}</h3>
                                            <h4>{l s='Enter your e-mail address to create an account'}.</h4>
                                            <p class="text">
                                                <label for="email_create">{l s='E-mail address'}</label><br />
                                                <span><input type="text" id="email_create" name="email_create" value="{if isset($smarty.post.email_create)}{$smarty.post.email_create|escape:'htmlall':'UTF-8'|stripslashes}{/if}" class="account_input" /></span>
                                            </p>
                                            <p class="submit">
                                            {if isset($back)}<input type="hidden" class="hidden" name="back" value="{$back|escape:'htmlall':'UTF-8'}" />{/if}
                                                <input type="submit" id="SubmitCreate" name="SubmitCreate" class="button_large" value="{l s='Create your account'}" />
                                                <input type="hidden" class="hidden" name="SubmitCreate" value="{l s='Create your account'}" />
                                            </p>
                                        </fieldset>
                                    </form>
     
                        </div>
                  </div>
           	 </li>
			{else}
			<li>
				<a href="{$link->getPageLink('my-account.php', true)}" class="lof_btnaccount" title="{l s='Your Account' mod='lofuserinfo'}"><span>{l s='Your Account' mod='lofuserinfo'}</span></a>
			</li>
            {/if}
        </ul>
	</div>
    <!--- END OF LOGIN - REGISTER BLOCK --->
   	<div id="lof_header_cart"> 
    	<ul>
            <li>
            	<span class="header">{l s='Shopping Cart' mod='lofuserinfo'}</span>
                		{if !$PS_CATALOG_MODE}
                           <span id="shopping_cart">
                                <span class="ajax_cart_quantity ">{$cart_qties}</span>
                                <span class="ajax_cart_product_txt{if $cart_qties == 1 || $cart_qties == 0} hidden{/if}">{l s='product' mod='lofuserinfo'}</span>
                                <span class="ajax_cart_product_txt_s{if $cart_qties < 2} hidden{/if}">{l s='products' mod='lofuserinfo'}</span>
                                {if $cart_qties >= 0} 
                                	{l s='Total :' mod='lofuserinfo'}
                                    <span class="ajax_cart_total{if $cart_qties == 0} hidden{/if}"> 
                                        {if $priceDisplay == 1}
                                            {assign var='blockuser_cart_flag' value='Cart::BOTH_WITHOUT_SHIPPING'|constant}
                                            {convertPrice price=$cart->getOrderTotal(false, $blockuser_cart_flag)}
                                        {else}
                                            {assign var='blockuser_cart_flag' value='Cart::BOTH_WITHOUT_SHIPPING'|constant}
                                            {convertPrice price=$cart->getOrderTotal(true, $blockuser_cart_flag)}
                                        {/if}
                                    </span>
                                {/if}
                                <span class="ajax_cart_no_product{if $cart_qties > 0} hidden{/if}">{l s='empty' mod='lofuserinfo'}</span>
                               
                            </span> 
                             <span class="buy_product"><a class="btnshowcart" href="{$link->getPageLink('order.php', true)}">{l s='Go to cart' mod='lofuserinfo'}</a></span>
                          {/if}
                <div class="lof_container_cart lof_popup">
                	   <div class="lof_wrapper">
         					
<script type="text/javascript">
var CUSTOMIZE_TEXTFIELD = {$CUSTOMIZE_TEXTFIELD};
var customizationIdMessage = '{l s='Customization #' mod='blockcart' js=1}';
var removingLinkText = '{l s='remove this product from my cart' mod='blockcart' js=1}';
</script>

<!-- MODULE Block cart -->
<div id="cart_block" class="{if isset($simple_effect_on)&& $simple_effect_on==1}overlay{/if}">
	
	<div class="block_content">
	<!-- block summary -->
	
	<!-- block list of products -->
	<div id="cart_block_list" >
	{if $products}
		<dl class="products">
		{foreach from=$products item='product' name='myLoop'}
			{assign var='productId' value=$product.id_product}
			{assign var='productAttributeId' value=$product.id_product_attribute}
			<dt id="cart_block_product_{$product.id_product}{if $product.id_product_attribute}_{$product.id_product_attribute}{/if}" class="{if $smarty.foreach.myLoop.first}first_item{elseif $smarty.foreach.myLoop.last}last_item{else}item{/if}">
				<span class="quantity-formated"><span class="quantity">{$product.cart_quantity}</span>x</span>
				<a class="cart_block_product_name" href="{$link->getProductLink($product.id_product, $product.link_rewrite, $product.category)}" title="{$product.name|escape:html:'UTF-8'}">{t text=$product.name length='10' encode='true'}</a>
				<span class="remove_link">{if !isset($customizedDatas.$productId.$productAttributeId)}<a rel="nofollow" class="ajax_cart_block_remove_link" href="{$link->getPageLink('cart.php')}?delete&amp;id_product={$product.id_product}&amp;ipa={$product.id_product_attribute}&amp;token={$static_token}" title="{l s='remove this product from my cart' mod='blockcart'}">&nbsp;</a>{/if}</span>
				<span class="price">{if $priceDisplay == $smarty.const.PS_TAX_EXC}{displayWtPrice p="`$product.total`"}{else}{displayWtPrice p="`$product.total_wt`"}{/if}</span>
			</dt>
			{if isset($product.attributes_small)}
			<dd id="cart_block_combination_of_{$product.id_product}{if $product.id_product_attribute}_{$product.id_product_attribute}{/if}" class="{if $smarty.foreach.myLoop.first}first_item{elseif $smarty.foreach.myLoop.last}last_item{else}item{/if}">
				<a href="{$link->getProductLink($product.id_product, $product.link_rewrite, $product.category)}" title="{l s='Product detail'}">{$product.attributes_small}</a>
			{/if}

			<!-- Customizable datas -->
			{if isset($customizedDatas.$productId.$productAttributeId)}
				{if !isset($product.attributes_small)}<dd id="cart_block_combination_of_{$product.id_product}{if $product.id_product_attribute}_{$product.id_product_attribute}{/if}" class="{if $smarty.foreach.myLoop.first}first_item{elseif $smarty.foreach.myLoop.last}last_item{else}item{/if}">{/if}
				<ul class="cart_block_customizations" id="customization_{$productId}_{$productAttributeId}">
					{foreach from=$customizedDatas.$productId.$productAttributeId key='id_customization' item='customization' name='customizations'}
						<li name="customization">
							<div class="deleteCustomizableProduct" id="deleteCustomizableProduct_{$id_customization|intval}_{$product.id_product|intval}_{$product.id_product_attribute|intval}"><a class="ajax_cart_block_remove_link" href="{$link->getPageLink('cart.php')}?delete&amp;id_product={$product.id_product|intval}&amp;ipa={$product.id_product_attribute|intval}&amp;id_customization={$id_customization}&amp;token={$static_token}"> </a></div>
							<span class="quantity-formated"><span class="quantity">{$customization.quantity}</span>x</span>{if isset($customization.datas.$CUSTOMIZE_TEXTFIELD.0)}{t text=$customization.datas.$CUSTOMIZE_TEXTFIELD.0.value|replace:"<br />":" " length='28' encode='true'}
							{else}
							{l s='Customization #' mod='blockcart'}{$id_customization|intval}{l s=':' mod='blockcart'}
							{/if}
						</li>
					{/foreach}
				</ul>
				{if !isset($product.attributes_small)}</dd>{/if}
			{/if}

			{if isset($product.attributes_small)}</dd>{/if}

		{/foreach}
		</dl>
	{/if}
		<p {if $products}class="hidden"{/if} id="cart_block_no_products">{l s='No products' mod='blockcart'}</p>

		{if $discounts|@count > 0}<table id="vouchers">
			<tbody>
			{foreach from=$discounts item=discount}
				<tr class="bloc_cart_voucher" id="bloc_cart_voucher_{$discount.id_discount}">
					<td class="name" title="{$discount.description}">{$discount.name|cat:' : '|cat:$discount.description|truncate:18:'...'|escape:'htmlall':'UTF-8'}</td>
					<td class="price">-{if $discount.value_real != '!'}{if $priceDisplay == 1}{convertPrice price=$discount.value_tax_exc}{else}{convertPrice price=$discount.value_real}{/if}{/if}</td>
					<td class="delete"><a href="{$link->getPageLink("$order_process.php", true)}?deleteDiscount={$discount.id_discount}" title="{l s='Delete'}"><img src="{$img_dir}icon/delete.gif" alt="{l s='Delete'}" width="11" height="13" class="icon" /></a></td>
				</tr>
			{/foreach}
			</tbody>
		</table>
		{/if}

		<p id="cart-prices">
			<span>{l s='Shipping' mod='blockcart'}</span>
			<span id="cart_block_shipping_cost" class="price ajax_cart_shipping_cost">{$shipping_cost}</span>
			<br/>
			{if $show_wrapping}
				{assign var='blockcart_cart_flag' value='Cart::ONLY_WRAPPING'|constant}
				<span>{l s='Wrapping' mod='blockcart'}</span>
				<span id="cart_block_wrapping_cost" class="price cart_block_wrapping_cost">{if $priceDisplay == 1}{convertPrice price=$cart->getOrderTotal(false, $blockcart_cart_flag)}{else}{convertPrice price=$cart->getOrderTotal(true, $blockcart_cart_flag)}{/if}</span>
				<br/>
			{/if}
			{if $show_tax && isset($tax_cost)}
				<span>{l s='Tax' mod='blockcart'}</span>
				<span id="cart_block_tax_cost" class="price ajax_cart_tax_cost">{$tax_cost}</span>
				<br/>
			{/if}
			<span>{l s='Total' mod='blockcart'}</span>
			<span id="cart_block_total" class="price ajax_block_cart_total">{$total}</span>
		</p>
		{if $use_taxes}
			{if $priceDisplay == 0}
				<p id="cart-price-precisions">
					{l s='Prices are tax included' mod='blockcart'}
				</p>
			{/if}
			{if $priceDisplay == 1}
				<p id="cart-price-precisions">
					{l s='Prices are tax excluded' mod='blockcart'}
				</p>
			{/if}
		{/if}
		<p id="cart-buttons">
			{if $order_process == 'order'}<a href="{$link->getPageLink("$order_process.php", true)}" class="button_small" title="{l s='Cart' mod='blockcart'}">{l s='Cart' mod='blockcart'}</a>{/if}
			<a href="{$link->getPageLink("$order_process.php", true)}{if $order_process == 'order'}?step=1{/if}" id="button_order_cart" class="exclusive{if $order_process == 'order-opc'}_large{/if}" title="{l s='Check out' mod='blockcart'}">{l s='Check out' mod='blockcart'}</a>
		</p>
	</div>
	</div>
</div>
<!-- /MODULE Block cart -->


 
                     	</div>   
                  </div>  
             </li>
        </ul>    
    </div>
	</div>	
</div>

<!-- /Block user information module HEADER -->
