<?php
if (!defined('_CAN_LOAD_FILES_'))
	exit;
?>
<link rel="stylesheet" href="<?php echo __PS_BASE_URI__."modules/".$this->name."/assets/admin/form.css";?>" type="text/css" media="screen" charset="utf-8" />
<script type="text/javascript" src="<?php echo __PS_BASE_URI__."modules/".$this->name."/assets/admin/form.js";?>"></script>
<script type="text/javascript">
  $(document).ready(function() {    
   	$('.it-addrow-block .add').each( function( idx , item ){    	  
        $(item).bind('click',function(e){
			var name        = $(item).attr('id').replace('btna-','');            
            var div         = $('<div class="row"></div>');
            var spantext    = $('<span class="spantext"></span>');
            var span        = $('<span class="remove"></span>');
            var input       = $('<input type="text" name="'+name+'[]" value=""/>');
                     			           
			var parent = $(item).parent().parent();
                        
            div.append(spantext);
            div.append(input);
            div.append(span);
                        
            parent.append(div);
            number = parent.find('input').length;                  
            spantext.html(parent.find('input').length);			
            
			span.bind('click',function(){ 
				if( span.parent().find('input').value ) {
					if( confirm('Are you sure to remove this') ) {
						span.parent().remove(); 
					}
				} else {
					span.parent().remove(); 
				}				
			} );				 			
        });
	});
    
	$('.it-addrow-block .remove').bind('click',function(events){	    
	    parent = $(this).parent();        
		if( parent.find('input').value ) {
			if( confirm('Are you sure to remove this') ) {
				parent.remove();
			}
		}else {
			parent.remove();
		}		
	});
             
  });
</script>
<h3><?php echo $this->l('Lof Silder Configuration');?></h3>
<?php 
//register Yes - No Lang
$yesNoLang = array("0"=>$this->l('No'),"1"=>$this->l('Yes'));
$postYArr  = array("bottom"=>$this->l('Bottom'),"top"=>$this->l('Top'));
$postXArr  = array("right"=>$this->l('Right'),"left"=>$this->l('Left'));
$fileType  = array("image"=>$this->l('Image'),"flash"=>$this->l('Flash'));
$targetArr = array("_blank"=>$this->l('Blank'),"_parent"=>$this->l('Parent'),"_self"=>$this->l('Self'),"_top"=>$this->l('Top'));
$imagePos  = array("left"=>$this->l('Left'),"center"=>$this->l('Center'),"right"=>$this->l('Right'));

?>
<form action="<?php echo $_SERVER['REQUEST_URI'].'&rand='.rand();?>" method="post" id="lofform">
 <input type="submit" name="submit" value="<?php echo $this->l('Update');?>" class="button" />
  <fieldset>
    <legend><img src="../img/admin/contact.gif" /><?php echo $this->l('General Setting'); ?></legend>
    <div class="lof_config_wrrapper clearfix">
      <ul>
        <?php 
            echo $this->_params->selectTag("module_theme",$themes,$this->getParamValue("module_theme",'default'),$this->l('Theme - Layout'),'class="inputbox"', 'class="row" title="'.$this->l('Select a theme').'"');                  
			echo $this->_params->inputTag("title",$this->getParamValue("title","Latest Tweets"),$this->l('Title Module'),'class="text_area"','class="row"','');                                                
			echo $this->_params->inputTag("module_width",$this->getParamValue("module_width",275),$this->l('module width'),'class="text_area"','class="row"','');                                                
            echo $this->_params->inputTag("module_height",$this->getParamValue("module_height",200),$this->l('Module Height'),'class="text_area"','class="row"','');
        ?>                 
      </ul>
    </div>
  </fieldset>
    
  <fieldset>
    <legend><img src="../img/admin/contact.gif" /><?php echo $this->l('Global Setting'); ?></legend>
    <div class="lof_config_wrrapper clearfix">
      <ul>
        <?php
            echo $this->_params->inputTag("username",$this->getParamValue("username","landofcoder,habqlandofcoder,TechCrunch"),$this->l('Location'),'class="text_area"','class="row"','','add multible username ex: landofcoder,habqlandofcoder,TechCrunch');
            echo $this->_params->inputTag("limit_items",$this->getParamValue("limit_items",2),$this->l('Limit Items'),'class="text_area"','class="row"','','limit items');
            echo $this->_params->inputTag("space",$this->getParamValue("space",5),$this->l('Space'),'class="text_area"','class="row"','');
			$arrshowMode = array('ticker'=>$this->l('Ticker'),'scroll'=>$this->l('Scroll'));
			echo $this->_params->selectTag("showMode",$arrshowMode,$this->getParamValue("showMode","scroll"),$this->l('Show Mode'),'class="inputbox select-group"', 'class="row"');               
			$arrver = array('1'=>$this->l('Vertical'),'0'=>$this->l('Horizontal'));
			echo $this->_params->selectTag("layout",$arrver,$this->getParamValue("layout",1),$this->l('Layout'),'class="inputbox select-group"', 'class="row"','','use show mode "Block" ');               
			echo $this->_params->radioBooleanTag("hoverPause", $yesNoLang,$this->getParamValue("hoverPause",1),$this->l('Hover Pause'),'','class="row"','','');
			echo $this->_params->inputTag("visible",$this->getParamValue("visible",3),$this->l('Visible'),'class="text_area"','class="row"','','Number visible items');
			echo $this->_params->inputTag("auto",$this->getParamValue("auto",500),$this->l('Auto'),'class="text_area"','class="row"','','');
			echo $this->_params->inputTag("speed",$this->getParamValue("speed",1000),$this->l('Speed'),'class="text_area"','class="row"','','');
			echo $this->_params->radioBooleanTag("expandHovercards", $yesNoLang,$this->getParamValue("expandHovercards",1),$this->l('Expand Hover Cards'),'','class="row"','','');
			echo $this->_params->radioBooleanTag("showSource", $yesNoLang,$this->getParamValue("showSource",1),$this->l('Show Source'),'','class="row"','','');				
        ?>
      </ul>
    </div>
  </fieldset>
<br />
  <input type="submit" name="submit" value="<?php echo $this->l('Update');?>" class="button" />
  	<fieldset><legend><img src="../img/admin/comment.gif" alt="" title="" /><?php echo $this->l('Information');?></legend>    	
    	<ul>
    	     <li>+ <a target="_blank" href="http://landofcoder.com/our-porfolios/prestashop/item/53-prestashop-lof-slider-module.html"><?php echo $this->l('Detail Information');?></li>
             <li>+ <a target="_blank" href="http://landofcoder.com/forum/forum.html?id=40"><?php echo $this->l('Forum support');?></a></li>
             <li>+ <a target="_blank" href="http://landofcoder.com/submit-request.html"><?php echo $this->l('Customization/Technical Support Via Email');?>.</a></li>
             <li>+ <a target="_blank" href="http://landofcoder.com/download/guides-docs/docs-guide-prestashop/121-prestashop13x-lofcoinslider-module.html"><?php echo $this->l('UserGuide ');?></a></li>
        </ul>
        <br />
        @copyright: <a href="http://landofcoder.com">LandOfCoder.com</a>
    </fieldset>
</form>
