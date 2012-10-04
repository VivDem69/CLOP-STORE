<div class="lof-module-tabsnews-wrap">
<div class="lof_inner">
<div class="lof-module-tabsnews {$theme} lof-tabs-{$lofiso_code} clearfix" style="width:{$moduleWidth}px;height:{$moduleHeight}">
    <div id="lof-tabnews-module-{$moduleId}">
        {if ($showTips == "lof-tooltip") AND ($checkversion >= 1.4)}
            <script type="text/javascript">  
                jQuery(document).ready(function() {ldelim}
            		jQuery(".lof-tool-item-{$moduleId}").tooltip({ldelim} 
            			effect: 'slide',
            			offset: [0, 2],
            			onBeforeShow:	function(event, position) {ldelim}
            			                this.getTip().appendTo(document.body);
                                        return true;{rdelim}{rdelim}
            		).dynamic({ldelim} bottom: {ldelim} direction: 'down', bounce: true {rdelim}{rdelim});
                {rdelim});
            </script>
        {/if}
        <div class="lof-tabnews-panel">
         	<ul class="tabs-panel tabs-panel-{$moduleId}">
                {if ($featuredTab == 1)}
                <li class="lof-tab">
                    <div class="bg-tabs-left-bd">
                        <h4 class="bg-heading">
                            <span class="bg-tabs-left">
                                <span class="bg-tabs-middle">{l s='Featured Products' mod='loftabs'}</span>
                            </span>
                        </h4>
                    </div>
                </li>    
                {/if}
                {if ($bestsellerTab == 1)}
                <li class="lof-tab">
                    <div class="bg-tabs-left-bd">
                        <a href="#lof-tabs-{$moduleId}-bestseller">
                            <span class="bg-tabs-left">
                                <span class="bg-tabs-middle">{l s='Best Seller' mod='loftabs'}</span>
                            </span>
                        </a>
                    </div>
                </li>    
                {/if}
                {if ($specialTab == 1)}
                
                <li class="lof-tab">
                    <div class="bg-tabs-left-bd">
                        <a href="#lof-tabs-{$moduleId}-special">
                            <span class="bg-tabs-left">
                                <span class="bg-tabs-middle">{l s='Specials' mod='loftabs'}</span>
                            </span>
                        </a>
                    </div>
                </li>    
                {/if}
                {if ($newTab == 1)}
                <li class="lof-tab">
                    <div class="bg-tabs-left-bd">
                        <a href="#lof-tabs-{$moduleId}-new">
                            <span class="bg-tabs-left">
                                <span class="bg-tabs-middle">{l s='New Products' mod='loftabs'}</span>
                            </span>
                        </a>
                    </div>
                </li>    
                
                {/if}
                {if ($enableCate == 1)}
                {foreach from=$cates item=cate}
                    <li class="lof-tab" dir="lof-tabs-{$moduleId}-{$cate.id_category}">
                        <div class="bg-tabs-left-bd">
                            <a href="#lof-tabs-{$moduleId}-{$cate.id_category}">
                                <span class="bg-tabs-left">
                                    <span class="bg-tabs-middle">{$cate.name}</span>
                                </span>
                            </a>
                        </div>
                    </li>
                 {/foreach}
                 {/if}
        	</ul>
        </div>
        
        <div class="lof-tabnews-content">
            {if $featuredTab == 1}           
                {include file="$featuredUrlLayouts"}
            {/if}
            {if $specialTab == 1}
                {include file="$specialUrlLayouts"}
            {/if}
            {if $newTab == 1}
                {include file="$newProductsUrlLayouts"}
            {/if}
            {if $bestsellerTab == 1}
                {include file="$bestSellerUrlLayouts"}
            {/if}
            {foreach from=$cates item=cate}
            {if $showTips == 'lof-tipbox'}
            <script type="text/javascript">
            /* <![CDATA[ */
            	jQuery(document).ready(function($) {ldelim}
            		$(".lof-box-tools-{$cate.id_category} .product_label").hover(function() {ldelim}
            			$(".lof-box-tools-{$cate.id_category} .product_label").removeClass("open");
            			$(this).removeClass("opacize").addClass("open");
            		{rdelim}, function () {ldelim}
            			$(this).removeClass("open");			
            		{rdelim});	
            		$(".lof-box-tools-{$cate.id_category} .product_label .close").click(function() {ldelim}
            			$(this).parents(".product_label").removeClass("open");
            			$(".lof-box-tools-{$cate.id_category} .product_label").removeClass("opacize");
            		{rdelim});
            	{rdelim});
            /* ]]> */
            </script>
            {/if}
            {if count($listlofproducts[$cate.id_category])>1}
            <script type="text/javascript">            
            	jQuery(document).ready(function() {ldelim}	
            		jQuery("#lof-content-main-{$moduleId}-{$cate.id_category}").easySliderTabs({ldelim}
                        prevId: 'lof-prev-{$moduleId}-{$cate.id_category}',         			 
                        nextId: 'lof-next-{$moduleId}-{$cate.id_category}',
                        catId: {$cate.id_category},
                        totalPage: {$hlofmissitem},
                        moduleTheme: '{$theme}',
            			auto: {$autoPlay},
            			widthPage: {$module_width},
            			speed: {$speed},
            			continuous: true,
                        controlsShow:false 
            		{rdelim});
            	{rdelim});	
            </script>
            {/if}
            <div id="lof-tabs-{$moduleId}-{$cate.id_category}" class="lof-content-tab lof-content-tab-{$moduleId}">
                {if count($listlofproducts[$cate.id_category]) >1 AND ($showButton == 1)}
                <div class="lof-buttons">
            		<div id="lof-prev-{$moduleId}-{$cate.id_category}" class="lof-prev"><a href="javascript:void(0);"></a></div>
            		<div id="lof-next-{$moduleId}-{$cate.id_category}" class="lof-next"><a href="javascript:void(0);"></a></div>
                </div>
                {/if}
                <div class="lof-container" id="lof-content-main-{$moduleId}-{$cate.id_category}"  style="width:{$module_width-10}px;">
                {if (!empty($listlofproducts[$cate.id_category]))}
                    <ul class="lof-content-main">
                        {foreach from=$listlofproducts[$cate.id_category] key=key item=lists}
                            <li class="lof-main-item" style="width:{$module_width-10}px;">
                                {foreach from=$lists key=i item=item}                                
                                    <div class="lof-content-main-item"  style="width:{$itemWidth}%">
                                        <div class="bd-lof-content ajax_block_product clearfix" style="float:left;">
                                            {if $showImage == 1}
                                                <div class="lof-box-tools-{$cate.id_category} lof-box-tools">
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
                                                            {if (($item.price_lof_reduction) != ($item.price)) AND ($priceSpecial == 1)}<span class="lof-price-discount">{displayWtPrice p=$item.price_without_reduction}</span><br />{/if}
                                                            <span>{$item.price}</span></div>
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
                                            

                                           <div class="lof-item-content" style="width:{$thumbmainWidth + 6}px;">
                                                {if ($showTitle == 1)}<h4><a href="{$item.link}" target="{$target}">{$item.name}</a></h4>{/if}
                                                {if ($showPuplic == 1)}
                                                <span style="color: #333333;font-size:11px;font-style: italic;">
													{$item.date_add|date_format:"%Y-%m-%d"}													
                                                </span>
                                                {/if}
                                                {if ($showDesc == 1)}<div class="lof-main-description"><p>{$item.description}</p></div>{/if}
                                           </div>
										   
										   {if ($showPrice == 1)}
                                            <div class="lof-tools-opacity" style="width:{$thumbmainWidth}px;">
                                                <span class="lof-price-contain">
                                                    <span class="lof-price">{$item.price}</span>
                                                    {if (($item.price_lof_reduction) != ($item.price)) AND ($priceSpecial == 1)}&nbsp;&nbsp;<span class="lof-price-discount">{displayWtPrice p=$item.price_without_reduction}</span>{/if}
                                    			</span>
                                           </div>
                                           {/if}
										   
                                           <div class="lof-main-puplic" style="width:{$thumbmainWidth}px;">
                                              <a class="lof-detail" href="{$item.link}">
													<span>{l s='View' mod='loftabs'}</span>
											  </a> 
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
                    <div class="clr clearfix"></div>
                {/if}
                </div>
            </div>
            {/foreach}
            <div class="clr clearfix"></div>
        </div>
        <div class="clr clearfix"></div>
    </div>
</div>
</div>
</div>
 <script type="text/javascript">
// <![CDATA[
	// we hide the tree only if JavaScript is activated
    jQuery(document).ready(function() {ldelim}
           jQuery("#lof-tabnews-module-{$moduleId}").tabs({ldelim}
    	       positionActive: {$posActive},
    	       moduleId: '{$moduleId}',
               continuous: false
	   {rdelim});
     {rdelim});
    
// ]]>
</script>   
