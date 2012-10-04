<!--Start Module-->
<div class="lof-breaking-news {$theme}" style="width:{$moduleWidth}px;height:{$moduleHeight}px;margin:0 auto;">
    <div id="lof-breaking-news-{$moduleId}" class="lofflexslider-news" style="width:{$moduleWidth}px;">
        <ul class="slides">
        {foreach from=$products item=row}
            <li style="height:{$moduleHeight}px;" class="clearfix">
                {if $enableLink}
                    <a href="{$row.link}" target="{$target}">{$row.content}</a>
                {else}
                    {$row.content}
                {/if}
            </li>
        {/foreach}
        </ul>
    </div>
	<div class="hotline"><span>Hotline</span><strong>+84 123 456 789</strong></div>
</div>
<!--Add Script-->
<!--End Module-->