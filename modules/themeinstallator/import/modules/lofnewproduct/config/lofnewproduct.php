<?php
if (!defined('_CAN_LOAD_FILES_'))
	exit;
 
?>
<link rel="stylesheet" href="<?php echo __PS_BASE_URI__."modules/".$this->name."/assets/admin/form.css";?>" type="text/css" media="screen" charset="utf-8" />
<link rel="stylesheet" href="<?php echo __PS_BASE_URI__."modules/".$this->name."/assets/admin/farbtastic/farbtastic.css";?>" type="text/css" media="screen" charset="utf-8" />
<script type="text/javascript" src="<?php echo __PS_BASE_URI__."modules/".$this->name."/assets/admin/farbtastic/farbtastic.js";?>"></script>
<script type="text/javascript" src="<?php echo __PS_BASE_URI__."modules/".$this->name."/assets/admin/form.js";?>"></script>
<script type="text/javascript">
jQuery(document).ready(function($) {    
   	jQuery('.it-addrow-block .add').each( function( idx , item ){    	  
        jQuery(item).bind('click',function(e){
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
    
	jQuery('.it-addrow-block .remove').bind('click',function(events){	    
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
<?php  $yesNoLang = array("0"=>$this->l('No'),"1"=>$this->l('Yes')); ?>
<h3><?php echo $this->l('Lof New Products Configuration');?></h3>
<form action="<?php echo $_SERVER['REQUEST_URI'].'&rand='.rand();?>" method="post" id="lofform">
 <input type="submit" name="submit" value="<?php echo $this->l('Update');?>" class="button" />
  <fieldset>
    <legend class="lof-legend"><img src="../img/admin/contact.gif" /><?php echo $this->l('Global Setting'); ?></legend>
    <div class="lof_config_wrrapper clearfix">
      <ul>
        <?php 
            $optionsTheme = array(
                'default'=>$this->l('Default'),
                'blue'=>$this->l('Blue'),
                'orange'=>$this->l('Orange'),
                'purple'=>$this->l('Purple')
            );
            echo $this->_params->selectTag("module_theme",$optionsTheme,$this->getParamValue("module_theme","default"),$this->l("Theme - Styles"),'class="inputbox"', 'class="row" title="'.$this->l('Select a theme').'"');     
            //echo $this->_params->selectTag("module_group",$groups,$this->getParamValue("module_group",'product'),$this->l('Select Group'),'class="inputbox select-group"', 'class="row" title="'.$this->l('Select a group').'"');
        ?>      	                   	        
          
           
        <li class="row module_group-product">
            <?php         
               //new product tab
			   echo $this->_params->lofGroupTag($this->l('New Product'),"lof-group");
               
               $homeSorceArr = array("default"=>$this->l('Default'), "productids"=>$this->l('Product IDs')); 
               echo $this->_params->selectTag("home_sorce",$homeSorceArr,$this->getParamValue("home_sorce","default"),$this->l('Get Product From'),'class="inputbox select-group"','','class="row"');               
               //echo $this->_params->getCategory("category[]",$this->getParamValue("category",""),$this->l('Select category'),'size="10" multiple="multiple" style="width: 90%;" class="inputbox"','','class="row home_sorce-selectcat"','',$this->l('All Categories'));
               echo $this->_params->inputTag("product_ids",$this->getParamValue("product_ids","1,2,3,4,5"),$this->l('New Product ids'),'class="text_area"','','class="row home_sorce-productids"');
               	   			   
			   $arrOder = array('p.date_add'=>$this->l('Date Add'),'p.date_add DESC'=>$this->l('Date Add DESC'),
                                'name'=>$this->l('Name'),'name DESC'=>$this->l('Name DESC'),
                                'quantity'=>$this->l('Quantity'),'quantity DESC'=>$this->l('Quantity DESC'),
                                'p.price'=>$this->l('Price'),'p.price DESC'=>$this->l('Price DESC'));
               echo $this->_params->selectTag("order_by",$arrOder,$this->getParamValue("order_by","p.date_add"),$this->l('Order By'),'class="inputbox select-group"','','class="row home_sorce-selectmanu"');			   
               echo $this->_params->selectTag("featured_tab",$yesNoLang,$this->getParamValue("featured_tab","1"),$this->l('Enable New Product Tab'),'class="inputbox select-group"','','class="row"');
               
               
               
               
               echo $this->_params->inputTag("limit_items",$this->getParamValue("limit_items","12"),$this->l('Limit items'),'class="text_area"','','class="home_sorce-selectcat"');
               echo $this->_params->inputTag("timenew",$this->getParamValue("timenew",2),$this->l('Time to set new product(Days, Ex: 2)'),'class="text_area"','','',$this->l("Disable with the value as 0 or null."));
               echo $this->_params->inputTag("md_height",$this->getParamValue("md_height",auto),$this->l('Module Height'),'class="text_area"','','class="row slider_layout-image-description"');
               echo $this->_params->inputTag("md_width",$this->getParamValue("md_width",700),$this->l('Module Width'),'class="text_area"','','class="row slider_layout-image-description"');
               echo $this->_params->inputTag("pos_act",$this->getParamValue("pos_act",0),$this->l('Default Active Tab'),'class="text_area"','','class="row slider_layout-image-description"');
               echo $this->_params->inputTag("speed",$this->getParamValue("speed",800),$this->l('Slider Speed'),'class="text_area"','','class="row slider_layout-image-description"');
               echo $this->_params->radioBooleanTag("auto_play", $yesNoLang,$this->getParamValue("auto_play",0),$this->l('Auto Play Tabs Slider'),'class="select-option"','class="row"','','');               			   	                            
               ?>                    
      </ul>
    </div>
  </fieldset>
    
  <fieldset>
    <legend class="lof-legend"><img src="../img/admin/contact.gif" /><?php echo $this->l('Main Slider Setting'); ?></legend>
    <div class="lof_config_wrrapper clearfix">
      <ul>
        <?php 
            $options = array(
                '_blank'=>$this->l('New Window'),
                '_self'=>$this->l('Same Window')
            );
            echo $this->_params->selectTag("target",$options,$this->getParamValue("target","_self"),$this->l("Open Link"),'class="inputbox"','class="row"','','');
            echo $this->_params->inputTag("des_max_chars",$this->getParamValue("des_max_chars","100"),$this->l('Description Max Chars'),'class="text_area"','class="row cre_main_size-"','');
            echo $this->_params->radioBooleanTag("cre_main_size", $yesNoLang, $this->getParamValue("cre_main_size",0),$this->l('Create Size of Main Image'),'class="select-option"','class="row"','',$this->l("You can create a new size or use available size."));
            $tispoptions = array(
                'lof-none'=>$this->l('None'),
                'lof-tooltip'=>$this->l('Tooltip'),
                'lof-tipbox'=>$this->l('TipBox')
            );
            echo $this->_params->selectTag("show_tips",$tispoptions,$this->getParamValue("show_tips","lof-none"),$this->l("Tooltip Style"),'class="inputbox"','class="row"','','');
            
            $mainImgSize = array();
            foreach ($formats as $k=> $format):
                $mainImgSize[$format['name']] = $format['name'].'('.$format['width']."x".$format['height'].')';
            endforeach;            
            echo $this->_params->selectTag("main_img_size",$mainImgSize,$this->getParamValue("main_img_size","home"),$this->l('Main Image Size'),'class="inputbox select-group"','class="row cre_main_size-0"','',$this->l("You can create a new size via Menu <b>Preferences/Image</b>."));
            echo $this->_params->inputTag("main_height",$this->getParamValue("main_height",330),$this->l('Main Image Height'),'class="text_area"','class="row cre_main_size-1"','');
            echo $this->_params->inputTag("main_width",$this->getParamValue("main_width",220),$this->l('Main Image Width'),'class="text_area"','class="row cre_main_size-1"','');
            echo $this->_params->inputTag("limit_cols",$this->getParamValue("limit_cols",3),$this->l('Limit Colums'),'class="text_area"','class="row cre_main_size-"','');
            echo $this->_params->inputTag("limit_rows",$this->getParamValue("limit_rows",2),$this->l('Limit Rows'),'class="text_area"','class="row cre_main_size-"','');
            echo $this->_params->radioBooleanTag("show_desc", $yesNoLang,$this->getParamValue("show_desc",1),$this->l('Enable Main Description'),'class="select-option"','class="row"','','');
            echo $this->_params->radioBooleanTag("show_price", $yesNoLang,$this->getParamValue("show_price",1),$this->l('Enable Main Price'),'class="select-option"','class="row"','','');
            echo $this->_params->radioBooleanTag("price_special", $yesNoLang,$this->getParamValue("price_special",0),$this->l('Enable Price without Reduction'),'class="select-option"','class="row"','','');
            echo $this->_params->radioBooleanTag("show_title", $yesNoLang,$this->getParamValue("show_title",1),$this->l('Enable Main Title'),'class="select-option"','class="row"','','');
            echo $this->_params->radioBooleanTag("show_image", $yesNoLang,$this->getParamValue("show_image",1),$this->l('Enable Main Image'),'class="select-option"','class="row"','','');
            echo $this->_params->radioBooleanTag("show_puplic", $yesNoLang,$this->getParamValue("show_puplic",0),$this->l('Enable Puplic Date'),'class="select-option"','class="row"','','');
            
            
            echo $this->_params->radioBooleanTag("controls_btn_show", $yesNoLang,$this->getParamValue("controls_btn_show",0),$this->l('Controls Enable Button'),'class="select-option"','class="row"','',$this->l('Yes: Show next,preview button; No: Show navigation button'));
            
            
            echo $this->_params->radioBooleanTag("show_button", $yesNoLang,$this->getParamValue("show_button",0),$this->l('Enable Button'),'class="select-option"','class="row"','','');
            
            echo $this->_params->radioBooleanTag("online_icon", $yesNoLang,$this->getParamValue("online_icon",0),$this->l('Enable Online Only Icon'),'class="select-option"','class="row"','','');
            echo $this->_params->radioBooleanTag("feature_icon", $yesNoLang,$this->getParamValue("feature_icon",0),$this->l('Enable Feature Icon'),'class="select-option"','class="row"','','');
            echo $this->_params->radioBooleanTag("new_icon", $yesNoLang,$this->getParamValue("new_icon",0),$this->l('Enable New Icon'),'class="select-option"','class="row"','','');
            echo $this->_params->radioBooleanTag("sale_icon", $yesNoLang,$this->getParamValue("sale_icon",0),$this->l('Enable Sale Icon'),'class="select-option"','class="row"','','');
            
        ?>
      </ul>
    </div>
  </fieldset>
 
<br />
  <input type="submit" name="submit" value="<?php echo $this->l('Update');?>" class="button" />
  	<fieldset><legend class="lof-legend"><img src="../img/admin/comment.gif" alt="" title="" /><?php echo $this->l('Information');?></legend>    	
    	<ul>
    	     <li>+ <a target="_blank" href="http://landofcoder.com/prestashop/"><?php echo $this->l('Detail Information');?></li>
             <li>+ <a target="_blank" href="http://landofcoder.com/supports/forum.html"><?php echo $this->l('Forum support');?></a></li>
             <li>+ <a target="_blank" href="http://landofcoder.com/submit-request.html"><?php echo $this->l('Customization/Technical Support Via Email');?>.</a></li>
             <li>+ <a target="_blank" href="http://landofcoder.com/prestashop/guides/"><?php echo $this->l('UserGuide ');?></a></li>
        </ul>
        <br />
        @Copyright: <a href="http://landofcoder.com">LandOfCoder.com</a>
		<br/>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/vi_VN/all.js#xfbml=1";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, "script", "facebook-jssdk"));</script>
		<div class="social_buttons">
			<div class="fb-like" data-href="http://www.facebook.com/LeoTheme" data-send="false" data-width="450" data-show-faces="false"></div>
			<a href="https://twitter.com/leotheme" class="twitter-follow-button" data-show-count="false" data-size="large">Follow @leotheme</a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
	   </div>
    </fieldset>
</form>
