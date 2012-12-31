<?php

/**
 * @package     Extly.Modules
 * @subpackage  mod_sobipro_tree - SobiPro Tree of Categories
 * 
 * @author      Prieco S.A. <support@extly.com>
 * @copyright   Copyright (C) 2007 - 2012 Prieco, S.A. All rights reserved.
 * @license     http://http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL 
 * @link        http://www.prieco.com http://www.extly.com http://support.extly.com 
 */
// No direct access
defined('_JEXEC') or die('Restricted access');

$isMultimode = ModSobiproTreeHelper::getMultimode($debug);

$list = ModSobiproTreeHelper::getListNLevel(
		$parentid,
		$categorystartlevel,
		$categorymode,
		$count,
		$sorder,
		$require_stats,
		$isMultimode,
		$debug
		);

$sectionid = $parentid;
$parents = array_keys($list);

if ((!count($list)) || ($list[$sectionid] == null))
{
	echo 'Empty Section';
	return;
}

?>
<div class="sidebar-nav">
	<div id="accordion-categories" class="accordion">
	<?php
		echo ModSobiproTreeHelper::generate(
				$list, $sectionid,
				$actual_sid, $scitemid, $subItemsid, $defaultItemid,
				$scounter, $hide_empty, $categorystartlevel, $categorymode,1,0,0
		).'</div></div></div>';?>	
	</div>
</div>
