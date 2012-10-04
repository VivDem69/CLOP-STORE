<div class="lof-scrollbar-default-pa" style="width:{$moduleWidth};height:{$moduleHeight}">
<div class="lof-scrollbar-default mcs5_container" id="lof-scroll{$posName}{$blockid}" style="width:{$moduleWidth};height:{$moduleHeight -17}px"><div style="clear:both"></div>
	<div class="customScrollBox">
		<div class="horWrapper"> 
			<div class="container">
				<div class="content">
					<ul>
					{foreach from=$products key=key item=item name=foo}
						<li>
						<div class="side-left-desc">
						<div class="side-right-desc">
							<div class="side-top-desc">
								<div class="side-bot-desc">
									<div class="left-top-desc">
										<div class="right-top-desc">
											<div class="left-bot-desc">
												<div class="right-bot-desc">
													<h2 class="lof-cmsc-title"><a href="{$item.link}" >{$item.title}</a></h2>
													<div class="desc std">
													{$item.desc}	
													</div><div style="clear:both"></div>   
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						</div>
						</li>
					{/foreach}
					</ul>
				</div>
			</div>
			<div class="dragger_container" style="width:{$moduleWidth - 15}px;">
				<div class="dragger"></div>
			</div>
		</div>
	</div>
	{if $scrollBtns}
		<a href="#" class="scrollUpBtn">&#8678;</a> <a href="#" class="scrollDownBtn">&#8680;</a>
	{/if}
	<div class="lof-title-module"><h4>{$module_title}</h4></div>
</div>
</div>