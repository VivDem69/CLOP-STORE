<div class="clearfix clear clr"></div>
<div class="lof-module-newproduct {$theme} lof-tabs-{$lofiso_code} clearfix" style="width:{$moduleWidth}px;height:{$moduleHeight}">
    <div id="lof-tabnews-module-{$moduleId}" style="width:100%;">
        {if ($showTips == "lof-tooltip") AND ($checkversion >= 1.4)}
            <script type="text/javascript">  
                jQuery(document).ready(function() {ldelim}
            		jQuery(".lof-tool-item-{$moduleId}").tooltip({ldelim} 
            			effect: 'slide',
            			offset: [0, 2],
            			onBeforeShow:	function(event, position) {ldelim}
            			                this.getTip().appendTo(document.body);
                                        return true;{rdelim}{rdelim}
            		).dynamic({ldelim} bottom: {ldelim} direction: 'down', bounce: true {rdelim}{rdelim});
                {rdelim});
            </script>
        {/if}
        <div class="lof-tabnews-panel">
         	<ul class="tabs-panel tabs-panel-{$moduleId}">
                {if ($featuredTab == 1)}
                <li class="lof-tab">
                    <div class="bg-tabs-left-bd">
                        <a href="#lof-tabs-{$moduleId}-featured">
                            <span class="bg-tabs-left">
                                <span class="bg-tabs-middle">{l s='New ' mod='lofnewproduct'}</span>
								 <span class="bg-tabs-middle-right">{l s='Products' mod='lofnewproduct'}</span>
                            </span>
                        </a>
                    </div>
                </li>    
                {/if}
        	</ul>
        </div>
        <div class="lof-tabnews-content">
            {if $featuredTab == 1}           
                {include file="$featuredUrlLayouts"}
            {/if}
        </div>
        <div class="clr clearfix"></div>
    </div>
</div>
 <script type="text/javascript">
// <![CDATA[
	// we hide the tree only if JavaScript is activated
    jQuery(document).ready(function() {ldelim}
           jQuery("#lof-tabnews-module-{$moduleId}").tabs({ldelim}
    	       positionActive: {$posActive},
    	       moduleId: '{$moduleId}',
               continuous: false
	   {rdelim});
     {rdelim});
    
// ]]>
</script>   
