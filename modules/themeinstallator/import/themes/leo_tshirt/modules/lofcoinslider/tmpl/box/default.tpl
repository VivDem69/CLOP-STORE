<div id="lofcoinslide{$prfSlide}{$blockid}" class="lof-coinslider-box" style="height:{$moduleHeight}; width:{$moduleWidth}">
 <div class="lof-wrapper {$css3Class}">
 	<div class="lof-wrapper-suffix">
         {if ($params->get('preload',1)==1)}
         <div class="preload"><div></div></div>
         {/if}
        <!-- MAIN CONTENT -->  
            {if ($params->get('shadow',1)==1)}       
                <div class="lof-table" style="width:{$main_width_theme+44}px;margin-bottom: -6px;">
                    <div class="lof-row">
                    <div class="lof-cell lof-above-left">&nbsp;</div>
                    <div class="lof-cell lof-above-middle" style="width:{$main_width_theme}px">&nbsp;</div>
                    <div class="lof-cell lof-above-right">&nbsp;</div>
                    </div>
                </div>
            {/if}
            <div id="lofcs-full3d-{$prfSlide}{$blockid}" class="nivoSlider" style="height:{$params->get('main_height',300)}px;width:{$main_width_theme-1}px;position:relative">                                       
                    {foreach from=$products item=row}
                    <div class="lof-content-wrrapper">                               
                        {if $row.name}                                                
                            <div id="lof-container-{$row.groupandnum}" style="display: none;">
                                <p class="lof-title">
                                    <a href="{$row.link}" rel="{$row.link}" title="{$row.name}" style="color:{$params->get('caption_linkcolor','#ffffff')}"><b>{$row.name}</b></a>
                                     {if $params->get('show_price',1) && isset($row.price) && $row.price}
                                        <b style="color:{$params->get('price_color','#ffffff')}">({$row.price})</b>
                                    {/if}      
                                </p>
                                <p class="lof-info" style="color:{$params->get('caption_fontcolor','#ffffff')}">
                                    {$row.description}  
                                </p>
                            </div>        
                         {/if}
                         <a href="{$row.link}" style="height:{$params->get('main_height',300)}px;width:{$main_width_theme}px;display:block">       	  
                            <img src="{$row.mainImge}" title="{$row.titleImg}"/>  		        	
                         </a>            
                    </div>                
                    {/foreach}        
            </div> 
             <!-- END MAIN CONTENT -->
            {if ($params->get('shadow',1)==1)}
                <div class="lof-table" style="width:{$main_width_theme+44}px;margin-top: -7px;">
                    <div class="lof-row">
                    <div class="lof-cell lof-bottom-left">&nbsp;</div>
                    <div class="lof-cell lof-bottom-middle" style="width:{$main_width_theme}px">&nbsp;</div>
                    <div class="lof-cell lof-bottom-right">&nbsp;</div>
                    </div>
                </div>
            {/if}
      </div>     
</div>
</div>          