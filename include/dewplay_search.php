<?php
require_once dirname(__FILE__) . '/../header.php';
require_once dirname(__FILE__) . '/../class/baidu.php';
$xoopsLogger->activated = false ;

$op = $_REQUEST['op'] ;
if ( $op == 'search' ) {
	$baidu = new musicBaidu();
	$music = $baidu->search($_REQUEST['word']);
	if ( $music ) {
		$str  = "<table width='100%'>";
		$str .= "<tr><td><div id='listmusic_s' url=" . $music['url'] . ">" . $music['name'] . "</div></td><td align='right'> <span class='musiclist' mid='listmusic_s' op='add' ><img src='".XOOPS_URL."/modules/ncplayer/images/add.png' /></span></td></tr>";
		$str .= "</table>";
	} else {
		$str = "Sorry , can't get the music";
	}
	echo $str ;
}

if ( $op == 'list' ) {
	$baidu  = new musicBaidu();
	$music = $baidu->getList(100, @$_REQUEST['searchstart']);
	
	echo "<div>" . $music[$pagenav] . "</div>" ;
	
	$str = "<table width='100%'>";
	foreach( $music['music'] as $k=>$v ) {
		$str .= "<tr><td><div id='listmusic{$k}' url=".$v['url'].">" . $v['name'] . "</div></td><td align='right'> <span class='musiclist' mid='listmusic{$k}' op='add' ><img src='".XOOPS_URL."/modules/ncplayer/images/add.png' /></span></td></tr>";
	}
	$str .= "</table>";
	
	echo $str ;
}

echo "<script type='text/javascript' src='".XOOPS_URL . "/modules/ncplayer/include/dewplay3.js'></script>";
?>