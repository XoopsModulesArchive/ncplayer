<?php
/**
 * Donation block  manager  for nckarma
 *
 * 
 * @copyright	The XOOPS project http://www.xoops.org/
 * @license		http://www.fsf.org/copyleft/gpl.html GNU public license
 * @author		Wenfei Li (nightcat) <liwenfei@21cn.com>
 * @since		0.95
 * @version		$Id$ 2007-08-19
 * @package		module::ncpay
 */

function b_ncplayer_show() 
{
	$blocks['default'] = _NCPLAYER_DEFAULT_MUSIC ;	
	
	$blocks['player'] =  XOOPS_URL . '/modules/ncplayer/include' ;	
//	$blocks['jquery'] =  XOOPS_URL . '/modules/ncplayer/include/jquery-1.2.1.js' ;	
	$blocks['dewplayer'] =  XOOPS_URL . '/modules/ncplayer/include/dewplay.js' ;	
	$blocks['url'] =  XOOPS_URL . '/modules/ncplayer/include/dewplay.php' ;	
	$blocks['listurl'] =  XOOPS_URL . '/modules/ncplayer/include/dewplay_list.php' ;	
	$blocks['searchurl'] =  XOOPS_URL . '/modules/ncplayer/include/dewplay_search.php' ;	

    return $blocks;
}
?>