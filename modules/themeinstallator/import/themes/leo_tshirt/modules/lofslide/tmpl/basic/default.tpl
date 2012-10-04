<!--Start Module-->
<div id="lof-slideshow-md">
<div class="lof_inner">
<div class="lof-module-slideshow {$theme}" style="width:{$moduleWidth}px;height:{$moduleHeight+80}px;margin:0 auto;">
    <div class="lof-slideshow-bd-{$moduleId} lof-slideshow-bd">
        <div class="lofslideshow-container lofslideshow-container-{$moduleId}">
            {if $params->get("publicfixicon","lof-featured-icon") != ""}
            <div class="lof-icon-public {$publicFixIcon}">&nbsp;</div>
            {/if}
            <div id="lof-begin-slide-{$moduleId}" class="lofflexslider" style="width:{$moduleWidth-30}px;">
                <ul class="slides">
                {foreach from=$products item=row}
                    <li style="height:{$thumbmainHeight}px;" class="ajax_product first_item clearfix">
                        {if $row.classicon != '' AND $row.classicon != 'lof-none' AND $showIconItem == 1}
                        <span class="{if $postCaption == "lof-cap-bottom"}{$row.classicon}-bottom{/if}{if $postCaption == "lof-cap-top"}{$row.classicon}{/if}">&nbsp;</span>
                        {/if}
                        <a href="{$row.link}" target="{$target}" title="{$row.name}" class="product_img_link product_image"><img src="{$row.mainImge}" style="height:100%;"/></a>
                        {if $showCaption == 1}
                        {if $postCaption == "lof-cap-top"}
                        {if $row.link != "" OR $row.price != "" OR $row.description != "" OR $row.name != ""}
                        <div class="lof-top-caption lof-top-caption-{$moduleId}" style="width:{$captionWidth}px;">
                            <div class="top-caption-left">
                                <div class="top-caption-right">
                                    <div class="top-caption-middle-top" style="width:{$captionWidth-18}px;">&nbsp;</div>
                                </div>
                            </div>
                            <div class="lof-caption-top-center" style="width:{$captionWidth-20}px;">
                                {if $showTitle == 1}<a href="{$row.link}" target="{$target}" title="{$row.name}" class="lof-title-caption">{$row.name}</a>{/if}
                                <br />
                                
                                {if $showDesc == 1}<span class="lof-slide-desc">{$row.description}</span>{/if}
                                <br />
								
								{if $row.price != ""}
                                <span class="lof-slide-price">({$row.price})</span>
                                <br />
                                {/if}
								
								{if $row.price_without_reduction != ""}
                                <span class="lof-slide-price-discount">({$row.price_without_reduction})</span>
                                <br />
                                {/if}
								
                            </div>
                            {if $viewDetail == 1 AND $row.link != ""}
        					   <a class="lof-button lof-caption-view-top" href="{$row.link}" title="{l s='View' mod='lofslide'}">{l s='View...' mod='lofslide'}</a>
        				    {/if}
                            {if $showAddCart == 1 AND $source == 'product'}
                                {if ($row.quantity > 0 OR $row.allow_oosp)}
                                <a class="button lof-caption-addcart-top ajax_add_to_cart_button exclusive" rel="ajax_id_product_{$row.id_product}" href="{$site_url}cart.php?add&amp;id_product={$row.id_product}&amp;token={$token}" title="{l s='Shop now' mod='lofslide'}">{l s='Shop now' mod='lofslide'}</a>
                                {else}
                                <span class="lof-caption-addcart-top exclusive">{l s='Shop now' mod='lofslide'}</span>
                                {/if}
                            {/if}
                            <div class="bottom-caption-left">
                                <div class="bottom-caption-right">
                                    <div class="bottom-caption-middle-bottom" style="width:{$captionWidth-18}px;">&nbsp;</div>
                                </div>
                            </div>
                        </div>
                        {/if}
                        {/if}
                        {if $postCaption == "lof-cap-bottom"}
                        <p class="lof-caption lof-caption-{$moduleId}">
                            {if $showTitle == 1}<a href="{$row.link}" target="{$target}" title="{$row.name}" class="lof-title-caption">{$row.name}</a>{/if}                            
                            
                            {if $showDesc == 1}<span class="lof-slide-desc">{$row.description}</span>{/if}
                            <br />
							
							{if $row.price_without_reduction != ""}
                            <br />
							<span class="lof-slide-price-discount">${$row.price_without_reduction}</span>
                            {/if}							
							{if $row.price != ""}
                            <span class="lof-slide-price">{$row.price}</span>
                            <br />
                            {/if}							
							
                            {if $showAddCart == 1 AND $source == 'product'}
                                {if ($row.quantity > 0 OR $row.allow_oosp)}
                                <a class="button lof-slideshow-addcart ajax_add_to_cart_button exclusive" rel="ajax_id_product_{$row.id_product}" href="{$site_url}cart.php?add&amp;id_product={$row.id_product}&amp;token={$token}" title="{l s='Shop now' mod='lofslide'}">{l s='Shop now' mod='lofslide'}</a>
                                {else}
                                <span class="lof-slideshow-addcart exclusive">{l s='Shop now' mod='lofslide'}</span>
                                {/if}
                            {/if}
							
							{*
                            {if $viewDetail == 1 AND $row.link != ""}
        					   <a class="lof-button lof-slideshow-view" href="{$row.link}" title="{l s='View' mod='lofslide'}">{l s='View...' mod='lofslide'}</a>
        				    {/if}
							*}
                        </p>
                        {/if}
                        {/if}
                    </li>
                {/foreach}
                </ul>
            </div>
            <div class="lof-panel-nav-{$moduleId} lof-panel-nav" style="width:{$widthTooltip}px;">
                <ol class="lof-control-nav lof-control-nav-{$moduleId}" style="width:{$widthNav}px;">
                    {foreach from=$products item=row}
                    <li>
                        <a href="#" {if $showTooltip == 1 AND $checkVersion >=1.4}class="lof-tool-item-{$moduleId}"{/if}></a>
                        {if $showTooltip == 1 AND $checkVersion >=1.4}
                        <div class="lof-tooltip" style="width:{$widthTooltip}px;">
                            <div class="lof-tooltip-top-right">
                                <div class="lof-tooltip-top-left">
                                    <div class="lof-tooltip-top-middle" style="width:{$widthTooltip-8}px;"></div>
                                </div>
                            </div>
                            <div class="lof-tooltip-middle">
                                <div class="fix-image" style="height:{$thumbnailHeight}px;">
                                    <img src="{$row.thumbImge}"  height="100%" alt="{l s='Images' mod='lofslide'}"  />
                                </div>
                            </div>
                            <div class="lof-tooltip-bottom-right">
                                <div class="lof-tooltip-bottom-left">
                                    <div class="lof-tooltip-bottom-middle" style="width:{$widthTooltip-8}px;"></div>
                                </div>
                            </div>
                            <div class="lof-tooltip-panel">&nbsp;</div>
                        </div>
                        {/if}
                    </li>
                    {/foreach}
                </ol>
            </div>
        </div>    
    </div>
</div>
</div>
</div>
<!--Add Script-->
<!--End Module-->