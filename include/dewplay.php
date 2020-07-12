<?php
require_once dirname(__FILE__) . '/../header.php';

$xoopsLogger->activated = false ;

$player = XOOPS_URL . '/modules/ncplayer/include/';
$music = $_GET['music'];
$son = $music.'&autoplay=1&showtime=1&random=1';

//echo '
//<object type="application/x-shockwave-flash" data="'.$player.'dewplayer.swf?mp3='.$son.'" width="100%" height="20" bgcolor="#eee">
//<param name="movie" value="'.$player.'dewplayer.swf?son='.$son.'" /> 
//<param name="bgcolor" value="#eee">
//</object>';

echo '<object type="application/x-shockwave-flash" 
data="' . $player . 'dewplayer.swf?mp3=' . $son . '" width="100%" height="20" bgcolor="#ccc">
<param name="wmode" value="transparent">
<param name="bgcolor" value="#ccc">
<param name="movie" value="' . $player . 'dewplayer.swf?mp3=' . $son . '" />
</object>';

?>