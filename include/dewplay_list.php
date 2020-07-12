<?php
require_once dirname(__FILE__) . '/../header.php';

$xoopsLogger->activated = false ;

$start = !empty($_REQUEST['start']) ? $_REQUEST['start'] : 0 ;
$limit = !empty($GLOBALS['xoopsModuleConfig']['perpage']) ? $GLOBALS['xoopsModuleConfig']['perpage'] : 10 ;

/*@var $handler NcplayerPlayerHandler*/
$handler = xoops_getmodulehandler('player', 'ncplayer');

// Add music
if ( !empty($_REQUEST['op']) && $_REQUEST['op']  == 'add' ) {
	$name = $_REQUEST['name'];
	$url  = $_REQUEST['url'];
	if ( $name && $url ) {
		$uid = !empty($GLOBALS['xoopsUser']) ? $GLOBALS['xoopsUser']->getVar('uid') : 1 ;
		$criteria = new CriteriaCompo();
		$criteria->add(new Criteria('name', $name));
		$criteria->add(new Criteria('url', $url));
		$criteria->add(new Criteria('uid', $uid));
		if ( !$handler->getObjects($criteria) ) {
			$obj = $handler->create();
			$obj->setVar('name', $name);
			$obj->setVar('url', $url);
			$obj->setVar('dtime', time());
			$obj->setVar('uid', $uid);
			$handler->insert($obj, true);
		}
	}
}


// Del music 
if ( !empty($_REQUEST['op']) && $_REQUEST['op'] == 'del' ) {
	$id = $_REQUEST['id'];
	if ( $id ) {
		/*@var $obj XoopsPlayer */
		$obj = $handler->get($id);
		if (!$handler->delete($obj, true)){
			$obj->getHtmlErrors();
		}
	}
}


// List all music 
$criteria = new CriteriaCompo();
$criteria->add(new Criteria('uid', 1));
if ( $GLOBALS['xoopsUser'] ) {
	$criteria->add(new Criteria('uid', $GLOBALS['xoopsUser']->getVar('uid')), 'OR');
}
$total = $handler->getCount($criteria);

if ( $total > $limit ) {
	$preNum = $start - $limit ;
	if ( $preNum >= 0) {
		$pre  = '<span class="nav" start="' . $preNum . '"><img src="'.XOOPS_URL.'/modules/ncplayer/images/pre.gif"></span>' ;
	}
	
	$nextNum = $start + $limit ;
	if ( $nextNum < $total ) {
		$next = '<span class="nav" start="' . $nextNum . '"><img src="'.XOOPS_URL.'/modules/ncplayer/images/next.gif"></span>' ;
	}
}

$criteria->setSort('dtime');
$criteria->setOrder('DESC');
$criteria->setLimit($limit);
$criteria->setStart($start);

$blocks = $handler->getMusic($criteria);

$str = '<table width="100%">';
foreach ( $blocks as $block ) {
	$str .= '<tr><td>
	<span><input style="border:1px solid #eee;" class="checkbox" music="'.$block['url'].'" type="checkbox" name="checkbox" value="" /></span>
	<span class="play" music="'.$block['url'].'">'.xoops_substr($block['name'], 0, 20).'</span></td>  
	<td style="text-align:right;"><span musicid="'.$block['id'].'" op="del" class="delete"><img src="'.XOOPS_URL.'/modules/ncplayer/images/x.gif" /></span></td></tr>';
}
$str .= '</table>';

$nav  = "<table width='100%'><tr><td width='70%'>";
$nav .= "<span id='add'><img src='".XOOPS_URL."/modules/ncplayer/images/add.png'></span>";
$nav .= "<span id='search' style='padding-left:5px;'><img src='".XOOPS_URL."/modules/ncplayer/images/search.png'></span>";
$nav .= "<span id='top500' style='padding-left:5px;'>Top500</span></td>";
if ( $pre || $next ) {
	$nav .= "<td><span>" . $pre . " " . $next . "</span></td>" ;
}
$nav .= "</tr></table>"; 

echo $nav ;
echo "<div style='margin:2px;'>" . $str . "</div>" ;
echo "<div style='text-align:right;margin:2px;'><input id='multiplay' type='button' name='multiplay' value='multiplay' /></div>";
echo "<script type='text/javascript' src='".XOOPS_URL . "/modules/ncplayer/include/dewplay2.js'></script>";


?>