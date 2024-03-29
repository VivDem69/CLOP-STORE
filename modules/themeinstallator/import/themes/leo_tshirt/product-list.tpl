{*
* 2007-2011 PrestaShop 
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2011 PrestaShop SA
*  @version  Release: $Revision: 1.4 $
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}

{if isset($products)}
	<!-- Products list -->
	
	{assign var='liHeight' value=342}
			{assign var='nbItemsPerLine' value=3}
			{assign var='nbLi' value=$products|@count}
			{math equation="nbLi/nbItemsPerLine" nbLi=$nbLi nbItemsPerLine=$nbItemsPerLine assign=nbLines}
			{math equation="nbLines*liHeight" nbLines=$nbLines|ceil liHeight=$liHeight assign=ulHeight}
			<ul id="product_list" class="clear">
			{foreach from=$products item=product name=products}
				<li class="ajax_block_product {if $smarty.foreach.products.first}first_item{elseif $smarty.foreach.products.last}last_item{else}item{/if} {if $smarty.foreach.products.iteration%$nbItemsPerLine == 0}last_item_of_line{elseif $smarty.foreach.products.iteration%$nbItemsPerLine == 1}clear{/if} {if $smarty.foreach.products.iteration > ($smarty.foreach.products.total - ($smarty.foreach.products.total % $nbItemsPerLine))}last_line{/if}">
          <div class="prod_list_cont">
 			
            <div class="clear"></div>
			<div class="center_block">
            <div class="lof-product">
				<a href="{$product.link|escape:'htmlall':'UTF-8'}" class="product_img_link" title="{$product.name|escape:'htmlall':'UTF-8'}"><img src="{$link->getImageLink($product.link_rewrite, $product.id_image, 'home')}" alt="{$product.legend|escape:'htmlall':'UTF-8'}"  /></a>
            </div>
               
			</div>	
            {if isset($product.online_only) && $product.online_only}<br /><span class="online_only">{l s='Online only!'}</span>{/if}
			<div class="right_block">
			  <h3><a href="{$product.link|escape:'htmlall':'UTF-8'}" title="{$product.name|escape:'htmlall':'UTF-8'}">{$product.name|truncate:20:'...'|escape:'htmlall':'UTF-8'}</a></h3>
				<p class="product_desc">{$product.description_short|truncate:360:'...'|strip_tags:'UTF-8'}</p>
				 {if (!$PS_CATALOG_MODE AND ((isset($product.show_price) && $product.show_price) || (isset($product.available_for_order) && $product.available_for_order)))}
				{if isset($product.on_sale) && $product.on_sale && isset($product.show_price) && $product.show_price && !$PS_CATALOG_MODE}<span class="on_sale">{l s='On sale!'}></span>
				{elseif isset($product.reduction) && $product.reduction && isset($product.show_price) && $product.show_price && !$PS_CATALOG_MODE}<span class="discount">{l s='Reduced price!'}</span>{/if}
					{if isset($product.show_price) && $product.show_price && !isset($restricted_country_mode)}<span class="price lof-price-fix" style="display: inline;">{if !$priceDisplay}{convertPrice price=$product.price}{else}{convertPrice price=$product.price_tax_exc}{/if}</span>{/if}
					<!---{if isset($product.available_for_order) && $product.available_for_order && !isset($restricted_country_mode)}<span class="availability">{if ($product.allow_oosp || $product.quantity > 0)}{l s='Available'}{elseif (isset($product.quantity_all_versions) && $product.quantity_all_versions > 0)}{l s='Product available with different options'}{else}{l s='Out of stock'}{/if}</span>{/if}--->
				
				{/if}
				
                
				
				
				<!--- <a class="button" href="{$product.link|escape:'htmlall':'UTF-8'}" title="{l s='View'}">{l s='View'}</a> --->
               
				
                
                
                {if isset($comparator_max_item) && $comparator_max_item}
					<p class="compare"><input type="checkbox" onclick="checkForComparison({$comparator_max_item})" class="comparator" id="comparator_item_{$product.id_product}" value="{$product.id_product}" /> <label for="comparator_item_{$product.id_product}">{l s='Compare'}</label></p>
				{/if}	
				{if ($product.id_product_attribute == 0 || (isset($add_prod_display) && ($add_prod_display == 1))) && $product.available_for_order && !isset($restricted_country_mode) && !$PS_CATALOG_MODE}
					{if ($product.allow_oosp || $product.quantity > 0) && $product.customizable != 2}
						<a class="lof-add-cart button ajax_add_to_cart_button exclusive" rel="ajax_id_product_{$product.id_product|intval}" href="{$link->getPageLink('cart.php')}?add&amp;id_product={$product.id_product|intval}{if isset($static_token)}&amp;token={$static_token}{/if}" title="{l s='Add to cart'}"><span>{l s='Add to cart'}</span></a>
					{else}
							<span class="exclusive">{l s='Add to cart'}</span>
					{/if}
				{/if}
				<div class="lofbottom">&nbsp;</div>	
			</div>
   <div class="clear"></div>
      
      </div>
		</li>
	{/foreach}
	</ul>
	<!-- /Products list -->
{/if}
