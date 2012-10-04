<div class='lof-scrollbar-gray-pa lof-parrent' style="width:{$moduleWidth};height:{$moduleHeight}">
<div class='lof-v-title'><h4>{$module_title}</h4></div>
<div class="lof-scrollbar-gray mcs_container" id="lof-scroll{$posName}{$blockid}" style="width:{$moduleWidth - 19}px;height:{$moduleHeight - 40}px"><div style="clear:both"></div>
<div class="customScrollBox">
	<div class="container" style="width:{$moduleWidth-39}px">
		<div class="content">
			<div class="lof-element lof-element-{$blockid} products_block">
				<div class="lof-inner">
					<div class="lof-cms-item">
						{foreach from=$products key=key1 item=item name=products}
							{if $smarty.foreach.products.index lt {$limit_cate}}
								<div class="lof-item">
									<h2 class="lof-cmsc-title"><a href="{$site_url}cms.php?id_cms={$item.id_cms}" >{$item.meta_title}</a></h2>
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
																		{$item.content}	
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
								</div>
							{/if}
						{/foreach}
					</div>
				</div>
			</div>
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