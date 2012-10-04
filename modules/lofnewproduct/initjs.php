<script type="text/javascript">
// <![CDATA[
	// we hide the tree only if JavaScript is activated
    jQuery(document).ready(function() {
           jQuery("#lof-tabnews-module-<?php echo $moduleId;?>").tabs({
    	       positionActive: <?php echo $params->get("pos_act",0);?>,
    	       moduleId: '<?php echo $moduleId;?>',
               continuous: false
	   });
     });
    
// ]]>
</script>