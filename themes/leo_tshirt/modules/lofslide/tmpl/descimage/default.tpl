<!--Start Module-->
{if $total > 0}
<div class="lof-module-slideshow {$theme}" style="width:{$moduleWidth}px;height:{$moduleHeight}px;margin:0 auto;">
    <div class="lof-slideshow-bd-{$moduleId} lof-slideshow-bd" style="height:{$moduleHeight}px;">
        <div class="lofslideshow-container lofslideshow-container-{$moduleId}">
            {if $publicFixIcon != ""}
            <div class="lof-icon-public {$publicFixIcon}">&nbsp;</div>
            {/if}
            <div id="lof-begin-slide-{$moduleId}" class="lofflexslider" style="width:{$moduleWidth-30}px;height:{$moduleHeight-8}px;">
                <ul class="slides">
                {foreach from=$products item=row}
                    <li style="height:100%" class="ajax_product first_item clearfix">
                        <div class="lof-item-main-image" style="width:{$thumbmainWidth}px;height:100%;">
                            {if $row.classicon != '' AND $row.classicon != 'lof-none' AND $showIconItem == 1}
                            <span class="{$row.classicon}">&nbsp;</span>
                            {/if}
                            <a href="{$row.link}" target="{$target}" title="{$row.name}" class="product_img_link product_image"><img src="{$row.mainImge}" /></a>
                        </div>
                        {if $showCaption == 1}
                        <div class="lof-item-main-desc" style="{if $widthDesc <= 0}width:{$widthMainDesc}px;{/if}{if $widthDesc > 0}width:{$widthDesc}px;{/if}height:100%;">
                            {if $showDate == 1 AND $source == 'product'}
                            <span class="lof-slide-date" style="">
                                {$dateSlide}
                            </span>
                            <span class="lof-slides-h-s">//</span>
                            {/if}
                            {if $viewDetail == 1 AND $row.link != ""}
                            <a class="lof-button lof-slideshow-view" style="{if $source == 'custom'}padding-left:10px;{/if}" href="{$row.link}" title="{l s='View' mod='lofslide'}">{l s='View...' mod='lofslide'}</a>
                            
                            {/if}                                                       
                            {if $showAddCart == 1 AND $source == 'product'}
                            <span class="lof-slides-h-s">//</span>
                            {if ($row.quantity > 0 OR $row.allow_oosp)}
                            <a class="lof-slideshow-addcart ajax_add_to_cart_button" rel="ajax_id_product_{$row.id_product}" href="{$site_url}cart.php?add&amp;id_product={$row.id_product}&amp;token={$token}" title="{l s='Add to cart' mod='lofslide'}">{l s='Add to cart' mod='lofslide'}</a>
                            {else}
                            <span class="lof-slideshow-addcart">{l s='Add to cart' mod='lofslide'}</span>
                            {/if}
                            {/if}
                            <div class="lof-slide-main-content">
                                <h3><a href="{$row.link}">{$row.name}</a></h3>
                                <span class="lof-slide-price">{$row.price}</span>
                                <p class="lof-slide-main-desc">{$row.description}</p>
                            </div> 
                        </div>
                        {/if}
                    </li>
                {/foreach}
                </ul>
            </div>
            <div class="lof-panel-nav-{$moduleId} lof-panel-nav" style="width:{$widthPage}px;">
                <ol class="lof-control-nav lof-control-nav-{$moduleId}" style="height:{$thumbnailHeight+20}px;width:{$widthNav}px;">
                    {foreach from=$products item=row}
                    <li>
                        <div class="lof-nav-item-slide">
                            <a href="#" style="width:{$thumbnailWidth}px;height:{$thumbnailHeight}px;">
                                <img src="{$row.thumbImge}" title="{$row.name}" style="height:100%;"/>
                            </a>
                        </div>
                    </li>
                    {/foreach}
                </ol>
            </div>
        </div>    
    </div>
</div>
{/if}
<!--Add Script-->
<!--End Module-->