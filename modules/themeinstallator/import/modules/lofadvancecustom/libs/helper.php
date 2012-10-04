<?php
/**
 * $ModDesc
 * 
 * @version		$Id: helper.php $Revision
 * @package		modules
 * @subpackage	$Subpackage
 * @copyright	Copyright (C) May 2010 LandOfCoder.com <@emai:landofcoder@gmail.com>. All rights reserved.
 * @website 	htt://landofcoder.com
 * @license		GNU General Public License version 2
 */
if (!defined('_CAN_LOAD_FILES_')){
    define('_CAN_LOAD_FILES_',1);
}
if( !class_exists('MegamenuHelper', false) ){  
	class MegamenuHelper {
		/**
		* Module name
		*/
		var $modulename = 'lofmegamenu';
        /**
		 * override method: get list image from articles.
		 */
		function getListByParameters( $params, $pparams ){
			$products = self::getHtml( $params );
			return $products;
		}
		
		function getHtml( $params ){
			$children = self::getMenus( $params);
			$html = '';
			if($children)
				self::getHtmlCate($children, 0, $html, 0 ,$params);
			$html = "<ul id='lofmegamenu' class='megamenu level0'>".$html."</ul>";
			return $html;
		}
		
		function getHtmlCate($children, $id = 0, &$str, $level = 0, $params, $space = 0,$col = false, $tgcol = -1,$new = 0){
			global $cookie,$smarty;
			$pos = $params->get('pos','top');
			$widthDefault = ($pos == 'top' ? $params->get('itemswidth_top', 200) : $params->get('itemswidth_left', 200)); 
			
			if(!empty($children[$id])){
				foreach($children[$id] as $item){
					$k = 0;
					if( $item['privacy'] == 0 || ($item['privacy'] == 1 && !$cookie->id_customer) || ($item['privacy'] == 2 && $cookie->id_customer)){
						
						if( $item['col'] && $tgcol != $item['col'] && $tgcol != -1 && $tgcol != 0){	
							
							$str .="</ul>";
							$str .="</div>";
							$col = true;
						}
						
						if( $item['col'] && $col  && $tgcol != -1 && ($tgcol != $item['col'] || $new == 1) ){
							$amount_submenu = $item['colums'];
							$str .= '<div class="lofcolumn col'.$item['col'].'"'.(!empty($item['columnwidth']) ? ' style="width:'. $item['columnwidth'].'px"' : '').'>';
							$str .= "<ul class='ulitem'>";
						}
						$new = 0;
						
						$str .= "<li class='lofitem".$level.( ($item['group'] == 1) ? ' menugroup' : ' menunongroup').( $item['menu_class'] ? ' '.$item['menu_class'] : '' ).(( !empty($children[$item['id_lofmegamenu']]) || $item['type_submenu'] != 1 ) ? ' lofsub' : ' lofnonsub').( $item['type'] == 'module' ? ' has-module' : '')."'>";
						if( $item['type'] == 'module' ){
							$str .= $item['module'];
						}else{
							/* start link */
							$str .= "<a".($item['target'] == '_newwithout' ? ' onclick=\'javascript: window.open("'.$item['link'].'", "", "toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes"); return false\'' : '')." href='".$item['link']."'".($item['target'] == '_self' ? ' target="_self"' : ($item['target'] == '_blank' ? ' target="_blank"' : '') ).">".
							/* icon menu */
							( $item['menuicon'] ? "<span class='has-image".( !$item['show_title'] ? ' hide-title' : '')."' style='background:url(".$item['menuicon'].") no-repeat scroll left center transparent;'>" : "" ).
								( $item['show_title'] ? "<span class='lof-menu-title'>".$item['name']."</span>".
									( $level == 0 ? "<span class='lof-menu-desc'>".($item['description'] ? $item['description'] : "&nbsp;")."</span>" : ($item['description'] ? "<span class='lof-menu-desc'> ". $item['description'] ."</span>" : ""))
								 : "&nbsp;").
							( $item['menuicon'] ? "</span>" : '') ;
							/* end icon */
							$str .= "</a>";
							/* end link */
						}
						if(!empty($children[$item['id_lofmegamenu']])){
							$amount_submenu = $item['colums'];
							$str .= "<div class='divul_container level".($level + 1).( ($item['group'] == 1) ? ' menugroup' : ' menunongroup')."'".( $item['group'] == 0 ? ( $item['submenu_width'] > 0 ? ' style="width:'.$item['submenu_width'].'px"' : ' style="width:'.($amount_submenu * $widthDefault).'px"' ) : ' style="width:100%;"' ).">";
							$str .= "<div class='lof_container'>";
							if( $item['group'] == 1){
								$str .= "<ul class='ulitem'>";
							}else{
								$tgcol = 0;
							}
								$columnwidths = '';
								$columnwidth = '';
								if( !empty( $item['submenu_colum_width'] ) ){
									$columnwidths = explode( ':',$item['submenu_colum_width'] );
								}elseif( !empty( $item['colum_width'] ) ){
									$columnwidth = $item['colum_width'] ;
								}elseif( !empty( $item['submenu_width'] )){
									$columnwidth = floor($item['submenu_width']/($item['colums'] <= 0 ? 1 : $item['colums'])) ;
								}else{
									$columnwidth = $widthDefault;
								}
								/**/
								$columns = ($item['colums'] <= 0 ? 1 : $item['colums']);
								$columns = ceil($item['numberItems']/$columns);
								
								if( $item['numberItems'] % $columns == 0 ){
									$lofcol = true;
								}else{
									$lofcol = false;
								}
								$i = 0;
								$j = 0;
								if( $item['type_submenu'] == 0 && $item['modules'] ){
									$k = 1;
									foreach( $item['modules'] as $module ){/*module*/
										if( isset($columnwidths[$i]) && Validate::isInt($columnwidths[$i])){
											$columnwidth = $columnwidths[$i];
										}
										if($i == 0){
											if( !$item['group'] ){
												$str .= '<div class="lofcolumn col1"'.($columnwidth ? ' style="width:'.$columnwidth.'px"' : '' ).'>';
												$str .= "<ul class='ulitem'>";
											}
										}
										if( $j  == $columns ){
											$k++;
											$str .= '</ul>';
											$str .= '</div>';
											$str .= '<div class="lofcolumn col'.$k.'">';
											$str .= "<ul class='ulitem'>";
											$j = 1;
										}else{
											$j++;
										}
										$str .= "<li class='lofitem".( $level + 1 )." menunongroup lofnonsub'>".$module."</li>";
										$i++;
									}
								}elseif( $item['type_submenu'] == 2 ){ /*text*/
									
									if( isset($columnwidths[0]) && Validate::isInt($columnwidths[0])){
										$columnwidth = $columnwidths[0];
									}
									if( !$item['group'] ){
										$str .= '<div class="lofcolumn col1"'.($columnwidth ? ' style="width:'.$columnwidth.'px"' : '' ).'>';
										$str .= "<ul class='ulitem'>";
									}
									$str .= "<li class='lofitem".( $level + 1 )." menunongroup lofnonsub'>".$item['content_text']."</li>";
								}elseif( $item['type_submenu'] == 3 && $item['products'] ){/* products */
									$k = 1;
									foreach( $item['products'] as $row ){
										if( isset($columnwidths[$i]) && Validate::isInt($columnwidths[$i])){
											$columnwidth = $columnwidths[$i];
										}
										if($i == 0){
											if( !$item['group'] ){
												$str .= '<div class="lofcolumn col1"'.($columnwidth ? ' style="width:'.$columnwidth.'px"' : '' ).'>';
												$str .= "<ul class='ulitem'>";
											}
										}
										if( $j  == $columns ){
											$k++;
											$str .= '</ul>';
											$str .= '</div>';
											$str .= '<div class="lofcolumn col'.$k.'"'.($columnwidth ? ' style="width:'.$columnwidth.'px"' : '' ).'>';
											$str .= "<ul class='ulitem'>";
											$j = 1;
										}else{
											$j++;
										}
										$str .= "<li class='lofitem".( $level + 1 )." menunongroup lofnonsub'><a href='".$row['link']."' title='".$row['name']."'><span class='lof-menu-title'>".$row['name']."</span></a></li>";
										$i++;
									}
								}elseif( $item['type_submenu'] == 4 && $item['categories'] ){/* categories */
									$k = 1;
									foreach( $item['categories'] as $row ){
										if( isset($columnwidths[$i]) && Validate::isInt($columnwidths[$i])){
											$columnwidth = $columnwidths[$i];
										}
										if($i == 0){
											if( !$item['group'] ){
												$str .= '<div class="lofcolumn col1"'.($columnwidth ? ' style="width:'.$columnwidth.'px"' : '' ).'>';
												$str .= "<ul class='ulitem'>";
											}
										}
										if( $j  == $columns ){
											$k++;
											$str .= '</ul>';
											$str .= '</div>';
											$str .= '<div class="lofcolumn col'.$k.'"'.($columnwidth ? ' style="width:'.$columnwidth.'px"' : '' ).'>';
											$str .= "<ul class='ulitem'>";
											$j = 1;
										}else{
											$j++;
										}
										$str .= "<li class='lofitem".( $level + 1 )." menunongroup lofnonsub'><a href='".$row['link']."' title='".$row['name']."'><span class='lof-menu-title'>".$row['name']."</span></a></li>";
										$i++;
									}
								}elseif( $item['type_submenu'] == 5 && $item['cmss'] ){/* CMS */
									$k = 1;
									foreach( $item['cmss'] as $row ){
										if( isset($columnwidths[$i]) && Validate::isInt($columnwidths[$i])){
											$columnwidth = $columnwidths[$i];
										}
										if($i == 0){
											if( !$item['group'] ){
												$str .= '<div class="lofcolumn col1"'.($columnwidth ? ' style="width:'.$columnwidth.'px"' : '' ).'>';
												$str .= "<ul class='ulitem'>";
											}
										}
										if( $j  == $columns){
											$k++;
											$str .= '</ul>';
											$str .= '</div>';
											$str .= '<div class="lofcolumn col'.$k.'"'.($columnwidth ? ' style="width:'.$columnwidth.'px"' : '' ).'>';
											$str .= "<ul class='ulitem'>";
											$j = 1;
										}else{
											$j++;
										}
										$str .= "<li class='lofitem".( $level + 1 )." menunongroup lofnonsub'><a href='".$row['link']."' title='".$row['meta_title']."'><span class='lof-menu-title'>".$row['meta_title']."</span></a></li>";
										$i++;
									}
								}else{
									$lofcol = true;
								}
								/* get Submenu */
								
								if( isset($k) && $k > 0 ){
									$tgcol = $k;
								}
								$lofnew = 0;
								if( $item['group'] == 1 ){
									
									$space = $space.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
								}else{
									if( $item['col'] == 1 ){
										$lofnew = 1;
									}
									if( $tgcol == 0 && $item['type_submenu'] != 1 ){
										$tgcol = 1;
									}
									$space = '';
								}
								
								$loflevel = $level + 1;
								//var_dump($tgcol); die;
								self::getHtmlCate( $children, $item['id_lofmegamenu'] , $str, $loflevel, $params, $space, $lofcol, $tgcol, $lofnew );
							//$str .= "</ul>";
							//if( $item['group'] == 1){
								$str .= "</ul>";
							//}
							if( $item['group'] != 1){
								$str .= "</div>";
							}
							$str .= "</div>";
							$str .= "</div>";
						}else{
							$arr = array(0,2,3,4,5);
							if(in_array( $item['type_submenu'], $arr )){
								$amount_submenu = $item['colums'];
								$str .= "<div class='divul_container level".($level + 1).( ($item['group'] == 1) ? ' menugroup' : ' menunongroup').( $item['menu_class'] ? ' '.$item['menu_class'] : '' )."'".( $item['group'] == 0 ? ( $item['submenu_width'] > 0 ? ' style="width:'.$item['submenu_width'].'px"' : ' style="width:'.($amount_submenu * $widthDefault).'px"' ) : ' style="width:100%;"' ).">";
								$str .= "<div class='lof_container'>";
								if( $item['group'] == 1){
									$str .= "<ul class='ulitem'>";
								}
								$columnwidths = '';
								$columnwidth = '';
								if( !empty( $item['submenu_colum_width'] ) ){
									$columnwidths = explode( ':',$item['submenu_colum_width'] );
								}elseif( !empty( $item['colum_width'] ) ){
									$columnwidth = $item['colum_width'] ;
								}elseif( !empty( $item['submenu_width'] )){
									$columnwidth = floor($item['submenu_width']/($item['colums'] <= 0 ? 1 : $item['colums'])) ;
								}else{
									$columnwidth = $widthDefault;
								}
								$columns = ($item['colums'] <= 0 ? 1 : $item['colums']);
								$columns = ceil($item['numberItems']/$columns);
								$i = 0;
								$j = 0;
								if( $item['type_submenu'] == 0 && $item['modules'] ){
									$k = 1;
									foreach( $item['modules'] as $module ){/*module*/
										if( isset($columnwidths[$i]) && Validate::isInt($columnwidths[$i])){
											$columnwidth = $columnwidths[$i];
										}
										if($i == 0){
											if( !$item['group'] ){
												$str .= '<div class="lofcolumn col1"'.($columnwidth ? ' style="width:'.$columnwidth.'px"' : '' ).'>';
												$str .= "<ul class='ulitem'>";
											}
										}
										if( $j  == $columns){
											$k++;
											$str .= '</ul>';
											$str .= '</div>';
											$str .= '<div class="lofcolumn col'.$k.'">';
											$str .= "<ul class='ulitem'>";
											$j = 1;
										}else{
											$j++;
										}
										$str .= "<li class='lofitem".( $level + 1 )." menunongroup lofnonsub'>".$module."</li>";
										$i++;
									}
								}elseif( $item['type_submenu'] == 2 ){ /*text*/
									if( isset($columnwidths[0]) && Validate::isInt($columnwidths[0])){
										$columnwidth = $columnwidths[0];
									}
									if( !$item['group'] ){
										$str .= '<div class="lofcolumn col1"'.($columnwidth ? ' style="width:'.$columnwidth.'px"' : '' ).'>';
										$str .= "<ul class='ulitem'>";
									}
									$str .= "<li class='lofitem".( $level + 1 )." menunongroup lofnonsub'>".$item['content_text']."</li>";
								}elseif( $item['type_submenu'] == 3 && $item['products'] ){/* products */
									$k = 1;
									foreach( $item['products'] as $row ){
										if( isset($columnwidths[$i]) && Validate::isInt($columnwidths[$i])){
											$columnwidth = $columnwidths[$i];
										}
										if($i == 0){
											if( !$item['group'] ){
												$str .= '<div class="lofcolumn col1"'.($columnwidth ? ' style="width:'.$columnwidth.'px"' : '' ).'>';
												$str .= "<ul class='ulitem'>";
											}
										}
										if( $j  == $columns ){
											$k++;
											$str .= '</ul>';
											$str .= '</div>';
											$str .= '<div class="lofcolumn col'.$k.'"'.($columnwidth ? ' style="width:'.$columnwidth.'px"' : '' ).'>';
											$str .= "<ul class='ulitem'>";
											$j = 1;
										}else{
											$j++;
										}
										$str .= "<li class='lofitem".( $level + 1 )." menunongroup lofnonsub'><a href='".$row['link']."' title='".$row['name']."'><span class='lof-menu-title'>".$row['name']."</span></a></li>";
										$i++;
									}
								}elseif( $item['type_submenu'] == 4 && $item['categories'] ){/* categories */
									$k = 1;
									foreach( $item['categories'] as $row ){
										if( isset($columnwidths[$i]) && Validate::isInt($columnwidths[$i])){
											$columnwidth = $columnwidths[$i];
										}
										if($i == 0){
											if( !$item['group'] ){
												$str .= '<div class="lofcolumn col1"'.($columnwidth ? ' style="width:'.$columnwidth.'px"' : '' ).'>';
												$str .= "<ul class='ulitem'>";
											}
										}
										if( $j  == $columns ){
											$k++;
											$str .= '</ul>';
											$str .= '</div>';
											$str .= '<div class="lofcolumn col'.$k.'"'.($columnwidth ? ' style="width:'.$columnwidth.'px"' : '' ).'>';
											$str .= "<ul class='ulitem'>";
											$j = 1;
										}else{
											$j++;
										}
										$str .= "<li class='lofitem".( $level + 1 )." menunongroup lofnonsub'><a href='".$row['link']."' title='".$row['name']."'><span class='lof-menu-title'>".$row['name']."</span></a></li>";
										$i++;
									}
								}elseif( $item['type_submenu'] == 5 && $item['cmss'] ){/* CMS */
									$k = 1;
									foreach( $item['cmss'] as $row ){
										if( isset($columnwidths[$i]) && Validate::isInt($columnwidths[$i])){
											$columnwidth = $columnwidths[$i];
										}
										if($i == 0){
											if( !$item['group'] ){
												$str .= '<div class="lofcolumn col1"'.($columnwidth ? ' style="width:'.$columnwidth.'px"' : '' ).'>';
												$str .= "<ul class='ulitem'>";
											}
										}
										if( $j  == $columns){
											$k++;
											$str .= '</ul>';
											$str .= '</div>';
											$str .= '<div class="lofcolumn col'.$k.'"'.($columnwidth ? ' style="width:'.$columnwidth.'px"' : '' ).'>';
											$str .= "<ul class='ulitem'>";
											$j = 1;
										}else{
											$j++;
										}
										$str .= "<li class='lofitem".( $level + 1 )." menunongroup lofnonsub'><a href='".$row['link']."' title='".$row['meta_title']."'><span class='lof-menu-title'>".$row['meta_title']."</span></a></li>";
										$i++;
									}
								}
								/*
								if( !$item['group'] ){
									$str .= "</ul>";
									$str .= "</div>";
								}
								if( $item['group'] == 1){
									$str .= "</ul>";
								}
								*/
								$str .= "</ul>";
								if( $item['group'] != 1){
									$str .= "</div>";
								}
								$str .= "</div>";
								$str .= "</div>";
							}
						}
						$tgcol = $item['col'];
						$str .="</li>";
						
					}
				}
				if( !empty($str) ){
					//$str .="</div>";
				}
			}
			return $str;
		}
		/**
		* get menus
		*
		*/
		public function getMenus( $params ){
			global $smarty;
			$pos = $params->get('pos','top');
			$widthDefault = ($pos == 'top' ? $params->get('itemswidth_top', 200) : $params->get('itemswidth_left', 200));
			$position_type = ($params->pos == 'leftColumn' ? 'left' : 'top');
			$menus = LofClassMegaMenu::getMegaMenus( null, true, $position_type);
			if(!$menus)
				return array();
			foreach( $menus as &$menu ){
				$menu['menuicon'] = $this->getMenuIcon( $menu['id_lofmegamenu'] );
				/* get Modules */
				$menu['modules'] = '';
				$menu['products'] = '';
				$menu['categories'] = '';
				$menu['cmss'] = '';
				$numbers = 0;
				if( $menu['type_submenu'] == 0 ){
					if( !empty($menu['submenu_content']) ){
						$modules = $this->getListModules( $menu['submenu_content'] );
						if($modules){
							$menu['modules'] = $modules;
							$numbers = count( $menu['modules'] );
						}else{
							$menu['type_submenu'] = 1;
						}
					}
				}elseif( $menu['type_submenu'] == 3 ){
					if( !empty($menu['submenu_content']) ){
						$arrContent = explode(':', $menu['submenu_content']);
						$products = $this->getListProducts( $arrContent[0],(isset($arrContent[1]) ? $arrContent[1] : false),(isset($arrContent[2]) && Validate::isUnsignedId($arrContent[2]) ? $arrContent[2] : false) );
						if($products){
							$menu['products'] = $products;
							$numbers = count( $menu['products'] );
						}else{
							$menu['type_submenu'] = 1;
						}
					}
				}elseif( $menu['type_submenu'] == 4 ){
					if( !empty($menu['submenu_content']) ){
						$arrContent = explode(':', $menu['submenu_content']);
						$order_by = false;
						$order_way = 'DESC';
						$order_by_way = (isset($arrContent[1]) ? $arrContent[1] : false);
						if($order_by_way){
							$o = explode('-', $order_by_way);
							$order_by = $o[0];
							$order_way = $o[1];
						}
						$categories = $this->getListCategories( $arrContent[0], $order_by, $order_way );
						if($categories){
							$menu['categories'] = $categories;
							$numbers = count( $menu['categories'] );
						}else{
							$menu['type_submenu'] = 1;
						}
					}
				}elseif( $menu['type_submenu'] == 5 ){
					if( !empty($menu['submenu_content']) ){
						$arrContent = explode(':', $menu['submenu_content']);
						$order_by = false;
						$order_way = 'DESC';
						$order_by_way = (isset($arrContent[1]) ? $arrContent[1] : false);
						if($order_by_way){
							$o = explode('-', $order_by_way);
							$order_by = $o[0];
							$order_way = $o[1];
						}
						
						$cmss = $this->getListCMSs( $arrContent[0], $order_by, $order_way,0, (isset($arrContent[2]) && Validate::isUnsignedId($arrContent[2]) ? $arrContent[2] : false) );
						if($cmss){
							$menu['cmss'] = $cmss;
							$numbers = count( $menu['cmss'] );
						}else{
							$menu['type_submenu'] = 1;
						}
					}
				}elseif($menu['type_submenu'] == 2){
					$numbers = 1;
				}
				$numberItem = count(LofClassMegaMenu::getsubmegamenu( $menu['id_lofmegamenu'] ));
				$menu['numberItems'] = $numberItem + $numbers;
				if( $menu['type'] == 'module' ){
					$menu['module'] = self::getModuleAssign($menu['value']);
					$menu['link'] = '#';
				}else{
					$menu['link'] = self::getLinkMenu( $menu['value'], $menu['type']);
					$menu['module'] = '';
				}
			}
			$children = array();
			if ( $menus ){
				foreach ( $menus as $v ){				
					$pt 	= $v["id_lofmegamenu_parent"];
					$list 	= @$children[$pt] ? $children[$pt] : array();
					array_push( $list, $v );
					$children[$pt] = $list;
				}
				$children;
			}
			foreach( $children as $key => $value){
				$columnwidths = array();
				$obj = new LofClassMegaMenu( $key );
				$i = 0 ;
				$countNumber = 0;
				if( $obj->type_submenu == 0){
					foreach( $menus as $row ){
						if( $row['id_lofmegamenu'] == $obj->id_lofmegamenu ){
							if( !empty($row['modules']) ){
								$countNumber = count( $row['modules'] );
							}
							break;
						}
					}
				}elseif( $obj->type_submenu == 2 ){
					$countNumber = 1;
				}elseif( $obj->type_submenu == 3 ){/* sub products */
					foreach( $menus as $row ){
						if( $row['id_lofmegamenu'] == $obj->id_lofmegamenu ){
							if( !empty($row['products']) ){
								$countNumber = count( $row['products'] );
							}
							break;
						}
					}
				}elseif( $obj->type_submenu == 4 ){/* sub categories */
					foreach( $menus as $row ){
						if( $row['id_lofmegamenu'] == $obj->id_lofmegamenu ){
							if( !empty($row['categories']) ){
								$countNumber = count( $row['categories'] );
							}
							break;
						}
					}
				}elseif( $obj->type_submenu == 5 ){/* sub CMS */
					foreach( $menus as $row ){
						if( $row['id_lofmegamenu'] == $obj->id_lofmegamenu ){
							if( !empty($row['cmss']) ){
								$countNumber = count( $row['cmss'] );
							}
							break;
						}
					}
				}
				$numberOfColumn = 0;
				$colums = 1;
				if( Validate::isLoadedObject( $obj ) ){
					/* Column */
					if( $obj->group == 0 ){
						if( $obj->colums <= 0 ){
							$colums = 1;
						}else{
							$colums = $obj->colums;
						}
						//$mod = count($children[$key]) % $colums ;
						$numberOfColumn = ceil((count($children[$key]) + $countNumber) /$colums) ;
						//echo $colums.' '.$countNumber ; die;
					}
				}
				if($numberOfColumn > 0){
					$j = ( $numberOfColumn > $countNumber ? $countNumber : ($numberOfColumn == $countNumber ? 0 : $numberOfColumn % $countNumber) ) + 1;
					$k = ( $numberOfColumn > $countNumber ? 0 : ($numberOfColumn == $countNumber ? 1 : intval($countNumber/$numberOfColumn)) ) + 1;
				}
				foreach( $children[$key] as &$child ){
					if( Validate::isLoadedObject( $obj ) ){
						/* Column */
						if( $numberOfColumn > 0 && $obj->group == 0 ){
							$child['col'] = $k;
							if( $j < $numberOfColumn ){
								$j++;
							}else{
								$k++;
								$j = 1;
							}
						}else{
							$child['col'] = 0;
						}
						/* Width*/
						if( !empty($obj->submenu_colum_width) ){
							$columnwidths = explode( ':',$obj->submenu_colum_width );
							if( $obj->type_submenu == 0){
								foreach( $menus as $row ){
									if( $row['id_lofmegamenu'] == $obj->id_lofmegamenu ){
										if( !empty($row['modules']) ){
											$i = count( $row['modules'] );
										}
										break;
									}
								}
							}elseif( $obj->type_submenu == 2 ){
								$i = 1;
							}elseif( $obj->type_submenu == 3 ){/* sub products */
								foreach( $menus as $row ){
									if( $row['id_lofmegamenu'] == $obj->id_lofmegamenu ){
										if( !empty($row['products']) ){
											$i = count( $row['products'] );
										}
										break;
									}
								}
							}elseif( $obj->type_submenu == 4 ){/* sub categories */
								foreach( $menus as $row ){
									if( $row['id_lofmegamenu'] == $obj->id_lofmegamenu ){
										if( !empty($row['categories']) ){
											$i = count( $row['categories'] );
										}
										break;
									}
								}
							}elseif( $obj->type_submenu == 5 ){/* sub CMS */
								foreach( $menus as $row ){
									if( $row['id_lofmegamenu'] == $obj->id_lofmegamenu ){
										if( !empty($row['cmss']) ){
											$i = count( $row['cmss'] );
										}
										break;
									}
								}
							}
							if( isset($columnwidths[($child['col'] - 1)]) && Validate::isInt($columnwidths[($child['col'] - 1)])){
								$child['columnwidth'] = $columnwidths[($child['col'] - 1)];
							}
						}elseif( !empty($obj->colum_width ) && Validate::isInt( $obj->colum_width ) ){
							$child['columnwidth'] = $obj->colum_width ;
						}elseif( !empty( $obj->submenu_width ) && Validate::isInt( $obj->submenu_width ) ){
							$amount_submenu = count( LofClassMegaMenu::getsubmegamenu( $obj->id_lofmegamenu ) );
							if( $obj->type_submenu == 0 ){
								foreach( $menus as $row ){
									if( $row['id_lofmegamenu'] == $obj->id_lofmegamenu ){
										if( !empty($row['modules']) ){
											$amount_submenu = $amount_submenu + count( $row['modules'] );
										}
										break;
									}
								}
							}elseif( $obj->type_submenu == 2 ){
								$amount_submenu ++;
							}elseif( $obj->type_submenu == 3 ){
								foreach( $menus as $row ){
									if( $row['id_lofmegamenu'] == $obj->id_lofmegamenu ){
										if( !empty($row['products']) ){
											$amount_submenu = $amount_submenu + count( $row['products'] );
										}
										break;
									}
								}
							}elseif( $obj->type_submenu == 4 ){
								foreach( $menus as $row ){
									if( $row['id_lofmegamenu'] == $obj->id_lofmegamenu ){
										if( !empty($row['categories']) ){
											$amount_submenu = $amount_submenu + count( $row['categories'] );
										}
										break;
									}
								}
							}elseif( $obj->type_submenu == 5 ){
								foreach( $menus as $row ){
									if( $row['id_lofmegamenu'] == $obj->id_lofmegamenu ){
										if( !empty($row['cmss']) ){
											$amount_submenu = $amount_submenu + count( $row['cmss'] );
										}
										break;
									}
								}
							}
							if( $obj->colums > $amount_submenu )
								$amount = $amount_submenu;
							else
								$amount = $obj->colums ;
							if( $amount > 0 ){
								$child['columnwidth'] = floor( $obj->submenu_width/$amount );
							}
						}
						if( !isset( $child['columnwidth'] ) ){
							$child['columnwidth'] = $widthDefault;
						}
					}else{
						$child['columnwidth'] = false;
						$child['col'] = 0;
					}
					$i ++;
				}
				
			}
			return $children;
		}
		/**
		* get module By Name
		*
		*/
		public function getModuleByName( $module_name){
			return Db::getInstance()->getRow('
			SELECT *
			FROM `'._DB_PREFIX_.'module`
			WHERE `name` = \''.$module_name.'\'');
		}
		/**
		* get module By ID
		*
		*/
		public function getModule( $id_module){
			return Db::getInstance()->getRow('
			SELECT *
			FROM `'._DB_PREFIX_.'module`
			WHERE `id_module` = '.$id_module);
		}
		/**
		* get hook
		*
		*/
		public function getHook( $id_hook){
			return Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow('
			SELECT *
			FROM `'._DB_PREFIX_.'hook` 
			WHERE `id_hook` = '.$id_hook);
		}
		/**
		* get list Modules
		*
		*/
		public function getListModules( $values ){
			$lofmodules = array();
			$lofhooks = array();
			if($values ){
				$arrmodulehook = explode(',', $values);
				foreach( $arrmodulehook as $modulehook){
					$arrItems = explode(':',$modulehook); 
					if( count($arrItems) == 2){
						$lofmodules[] = self::getModule( $arrItems[0] );
						$lofhooks[] = self::getHook( $arrItems[1] );
					}
				}
			}
			$results = array();
			if( $lofmodules && $lofhooks && (count($lofhooks) == count($lofmodules)) ){
				for( $i = 0; $i < count($lofhooks); $i++){
					$array = array();
					$array['id_hook']   = $lofhooks[$i]['id_hook'];
					$array['module'] 	= $lofmodules[$i]['name'];
					$array['id_module'] = $lofmodules[$i]['id_module'];
					$results[] = self::lofHookExec( $lofhooks[$i]['name'], array(), $lofmodules[$i]['id_module'], $array );
					/* delete module hook
					self::DeleteModuleHook( $lofmodules[$i]['id_module'], $lofhooks[$i]['id_hook'] );
					*/
				}
			}
			return $results;
		}
		/**
		* get list Products
		*
		*/
		public function getListProducts( $values, $order_by_way = false, $limit = false){
			$where = '';
			if( $values ){
				$id_categories = explode(',', $values);
				if( count($id_categories) == 1){
					$where = ' AND cp.`id_category` = '.$id_categories[0];
				}else{
					$where = ' AND cp.`id_category` IN ('.$values.')';
				}
			}
			$start = 0;
			$order_by = false;
			$order_way = 'DESC';
			if($order_by_way){
				$o = explode('-', $order_by_way);
				$order_by = $o[0];
				$order_way = $o[1];
			}
			if(version_compare(_PS_VERSION_, '1.4.0.0', '>=')){
				return self::getListProductsV14($where, $order_by, $order_way, $start, $limit);
			}else{
				return self::getListProductsV13($where, $order_by, $order_way, $start, $limit);
			}
		}
		
		public function getListProductsV13($where='', $order_by = false, $order_way = 'DESC', $start = 0, $limit = false){		
			global $cookie, $link;
			$id_lang = intval($cookie->id_lang);
		
			$sql = '
			SELECT DISTINCT p.id_product, p.*, pa.`id_product_attribute`, pl.`description`, pl.`description_short`, pl.`available_now`, pl.`available_later`, pl.`link_rewrite`, pl.`meta_description`, pl.`meta_keywords`, pl.`meta_title`, pl.`name`, i.`id_image`, il.`legend`, m.`name` AS manufacturer_name, tl.`name` AS tax_name, t.`rate`, cl.`name` AS category_default, DATEDIFF(p.`date_add`, DATE_SUB(NOW(), INTERVAL '.(Validate::isUnsignedInt(Configuration::get('PS_NB_DAYS_NEW_PRODUCT')) ? Configuration::get('PS_NB_DAYS_NEW_PRODUCT') : 20).' DAY)) > 0 AS new,
				(p.`price` * IF(t.`rate`,((100 + (t.`rate`))/100),1) - IF((DATEDIFF(`reduction_from`, CURDATE()) <= 0 AND DATEDIFF(`reduction_to`, CURDATE()) >=0) OR `reduction_from` = `reduction_to`, IF(`reduction_price` > 0, `reduction_price`, (p.`price` * IF(t.`rate`,((100 + (t.`rate`))/100),1) * `reduction_percent` / 100)),0)) AS orderprice 
			FROM `'._DB_PREFIX_.'category_product` cp
			LEFT JOIN `'._DB_PREFIX_.'product` p ON p.`id_product` = cp.`id_product`
			LEFT JOIN `'._DB_PREFIX_.'product_attribute` pa ON (p.`id_product` = pa.`id_product` AND default_on = 1)
			LEFT JOIN `'._DB_PREFIX_.'category_lang` cl ON (p.`id_category_default` = cl.`id_category` AND cl.`id_lang` = '.intval($id_lang).')
			LEFT JOIN `'._DB_PREFIX_.'product_lang` pl ON (p.`id_product` = pl.`id_product` AND pl.`id_lang` = '.intval($id_lang).')
			LEFT JOIN `'._DB_PREFIX_.'image` i ON (i.`id_product` = p.`id_product` AND i.`cover` = 1)
			LEFT JOIN `'._DB_PREFIX_.'image_lang` il ON (i.`id_image` = il.`id_image` AND il.`id_lang` = '.intval($id_lang).')
			LEFT JOIN `'._DB_PREFIX_.'tax` t ON t.`id_tax` = p.`id_tax`
			LEFT JOIN `'._DB_PREFIX_.'tax_lang` tl ON (t.`id_tax` = tl.`id_tax` AND tl.`id_lang` = '.intval($id_lang).')
			LEFT JOIN `'._DB_PREFIX_.'manufacturer` m ON m.`id_manufacturer` = p.`id_manufacturer`
			WHERE  p.`active` = 1 '.$where
			.($order_by ? ' ORDER BY '.$order_by.' '.$order_way : '')
			.($limit ? ' LIMIT '.(int)($start).','.(int)($limit) : '');
			
			$result = Db::getInstance()->ExecuteS($sql);
			return Product::getProductsProperties($id_lang, $result);
		}
		
		public function getListProductsV14($where='', $order_by = false, $order_way = 'DESC', $start = 0, $limit = false){		
			global $cookie, $link;
			$id_lang = intval($cookie->id_lang);
			
			$sql = '
			SELECT DISTINCT p.id_product, p.*, pa.`id_product_attribute`, pl.`description`, pl.`description_short`, pl.`available_now`, pl.`available_later`, pl.`link_rewrite`, pl.`meta_description`, pl.`meta_keywords`, pl.`meta_title`, pl.`name`, i.`id_image`, il.`legend`, m.`name` AS manufacturer_name, tl.`name` AS tax_name, t.`rate`, cl.`name` AS category_default, DATEDIFF(p.`date_add`, DATE_SUB(NOW(), INTERVAL '.(Validate::isUnsignedInt(Configuration::get('PS_NB_DAYS_NEW_PRODUCT')) ? Configuration::get('PS_NB_DAYS_NEW_PRODUCT') : 20).' DAY)) > 0 AS new,(p.`price` * IF(t.`rate`,((100 + (t.`rate`))/100),1)) AS orderprice
			FROM `'._DB_PREFIX_.'category_product` cp
			LEFT JOIN `'._DB_PREFIX_.'product` p ON p.`id_product` = cp.`id_product`
			LEFT JOIN `'._DB_PREFIX_.'product_attribute` pa ON (p.`id_product` = pa.`id_product` AND default_on = 1)
			LEFT JOIN `'._DB_PREFIX_.'category_lang` cl ON (p.`id_category_default` = cl.`id_category` AND cl.`id_lang` = '.(int)($id_lang).')
			LEFT JOIN `'._DB_PREFIX_.'product_lang` pl ON (p.`id_product` = pl.`id_product` AND pl.`id_lang` = '.(int)($id_lang).')
			LEFT JOIN `'._DB_PREFIX_.'image` i ON (i.`id_product` = p.`id_product` AND i.`cover` = 1)
			LEFT JOIN `'._DB_PREFIX_.'image_lang` il ON (i.`id_image` = il.`id_image` AND il.`id_lang` = '.(int)($id_lang).')
			LEFT JOIN `'._DB_PREFIX_.'tax_rule` tr ON (p.`id_tax_rules_group` = tr.`id_tax_rules_group`
													   AND tr.`id_country` = '.(int)Country::getDefaultCountryId().'
													   AND tr.`id_state` = 0)
			LEFT JOIN `'._DB_PREFIX_.'tax` t ON (t.`id_tax` = tr.`id_tax`)
			LEFT JOIN `'._DB_PREFIX_.'tax_lang` tl ON (t.`id_tax` = tl.`id_tax` AND tl.`id_lang` = '.(int)($id_lang).')
			LEFT JOIN `'._DB_PREFIX_.'manufacturer` m ON m.`id_manufacturer` = p.`id_manufacturer` 
			WHERE  p.`active` = 1 '.$where
			.($order_by ? ' ORDER BY '.$order_by.' '.$order_way : '')
			.($limit ? ' LIMIT '.(int)($start).','.(int)($limit) : '');
			
			$result = Db::getInstance(_PS_USE_SQL_SLAVE_)->ExecuteS($sql);
			
			if(!$result) return array();
			return Product::getProductsProperties($id_lang, $result);
		}
		/**
		* get list Products
		* return OBJECT
		*/
		public function getListCategories( $values, $order_by = false, $order_way = 'DESC'){
			global $cookie,$link;
			$id_lang = intval($cookie->id_lang);
			$where = '';
			if( $values ){
				$id_categories = explode(',', $values);
				if( count($id_categories) == 1){
					$where = ' AND c.`id_category` = '.$id_categories[0];
				}else{
					$where = ' AND c.`id_category` IN ('.$values.')';
				}
			}
			$results = Db::getInstance(_PS_USE_SQL_SLAVE_)->ExecuteS('
				SELECT *
				FROM `'._DB_PREFIX_.'category` c
				LEFT JOIN `'._DB_PREFIX_.'category_lang` cl ON (c.`id_category` = cl.`id_category` AND cl.`id_lang` = '.$id_lang.')
				WHERE `active` = 1 '.$where.
				($order_by ? ' ORDER BY '.$order_by.' '.$order_way : ' ORDER BY c.`id_category` ASC')
			);
			if( !$results )
				return array();
			foreach( $results as &$result ){
				$result['link'] = $link->getCategoryLink((int)$result['id_category'], $result['link_rewrite'], (int)$result['id_lang']);
			}
			return $results;
		}
		/**
		* get list Products
		* return OBJECT
		*/
		public function getListCMSs( $values, $order_by = false, $order_way = 'DESC', $start = 0, $limit = false ){
			global $cookie, $link;
			$id_lang = intval($cookie->id_lang);
			$where = '';
			if( $values ){
				$id_categories = explode(',', $values);
				if( count($id_categories) == 1){
					$where = ' AND c.`id_cms_category` = '.$id_categories[0];
				}else{
					$where = ' AND c.`id_cms_category` IN ('.$values.')';
				}
			}
			$results = Db::getInstance()->ExecuteS('
				SELECT *
				FROM `'._DB_PREFIX_.'cms` c
				JOIN `'._DB_PREFIX_.'cms_lang` l ON (c.`id_cms` = l.`id_cms`)
				WHERE c.`active` = 1 AND l.`id_lang` = '.(int)($id_lang).$where
				.($order_by ? ' ORDER BY '.$order_by.' '.$order_way : ' ORDER BY c.`id_cms`')
				.($limit ? ' LIMIT '.(int)($start).','.(int)($limit) : '')
			);
			if( !$results )
				return array();
			foreach ( $results as &$result ){
				$result['link'] = $link->getCMSLink((int)$result['id_cms'], $result['link_rewrite'], false, (int)$result['id_lang']);
			}
			return $results;
		}
		/**
		* get Module Assign
		*/
		public function getModuleAssign( $module_name = '' ){
			$lofmegamenu = new lofmegamenu();
			$moduleAssign = $lofmegamenu->moduleAssign;
			
			if( !empty($module_name) && isset($moduleAssign[$module_name]) ){
				$id_hook = isset($moduleAssign[$module_name][0]) ? $moduleAssign[$module_name][0] : 14;
				$hook_name = isset($moduleAssign[$module_name][1]) ? $moduleAssign[$module_name][1] : 'top';
				$module = self::getModuleByName( $module_name );
				if( $module ){
					$id_module = $module['id_module'];
					$array = array();
					$array['id_hook']   = $id_hook;
					$array['module'] 	= $module_name;
					$array['id_module'] = $id_module;
					/*self::DeleteModuleHook( $id_module, $id_hook );*/
					return self::lofHookExec( $hook_name, array(), $id_module, $array );
				}
			}
			return '';			
		}
		/**
		* Hook Exec
		*
		*/
		public static function lofHookExec( $hook_name, $hookArgs = array(), $id_module = NULL, $array = array() ){
			global $cart, $cookie;
			if ((!empty($id_module) AND !Validate::isUnsignedId($id_module)) OR !Validate::isHookName($hook_name))
				die(Tools::displayError());

			$live_edit = false;
			if (!isset($hookArgs['cookie']) OR !$hookArgs['cookie'])
				$hookArgs['cookie'] = $cookie;
			if (!isset($hookArgs['cart']) OR !$hookArgs['cart'])
				$hookArgs['cart'] = $cart;
			$hook_name = strtolower($hook_name);
			$altern = 0;
			
			if ($id_module AND $id_module != $array['id_module'])
				continue;
			if (!($moduleInstance = Module::getInstanceByName($array['module'])))
				continue;

			$exceptions = $moduleInstance->getExceptions((int)$array['id_hook'], (int)$array['id_module']);
			foreach ($exceptions AS $exception)
				if (strstr(basename($_SERVER['PHP_SELF']).'?'.$_SERVER['QUERY_STRING'], $exception['file_name']) && !strstr($_SERVER['QUERY_STRING'], $exception['file_name']))
					continue 2;

			if (is_callable(array($moduleInstance, 'hook'.$hook_name)))
			{
				$hookArgs['altern'] = ++$altern;
				$output = call_user_func(array($moduleInstance, 'hook'.$hook_name), $hookArgs);
			}
			return $output;
		}
		/**
		* delete Module Hook
		*
		*/
		public function DeleteModuleHook( $id_module, $id_hook ){
			Db::getInstance()->Execute('
				DELETE FROM `'._DB_PREFIX_.'hook_module`
				WHERE `id_module` = '.(int)($id_module).'
				AND `id_hook` = '.(int)($id_hook));
			/*Module::cleanPositions( $id_hook );*/
			return true;
		}
		public function getMenuIcon( $id_menu ){
			$imageType = 'png';
			if ( file_exists( _PS_MODULE_DIR_.$this->modulename.'/'.'icon/'.$id_menu.'.'.$imageType ) ){
				return _MODULE_DIR_.$this->modulename.'/'.'icon/'.$id_menu.'.'.$imageType;
			}
			return '';
		}
		public function getLinkMenu( $value, $type ){
			global $link, $cookie;
			$result = '';
			switch ( $type ){
				case 'product':
					if(Validate::isLoadedObject($objPro = new Product($value,true, $cookie->id_lang))){
						$result = $link->getProductLink((int)$objPro->id, $objPro->link_rewrite, NULL, NULL, $cookie->id_lang);
					}
				break;
				case 'category':
					if(Validate::isLoadedObject($objCate = new Category($value, $cookie->id_lang))){
						$result = $link->getCategoryLink((int)$objCate->id, $objCate->link_rewrite, $cookie->id_lang);
					}
				break;
				case 'cms':
					if(Validate::isLoadedObject($objCMS = new CMS($value, $cookie->id_lang))){
						$result = $link->getCMSLink((int)$objCMS->id, $objCMS->link_rewrite, $cookie->id_lang);
					}
				break;
				case 'link':
					$result = $value;
				break;
				case 'manufacturer':
					if(Validate::isLoadedObject($objManu = new Manufacturer($value, $cookie->id_lang))){
						$result = $link->getManufacturerLink((int)$objManu->id, $objManu->link_rewrite, $cookie->id_lang);
					}
				break;
				case 'supplier':
					if(Validate::isLoadedObject($objSupp = new Supplier($value, $cookie->id_lang))){
						$result = $link->getSupplierLink((int)$objSupp->id, $objSupp->link_rewrite, $cookie->id_lang);
					}
				break;
			}
			return $result;
		}
		
	}/*End Class*/
}/*End Check*/
?>