<?php /*%%SmartyHeaderCode:4855506c63efea3b89-42148249%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '42f11d5aaa4280ebc2efc1baef7bb3a2f7e88917' => 
    array (
      0 => 'C:\\xampp\\htdocs\\clopstore/themes/leo_tshirt/modules/blockcategories/blockcategories.tpl',
      1 => 1349280129,
      2 => 'file',
    ),
    'c7ea264e86d0e59615b3d943a81993357ae1b8f5' => 
    array (
      0 => 'C:\\xampp\\htdocs\\clopstore/themes/leo_tshirt/modules/blockcategories/category-tree-branch.tpl',
      1 => 1349280129,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4855506c63efea3b89-42148249',
  'has_nocache_code' => false,
  'cache_lifetime' => 3600,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!$no_render) {?>

<!-- Block categories module -->
<div id="categories_block_left" class="block">
	<h4 class="heading-hightlight"><span>Cat&eacute;gories</span></h4>
	<div class="block_content">
		<ul class="tree dhtml">
									
<li >
	<a href="http://localhost/clopstore/category.php?id_category=2"  title="Il est temps, pour le meilleur lecteur de musique, de remonter sur scène pour un rappel. Avec le nouvel iPod, le monde est votre scène.">E-Cigarettes</a>
	</li>
												
<li >
	<a href="http://localhost/clopstore/category.php?id_category=3"  title="Tous les accessoires à la mode pour votre iPod">E-Liquides</a>
	</li>
												
<li >
	<a href="http://localhost/clopstore/category.php?id_category=4"  title="Le tout dernier processeur Intel, un disque dur plus spacieux, de la mémoire à profusion et d&#039;autres nouveautés. Le tout, dans à peine 2,59 cm qui vous libèrent de toute entrave. Les nouveaux portables Mac réunissent les performances, la puissance et la connectivité d&#039;un ordinateur de bureau. Sans la partie bureau.">Accessoires</a>
	</li>
												
<li class="last">
	<a href="http://localhost/clopstore/category.php?id_category=5"  title="">Diagnostic Personnalisé</a>
	</li>
							</ul>
		<script type="text/javascript">
		// <![CDATA[
			// we hide the tree only if JavaScript is activated
			$('div#categories_block_left ul.dhtml').hide();
		// ]]>
		</script>
	</div>
</div>
<!-- /Block categories module -->
<?php } ?>