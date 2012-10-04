<?php
if (!defined('_CAN_LOAD_FILES_'))
	exit;
?>
<link rel="stylesheet" href="<?php echo __PS_BASE_URI__."modules/".$this->name."/assets/admin/form.css";?>" type="text/css" media="screen" charset="utf-8" />
<link rel="stylesheet" href="<?php echo __PS_BASE_URI__."modules/".$this->name."/assets/admin/farbtastic/farbtastic.css";?>" type="text/css" media="screen" charset="utf-8" />
<script type="text/javascript" src="<?php echo __PS_BASE_URI__."modules/".$this->name."/assets/admin/farbtastic/farbtastic.js";?>"></script>
<script type="text/javascript" src="<?php echo __PS_BASE_URI__."modules/".$this->name."/assets/admin/form.js";?>"></script>
<script type="text/javascript">
$(document).ready(function() {   	            
    //When page loads...
    $(".tab_content").hide(); //Hide all content
    $("ul.tabs li:first").addClass("active").show(); //Activate first tab
    $(".tab_content:first").show(); //Show first tab content
    
    //On Click Event
    $("ul.tabs li").click(function() {
    
    	$("ul.tabs li").removeClass("active"); //Remove any "active" class
    	$(this).addClass("active"); //Add "active" class to selected tab
    	$(".tab_content").hide(); //Hide all tab content
    
    	var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content        
    	$(activeTab).fadeIn(); //Fade in the active ID content
    	return false;
    });     
  });
</script>
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
<?php  
    $yesNoLang = array("0"=>$this->l('No'),"1"=>$this->l('Yes')); 
    $fileLangArr = array(
                    "is_ena"        => $this->l('Is Enabled'),
                    "global_set"    => $this->l('Content'),
                    "title"         => $this->l('Title'),                    
                    "link"          => $this->l('Link'),
                    "content"       => $this->l('Content'),
                    "path_img"      => $this->l('Image'),
                    "classicon"     => $this->l('Type of Icon'),
                    "price"         => $this->l('Price'),
                    "desc"          => $this->l('Description')
                    );
    $languages = Language::getLanguages(true);
    $lang = array();
    $lang['auto'] = 'Auto Language';
    foreach($languages AS $language){
    	$lang[$language['id_lang']] = $language['name'];	
    }
?>
<h3><?php echo $this->l('Lof Social Share Configuration');?></h3>
<form action="<?php echo $_SERVER['REQUEST_URI'].'&rand='.rand();?>" enctype="multipart/form-data" method="post" id="lofform">
 <input type="submit" name="submit" value="<?php echo $this->l('Update');?>" class="button" />
  <fieldset>
    <legend class="lof-legend"><img src="../img/admin/contact.gif" /><?php echo $this->l('Global Setting'); ?></legend>
    <div class="lof_config_wrrapper clearfix">
      <ul>
        <?php 
            $optionsTheme = array(
                'basic'=>$this->l('Basic')
            );
            $groups = array(
                'product'=>$this->l('Products Sharing'),
                'pages'=>$this->l('Pages Sharing')
            );
            $hook = array(
                'home'=>$this->l('home'),
                'rightColumn'=>$this->l('rightColumn'),
                'leftColumn'=>$this->l('leftColumn'),
                'footer'=>$this->l('footer')
            );
            echo $this->_params->selectTag("module_theme",$optionsTheme,$this->getParamValue("module_theme","basic"),$this->l('Theme - Layout'),'class="inputbox"', 'class="row" title="'.$this->l('Select a theme').'"');       
            echo $this->_params->selectTag("module_group",$groups,$this->getParamValue("module_group",'product'),$this->l('Select Group'),'class="inputbox select-group"', 'class="row module_group-1" title="'.$this->l('Select a group').'"');
            echo $this->_params->selectTag("lofhook",$hook,$this->getParamValue("lofhook","home"),$this->l('Hook Pages'),'class="inputbox select-group"','class="row module_group-1 module_group-pages"','' );
        ?>      	                   	        
        <li class="row module_group-product">
            <?php 
               echo $this->_params->lofGroupTag($this->l('Group Product'),"lof-group");               
               $homeSorceArr = array("selectcat"=>$this->l('Select category'),"productids"=>$this->l('Product IDs')); 
               echo $this->_params->selectTag("home_sorce",$homeSorceArr,$this->getParamValue("home_sorce","selectcat"),$this->l('Get Product From'),'class="inputbox select-group"','','class="row"');               
               echo $this->_params->getCategory("category[]",$this->getParamValue("category",""),$this->l('Select category'),'size="10" multiple="multiple" style="width: 90%;" class="inputbox"','','class="row home_sorce-selectcat"','',$this->l('All Categories'));
               echo $this->_params->inputTag("productids",$this->getParamValue("productids","1,2,3,4,5"),$this->l('Product IDs'),'class="text_area"','class="home_sorce-productids"','');
               $optsWidget = array(
                    '0' => $this->l('Classic'),
                    '1' => $this->l('Multi-post')
               );
               $path = __PS_BASE_URI__."modules/".$this->name."/config/images/";
               
               $optsButton = array(
                    'lg-icons' => '<img src="'.$path.'largeIcon.JPG" alt="" title="'.$this->l('Large Icons').'" /><br />',
                    'lg-horizontal' => '<img src="'.$path.'horizontalCounts.JPG" alt="" title="'.$this->l('Horizontal Count').'" /><br /><br />',
                    'lg-vertical' => '<img src="'.$path.'verticalCounts.JPG" alt="" title="'.$this->l('Vertical Count').'" /><br />',
                    'sm-regular' => '<img src="'.$path.'regularButtons.JPG" alt="" title="'.$this->l('Regular Buttons').'" /><br />',
                    'sm-notext' => '<img src="'.$path.'buttonNoText.JPG" alt="" title="'.$this->l('Regular Button No-Text').'" /><br />',
                    'button' => '<img src="'.$path.'buttons.JPG" alt="" title="'.$this->l('Buttons').'" />'
               );
               echo $this->_params->radioBooleanTag("widgettype", $optsWidget,$this->getParamValue("widgettype",1),$this->l('Widget Type :'),'class="select-option"','class="row"','','');
               echo $this->_params->inputTag("pubkey",$this->getParamValue("pubkey",''),$this->l('Publisher Key :'),'class="text_area"','class="row"','');
               echo $this->_params->radioBooleanTag("butstyle", $optsButton,$this->getParamValue("butstyle",'lg-icons'),$this->l('Button Style :'),'class="select-option"','class="row"','','');
               ?>
          </li>
                             
      </ul>
    </div>
  </fieldset>
  <fieldset class="lof-fieldset">
    <legend class="lof-legend"><img src="../img/admin/contact.gif" /><?php echo $this->l('Included Services'); ?></legend>
    <div class="lof_config_wrrapper clearfix">
      <ul>
        <?php 
            echo $this->_params->radioBooleanTag("linkedin", $yesNoLang,$this->getParamValue("linkedin",1),$this->l('Include LinkedIn'),'class="select-option"','class="row"','','');
            echo $this->_params->radioBooleanTag("facebook", $yesNoLang,$this->getParamValue("facebook",1),$this->l('Include Facebook'),'class="select-option"','class="row"','','');
            echo $this->_params->radioBooleanTag("twitter", $yesNoLang,$this->getParamValue("twitter",1),$this->l('Include Twitter'),'class="select-option"','class="row"','','');
            echo $this->_params->radioBooleanTag("yahoo", $yesNoLang,$this->getParamValue("yahoo",1),$this->l('Include Yahoo'),'class="select-option"','class="row"','','');
            echo $this->_params->radioBooleanTag("email", $yesNoLang,$this->getParamValue("email",1),$this->l('Include Email'),'class="select-option"','class="row"','','');
            echo $this->_params->radioBooleanTag("sharethis", $yesNoLang,$this->getParamValue("sharethis",1),$this->l('Include Sharethis'),'class="select-option"','class="row"','','');
            echo $this->_params->radioBooleanTag("plusone", $yesNoLang,$this->getParamValue("plusone",0),$this->l('Include Google plus'),'class="select-option"','class="row"','','');
            echo $this->_params->radioBooleanTag("fblike", $yesNoLang,$this->getParamValue("fblike",0),$this->l('Include FB Like'),'class="select-option"','class="row"','','');
            echo $this->_params->radioBooleanTag("technorati", $yesNoLang,$this->getParamValue("technorati",1),$this->l('Include Technorati'),'class="select-option"','class="row"','','');
            echo $this->_params->radioBooleanTag("newsvine", $yesNoLang,$this->getParamValue("newsvine",1),$this->l('Include Newsvine'),'class="select-option"','class="row"','','');
            echo $this->_params->radioBooleanTag("blogmarks", $yesNoLang,$this->getParamValue("blogmarks",1),$this->l('Include Blogmarks'),'class="select-option"','class="row"','','');
            echo $this->_params->radioBooleanTag("digg", $yesNoLang,$this->getParamValue("digg",1),$this->l('Include Digg'),'class="select-option"','class="row"','','');
            echo $this->_params->radioBooleanTag("reddit", $yesNoLang,$this->getParamValue("reddit",1),$this->l('Include Reddit'),'class="select-option"','class="row"','','');
        ?>
      </ul>
    </div>
  </fieldset>
  
<br />
  <input type="submit" name="submit" value="<?php echo $this->l('Update');?>" class="button" />
  	<fieldset><legend class="lof-legend"><img src="../img/admin/comment.gif" alt="" title="" /><?php echo $this->l('Information');?></legend>    	
    	<ul>
    	     <li>+ <a target="_blank" href="http://landofcoder.com/prestashop/slider/lof-carousel.html"><?php echo $this->l('Detail Information');?></li>
             <li>+ <a target="_blank" href="http://landofcoder.com/supports/forum.html?id=87"><?php echo $this->l('Forum support');?></a></li>
             <li>+ <a target="_blank" href="http://www.landofcoder.com/submit-request.html"><?php echo $this->l('Customization/Technical Support Via Email');?>.</a></li>
             <li>+ <a target="_blank" href="http://landofcoder.com/prestashop/guides/lof-carousel.html"><?php echo $this->l('UserGuide ');?></a></li>
        </ul>
        <br />
        @Copyright: <a href="http://wwww.landofcoder.com">LandOfCoder.com</a>
    </fieldset>
</form>