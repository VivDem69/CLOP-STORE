<div class="{$classImage}" style="{$leftRightImg}{$itemfloat}width:{$thumbnailWidth}px;height:{$thumbnailHeight}px;background:#FFF;" title="{$row.name}">
    {if $showIconItem}
        {if $row.lof_online_only_icon != '' AND $onlineIcon == 1}
        <div class="{$row.lof_online_only_icon}">&nbsp;</div>
        {/if}
        {if $row.lof_sale_icon != '' AND $saleIcon == 1}
        <div class="{$row.lof_sale_icon}">&nbsp;</div>
        {/if}
        {if $row.lof_new_icon != '' AND $newIcon == 1}
        <div class="{$row.lof_new_icon}">&nbsp;</div>
        {/if}
        {if $row.lof_features != '' AND $featureIcon == 1}
        <div class="{$row.lof_features}">&nbsp;</div>
        {/if}
    {/if}
        <a href="{$row.link}" target="" title="{$row.name}" class="product_img_link product_image"><img src="{$row.mainImge}" style="height:100%;"/></a>
     {if $showTitleImg == 1}<div class="lof-title-image">{$row.name}</div>{/if}
</div>