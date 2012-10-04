<div class="{$sclassImage}" style="{$sleftRightImg};{$sitemfloat};width:{$sthumbnailWidth}px;height:{$sthumbnailHeight}px;background:#FFF;" title="{$row.name}">
    {if $sshowIconItem}
        {if $row.lof_online_only_icon != '' AND $sonlineIcon == 1}
        <div class="{$row.lof_online_only_icon}">&nbsp;</div>
        {/if}
        {if $row.lof_sale_icon != '' AND $ssaleIcon == 1}
        <div class="{$row.lof_sale_icon}">&nbsp;</div>
        {/if}
        {if $row.lof_new_icon != '' AND $snewIcon == 1}
        <div class="{$row.lof_new_icon}">&nbsp;</div>
        {/if}
        {if $row.lof_features != '' AND $sfeatureIcon == 1}
        <div class="{$row.lof_features}">&nbsp;</div>
        {/if}
    {/if}
    <a href="{$row.link}" target="" title="{$row.name}" class="product_img_link product_image"><img src="{$row.smainImge}" style="height:100%;"/></a>
    {if $sshowTitleImg == 1}<div class="lof-title-image">{$row.name}</div>{/if}    
</div>