<?php
/**
 * $ModDesc
 * 
 * @version	$Id: group_base.php $Revision
 * @package	modules
 * @subpackage	$Subpackage
 * @copyright	Copyright (C) June 2010 LandOfCoder.com <@emai:landofcoder@gmail.com>. All rights reserved.
 * @website 	htt://landofcoder.com
 * @license	GNU General Public License version 2
 */
if (!defined('_CAN_LOAD_FILES_')){
    define('_CAN_LOAD_FILES_',1);
}
if( !class_exists('LofNewProductDataSourceBase', false) ){
	 /**
  * LofDataSourceBase Class
  */	
 abstract class LofNewProductDataSourceBase{
	/**
	 * @var string $_thumbnailPath
	 * 
	 * @access protected;
	 */
	var $_thumbnailPath = "";
	
	/**
	 * @var string $_thumbnailURL;
	 * 
	 * @access protected;
	 */
	var $_thumbnaiURL = "";
	
	var $_imagesRendered = array( 'thumbnail'=>array(),'mainImage'=>array() );
    
    /**
	 * Set folder's path and url of thumbnail folder
	 * 
	 */
	function setThumbPathInfo( $path, $url ){
		$this->_thumbnailPath=$path;
		$this->_thumbnaiURL =$url;
		return $this;
	}
    
    public function setImagesRendered( $name=array() ){
 		$this->_imagesRendered = $name;
		return $this;
	}
    
    /**
    * resize image thumbail  from image source
    */	
    public function generateImages( $item, $params ){        
        //if create main image size don't get from prestashop'
		if($params->get("cre_main_size",0)){
		    $main_img_size["height"] = $params->get("main_height",330); 			
			if($params->get("main_width_theme",0)){
				$main_img_size["width"]  = $params->get("main_width_theme",220);	
			}else{
				$main_img_size["width"]  = $params->get("main_width",220);	
			}
            
            $item["mainImge"] = $this->resizeImage( $item["mainImge"], $main_img_size ); 
		}
        if($params->get("auto_renderthumb",1)){
            $thumb_size["height"] = $params->get("thumb_height",35); 
            $thumb_size["width"]  = $params->get("thumb_width",85);    
            $item["thumbImge"] = $this->resizeImage( $item["thumbImge"], $thumb_size );
        }                
		return $item;
	} 
    /**
    * resize image
    */
	public function resizeImage( $path, $size ){	        		
        $tpath      = str_replace( _PS_BASE_URL_, "", $path );
		$tpath      = str_replace( __PS_BASE_URI__, "", $tpath );                
		$sourceFile = _PS_ROOT_DIR_.'/'.$tpath;         
		if( file_exists($sourceFile) ){ 
		  // return $path;            		
			$tmp        = explode("/",$path);                    
			$path       = $this->_thumbnaiURL."/".$size["width"]."_".$size["height"]."_".$tmp[count($tmp)-1];            
			$savePath   = $this->_thumbnailPath."/".$size["width"]."_".$size["height"]."_".$tmp[count($tmp)-1];
			if( !file_exists($savePath) ){  // return $path;
			  $thumb = PhpThumbFactory::create( $sourceFile  );             
			  $thumb->adaptiveResize( $size["width"], $size["height"]);            
			  $thumb->save( $savePath  ); 
			}  
		}        
		return $path;
    }
	function removedir($dirname)
    {
		$dir_handle = null;
        if (is_dir($dirname))$dir_handle = opendir($dirname);
		
        if (!$dir_handle)return false;
		
        while($file = readdir($dir_handle)) {
            if ($file != "." && $file != "..") {
                if (!is_dir($dirname."/".$file))
                unlink($dirname."/".$file);
                else
                {
                    $a=$dirname.'/'.$file;
                    removedir($a);
                }
            }
        }
        closedir($dir_handle);
        rmdir($dirname);
        return true;
    }
}
}
?>