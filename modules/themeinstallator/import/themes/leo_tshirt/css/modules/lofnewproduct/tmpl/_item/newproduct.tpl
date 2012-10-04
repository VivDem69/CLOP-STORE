    {if $showTips == 'lof-tipbox'}
    <script type="text/javascript">
    /* <![CDATA[ */
    	jQuery(document).ready(function($) {ldelim}
    		$(".lof-box-tools-news .product_label").hover(function() {ldelim}
    			$(".lof-box-tools-news .product_label").removeClass("open");
    			$(this).removeClass("opacize").addClass("open");
    		{rdelim}, function () {ldelim}
    			$(this).removeClass("open");			
    		{rdelim});	
    		$(".lof-box-tools-news .product_label .close").click(function() {ldelim}
    			$(this).parents(".product_label").removeClass("open");
    			$(".lof-box-tools-news .product_label").removeClass("opacize");
    		{rdelim});
    	{rdelim});
    /* ]]> */
    </script>
    {/if}
    {if (count($listloffeatureds)>$countitemperpage)}
    <script type="text/javascript">            
    	jQuery(document).ready(function() {ldelim}	
			jQuery('#lof-tabs-{$moduleId}-news').contentcarousel({ldelim}
				moduleId        : '{$moduleId}',
				displayButton   : '1',
				numCols         : 4,
				// speed for the sliding animation
				sliderSpeed		: {$speed},
				// easing for the sliding animation
				sliderEasing	: 'easeOutQuad',
				// speed for the item animation (open / close)
				itemSpeed		: {$speed},
				// easing for the item animation (open / close)
				itemEasing		: 'easeOutQuad',
				// number of items to scroll at a time
				mousewheel		: 1,
				scroll			: {$scroll_items}
			{rdelim});
            {if $showButton eq '0'}
                $('.lofnew_control').css('display','none');
            {/if}
            
    	{rdelim});	
    </script>
    {/if}
    <div id="lof-tabs-{$moduleId}-news" class="lof-container lof-content-tab lof-content-tab-{$moduleId}">
        <div class="lof-wrapper-carousel-{$moduleId} lof-wrapper-carousel lof-container" id="lof-content-main-news-{$moduleId}"  style="width:{$slide_width};height:{$slide_height};">
        {if (!empty($loflistFeatureds[0]))}
                    {foreach from=$loflistFeatureds[0] key=key item=lists}                        
                            {foreach from=$lists key=i item=item}                      
                            <div class="lof-item-carousel lof-content-main-item"  style="width:{$itemWidth}%">
                                <div class="bd-lof-content ajax_block_product clearfix" style="text-align:center;margin:0 auto;">
                                    {if $showImage == 1}
                                        <div class="lof-box-tools-news lof-box-tools">
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
                                                    <div class="box-detail"><a href="<?php echo $item['link'];?>">{l s='Detail' mod='lofnewproduct'}</a></div>
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
                                        {if $showDesc eq '1'}
                                        <span class="lof-des">
                                            {$item.description}
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
                                        <a class="lof-add-cart ajax_add_to_cart_button" rel="ajax_id_product_{$item.id_product}" href="{$site_url}cart.php?add&amp;id_product={$item.id_product}&amp;token={$token}"><span>{l s='Add to cart' mod='lofnewproduct'}</span></a>
                                        {else}
                                            <span class="lof-add-cart">{l s='Add to cart' mod='lofnewproduct'}</span></a>
                                        {/if}
                                   </div>
                                   
                                </div>
                            </div>
                            {if ( ($i+1) % $limitnumcols== 0 AND $i < count($lists)-1 )}
                            <div class="clr clearfix"></div>
                            {/if}
                        {/foreach}
                    {/foreach}
            {else}
            <div>{l s='Has not products new' mod='lofnewproduct'}</div>
            <div class="clr clearfix"></div>
        {/if}
        </div>
		
        
        
        <!-- <div class="lofcontrol"><ol id="new-controls">
            <li id="new-controls1" class="current"><a href="javascript:void(0);" rel="0">1</a></li>
            <li id="new-controls2" class=""><a href="javascript:void(0);" rel="1">2</a></li></ol>
        </div>--->
        
    </div>
