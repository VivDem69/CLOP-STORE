<div class="lofcamera_container" style="{$container_style}">
    {if $lofcameraParams.showTitle}
        <h4>{$lofcameraParams.title}</h4>
    {/if}  
    <div class="camera_wrap {$lofcameraParams.skin}" id="{$hookname}"  >
        {foreach from=$images item=img}
            <div data-thumb="{$thumb_uri}{$img.name}" data-src="{$image_uri}{$img.name}" >
                {if $img.title and $lofcameraParams.showDesc}                            
                    <div class="camera_caption fadeFromBottom" >             
                        <div class="lof_camera_title" >
                            {if $lofcameraParams.showLink and $img.link}
                                <a href="{$img.link}" title="{$img.title}" {if $lofcameraParams.noFollow}rel="nofollow"{/if} >{$img.title}</a>
                            {else}
                                {$img.title}
                            {/if}                            
                        </div>
						{if $img.price}
                                <div class="lof_price">{$img.price}</div>
                        {/if}
                        <div class="lof_camara_desc">
                            {$img.desc}
                        </div>
						<div class="lof_detail">
						<a href="{$img.link}"> {l s='view product' mod='lofcamera'} </a>
						</div>
                    </div>
                {/if}
            </div>
        {/foreach}    
    </div>
</div>