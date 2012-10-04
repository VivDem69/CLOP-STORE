    {if $showTips == 'lof-tipbox'}
    <script type="text/javascript">
    /* <![CDATA[ */
    	jQuery(document).ready(function($) {ldelim}
    		$(".lof-box-tools-featured .product_label").hover(function() {ldelim}
    			$(".lof-box-tools-featured .product_label").removeClass("open");
    			$(this).removeClass("opacize").addClass("open");
    		{rdelim}, function () {ldelim}
    			$(this).removeClass("open");			
    		{rdelim});	
    		$(".lof-box-tools-featured .product_label .close").click(function() {ldelim}
    			$(this).parents(".product_label").removeClass("open");
    			$(".lof-box-tools-featured .product_label").removeClass("opacize");
    		{rdelim});
    	{rdelim});
    /* ]]> */
    </script>
    {/if}
    {if (count($listloffeatureds)>$countitemperpage)}
    <script type="text/javascript">            
    	jQuery(document).ready(function() {ldelim}	
    		jQuery("#lof-content-main-featured-{$moduleId}").SliderFeatured({ldelim}
                prevId: 'lof-prev-featured-{$moduleId}',         			 
                nextId: 'lof-next-featured-{$moduleId}',
                catId: 'featured',
                numeric: true,
                totalPage: {$hlofmissitem},
                moduleTheme: '{$theme}',
    			auto: {$autoPlay},
    			widthPage: {$module_width},
    			speed: {$speed},
    			continuous: true,
    			controlsShow: true 
    		{rdelim});
    	{rdelim});	
    </script>
    {/if}
    
    <div id="lof-tabs-{$moduleId}-featured" class="lof-content-tab lof-content-tab-{$moduleId}">
        <div class="lof-container" id="lof-content-main-featured-{$moduleId}"  style="width:{$module_width-10}px;">
        {if (!empty($loflistFeatureds[0]))}
            <ul class="lof-content-main">
                    {foreach from=$loflistFeatureds[0] key=key item=lists}                        
                    <li class="lof-main-item" style="width:{$module_width-10}px;">
                            {foreach from=$lists key=i item=item}                             
                            <div class="lof-content-main-item"  style="width:{$itemWidth}%">
                                <div class="bd-lof-content ajax_block_product clearfix" style="text-align:center;margin:0 auto;">
                                    {if $showImage == 1}
                                        <div class="lof-box-tools-featured lof-box-tools">
                                            <div class="product_label lof-tool-item lof-tool-item-{$moduleId}" style="height:{$thumbmainHeight}px;width:{$thumbmainWidth}px;">
                                                {if $item.lof_online_only_icon != '' AND $onlineIcon == 1}
                                                <div class="{$item.lof_online_only_icon}">&nbsp;</div>
                                                {/if}
                                                {if $item.lof_sale_icon != '' AND $saleIcon == 1}
                                                <div class="{$item.lof_sale_icon}">&nbsp;</div>
                                                {/if}
                                                {if $item.lof_new_icon != '' AND $newIcon == 1}
                                                <div class="{$item.lof_new_icon}">&nbsp;</div>
                                                {/if}
                                                {if $item.lof_features != '' AND $featureIcon == 1}
                                                <div class="{$item.lof_features}">&nbsp;</div>
                                                {/if}
                    							<a href="{$item.link}" target="{$target}" class="product_img_link product_image"><img src="{$item.mainImge}" alt="" /></a>
                                                {if ($showTips == "lof-tipbox")}
                                                <div class="lof-content-tools-text">
                                                    <h4>{$item.name}</h4>
                                                    <div class="box-price">
                                                        <span class="lof-price"><b>{$item.price}</b></span>
                                                        {if (($item.reduction) != ($item.price)) AND ($priceSpecial == 1)}&nbsp;&nbsp;<span class="lof-price-discount">{displayWtPrice p=$item.price_without_reduction}</span>{/if}
                                                    </div>
                                                    <div class="box-detail"><a href="<?php echo $item['link'];?>">{l s='Detail' mod='loftabs'}</a></div>
                                                    <span class="close"></span>
                                                </div>
                                                {/if}
                    						</div>
                                        </div>
                                        {if (($showTips == "lof-tooltip") AND ($checkversion >= 1.4))}
                                        <div class="tooltip">
                                            <div style="position: relative;background: #FFFFFF;width:430px;height: 200px;">
                                                <div style="position: relative;width:430px;height: 200px;overflow: hidden;">
                                                <span class="lof-tooltip-image"><a href="{$item.link}" target="{$target}"><img src="{$item.thumbImge}" alt="" style="height:100%;"/></a></span>
                                                </div>
                                                <div class="lof-tools-opacity" style="width:100%;">
                                                    <h4><a href="{$item.link}" target="{$target}">{$item.name}</a></h4>
                                                </div>
                                            </div>
                                        </div>
                                        {/if}
                                    {/if}
                                   <div class="lof-item-content">
                                        {if ($showTitle == 1)}<h4><a href="{$item.link}" target="{$target}">{$item.name}</a></h4>{/if}
                                        {if ($showPuplic == 1)}
                                        <span style="color: #333333;font-size:11px;font-style: italic;">
                                            {$item.dateAdd}
                                        </span>
                                        {/if}
                                   </div>
								   
                                    <div class="lof-tools-opacity">
										{if ($showPrice == 1)}
                                        <span class="lof-price-contain">
                                            <span class="lof-price"><b>{$item.price}</b></span>
                            			</span>
										{/if}
										{if (($item.quantity > 0 OR $item.allow_oosp))}
                                        <a class="lof-add-cart ajax_add_to_cart_button" rel="ajax_id_product_{$item.id_product}" href="{$site_url}cart.php?add&amp;id_product={$item.id_product}&amp;token={$token}"><span>{l s='Add to cart' mod='loftabs'}</span></a>
                                        {else}
                                            <span class="lof-add-cart">{l s='Add to cart' mod='loftabs'}</span></a>
                                        {/if}
                                   </div>
                                   
                                </div>
                            </div>
                            {if ( ($i+1) % $limitnumcols== 0 AND $i < count($lists)-1 )}
                            <div class="clr clearfix"></div>
                            {/if}
                        {/foreach}
                        <div class="clr clearfix"></div>
                    </li>
                    {/foreach}
            </ul>
            {else}
            <div>{l s='Has not products featured' mod='loftabs'}</div>
            <div class="clr clearfix"></div>
        {/if}
        </div>
    </div>