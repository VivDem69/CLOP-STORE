<ul class='lof-sliding-featured lof-sliding-featured-same-{$moduleId} {$spushscroll}'>
    {foreach from=$listproducts key=i item=row}
	<li class="{if (($i+1)%$smaxItemsPerRow==0)}classborder{else}classno{/if}"> 
		<div class="lof-sliding-feature-same lof-sliding-feature-same-{$moduleId}"> 
			<div class="sliding-feature-shot" style="width:{$sthumbnailWidth}px;height:{$sthumbnailHeight}px;"> 
				<div class="sliding-feature-same-content sliding-feature-same-content-{$moduleId}" style="{$smarginLeft};width:{$sthumbnailWidth*2}px;height:{$sthumbnailHeight*2}px;"> 
					{if $sblockUp == 1}
                        {include file="$slidingSameImage"}
                    {/if}
					<div class="sliding-feature-over" style="{$sfloatRight}width:{$sthumbnailWidth}px;height:{$sthumbnailHeight-5}px;">
						<div class="center">
							{if $sshowSubTitle}<strong class="same-title"><a href="{$row.link}" target="{$stargetlink}">{$row.subtitle}</a></strong>{/if} 
                            {if $sshowPrice}
                            <span class="dim lof-price-contain">
                                <span class="lof-price"><b>{if $source=="product"}{$row.price}{else}{displayWtPrice p=$row.price}{/if}</b></span>
                                {if (($row.price_lof_reduction) != ($row.price)) AND ($row.price_lof_reduction != "") AND ($spriceReduction == 1)}&nbsp;&nbsp;<span class="lof-price-discount">{displayWtPrice p=$row.price_without_reduction}</span>{/if}
                            </span>
                            {/if}
                            {if $source == "product" AND $sitemDateCreated == 1}<em class="lof-date-carousel">{$row.date_add|date_format:"%Y-%m-%d"}</em>{/if}
                            {if $sshowSubDesc}<span class="sliding-desc">{$row.subdescription}</span>{/if}
						</div>
                        {if $sshowReadmore}
                        <a href="{$row.link}" target="{$stargetlink}" class="sliding-detail" title="{$row.name}">{l s='Detail' mod='lofsliding'}</a>
                        {/if}
                        {if $source == "product"}
                            {if (($row.quantity > 0 OR $row.allow_oosp))}
                            <a class="lof-add-cart ajax_add_to_cart_button lof-add-cart-detail" rel="ajax_id_product_{$row.id_product}" href="{$site_url}cart.php?add&amp;id_product={$row.id_product}&amp;token={$token}"><span>{l s='Cart' mod='lofsliding'}</span></a>
                            {else}
                                <span class="lof-add-cart lof-add-cart-none lof-add-cart-detail">{l s='Cart' mod='lofsliding'}</span>
                            {/if}
                        {/if}
                         		
					</div>
                    {if $sblockDown == 1}
                        {include file="$slidingSameImage"}
                    {/if}
				</div><!-- Sliding feature img -->
                
			</div><!-- Sliding feature shot -->
            <div class="lof-shadow" style="width:{$sthumbnailWidth+13}px;"></div>
		</div><!-- Sliding feature -->
	</li>
    {if ($i+1)%$smaxItemsPerRow==0 AND $i<count($listproducts)-1}
	<div class="clearfix"></div>
    {/if}
    {/foreach}
</ul>