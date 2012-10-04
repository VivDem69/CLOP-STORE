<div class="lof-scrollbar-black-pa" style="width:{$moduleWidth};height:{$moduleHeight}">
<div class="lof-scrollbar-black mcs5_container " id="lof-scroll{$posName}{$blockid}" style="width:{$moduleWidth};height:{$moduleHeight -17}px"><div style="clear:both"></div>
	<div class="customScrollBox efhover">
        {if $module_title}
            {*<h4>{$module_title}</h4>*}
        {/if}
        <div class="lof-title-module">            
            {if $scrollBtns}
        		<a href="#" class="scrollUpBtn" title="{l s='Scroll To Previous'}">&nbsp;</a>
                <a href="#" class="scrollDownBtn" title="{l s='Scroll To Next'}">&nbsp;</a>
        	{/if}        	
        </div>
		<div class="horWrapper">
            <div class="lof-header-top">
                &nbsp;
            </div>
			<div class="container">
				<div class="content">
                    {$itemClass = "lof-item-first"}
                    {foreach from=$products key=key item=item name=foo}
                    <div class="lof-item {$itemClass}">
                        <div class="lof-item-img">                        
							<div class='lof-img1' {if $imgSize.height}style="height:{$imgSize.height}px;width:{$imgSize.width}px"{/if}><a href='{$item.link}' class='product_img_link product_image'>
                                {if $item.thumbImge}
								    <img src='{$item.thumbImge}' alt='{$item.title}' />
                                {/if}
    							</a>
                                <div class="lof-desc">                                                                                                   
    							     {$item.desc}        						                                
                                </div>
                                {if isset($item.type) && $item.type}
                                     <div class="{$item.type}">&nbsp;</div>
                                {/if}                                                                                                          
                            </div>
                        </div>                      
                        <div class="lof-info">
                            <div class='lof-title'>                                
                                <div class="lof-pro-name">
                                    <a href='{$item.link}' title="{$item.title}">{$item.title} | <span style="color:#A1D800">{l s='View'}</span></a>
                                </div>                                                                                                                                                                                                     
                            </div>
                        </div>                        
                    </div>
                    {$itemClass = ""}
                    {/foreach}					
				</div>
			</div>
            <div class="lof-scroll-bottom">            
    			<div class="dragger_container" style="width:{$moduleWidth-15}px;">
				   <div class="dragger"></div>
                </div>
            </div>            
		</div>
	</div>	
</div>
</div>