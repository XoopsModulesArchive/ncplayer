<?php
/**
 *  Xoops Version for ncplayer
 *
 * @copyright	The XOOPS project http://www.xoops.org/
 * @license		http://www.fsf.org/copyleft/gpl.html GNU public license
 * @author		Wenfei Li (nightcat) <liwenfei@21cn.com>
 * @since		1.00
 * @version		$Id$ 2007/11/30
 * @package		module::ncplayer
 */

$modversion['name'] = _NCPLAYER_MI_NAME;
$modversion['version'] = 1.00;
$modversion['description'] = _NCPLAYER_MI_NAME_DESC ;
$modversion['author'] = "nightcat";
$modversion['credits'] = "";
$modversion['license'] = "";
$modversion['official'] = 0;
$modversion['image'] = "images/logo.png";
$modversion['dirname'] = 'ncplayer';

$modversion['hasAdmin']   = 1;                   
$modversion['adminindex'] = "admin/index.php";   
$modversion['adminmenu']  = "admin/menu.php"; 

$modversion['hasMain']    = 0; 

$modversion['config'][]=array(
	"name" => "perpage",
	"title" => "_NCPLAYER_MI_PERPAGE",
	"description" => "_NCPLAYER_MI_PERPAGE_DESC",
	"formtype" => "textbox",
	"valuetype" => "int",
	"default" => 10
);

$modversion['sqlfile']['mysql'] = "sql/mysql.sql";
$modversion['tables'][0] = "ncplayer_list";

// blocks
$modversion['blocks'][1]['file']        = "ncplayer_blocks.php";
$modversion['blocks'][1]['name']        = _NCPLAYER_MI_PLAYER ;
$modversion['blocks'][1]['description'] = "Shows player block";
$modversion['blocks'][1]['show_func']   = "b_ncplayer_show";
$modversion['blocks'][1]['template']    = "ncplayer_block_player.html";
?>