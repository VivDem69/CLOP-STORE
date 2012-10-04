<div class='lof-scrollbar-gray-pa lof-parrent' style="width:{$moduleWidth};height:{$moduleHeight}">
<div class='lof-v-title'><h4>{$module_title}</h4></div>
{if $version == 1}
	{if $showcomparator == 1}
		<div class='lof-form-compare'>
		<form method="get" action="{$site_url}products-comparison.php" onsubmit="return checkBeforeComparison();">
			<p>
			<input type="submit" class="button lof-compare" value="{l s='Compare'}" style="float:right" />
			<input type="hidden" name="compare_product_list" class="compare_product_list" value="" />
			</p>
		</form>
		</div>
	{/if}
{/if}
<div class="lof-scrollbar-gray mcs_container" id="lof-scroll{$posName}{$blockid}" style="width:{$moduleWidth - 19}px;height:{$moduleHeight - 40}px">
<div class="customScrollBox">
	<div class="container" style="width:{$moduleWidth-39}px">
		<div class="content">
			{foreach from=$products key=key item=item name=foo}
				<div class="lof-element lof-element-{$blockid} products_block">
					<div class="lof-inner {if $smarty.foreach.foo.index % 2}lof-item-1{else}lof-item-0{/if}">
					   <div class='ajax_product first_item clearfix'>			
							{if $showimage == 1}
								<div class='lof-img' {if $moduleWidth<=462}style="width:100%"{/if}><a href='{$item.link}' class='product_img_link product_image'>
									<img src='{$item.mainImge}' alt='{$item.name}' />
								</a></div>
							{/if}
							<div class="lof-pro-left" {if $moduleWidth<=462 or $showimage==0}style="width:100%"{/if}>
								<div class='lof-title'><h5><a href='{$item.link}' title="{$item.name}">{$item.name}</a></h5></div>
								<div class='lof-description'>
									<div class="side-left-desc">
										<div class="side-right-desc">
											<div class="side-top-desc">
												<div class="side-bot-desc">
													<div class="left-top-desc">
														<div class="right-top-desc">
															<div class="left-bot-desc">
																<div class="right-bot-desc">
																	<div class="desc std">
																	{if $showdes == 'showdes'}
																	   {$item.description_short}
																	{else}                                        
																		{$item.description}
																	{/if}	
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>                                                                                          
								</div>
									{if $showprice == 1}
									   <div class='lof-price'><span class="price">{$item.price}</span></div>
									{/if}
									
									{if $view == 1}
									   <a class="button lof-view" href="{$item.link}" title="{l s='View'}">{l s='View'}</a>
									{/if}
								
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
									{if $version == 1}
									{if $showcomparator == 1}
										{if $comparator_max_item > 1}
											<div class='lof-showcomparator'>
												<input type="checkbox" onclick="checkForComparison({$comparator_max_item})" class="comparator" id="comparator_item_{$item.id_product}" value="{$item.id_product}" />
											</div>
										{/if}
									{/if}
								{/if}   	
							</div>	<div style="clear:both"></div>																			                
						</div>                 						
					</div>
				</div>
			{/foreach}
			
			<div style="clear:both;"></div>
		</div>
	</div>
	<div class="dragger_container" style="height:{$moduleHeight - 91}px">
		<div class="dragger"></div>
	</div>
</div>
{if $scrollBtns}
	<a href="#" class="scrollUpBtn"></a> <a href="#" class="scrollDownBtn"></a>
{/if}

</div>
</div>