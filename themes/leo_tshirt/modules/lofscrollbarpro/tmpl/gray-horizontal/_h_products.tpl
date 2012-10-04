<div class="lof-scrollbar-gray-pa" style="width:{$moduleWidth};height:{$moduleHeight}">
<div class="lof-scrollbar-gray mcs5_container " id="lof-scroll{$posName}{$blockid}" style="width:{$moduleWidth};height:{$moduleHeight -17}px"><div style="clear:both"></div>
	<div class="customScrollBox">        
        <div class="lof-title-module">
            {if $module_title}                
                <div class="lof-title-hl">&nbsp;</div>
                <div class="lof-title-hm"><h4>{$module_title}</h4></div>
                <div class="lof-title-hr">&nbsp;</div>                    
            {/if}            
            {if $version == 1}
        		{if $showcomparator == 1}
        			<div class='lof-form-compare'>
        			<form method="get" action="{$site_url}products-comparison.php" onsubmit="return checkBeforeComparison();">
        				<p>
        				<input type="submit" class="button lof-compare1" value="{l s='Compare'}" style="float:right" />
        				<input type="hidden" name="compare_product_list" class="compare_product_list" value="" />
        				</p>
        			</form>
        			</div>
        		{/if}
        	{/if}             
            {if $scrollBtns}
                <div class="lof-title-button">
                    <a href="#" class="scrollUpBtn" title="{l s='Scroll To Previous'}">&nbsp;</a>
                    <a href="#" class="scrollDownBtn" title="{l s='Scroll To Next'}">&nbsp;</a>
                </div>        		
        	{/if}                    	
        </div>                
		<div class="horWrapper efupdown">            
			<div class="container">                
				<div class="content">
                    {$itemClass = "lof-item-first"}
                    {foreach from=$products key=key item=item name=foo}
                    <div class="lof-item {$itemClass}">
                        <div class="lof-item-bg">
                        <div class="lof-info">
                            <div class='lof-title'>                                
                                <div class="lof-pro-name">
                                    <a href='{$item.link}' title="{$item.name}">{$item.name}</a>
                                </div>                                                                                                    
                                {if $showprice == 1}
                                <div class='lof-price1'><span class="price">{$item.price}</span></div>
                                {/if}                                                                    
                            </div>                        	                            
                                                        							                                                                                    
                        </div>                        
                        <div class="lof-item-img">                        
							<div class='lof-img1' {if $imgSize.height}style="height:{$imgSize.height}px"{/if}><a style="line-height:225px;" href='{$item.link}' class='product_img_link product_image'>
                                {if $item.mainImge}
								<img src='{$item.mainImge}' alt='{$item.name}' />
                                {/if}
							</a>
                            
                            <div class="lof-desc">                                
                                {if $showdes == 'showdes'}
        						   {$item.description_short}
        						{else}                                        
        							{$item.description}
        						{/if}                                
                            </div>
                            
                            {if $item.classicon}
                                <div class="{$item.classicon}">&nbsp;</div>
                            {/if}                                                       
                            </div>						
                        </div>
                        <div class="item-bottom">
                            {if $version == 1}
								{if $showcomparator == 1}
									{if $comparator_max_item > 1}
										<div class='lof-showcomparator1'>
											<input type="checkbox" onclick="checkForComparison({$comparator_max_item})" class="comparator" id="comparator_item_{$item.id_product}" value="{$item.id_product}" /> <label for="comparator_item_{$item.id_product}">{l s='Select to compare'}</label>
										</div>
									{/if}
								{/if}
							{/if}                            
                            {if $view == 1 or $showcart == 1}                                                                                                                              		
                                    {if $showcart == 1}
                            			{if $version == 0}    						
                            				{if ($item.allow_oosp == 1 || $item.quantity > 0) && $item.customizable != 2}
                            					<a class="button lof-addcart ajax_add_to_cart_button exclusive" rel="ajax_id_product_{$item.id_product}" href="{$site_url}cart.php?add&amp;id_product={$item.id_product}&amp;token={$token}" title="{l s='Add to cart'}">{l s='Add to cart'}</a>
                            				{else}
                            					<span class="exclusive lof-addcart">{l s='Add to cart'}</span>
                            				{/if}    						
                            			{elseif isset($item.available_for_order) && $item.available_for_order > 0 && $check_restricted_country_mode == 0}    						
                            				{if ($item.allow_oosp == 1 || $item.quantity > 0) && $item.customizable != 2}
                            					<a class="button lof-addcart ajax_add_to_cart_button exclusive" rel="ajax_id_product_{$item.id_product}" href="{$site_url}cart.php?add&amp;id_product={$item.id_product}&amp;token={$token}" title="{l s='Add to cart'}">{l s='Add to cart'}</a>
                            				{else}
                            					<span class="exclusive lof-addcart">{l s='Add to cart'}</span>
                            				{/if}    						
                            			{/if}
                            		{/if}
                                    {if $view == 1}
									   <a class="button lof-view" href="{$item.link}" title="{l s='View'}">{l s='View'}</a>
									{/if}                                                                    
                            {/if}   
                        </div>                                            
                        </div>                       
                    </div>
                    {$itemClass = ""}
                    {/foreach}					
				</div>
			</div>           
			<div class="lof-scroll-bottom" style="width:{$moduleWidth-20}px;">            
    			<div class="dragger_container" style="width:{$moduleWidth-18}px;">
				   <div class="dragger"></div>
                </div>
            </div>           
		</div>
	</div>	
</div>
</div>