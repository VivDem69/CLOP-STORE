<div class="lof_inner">
    <div class="clearfix"></div>
    {if $currentHook != 'productfooter'}
    <div class="block lof-slidingcaption-wrap {$theme} lof-sliding-{$lofiso_code} clearfix" style="width:{$moduleWidth}px;height:{$moduleHeight+16}px;margin:0 auto;">
		<div class="lof-sliding-features clearfix">
            <!-- sliding buttons -->
            {if $totalPages > 1}
    		<div class="sliding-buttons" style="width:{$moduleWidth-8}px;top:{$slidingTop}px;">
    			<a class="prev prev-home-{$moduleId}" href="#">Preview</a>
    			<a class="next next-home-{$moduleId}" href="#">Next</a>
    		</div>
            {/if}
            <!-- sliding navs -->
			<div class="sliding-features-home-{$moduleId} sliding-features-home" style="height:{$pagesHeight}px;width:{$modulePageWidth}px;">
				<!-- loop for homepage portfolio sliding -->
                {foreach from=$pages key=k item=listproducts}
                <ul class='lof-sliding-featured lof-sliding-featured-{$moduleId} {$pushscroll}'>
                    {foreach from=$listproducts key=i item=row}
                	<li class="{if (($i+1)%$maxItemsPerRow==0)}classborder{else}classno{/if}">
                		<div class="lof-sliding-feature lof-sliding-feature-{$moduleId}"> 
                			<div class="sliding-feature-shot" style="width:{$thumbnailWidth}px;height:{$thumbnailHeight}px;"> 
                				<div class="sliding-feature-content sliding-feature-content-{$moduleId}" style="{$marginLeft};width:{$thumbnailWidth*2}px;height:{$thumbnailHeight*2}px;"> 
                					{if $blockUp == 1}
                                        {include file="$slidingImage"}
                                    {/if}
                					<div class="sliding-feature-over" style="{$floatRight}height:{$thumbnailHeight}px;width:{$thumbnailWidth}px;">
                						<div class="center">
                							{if $showSubTitle}<strong><a href="{$row.link}" target="{$targetlink}">{$row.subtitle}</a></strong>{/if}
                                            <span class="dim lof-price-contain">
                                                <span class="lof-price"><b>{if $source=="product"}{$row.price}{else}{displayWtPrice p=$row.price}{/if}</b></span>
                                                {if (($row.price_lof_reduction) != ($row.price)) AND ($row.price_lof_reduction != "") AND ($priceReduction == 1)}&nbsp;&nbsp;<span class="lof-price-discount">{displayWtPrice p=$row.price_without_reduction}</span>{/if}
                                            </span>
                                            {if $source == "product" AND $itemDateCreated == 1}<em class="lof-date-carousel">{$row.date_add|date_format:"%Y-%m-%d"}</em>{/if}
                                            {if $showSubDesc}<span class="sliding-desc">{$row.subdescription}</span>{/if}
                                            
                						</div>
                                        {if $showReadmore}
                                        <a href="{$row.link}" target="{$targetlink}" class="sliding-detail" title="{$row.name}">{l s='Detail' mod='lofsliding'}</a>
                                        {/if}
                                        {if $source == "product"}
                                            {if (($row.quantity > 0 OR $row.allow_oosp))}
                                            <a class="lof-add-cart ajax_add_to_cart_button lof-add-cart-detail" rel="ajax_id_product_{$row.id_product}" href="{$site_url}cart.php?add&amp;id_product={$row.id_product}&amp;token={$token}"><span>{l s='Cart' mod='lofsliding'}</span></a>
                                            {else}
                                                <span class="lof-add-cart lof-add-cart-none lof-add-cart-detail">{l s='Cart' mod='lofsliding'}</span>
                                            {/if}
                                        {/if} 		
                					</div>
                                    {if $blockDown == 1}
                                        {include file="$slidingImage"}
                                    {/if}                                    
                				</div><!-- Sliding feature img -->
                                
                			</div><!-- Sliding feature shot -->
                            <div class="lof-shadow" style="width:{$thumbnailWidth+13}px;"></div>
                		</div><!-- Sliding feature -->
                	</li>
                    {if ($i+1)%$maxItemsPerRow==0 AND $i<count($listproducts)-1}
                	<div class="clearfix"></div>
                    {/if}
                    {/foreach}
                </ul>
				{/foreach}    
        </div><!-- Sliding features home -->
        {if $totalPages > 1}
        <div class="bd_button" style="width:{$widthButtonPages}px;">
            <div class="scrollbutton-{$moduleId} scrollbutton" style="width:{$widthButton}px;">
                <div id="lof-trigger-button-{$moduleId}" class="lof-button-nav">
                    
                </div>
            </div>
		</div>
        {/if}	
		</div><!-- Sliding features-home -->
	</div><!-- Sliding features -->
    {/if}
    
    
    {if ($currentHook == 'productfooter') AND ($source == "product") AND ($showsame == 1) AND ($samecategory == 1 OR $samemanufac == 1)}
    <div class="clearfix"></div>
    <div style="width:{$smoduleWidth}px;height:{$smoduleHeight+50}px;margin:0 auto;">
        <div id="lof-slidingtabs-module-{$moduleId}">
            <div class="lof-slidingtabs-panel">
             	<ul class="slidingtabs-panel slidingtabs-panel-{$moduleId}">
                    {if $samecategory == 1}
                    <li class="lof-tab">
                        <div class="bg-tabs-left-bd">
                            <a href="#lof-tabs-{$moduleId}-category">
                                <span class="bg-tabs-left">
                                    <span class="bg-tabs-middle">{l s='Products Same Category' mod='lofsliding'}</span>
                                </span>
                            </a>
                        </div>
                    </li>
                    {/if}
                    {if $samemanufac == 1}
                    <li class="lof-tab">
                        <div class="bg-tabs-left-bd">
                            <a href="#lof-tabs-{$moduleId}-manufact">
                                <span class="bg-tabs-left">
                                    <span class="bg-tabs-middle">{l s='Products Same Manufacturer' mod='lofsliding'}</span>
                                </span>
                            </a>
                        </div>
                    </li>
                    {/if}
            	</ul>
            </div>
            <div class="lof-tabnews-content">
                {if $samecategory == 1}
                <div id="lof-tabs-{$moduleId}-category" class="lof-content-tab lof-content-tab-{$moduleId}">
                        
                    <div class="lof-slidingcaption-wrap {$stheme} lof-sliding-{$lofiso_code} clearfix" style="width:{$smodulePageWidth}px;height:{$smoduleHeight+16}px;margin:0 auto;">
                		<div class="lof-sliding-features clearfix">
                            <!-- sliding buttons -->
                            {if count($cpages)>1}
                    		<div class="sliding-buttons-same">
                    			<a class="prev next-same-{$moduleId}" href="#">Preview</a>
                    			<a class="next next-same-{$moduleId}" href="#">Next</a>
                    		</div>
                            {/if}
                            <!-- sliding navs -->
                			<div class="sliding-features-home-same-{$moduleId} sliding-features-home same" style="height:{$spagesHeight-15}px;width:{$smodulePageWidth-15}px;">
                				<!-- loop for homepage portfolio sliding -->
                                {foreach from=$cpages key=k item=listproducts}
                                    {include file="$lofsame"}
                				{/foreach}    
                            </div><!-- Sliding features home -->
                		</div><!-- Sliding features-home -->
                	</div><!-- Sliding features --> 
                </div>
                {/if}
                {if $samemanufac == 1}
                <div id="lof-tabs-{$moduleId}-manufact" class="lof-content-tab lof-content-tab-{$moduleId}">
                    <div class="lof-slidingcaption-wrap {$stheme} lof-sliding-{$lofiso_code} clearfix" style="width:{$smodulePageWidth}px;height:{$smoduleHeight+16}px;margin:0 auto;">
                		<div class="lof-sliding-features clearfix">
                            <!-- sliding buttons -->
                            {if count($mpages)>1}
                    		<div class="sliding-buttons-same">
                    			<a class="prev next-same-{$moduleId}" href="#">Preview</a>
                    			<a class="next next-same-{$moduleId}" href="#">Next</a>
                    		</div>
                            {/if}
                            <!-- sliding navs -->
                			<div class="sliding-features-home-same-{$moduleId} sliding-features-home same" style="height:{$spagesHeight-15}px;width:{$smodulePageWidth-15}px;">
                				<!-- loop for homepage portfolio sliding -->
                                {foreach from=$mpages key=k item=listproducts}
                                    {include file="$lofsame"}
                				{/foreach}    
                            </div><!-- Sliding features home -->	
                		</div><!-- Sliding features-home -->
                	</div><!-- Sliding features -->
                        
                </div>
                {/if}
            </div> 
        </div>    
    </div>
	</div>
    <div class="clearfix"></div>
    <script type="text/javascript">
    // <![CDATA[
    	// we hide the tree only if JavaScript is activated
        jQuery(document).ready(function() {ldelim}
               jQuery("#lof-slidingtabs-module-{$moduleId}").slidingtabs({ldelim}
        	       positionActive: {$tabActive},
        	       moduleId: '{$moduleId}',
                   continuous: false
    	   {rdelim});
         {rdelim});
        
    // ]]>
    </script>
    {/if}